<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// verificacao basica (tbm fake)
$_SESSION['user']['tipo'] = "admin";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin - Cadastro de Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white text-center">
                <h2>Cadastrar Produto</h2>
            </div>

            <div class="card-body">

                <form action="view/admin_processa_cadastro_produto.php" method="POST">

                    <label class="form-label">Nome:</label><br>
                    <input type="text" name="nome" class="form-control mb-3"><br>

                    <label class="form-label">Categoria:</label><br>
                    <input type="text" name="categoria" class="form-control mb-3"><br>

                    <label class="form-label">Preço:</label><br>
                    <input type="number" step="0.01" name="preco" class="form-control mb-3"><br>

                    <label class="form-label">Estoque:</label><br>
                    <input type="number" name="estoque" class="form-control mb-3"><br>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>

                </form>

            </div>
        </div>
    </div>

    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>