<?php
require_once 'conexao.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_GET['id'])) {
    $_SESSION['mensagem'] = ['ID do produto não informado.'];
    $_SESSION['tipo_mensagem'] = 'danger';
    header('Location: tela_produtos.php');
    exit;
}

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id <= 0) {
    $_SESSION['mensagem'] = ['ID inválido.'];
    $_SESSION['tipo_mensagem'] = 'danger';
    header('Location: tela_produtos.php');
    exit;
}

try {
    $sql = 'DELETE FROM produtos WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $_SESSION['mensagem'] = ['Produto excluído com sucesso.'];
    $_SESSION['tipo_mensagem'] = 'success';
    header('Location: tela_produtos.php');
    exit;
}
catch (PDOException $e) {
    $_SESSION['mensagem'] = ['Erro ao excluir produto.'];
    $_SESSION['tipo_mensagem'] = 'danger';
    header('Location: tela_produtos.php');
    exit;
}
?>