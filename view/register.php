<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastrar - Infinity Disks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2>Criar Conta</h2>
        </div>

        <div class="card-body">

            <form action="processa_register.php" method="POST">

                <label class="form-label">Nome:</label><br>
                <input type="text" name="nome" class="form-control mb-3"><br>

                <label class="form-label">Email:</label><br>
                <input type="email" name="email" class="form-control mb-3"><br>

                <label class="form-label">Senha:</label><br>
                <input type="password" name="senha" class="form-control mb-3"><br>

                <button type="submit" class="btn btn-success w-100">Cadastrar</button>

            </form>

        </div>
    </div>
</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>