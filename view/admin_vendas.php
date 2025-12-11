<?php
session_start();

// vendas fake
$vendas = [
    ["id" => 1001, "cliente_id" => 8, "data" => "2008-06-23", "total" => 180.00],
    ["id" => 1002, "cliente_id" => 12, "data" => "1991-06-23", "total" => 320.00],
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin - Vendas</title>
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
        <h3>Painel Admin</h3>
        <ul>
            <li><a href="admin_cadastro_produto.php">Cadastrar Produto</a></li>
            <li><a href="admin_produtos.php">Produtos</a></li>
            <li><a href="admin_vendas.php">Vendas</a></li>
        </ul>
    </aside>

    <section class="products">
        <h2>💰 Vendas Realizadas</h2>
        <br>

        <form method="GET" action="admin_vendas.php" style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Data Inicial:</label>
                <input type="date" name="data_inicio" style="padding: 8px; border-radius: 4px; border: 1px solid #ddd;">
            </div>

            <div>
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Data Final:</label>
                <input type="date" name="data_fim" style="padding: 8px; border-radius: 4px; border: 1px solid #ddd;">
            </div>

            <div style="display: flex; align-items: flex-end;">
                <button type="submit" style="padding: 8px 16px; background: #e91e63; color: white; border: none; border-radius: 4px; cursor: pointer;">Filtrar</button>
            </div>
        </form>

        <table style="width:100%; border-collapse: collapse;">
            <thead style="background-color: #0e0c18; color: #fff;">
                <tr>
                    <th style="padding:12px; text-align:left; border-bottom: 2px solid #ddd;">ID Venda</th>
                    <th style="padding:12px; text-align:left; border-bottom: 2px solid #ddd;">ID Cliente</th>
                    <th style="padding:12px; text-align:left; border-bottom: 2px solid #ddd;">Data</th>
                    <th style="padding:12px; text-align:right; border-bottom: 2px solid #ddd;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vendas as $v): ?>
                <tr style="border-bottom: 1px solid #ddd; transition: background 0.3s ease;" onmouseover="this.style.background='#f9f9f9'" onmouseout="this.style.background='white'">
                    <td style="padding:12px;">#<?= htmlspecialchars($v["id"]) ?></td>
                    <td style="padding:12px;"> <?= htmlspecialchars($v["cliente_id"]) ?></td>
                    <td style="padding:12px;"><?= htmlspecialchars($v["data"]) ?></td>
                    <td style="padding:12px; text-align:right; font-weight: bold; color: #e91e63;">R$ <?= number_format($v["total"], 2, ",", ".") ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

</div>

<footer class="footer">
    <h4>Infinity Disks</h4>
    <p>Todos os direitos reservados.</p>
</footer>

</body>
</html>