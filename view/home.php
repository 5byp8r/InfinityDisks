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

<div class="page-container">

    <section style="flex:1; text-align:center;">
        <h2>Bem-vindo(a) à Infinity Disks</h2>
        <br>

        <?php if (!isset($_SESSION['user'])): ?>

            <p>
                <a href="login.php"><button>Entrar</button></a>
                &nbsp;
                <a href="register.php"><button>Cadastrar</button></a>
            </p>

        <?php else: ?>

            <p><b>Olá, <?= htmlspecialchars($_SESSION['user']['nome']) ?>!</b></p>
            <br>

            <p>
                <a href="catalogo.php"><button>Catálogo</button></a>
                &nbsp;
                <a href="carrinho.php"><button>Carrinho</button></a>
                &nbsp;
                <a href="minhas_compras.php"><button>Minhas Compras</button></a>
                &nbsp;

                <?php if ($_SESSION['user']['tipo'] === 'admin'): ?>
                    <a href="admin_cadastro_produto.php"><button>Admin - Produtos</button></a>
                <?php endif; ?>

                &nbsp;
                <a href="logout.php"><button>Sair</button></a>
            </p>

        <?php endif; ?>
    </section>

</div>

<footer class="footer">
    <h4>Infinity Disks</h4>
    <p>Todos os direitos reservados.</p>
</footer>

</body>
</html>