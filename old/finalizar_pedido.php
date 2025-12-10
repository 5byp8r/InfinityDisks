<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'Model/conexao.php';

$cart = $_SESSION['cart'] ?? [];
if (!$cart) {
    $_SESSION['mensagem'] = ['Carrinho vazio.'];
    $_SESSION['tipo_mensagem'] = 'warning';
    header('Location: carrinho.php');
    exit;
}

try {
    $pdo->beginTransaction();

    // checa e atualiza estoque
    foreach ($cart as $id => $item) {
        $stmt = $pdo->prepare("SELECT quantidade FROM produtos WHERE id = :id FOR UPDATE");
        $stmt->execute([':id' => $id]);
        $p = $stmt->fetch();

        if (!$p) {
            $pdo->rollBack();
            $_SESSION['mensagem'] = ["Produto {$item['descricao']} não encontrado."];
            $_SESSION['tipo_mensagem'] = 'danger';
            header('Location: carrinho.php');
            exit;
        }

        if ((int)$p['quantidade'] < (int)$item['qty']) {
            $pdo->rollBack();
            $_SESSION['mensagem'] = ["Estoque insuficiente para {$item['descricao']}."];
            $_SESSION['tipo_mensagem'] = 'warning';
            header('Location: carrinho.php');
            exit;
        }

        // reduz estoque
        $stmt = $pdo->prepare("UPDATE produtos SET quantidade = quantidade - :q WHERE id = :id");
        $stmt->execute([':q' => $item['qty'], ':id' => $id]);
    }

    $pdo->commit();

    unset($_SESSION['cart']);
    $_SESSION['mensagem'] = ['Compra finalizada com sucesso (simulado). Obrigado!'];
    $_SESSION['tipo_mensagem'] = 'success';
    header('Location: tela_produtos.php');
    exit;
}
catch (PDOException $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    $_SESSION['mensagem'] = ['Erro ao finalizar pedido: ' . $e->getMessage()];
    $_SESSION['tipo_mensagem'] = 'danger';
    header('Location: carrinho.php');
    exit;
}
?>