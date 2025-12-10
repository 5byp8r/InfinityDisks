<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastrar - Infinity Disks</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header-top">
    <div class="header-logo">
        <h2>Infinity Disks</h2>
    </div>

    <div class="header-search">
        <input type="text" placeholder="Pesquisar...">
    </div>

    <div class="header-actions">
        <a href="login.php">Login</a>
        <a href="carrinho.php">Carrinho</a>
    </div>
</header>

<nav class="navbar">
    <ul>
        <li><a href="index.php">Início</a></li>
        <li><a href="catalogo.php">Catálogo</a></li>
        <li><a href="minhas_compras.php">Minhas Compras</a></li>
    </ul>
</nav>

<div class="page-container">

    <div class="products" style="max-width: 420px; margin: auto;">

        <h2 style="margin-bottom: 20px;">Criar Conta</h2>

        <form action="processa_register.php" method="POST">

            <label>Nome:</label>
            <input type="text" name="nome">

            <br><br>

            <label>Email:</label>
            <input type="email" name="email">

            <br><br>

            <label>Senha:</label>
            <input type="password" name="senha">

            <br><br>

            <button type="submit">Cadastrar</button>

        </form>
    </div>

</div>

<footer class="footer">
    <h4>Infinity Disks</h4>
    <p>Loja online de discos e tecnologia.</p>
</footer>

</body>
</html>