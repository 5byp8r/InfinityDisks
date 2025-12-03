<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$mensagens = $_SESSION['mensagem'] ?? [];
$erros = $_SESSION['erros_cadastro_usuario'] ?? [];
unset($_SESSION['mensagem'], $_SESSION['erros_cadastro_usuario']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Registrar - Infinity Disks</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<header class="topo">
    <h1>Registrar usuário</h1>
    <nav><a href="tela_produtos.php">Voltar</a></nav>
</header>

<main class="container">
    <?php if ($erros): ?>
        <div class="alert danger"><ul><?php foreach ($erros as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div>
    <?php endif; ?>
    <?php if ($mensagens): ?>
        <div class="alert success"><ul><?php foreach ($mensagens as $m): ?><li><?= htmlspecialchars($m) ?></li><?php endforeach; ?></ul></div>
    <?php endif; ?>

    <form action="processar_cadastro_usuario.php" method="POST" class="form-card">
        <label>Nome: <input type="text" name="nome" required></label>
        <label>Email: <input type="email" name="email" required></label>
        <label>Senha: <input type="password" name="senha" required></label>
        <label>Confirmar senha: <input type="password" name="senha_conf" required></label>
        <button type="submit">Registrar</button>
    </form>
</main>

<footer class="rodape"><p>Loja de Discos — protótipo</p></footer>
</body>
</html>