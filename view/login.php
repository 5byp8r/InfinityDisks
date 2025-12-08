<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - Infinity Disks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 400px;">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-dark text-white">
            <h3 class="m-0">Login</h3>
        </div>

        <div class="card-body">

            <h1 class="text-center mb-4" style="font-size: 1.5rem;">Login</h1>

            <form action="processa_login.php" method="POST">

                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control mb-3">

                <label class="form-label">Senha:</label>
                <input type="password" name="senha" class="form-control mb-4">

                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>

            <p class="text-center mt-3">
                <a href="register.php" class="text-decoration-none">Criar conta</a>
            </p>

        </div>
    </div>
</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>