<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Infinity Disks - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white text-center">
            <h2>Bem-vindo(a) à Infinity Disks</h2>
        </div>

        <div class="card-body text-center">

            <?php if (!isset($_SESSION['user'])): ?>

                <p class="mt-3">
                    <a href="view/login.php" class="btn btn-primary me-2">Entrar</a>
                    <a href="view/register.php" class="btn btn-outline-primary">Cadastrar</a>
                </p>

            <?php else: ?>

                <p class="fw-bold fs-5">Olá, <?= htmlspecialchars($_SESSION['user']['nome']) ?>!</p>

                <p class="mt-3">
                    <a href="view/catalogo.php" class="btn btn-outline-dark me-2">Catálogo</a>
                    <a href="view/carrinho.php" class="btn btn-outline-dark me-2">Carrinho</a>
                    <a href="view/minhas_compras.php" class="btn btn-outline-dark me-2">Minhas Compras</a>

                    <?php if ($_SESSION['user']['tipo'] === 'admin'): ?>
                        <a href="view/admin_cadastro_produto.php" class="btn btn-warning me-2">Admin - Produtos</a>
                    <?php endif; ?>

                    <a href="view/logout.php" class="btn btn-danger">Sair</a>
                </p>

            <?php endif; ?>

        </div>
    </div>
</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>