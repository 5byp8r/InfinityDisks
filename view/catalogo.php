<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
<html>
<head>
    <meta charset="UTF-8">
    <title>Catálogo - Infinity Disks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white text-center">
            <h2>Catálogo de Produtos</h2>
        </div>

        <div class="card-body">

            <!-- filtro -->
            <form method="GET" action="view/catalogo.php" class="mb-4">
                <label class="form-label fw-bold">Filtrar por categoria:</label>
                <div class="input-group">
                    <select name="categoria" class="form-select">
                        <?php foreach ($categorias as $c): ?>
                            <option><?= htmlspecialchars($c) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </form>

            <h4 class="mb-3">Produtos Disponíveis</h4>

            <!-- cards dos produtos -->
            <div class="row">
                <?php foreach ($produtos as $p): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-secondary">
                            <div class="card-body">

                                <h5 class="card-title text-primary">
                                    <strong><?= htmlspecialchars($p['nome']) ?></strong>
                                </h5>

                                <p class="card-text mb-1">
                                    <strong>Categoria:</strong> <?= htmlspecialchars($p['categoria']) ?>
                                </p>

                                <p class="card-text">
                                    <strong>Preço:</strong>  
                                    R$ <?= number_format($p['preco'], 2, ",", ".") ?>
                                </p>

                                <form action="view/adicionar_carrinho.php" method="POST" class="mt-3">
                                    <input type="hidden" name="produto_id" value="<?= $p['id'] ?>">

                                    <label class="form-label">Quantidade:</label>
                                    <input type="number" name="quantidade" value="1" min="1" class="form-control mb-2">

                                    <button type="submit" class="btn btn-success w-100">
                                        Adicionar ao Carrinho
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>

</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>