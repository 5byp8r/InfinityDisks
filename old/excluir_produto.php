<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'Model/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id <= 0) {
    $_SESSION['mensagem'] = ['ID inválido.'];
    $_SESSION['tipo_mensagem'] = 'danger';
    header('Location: tela_produtos.php');
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = :id");
    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['mensagem'] = ['Produto excluído com sucesso.'];
        $_SESSION['tipo_mensagem'] = 'success';
    }
    else {
        $_SESSION['mensagem'] = ['Produto não encontrado ou já excluído.'];
        $_SESSION['tipo_mensagem'] = 'warning';
    }
}
catch (PDOException $e) {
    $_SESSION['mensagem'] = ['Erro ao excluir produto: ' . $e->getMessage()];
    $_SESSION['tipo_mensagem'] = 'danger';
}

header('Location: tela_produtos.php');
exit;
?>