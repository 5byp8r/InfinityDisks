<?php
if (session_status() === PHP_SESSION_NONE) session_start();
    require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tela_produtos.php');
    exit;
}

$descricao = trim(filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS));
categoria = trim(filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS));
$tipo = trim(filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS));
$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
$preco = filter_input(INPUT_POST, 'preco', FILTER_VALIDATE_FLOAT);


$erros = [];

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
    $_SESSION['erros_cadastro'] = $erros;
    header('Location: tela_produtos.php');
    exit;
}


try {
    $sql = "INSERT INTO produtos (descricao, categoria, tipo, quantidade, preco, data_cadastro) VALUES (:descricao, :categoria, :tipo, :quantidade, :preco, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
    ':descricao' => $descricao,
    ':categoria' => $categoria,
    ':tipo' => $tipo,
    ':quantidade' => $quantidade,
    ':preco' => $preco
    ]);


    $_SESSION['mensagem'] = ['Produto cadastrado com sucesso.'];
    $_SESSION['tipo_mensagem'] = 'success';
    header('Location: tela_produtos.php');
    exit;
}
catch (PDOException $e) {
    $_SESSION['erros_cadastro'] = ['Erro ao cadastrar produto.'];
    header('Location: tela_produtos.php');
    exit;
}
?>