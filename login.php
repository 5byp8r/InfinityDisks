<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$mensagens = $_SESSION['mensagem'] ?? [];
$erros = $_SESSION['erros_login'] ?? [];
unset($_SESSION['mensagem'], $_SESSION['erros_login']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Entrar - Loja de Discos</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<header class="topo"><h1>Login</h1><nav><a href="tela_produtos.php">Voltar</a></nav></header>

<main class="container">
    <?php if ($erros): ?>
        <div class="alert danger"><ul><?php foreach ($erros as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul></div>
    <?php endif; ?>
    <?php if ($mensagens): ?>
        <div class="alert success"><ul><?php foreach ($mensagens as $m): ?><li><?= htmlspecialchars($m) ?></li><?php endforeach; ?></ul></div>
    <?php endif; ?>

    <form action="processar_login.php" method="POST" class="form-card">
        <label>Email: <input type="email" name="email" required></label>
        <label>Senha: <input type="password" name="senha" required></label>
        <button type="submit">Entrar</button>
    </form>
</main>

<footer class="rodape"><p>Loja de Discos — protótipo</p></footer>
</body>
</html>