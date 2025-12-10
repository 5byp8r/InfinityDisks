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

<!-- menu de cima -->
<header class="header-top">
    <div class="header-logo">
        <a href="index.php"><b>INFINITY DISKS</b></a>
    </div>

    <div class="header-search">
        <input type="text" placeholder="Buscar...">
        <button>PESQUISAR</button>
    </div>

    <div class="header-actions">
        <a href="admin_produtos.php">ADMIN</a>
        <a href="carrinho.php">CARRINHO</a>
    </div>
</header>

<!-- menu de navegação -->
<nav class="navbar">
    <ul>
        <li><a href="catalogo.php">Catálogo</a></li>
        <li><a href="admin_cadastro_produto.php">Cadastrar Produto</a></li>
        <li><a href="admin_produtos.php">Gerenciar Produtos</a></li>
        <li><a href="admin_vendas.php">Vendas</a></li>
    </ul>
</nav>

<div class="page-container">

    <!-- sidebar -->
    <aside class="sidebar">
        <h3>Painel Admin</h3>
        <ul>
            <li><a href="admin_cadastro_produto.php">Cadastrar Produto</a></li>
            <li><a href="admin_produtos.php">Produtos</a></li>
            <li><a href="admin_vendas.php">Vendas</a></li>
        </ul>
    </aside>

    <!-- conteúdo -->
    <section class="products">
        <h2>Vendas Realizadas</h2>

        <form method="GET" action="admin_vendas.php" class="filter-form">

            <div>
                <label>Data Inicial:</label>
                <input type="date" name="data_inicio">
            </div>

            <div>
                <label>Data Final:</label>
                <input type="date" name="data_fim">
            </div>

            <div>
                <button type="submit">Filtrar</button>
            </div>

        </form>

        <table class="table">
            <tr>
                <th>ID</th>
                <th>ID Cliente</th>
                <th>Data</th>
                <th>Total</th>
            </tr>

            <?php foreach ($vendas as $v): ?>
            <tr>
                <td><?= $v["id"] ?></td>
                <td><?= $v["cliente_id"] ?></td>
                <td><?= $v["data"] ?></td>
                <td>R$ <?= number_format($v["total"], 2, ",", ".") ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

    </section>

</div>

<footer class="footer">
    <h4>Infinity Disks</h4>
    <p>Todos os direitos reservados.</p>
</footer>

</body>
</html>