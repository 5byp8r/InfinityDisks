<?php
require_once "../model/Usuario.php";
require_once "../model/CD.php";
require_once "../model/ItemVenda.php";
require_once "../model/Venda.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$categorias = ["Todos", "Vinil", "CD", "cinema"];

$produtos = CD::getAll();

if (isset($_GET['categoria']) && $_GET['categoria'] !== "Todos") {
    $cat = strtolower($_GET['categoria']);
    $produtos = array_filter($produtos, function ($p) use ($cat) {
        return strtolower($p->getCategoria()) === $cat;
    });
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Catálogo - Infinity Disks</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="header-top">
        <div class="header-logo">
            <a href="../view/home.php"><b>INFINITY DISKS</b></a>
        </div>

        <div class="header-search">
            <input class="barra" type="text" placeholder="Buscar produtos...">
            <button class="pesquisa"><img class="image" src="procurar.svg" alt="Pesquisar"></button>
        </div>
        <div></div>
        <div class="header-actions">
            <a class="lo.ca" href="../view/login.php">LOGIN</a>
            <a class="lo.ca" href="../view/carrinho.php">CARRINHO</a>
            
        </div>
    </header>
    
        <!-- Banner centralizado com ecos -->
        <div class="banner-wrapper">
            <img class="banner-echo echo1" src="imgBanner.png" alt="eco">
            <img class="banner-echo echo2" src="imgBanner.png" alt="eco">
            <img class="banner-echo echo3" src="imgBanner.png" alt="eco">
            <img class="banner-echo echo4" src="imgBanner.png" alt="eco">
            <img class="banner-echo echo5" src="imgBanner.png" alt="eco">
            <img class="banner-main" src="imgBanner.png" alt="Banner Infinity Disks">
        </div>

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
            <h3>Categorias</h3>
            <ul>
                <?php foreach ($categorias as $c): ?>
                    <li>
                        <a href="../view/catalogo.php?categoria=<?= urlencode($c) ?>">
                            <?= htmlspecialchars($c) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <section class="products">
            <h2>Produtos Disponíveis</h2>
            <br>

            <div class="products-grid">

                <?php if (empty($produtos)): ?>
                    <p>Nenhum produto encontrado.</p>

                <?php else: ?>
                    <?php foreach ($produtos as $p): ?>
                        <div class="product-card">

                            <div class="product-name">
                                <?= htmlspecialchars($p->getDescricao()) ?>
                            </div>
<img class="disc" src="disc_icon.png" alt="">
                            <p><strong>Categoria:</strong> <?= htmlspecialchars($p->getCategoria()) ?></p>

                            <p class="product-price">
                                R$ <?= number_format($p->getPreco(), 2, ",", ".") ?>
                            </p>

                            <!-- Formulário integrado com o controller -->
                            <form action="../controller/controller.php" method="POST" style="display: flex; gap: 8px;">

                                <?php if (!isset($_SESSION['venda_atual'])): ?>
                                    <input type="hidden" name="action" value="criarVenda">
                                    <button type="submit" style="flex: 1; padding: 8px;">
                                        Iniciar Compra
                                    </button>

                                <?php else: ?>
                                    <input type="hidden" name="action" value="adicionarItemVenda">
                                    <input type="hidden" name="id_cd" value="<?= $p->getId() ?>">
                                    <input type="number" name="quantidade" value="1" min="1"
                                        style="width: 60px; padding: 8px; border-radius: 4px; border: 1px solid #ddd;">
                                    <button type="submit" style="flex: 1; padding: 8px;">
                                        Comprar
                                    </button>
                                <?php endif; ?>

                            </form>

                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>

        </section>
    </div>

    <footer class="footer">
        <h4>Infinity Disks</h4>
        <p>Todos os direitos reservados.</p>
    </footer>

</body>

</html>