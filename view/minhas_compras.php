<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// compras ilusorias
$compras = [
    ["id" => 101, "data" => "2001-09-11", "total" => 259.80],
    ["id" => 102, "data" => "2001-09-11", "total" => 120.00],
];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Minhas Compras - Infinity Disks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">

        <div class="card-header bg-dark text-white text-center">
            <h2>Minhas Compras</h2>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($compras as $c): ?>
                            <tr>
                                <td><?= $c["id"] ?></td>
                                <td><?= $c["data"] ?></td>
                                <td>R$ <?= number_format($c["total"], 2, ",", ".") ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

        </div>

    </div>
</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>