<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Infinity Disks - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header-top">
    <div class="header-logo">
        <a href="home.php"><b>INFINITY DISKS</b></a>
    </div>

    <div class="header-search">
        <input class="barra" type="text" placeholder="Buscar...">
        <button class="pesquisa"><img class="image" src="procurar.svg" alt="Pesquisar"></button>
    </div>
    <div></div>
    <div class="header-actions">
        <a class="lo.ca" href="login.php">LOGIN</a>
        <a class="lo.ca" href="carrinho.php">CARRINHO</a>
    </div>
</header>

<nav class="navbar">
    <ul>
        <li><a href="catalogo.php">Catálogo</a></li>
        <li><a href="admin_cadastro_produto.php">Cadastrar Produto</a></li>
        <li><a href="admin_produtos.php">Produtos</a></li>
        <li><a href="admin_vendas.php">Vendas</a></li>
        <li><a href="sobre.php">Sobre</a></li>
    </ul>
</nav>

<div class="page-container">

    <aside class="sidebar">
        <h3>Bem-vindo(a)</h3>
        <ul>
            <li><a href="catalogo.php">Ir para Catálogo</a></li>
        </ul>
    </aside>

    <section class="products">
        <h2>Bem-vindo(a) à Infinity Disks</h2>
        <br>

        <?php if (!isset($_SESSION['user'])): ?>

            <div style="text-align:center; padding:40px 20px;">
                <p style="font-size: 1.2rem; margin-bottom: 30px;">Faça login ou crie uma conta para começar</p>
                <a href="login.php"><button class="btn-primary">Entrar</button></a>
                &nbsp;
                <a href="register.php"><button class="btn-secondary">Cadastrar</button></a>
            </div>

        <?php else: ?>

            <div style="text-align:center; padding:40px 20px;">
                <p style="font-size: 1.3rem; font-weight: bold; margin-bottom: 30px;">Olá, <?= htmlspecialchars($_SESSION['user']['nome']) ?>! 👋</p>
                <br>

                <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;">
                    <a href="catalogo.php"><button class="btn-primary">Catálogo</button></a>
                    <a href="carrinho.php"><button class="btn-primary">Carrinho</button></a>
                    <a href="minhas_compras.php"><button class="btn-primary">Minhas Compras</button></a>

                    <?php if ($_SESSION['user']['tipo'] === 'admin'): ?>
                        <a href="admin_cadastro_produto.php"><button class="btn-warning">Admin - Produtos</button></a>
                    <?php endif; ?>

                    <a href="logout.php"><button class="btn-danger">Sair</button></a>
                </div>
            </div>

        <?php endif; ?>
    </section>

</div>

<footer class="footer">
    <h4>Infinity Disks</h4>
    <p>Todos os direitos reservados.</p>
</footer>

</body>
</html>

</body>
</html>