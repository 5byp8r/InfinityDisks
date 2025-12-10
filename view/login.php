<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Infinity Disks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header-top">
    <div class="header-logo">
        <a href="index.php"><b>INFINITY DISKS</b></a>
    </div>

    <div class="header-search">
        <input type="text" placeholder="Buscar...">
        <button>PESQUISAR</button>
    </div>

    <div class="header-actions">
        <a href="carrinho.php">CARRINHO</a>
    </div>
</header>

<nav class="navbar">
    <ul>
        <li><a href="catalogo.php">Catálogo</a></li>
        <li><a href="sobre.php">Sobre</a></li>
    </ul>
</nav>

<div class="page-container" style="justify-content:center;">

    <div style="width: 380px; border:1px solid #ddd; padding:25px;">

        <h2 style="text-align:center; margin-bottom:18px;">Login</h2>

        <form action="processa_login.php" method="POST" style="display:flex; flex-direction:column; gap:12px;">

            <label for="email">Email:</label>
            <input type="email" name="email" style="padding:10px; border:1px solid #aaa;">

            <label for="senha">Senha:</label>
            <input type="password" name="senha" style="padding:10px; border:1px solid #aaa;">

            <button type="submit">Entrar</button>
        </form>

        <p style="text-align:center; margin-top:14px;">
            <a href="register.php">Criar conta</a>
        </p>
    </div>

</div>

<footer class="footer">
    <h4>Infinity Disks</h4>
    <p>Todos os direitos reservados.</p>
</footer>

</body>
</html>