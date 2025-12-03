<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'conexao.php';

$mensagens = $_SESSION['mensagem'] ?? [];
$tipo_mensagem = $_SESSION['tipo_mensagem'] ?? '';
unset($_SESSION['mensagem'], $_SESSION['tipo_mensagem']);

$cart = $_SESSION['cart'] ?? [];
$total = 0.00;
foreach ($cart as $item) {
    $total += $item['qty'] * floatval($item['preco']);
}
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
    <nav><a href="tela_produtos.php">Continuar comprando</a></nav>
</header>

<main class="container">
    <?php if ($mensagens): ?>
        <div class="alert <?= htmlspecialchars($tipo_mensagem ?: 'info') ?>">
            <ul><?php foreach ($mensagens as $m): ?><li><?= htmlspecialchars($m) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <?php if ($cart): ?>
        <table class="table-cart">
            <thead><tr><th>Produto</th><th>Qtd</th><th>Preço unit.</th><th>Subtotal</th><th>Ações</th></tr></thead>
            <tbody>
                <?php foreach ($cart as $id => $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['descricao']) ?></td>
                        <td><?= (int)$item['qty'] ?></td>
                        <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($item['qty'] * $item['preco'], 2, ',', '.') ?></td>
                        <td><a href="remover_carrinho.php?id=<?= (int)$id ?>" onclick="return confirm('Remover item?')">Remover</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="total">Total: R$ <?= number_format($total, 2, ',', '.') ?></p>

        <form action="finalizar_pedido.php" method="POST">
            <button type="submit">Finalizar compra (simulado)</button>
        </form>
    <?php else: ?>
        <p>Seu carrinho está vazio.</p>
    <?php endif; ?>
</main>

<footer class="rodape"><p>Loja de Discos — protótipo</p></footer>
</body>
</html>