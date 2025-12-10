<?php
session_start();
// verificacao simples (fake)
$_SESSION['user']['tipo'] = "admin";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin - Cadastro de Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header-top">
    <div class="header-logo">
        <a href="index.php"><b>INFINITY DISKS</b></a>
    </div>

    <div></div>

    <div class="header-actions">
        <a href="catalogo.php">CATÁLOGO</a>
        <a href="logout.php">SAIR</a>
    </div>
</header>

<div class="container">

    <div class="box">
        <h2>Cadastrar Produto</h2>

        <form action="admin_processa_cadastro_produto.php" method="POST" class="admin-form">

            <label>Nome do Produto</label>
            <input type="text" name="nome" required>

            <label>Categoria</label>
            <select name="categoria" required>
                <option value="Vinil">Vinil</option>
                <option value="CD">CD</option>
                <option value="cinema">Cinema</option>
            </select>

            <label>Preço (R$)</label>
            <input type="number" step="0.01" name="preco" required>

            <label>Estoque</label>
            <input type="number" name="estoque" min="1" required>

            <button type="submit" class="btn-dark">Cadastrar</button>

        </form>
    </div>

</div>

</body>
</html>