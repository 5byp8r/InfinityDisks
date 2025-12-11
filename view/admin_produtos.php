<?php
session_start();

// produtos fake
$produtos = [
    ["id" => 1, "nome" => "live and learn - crush 40", "categoria" => "cinema", "preco" => 120.00],
    ["id" => 2, "nome" => "billie jean - michael jackson", "categoria" => "Vinil", "preco" => 99.90],
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin - Produtos</title>
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
        <h2>⚠️ Produtos Cadastrados</h2>
        <br>

        <table style="width:100%; border-collapse: collapse;">
            <thead style="background-color: #0e0c18; color: #fff;">
                <tr>
                    <th style="padding:12px; text-align:left; border-bottom: 2px solid #ddd;">ID</th>
                    <th style="padding:12px; text-align:left; border-bottom: 2px solid #ddd;">Nome</th>
                    <th style="padding:12px; text-align:left; border-bottom: 2px solid #ddd;">Categoria</th>
                    <th style="padding:12px; text-align:left; border-bottom: 2px solid #ddd;">Preço</th>
                    <th style="padding:12px; text-align:center; border-bottom: 2px solid #ddd;">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $p): ?>
                <tr style="border-bottom: 1px solid #ddd; transition: background 0.3s ease;" onmouseover="this.style.background='#f9f9f9'" onmouseout="this.style.background='white'">
                    <td style="padding:12px;">#<?= htmlspecialchars($p["id"]) ?></td>
                    <td style="padding:12px;"><?= htmlspecialchars($p["nome"]) ?></td>
                    <td style="padding:12px;"><?= htmlspecialchars($p["categoria"]) ?></td>
                    <td style="padding:12px; font-weight: bold; color: #e91e63;">R$ <?= number_format($p["preco"], 2, ",", ".") ?></td>
                    <td style="padding:12px; text-align:center;">
                        <form action="remover_produto.php" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $p["id"] ?>">
                            <button type="submit" style="background: #dc3545; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer;">Excluir</button>
                        </form>
                    </td>
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