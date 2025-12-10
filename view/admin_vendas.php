<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// vendas fake
$vendas = [
    ["id" => 1001, "cliente_id" => 8, "data" => "2001-09-11", "total" => 180.00],
    ["id" => 1002, "cliente_id" => 12, "data" => "2001-09-11", "total" => 320.00],
];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin - Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white text-center">
            <h2>Vendas Realizadas</h2>
        </div>

        <div class="card-body">

            <form method="GET" action="view/admin_vendas.php" class="row g-3 mb-4">

                <div class="col-md-4">
                    <label class="form-label">Data Inicial:</label>
                    <input type="date" name="data_inicio" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Data Final:</label>
                    <input type="date" name="data_fim" class="form-control">
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                </div>

            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">

                    <tr class="table-dark">
                        <th>ID</th>
                        <th>ID Cliente</th>
                        <th>Data</th>
                        <th>Total</th>
                    </tr>

                    <?php foreach ($vendas as $v): ?>
                        <tr>
                            <td><?= $v["id"] ?></td>
                            <td><?= $v["cliente_id"] ?></td>
                            <td><?= $v["data"] ?></td>
                            <td>R$ <?= number_format($v["total"], 2, ",", ".") ?></td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </div>

        </div>
    </div>

</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>