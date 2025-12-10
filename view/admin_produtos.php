<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// produtos fake
$produtos = [
    ["id" => 1, "nome" => "live and learn - crush 40", "categoria" => "cinema", "preco" => 120.00],
    ["id" => 2, "nome" => "billie jean - michael jackson", "categoria" => "Vinil", "preco" => 99.90],
];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin - Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        
        <div class="card-header bg-dark text-white text-center">
            <h3>Produtos Cadastrados</h3>
        </div>

        <div class="card-body">

            <table class="table table-striped table-bordered table-hover align-middle">
                <tr class="table-primary text-center">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>

                <?php foreach ($produtos as $p): ?>
                    <tr>
                        <td class="text-center"><?= $p["id"] ?></td>
                        <td><?= htmlspecialchars($p["nome"]) ?></td>
                        <td><?= htmlspecialchars($p["categoria"]) ?></td>
                        <td>R$ <?= number_format($p["preco"], 2, ",", ".") ?></td>
                        <td class="text-center">
                            <form action="view/admin_remover_produto.php" method="POST">
                                <input type="hidden" name="id" value="<?= $p["id"] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>

        </div>
    </div>
</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>