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

<div class="page-container">

    <aside class="sidebar">
        <h3>Painel Admin</h3>
        <ul>
            <li><a href="admin_cadastro_produto.php">Cadastrar Produto</a></li>
            <li><a href="admin_produtos.php">Produtos</a></li>
        </ul>
    </aside>

    <section class="products">
        <h2>Produtos Cadastrados</h2>

        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Ação</th>
            </tr>

            <?php foreach ($produtos as $p): ?>
            <tr>
                <td><?= $p["id"] ?></td>
                <td><?= htmlspecialchars($p["nome"]) ?></td>
                <td><?= htmlspecialchars($p["categoria"]) ?></td>
                <td>R$ <?= number_format($p["preco"], 2, ",", ".") ?></td>
                <td>
                    <form action="admin_remover_produto.php" method="POST">
                        <input type="hidden" name="id" value="<?= $p["id"] ?>">
                        <button class="delete-btn" type="submit">Excluir</button>
                    </form>
                </td>
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