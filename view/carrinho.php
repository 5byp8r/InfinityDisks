<?php
require_once "../model/Usuario.php";
require_once "../model/CD.php";
require_once "../model/ItemVenda.php";
require_once "../model/Venda.php";

session_start();


$venda = isset($_SESSION['venda_atual']) ? $_SESSION['venda_atual'] : null;

$itens = $venda ? $venda->getItens() : [];

$total = 0;
foreach ($itens as $item) {
    $total += $item->getCd()->getPreco() * $item->getQuantidade();
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
            <a href="../view/home.php"><b>INFINITY DISKS</b></a>
        </div>

        <div class="header-search">
            <input class="barra" type="text" placeholder="Buscar...">
            <button class="pesquisa"><img class="image" src="procurar.svg" alt="Pesquisar"></button>
        </div>

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
            <h3>Opções</h3>
            <ul>
                <li><a href="../view/catalogo.php">Continuar Comprando</a></li>
            </ul>
        </aside>

        <section class="products">
            <h2>Seu Carrinho</h2>
            <br>

            <?php if (!$venda || count($itens) == 0): ?>
                <p>Nenhum item no carrinho.</p>

            <?php else: ?>

                <?php foreach ($itens as $index => $item): ?>
                    <div style="border:1px solid #ccc; padding:12px; margin-bottom:10px;">
                        <p><strong><?= htmlspecialchars($item->getCd()->getDescricao()) ?></strong></p>

                        <p>Quantidade: <?= $item->getQuantidade() ?></p>

                        <p>Preço unitário:
                            R$ <?= number_format($item->getCd()->getPreco(), 2, ",", ".") ?>
                        </p>

                        <form action="../controller/controller.php?action=removerItemVenda" method="POST">
                            <input type="hidden" name="index" value="<?= $index ?>">
                            <button>Remover</button>
                        </form>
                    </div>
                <?php endforeach; ?>

                <h3 style="text-align:right; margin-top:20px;">
                    Total: R$ <?= number_format($total, 2, ",", ".") ?>
                </h3>

                <form action="../controller/controller.php?action=finalizarVenda" method="POST"
                    style="text-align:right; margin-top:10px;">
                    <button>Confirmar Compra</button>
                </form>

            <?php endif; ?>

        </section>

    </div>

    <footer class="footer">
        <h4>Infinity Disks</h4>
        <p>Todos os direitos reservados.</p>
    </footer>

</body>

</html>