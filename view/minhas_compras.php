<?php
session_start();

// compras ilusorias
$compras = [
    ["id" => 101, "data" => "2001-09-11", "total" => 259.80],
    ["id" => 102, "data" => "2001-09-11", "total" => 120.00],
];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Minhas Compras - Infinity Disks</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<header class="header-top">
    <div class="header-logo">
        <h2>Infinity Disks</h2>
    </div>

    <div class="header-search">
        <input type="text" placeholder="Pesquisar..." class="form-control">
    </div>

    <div class="header-actions">
        <a href="carrinho.php">🛒</a>
        <a href="login.php">Login</a>
    </div>
</header>

<nav class="navbar">
    <ul>
        <li><a href="index.php">Início</a></li>
        <li><a href="produtos.php">Produtos</a></li>
        <li><a href="categorias.php">Categorias</a></li>
        <li><a href="compras.php">Minhas Compras</a></li>
    </ul>
</nav>

<div class="page-container">

    <aside class="sidebar">
        <h3>Minha Conta</h3>
        <ul>
            <li><a href="perfil.php">Perfil</a></li>
            <li><a href="compras.php">Compras</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </aside>

    <section class="products" style="font-size:16px;">
        <h2 style="margin-bottom:20px;">Minhas Compras</h2>

        <table style="width:100%; border-collapse: collapse;">
            <thead style="background:#0e0c18; color:#fff;">
                <tr>
                    <th style="padding:10px; text-align:left;">ID</th>
                    <th style="padding:10px; text-align:left;">Data</th>
                    <th style="padding:10px; text-align:left;">Total</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($compras as $c): ?>
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:10px;"><?= $c["id"] ?></td>
                    <td style="padding:10px;"><?= $c["data"] ?></td>
                    <td style="padding:10px;">R$ <?= number_format($c["total"], 2, ",", ".") ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

</div>

<footer class="footer">
    <h4>Infinity Disks</h4>
    <p>Sua loja de tecnologia.</p>
</footer>

</body>
</html>