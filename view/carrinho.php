<?php
session_start();

// carrinho placeholder
$carrinho = [
    ["id" => 1, "nome" => "live and learn - crush 40", "preco" => 120.00, "quantidade" => 2],
    ["id" => 2, "nome" => "billie jean - michael jackson", "preco" => 9.90, "quantidade" => 1],
];

$total = 0;
foreach ($carrinho as $item) {
    $total += $item["preco"] * $item["quantidade"];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho - Infinity Disks</title>
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
        <a href="login.php">LOGIN</a>
        <a href="carrinho.php">CARRINHO</a>
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
        <h3>Opções</h3>
        <ul>
            <li><a href="catalogo.php">Continuar Comprando</a></li>
        </ul>
    </aside>

    <!-- itens do carrinho -->
    <section class="products">
        <h2>Seu Carrinho</h2>
        <br>

        <?php foreach ($carrinho as $item): ?>
            <div style="border:1px solid #ccc; padding:12px; margin-bottom:10px;">
                <p><strong><?= htmlspecialchars($item["nome"]) ?></strong></p>
                <p>Quantidade: <?= $item["quantidade"] ?></p>
                <p>Preço Unitário: R$ <?= number_format($item["preco"], 2, ",", ".") ?></p>

                <form action="remover_item.php" method="POST">
                    <input type="hidden" name="produto_id" value="<?= $item["id"] ?>">
                    <button>Remover</button>
                </form>
            </div>
        <?php endforeach; ?>

        <h3 style="text-align:right; margin-top:20px;">
            Total: R$ <?= number_format($total, 2, ",", ".") ?>
        </h3>

        <form action="confirmar_compra.php" method="POST" style="text-align:right; margin-top:10px;">
            <button>Confirmar Compra</button>
        </form>
    </section>

</div>

<footer class="footer">
    <h4>Infinity Disks</h4>
    <p>Todos os direitos reservados.</p>
</footer>

</body>
</html>