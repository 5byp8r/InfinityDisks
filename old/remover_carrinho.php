<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id <= 0) {
    $_SESSION['mensagem'] = ['Item inválido.'];
    $_SESSION['tipo_mensagem'] = 'danger';
    header('Location: carrinho.php');
    exit;
}

if (isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
    $_SESSION['mensagem'] = ['Item removido do carrinho.'];
    $_SESSION['tipo_mensagem'] = 'success';
}
else {
    $_SESSION['mensagem'] = ['Item não encontrado no carrinho.'];
    $_SESSION['tipo_mensagem'] = 'warning';
}

header('Location: carrinho.php');
exit;
?>