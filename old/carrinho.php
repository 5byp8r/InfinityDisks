<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$venda = $_SESSION['venda_atual'] ?? null;
$mensagem = $_SESSION['erro'] ?? $_SESSION['sucesso'] ?? '';
unset($_SESSION['erro'], $_SESSION['sucesso']);

$itens = $venda ? $venda->getItens() : [];
$total = $venda ? $venda->getValorVenda() : 0.00;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Carrinho - Infinity Disks</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<header class="topo">
    <h1>Carrinho</h1>
    <nav><a href="catalogo.php">Continuar comprando</a></nav>
</header>

<main class="container">

    <?php if ($mensagem): ?>
        <div class="alert">
            <?= htmlspecialchars($mensagem) ?>
        </div>
    <?php endif; ?>

    <?php if ($venda && $itens): ?>
        <table class="table-cart">
            <thead>
            <tr>
                <th>Produto</th>
                <th>Qtd</th>
                <th>Preço unit.</th>
                <th>Subtotal</th>
                <th>Ações</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($itens as $index => $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item->getCd()->getDescricao()) ?></td>
                    <td><?= (int)$item->getQuantidade() ?></td>
                    <td>R$ <?= number_format($item->getCd()->getPreco(), 2, ',', '.') ?></td>
                    <td>R$ <?= number_format($item->getCd()->getPreco() * $item->getQuantidade(), 2, ',', '.') ?></td>
                    <td>
                        <form action="../Controller/controller.php?action=removerItemVenda" method="POST">
                            <input type="hidden" name="index" value="<?= $index ?>">
                            <button type="submit">Remover</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <p class="total">Total: R$ <?= number_format($total, 2, ',', '.') ?></p>

        <form action="../Controller/controller.php?action=finalizarVenda" method="POST">
            <button type="submit">Finalizar compra</button>
        </form>

    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
    <?php endif; ?>

</main>

<footer class="rodape">
    <p>Loja de Discos — protótipo</p>
</footer>

</body>
</html>
