<?php
session_start();

// categorias placeholder
$categorias = ["Todos", "Vinil", "CD", "cinema"];

// produtos fake
$produtos = [
    ["id" => 1, "nome" => "live and learn - crush 40", "categoria" => "cinema", "preco" => 120.00],
    ["id" => 2, "nome" => "billie jean - michael jackson", "categoria" => "Vinil", "preco" => 99.90],
    ["id" => 3, "nome" => "cansei de pensar em exemplo", "categoria" => "CD", "preco" => 39.90],
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Catálogo - Infinity Disks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- menu de cima -->
<header class="header-top">
    <div class="header-logo">
        <a href="index.php">
            <b>INFINITY DISKS
        </a>
    </div>

    <div class="header-search">
        <input type="text" placeholder="Buscar produtos...">
        <button>PESQUISAR</button>
    </div>

    <div class="header-actions">
        <a href="login.php">LOGIN</a>
        <a href="carrinho.php">CARRINHO</a>
    </div>
</header>

<!-- menu de categoiras -->
<nav class="navbar">
    <ul>
        <?php foreach ($categorias as $c): ?>
            <li><a href="catalogo.php?categoria=<?= urlencode($c) ?>"><?= htmlspecialchars($c) ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>

<div class="page-container">

    <!-- sidebart -->
    <aside class="sidebar">
        <h3>Categorias</h3>
        <ul>
            <?php foreach ($categorias as $c): ?>
                <li><a href="catalogo.php?categoria=<?= urlencode($c) ?>"><?= htmlspecialchars($c) ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <!-- produtos -->
    <section class="products">
        
        <h2>Produtos Disponíveis</h2>

        <div class="products-grid">
            <?php foreach ($produtos as $p): ?>
            <div class="product-card">

                <div class="product-name">
                    <?= htmlspecialchars($p['nome']) ?>
                </div>

                <p><?= htmlspecialchars($p['categoria']) ?></p>

                <p class="product-price">R$ <?= number_format($p['preco'], 2, ",", ".") ?></p>

                <form action="adicionar_carrinho.php" method="POST">
                    <input type="hidden" name="produto_id" value="<?= $p['id'] ?>">
                    <input type="number" name="quantidade" value="1" min="1">
                    <button type="submit">Comprar</button>
                </form>

            </div>
            <?php endforeach; ?>
        </div>

    </section>
</div>

<footer class="footer">
    <h4>Infinity Disks</h4>
    <p>Todos os direitos reservados.</p>
</footer>

</body>
</html>
