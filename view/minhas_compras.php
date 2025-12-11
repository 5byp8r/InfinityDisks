<?php
session_start();

// compras placeholder
$compras = [
    ["id" => 101, "data" => "2001-09-11", "total" => 259.80],
    ["id" => 102, "data" => "2001-09-11", "total" => 120.00],
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Compras - Infinity Disks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header-top">
    <div class="header-logo">
        <a href="../view/home.php"><b>INFINITY DISKS</b></a>
    </div>

    <div class="header-search">
        <input class="barra" type="text" placeholder="Buscar...">
        <button class="pesquisa"><img class="image" src="procurar.svg" alt="Pesquisar"></button>
    </div>
    <div></div>
    <div class="header-actions">
        <a class="lo.ca" href="../view/login.php">LOGIN</a>
        <a class="lo.ca" href="../view/carrinho.php">CARRINHO</a>
    </div>
</header>

<nav class="navbar">
    <ul>
        <li><a href="../view/catalogo.php">Catálogo</a></li>
        <li><a href="../view/admin_cadastro_produto.php">Cadastrar Produto</a></li>
        <li><a href="../view/admin_produtos.php">Produtos</a></li>
        <li><a href="../view/admin_vendas.php">Vendas</a></li>
        <li><a href="../view/sobre.php">Sobre</a></li>
    </ul>
</nav>

<div class="page-container">

    <aside class="sidebar">
        <h3>Minha Conta</h3>
        <ul>
            <li><a href="../view/catalogo.php">Continuar Comprando</a></li>
            <li><a href="../view/logout.php">Sair</a></li>
        </ul>
    </aside>

    <section class="products">
        <h2>📋 Minhas Compras</h2>
        <br>

        <?php if (empty($compras)): ?>
            <p style="text-align: center; color: #999; padding: 40px 20px;">Você ainda não realizou compras.</p>
        <?php else: ?>

            <table style="width:100%; border-collapse: collapse;">
                <thead style="background-color: #0e0c18; color: #fff;">
                    <tr>
                        <th style="padding:12px; text-align:left; border-bottom: 2px solid #ddd;">ID da Compra</th>
                        <th style="padding:12px; text-align:left; border-bottom: 2px solid #ddd;">Data</th>
                        <th style="padding:12px; text-align:right; border-bottom: 2px solid #ddd;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($compras as $c): ?>
                    <tr style="border-bottom: 1px solid #ddd; transition: background 0.3s ease;" onmouseover="this.style.background='#f9f9f9'" onmouseout="this.style.background='white'">
                        <td style="padding:12px;">#<?= htmlspecialchars($c["id"]) ?></td>
                        <td style="padding:12px;"><?= htmlspecialchars($c["data"]) ?></td>
                        <td style="padding:12px; text-align:right; font-weight: bold; color: #e91e63;">R$ <?= number_format($c["total"], 2, ",", ".") ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>
    </section>

</div>

<footer class="footer">
    <h4>Infinity Disks</h4>
    <p>Todos os direitos reservados.</p>
</footer>

</body>
</html>