<?php
if (session_status() === PHP_SESSION_NONE) session_start();
    require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tela_produtos.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$descricao = trim(filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS));
categoria = trim(filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS));
$tipo = trim(filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS));
$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
$preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);

$erros = [];
if ($id === false || $id <= 0)
    $erros[] = 'ID inválido.';
if (!$descricao)
    $erros[] = 'Descrição é obrigatória.';
if (!$categoria)
    $erros[] = 'Categoria é obrigatória.';
if (!$tipo || !in_array(strtolower($tipo), ['vinil','cd']))
    $erros[] = 'Tipo inválido.';
if ($quantidade === false || $quantidade < 0)
    $erros[] = 'Quantidade deve ser inteiro não negativo.';
if ($preco === false || $preco <= 0)
    $erros[] = 'Preço deve ser maior que zero.';

if (!empty($erros)) {
    $_SESSION['mensagem'] = $erros;
    $_SESSION['tipo_mensagem'] = 'danger';
    header("Location: tela_produtos.php?id={$id}");
    exit;
}

try {
    $sql = 'SELECT * FROM produtos WHERE id = :id LIMIT 1';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $produto_atual = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto_atual) {
        $_SESSION['mensagem'] = ['Produto não encontrado.'];
        $_SESSION['tipo_mensagem'] = 'danger';
        header('Location: tela_produtos.php');
        exit;
    }

    $houve_alteracao = (
        $produto_atual['descricao'] !== $descricao ||
        $produto_atual['categoria'] !== $categoria ||
        $produto_atual['tipo'] !== $tipo ||
        intval($produto_atual['quantidade']) !== intval($quantidade) ||
        floatval($produto_atual['preco']) !== floatval($preco)
    );

    if (!$houve_alteracao) {
        $_SESSION['mensagem'] = ['Nenhuma alteração foi realizada.'];
        $_SESSION['tipo_mensagem'] = 'warning';
        header("Location: tela_produtos.php?id={$id}");
        exit;
    }

    $sql = 'UPDATE produtos SET descricao = :descricao, categoria = :categoria, tipo = :tipo, quantidade = :quantidade, preco = :preco WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':descricao' => $descricao,
        ':categoria' => $categoria,
        ':tipo' => $tipo,
        ':quantidade' => $quantidade,
        ':preco' => $preco,
        ':id' => $id
    ]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = ['Produto atualizado com sucesso.'];
        $_SESSION['tipo_mensagem'] = 'success';
    }
    else {
        $_SESSION['mensagem'] = ['Nenhuma linha alterada.'];
        $_SESSION['tipo_mensagem'] = 'warning';
    }
    header('Location: tela_produtos.php');
    exit;
}
catch (PDOException $e) {
    $_SESSION['mensagem'] = ['Erro ao atualizar produto.'];
    $_SESSION['tipo_mensagem'] = 'danger';
    header("Location: tela_produtos.php?id={$id}");
    exit;
}
?>