<?php // leitura_produtos.php - busca produtos do banco
require_once 'Model/conexao.php';

try {
    $sql = "SELECT * FROM produtos ORDER BY data_cadastro DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll();
}
catch (PDOException $e) {
    $produtos = [];
}
?>
