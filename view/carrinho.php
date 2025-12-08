<?php
session_start();

// carrinho placegolder
$carrinho = [
    ["nome" => "live and learn - crush 40", "preco" => 120.00, "quantidade" => 2],
    ["nome" => "billie jean - michael jackson", "preco" => 9.90, "quantidade" => 1],
];

$total = 0;
foreach ($carrinho as $item) {
    $total += $item["preco"] * $item["quantidade"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Carrinho - Infinity Disks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white text-center">
            <h2>Seu Carrinho</h2>
        </div>

        <div class="card-body">

            <?php foreach ($carrinho as $item): ?>
                <div class="card mb-3 border-secondary">
                    <div class="card-body">
                        <p class="fw-bold mb-1"><?= htmlspecialchars($item["nome"]) ?></p>
                        <p class="mb-1">Quantidade: <strong><?= $item["quantidade"] ?></strong></p>
                        <p class="mb-0">Preço Unitário: <strong>R$ <?= number_format($item["preco"], 2, ",", ".") ?></strong></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <h3 class="text-end me-2">
                Total: <span class="text-success">R$ <?= number_format($total, 2, ",", ".") ?></span>
            </h3>

            <form action="confirmar_compra.php" method="POST" class="text-end">
                <button type="submit" class="btn btn-success">Confirmar Compra</button>
            </form>

            <form action="remover_item.php" method="POST">
                <input type="hidden" name="produto_id" value="<?= $id ?>">
                <button class="btn btn-danger btn-sm">Remover</button>
            </form>
        </div>
    </div>
</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>