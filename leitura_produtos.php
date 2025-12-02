<?php
require_once 'conexao.php';

try {
    $sql = "SELECT * FROM produtos ORDER BY data_cadastro DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['produtos'] = $produtos;
}
catch (PDOException $e) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $_SESSION['mensagem'] = ['Erro ao recuperar produtos.'];
    $_SESSION['tipo_mensagem'] = 'danger';
    $produtos = [];
}
?>