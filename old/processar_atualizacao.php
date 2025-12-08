<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tela_produtos.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$descricao  = trim($_POST['descricao'] ?? '');
$categoria  = trim($_POST['categoria'] ?? '');
$tipo       = trim($_POST['tipo'] ?? '');
$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
$preco      = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);

$erros = [];
if ($id === false || $id <= 0) $erros[] = 'ID inválido.';
if ($descricao === '') $erros[] = 'Descrição é obrigatória.';
if ($categoria === '') $erros[] = 'Categoria é obrigatória.';
if (!$tipo || !in_array(strtolower($tipo), ['vinil', 'cd'])) $erros[] = 'Tipo inválido.';
if ($quantidade === false || $quantidade < 0) $erros[] = 'Quantidade inválida.';
if ($preco === false || $preco <= 0) $erros[] = 'Preço inválido.';

if ($erros) {
    $_SESSION['mensagem'] = $erros;
    $_SESSION['tipo_mensagem'] = 'danger';
    header("Location: tela_produtos.php");
    exit;
}

try {
    // verifica existencia
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $id]);
    $atual = $stmt->fetch();

    if (!$atual) {
        $_SESSION['mensagem'] = ['Produto não encontrado.'];
        $_SESSION['tipo_mensagem'] = 'danger';
        header('Location: tela_produtos.php');
        exit;
    }

    $sql = "UPDATE produtos
            SET descricao = :descricao, categoria = :categoria, tipo = :tipo, quantidade = :quantidade, preco = :preco
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':descricao' => $descricao,
        ':categoria' => $categoria,
        ':tipo' => strtolower($tipo),
        ':quantidade' => $quantidade,
        ':preco' => $preco,
        ':id' => $id
    ]);

    $_SESSION['mensagem'] = ['Produto atualizado com sucesso.'];
    $_SESSION['tipo_mensagem'] = 'success';
} 
catch (PDOException $e) {
    $_SESSION['mensagem'] = ['Erro ao atualizar produto: ' . $e->getMessage()];
    $_SESSION['tipo_mensagem'] = 'danger';
}

header('Location: tela_produtos.php');
exit;
?>