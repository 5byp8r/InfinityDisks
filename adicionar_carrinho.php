<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'Model/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tela_produtos.php');
    exit;
}

$produto_id = filter_input(INPUT_POST, 'produto_id', FILTER_VALIDATE_INT);
$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);

if ($produto_id === false || $produto_id <= 0 || $quantidade === false || $quantidade <= 0) {
    $_SESSION['mensagem'] = ['Dados inválidos para adicionar ao carrinho.'];
    $_SESSION['tipo_mensagem'] = 'danger';
    header('Location: tela_produtos.php');
    exit;
}

// obtem o produto para verificar estoque
try {
    $stmt = $pdo->prepare("SELECT id, descricao, preco, quantidade FROM produtos WHERE id = :id LIMIT 1");
    $stmt->execute([':id' => $produto_id]);
    $produto = $stmt->fetch();

    if (!$produto) {
        $_SESSION['mensagem'] = ['Produto não encontrado.'];
        $_SESSION['tipo_mensagem'] = 'danger';
        header('Location: tela_produtos.php');
        exit;
    }

    if ($quantidade > (int)$produto['quantidade']) {
        $_SESSION['mensagem'] = ['Quantidade solicitada excede o estoque.'];
        $_SESSION['tipo_mensagem'] = 'warning';
        header('Location: tela_produtos.php');
        exit;
    }

    // inicializa carrinho na sessão: array produto_id => ['qty'=>x, 'descricao'=>..., 'preco'=>...]
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

    if (isset($_SESSION['cart'][$produto_id])) {
        $_SESSION['cart'][$produto_id]['qty'] += $quantidade;
    }
    else {
        $_SESSION['cart'][$produto_id] = [
            'qty' => $quantidade,
            'descricao' => $produto['descricao'],
            'preco' => $produto['preco']
        ];
    }

    $_SESSION['mensagem'] = ['Produto adicionado ao carrinho.'];
    $_SESSION['tipo_mensagem'] = 'success';
    header('Location: tela_produtos.php');
    exit;
}
catch (PDOException $e) {
    $_SESSION['mensagem'] = ['Erro ao adicionar ao carrinho.'];
    $_SESSION['tipo_mensagem'] = 'danger';
    header('Location: tela_produtos.php');
    exit;
}
?>