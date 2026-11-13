<?php
require_once "../model/ConexaoBD.php";
require_once "../model/Usuario.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->getTipo() != "admin") {
    header("Location: ../view/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin - Cadastro de CD</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white text-center">
                <h2>Cadastrar CD</h2>
            </div>

            <div class="card-body">

                <form action="../controller/controller.php" method="POST">

                    <input type="hidden" name="action" value="cadastrarCD">

                    <label class="form-label">Descrição:</label>
                    <input type="text" name="descricao" class="form-control mb-3" required>

                    <label class="form-label">Categoria:</label>
                    <input type="text" name="categoria" class="form-control mb-3" required>

                    <label class="form-label">Tipo:</label>
                    <input type="text" name="tipo" class="form-control mb-3" required>

                    <label class="form-label">Músicas (separadas por vírgula):</label>
                    <textarea name="musicas" class="form-control mb-3" rows="3" required></textarea>

                    <label class="form-label">Estoque:</label>
                    <input type="number" name="estoque" class="form-control mb-3" min="0" required>

                    <label class="form-label">Preço:</label>
                    <input type="number" step="0.01" name="preco" class="form-control mb-3" required>

                    <button type="submit" class="btn btn-primary w-100">Cadastrar</button>

                </form>

            </div>
        </div>
    </div>

    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>