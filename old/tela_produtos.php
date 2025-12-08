<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'leitura_produtos.php';

// mensagens
$erros = $_SESSION['erros_cadastro'] ?? [];
$mensagens = $_SESSION['mensagem'] ?? [];
$tipo_mensagem = $_SESSION['tipo_mensagem'] ?? '';

unset($_SESSION['erros_cadastro'], $_SESSION['mensagem'], $_SESSION['tipo_mensagem']);

// usuário logado?
$usuario_logado = $_SESSION['usuario'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Infinity Disks - Produtos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header class="topo">
    <h1>Infinity Disks</h1>
    <nav>
        <a href="tela_produtos.php">Produtos</a>
        <a href="carrinho.php">Carrinho (<?= array_sum(array_column($_SESSION['cart'] ?? [], 'qty')) ?: 0 ?>)</a>
        <?php if ($usuario_logado): ?>
            <span>Olá, <?= htmlspecialchars($usuario_logado['nome']) ?></span>
            <a href="logout.php">Sair</a>
        <?php else: ?>
            <a href="cadastro_usuario.php">Registrar</a>
            <a href="login.php">Entrar</a>
        <?php endif; ?>
    </nav>
</header>

<main class="container">
    <?php if ($erros): ?>
        <div class="alert danger">
            <ul><?php foreach ($erros as $e): ?><li><?= htmlspecialchars($e) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <?php if ($mensagens): ?>
        <div class="alert <?= htmlspecialchars($tipo_mensagem ?: 'info') ?>">
            <ul><?php foreach ($mensagens as $m): ?><li><?= htmlspecialchars($m) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <section class="produtos">
        <?php if ($produtos): ?>
            <?php foreach ($produtos as $p): ?>
                <article class="card">
                    <h3><?= htmlspecialchars($p['descricao']) ?></h3>
                    <p><strong>Categoria:</strong> <?= htmlspecialchars($p['categoria']) ?></p>
                    <p><strong>Tipo:</strong> <?= htmlspecialchars($p['tipo']) ?></p>
                    <p><strong>Estoque:</strong> <?= htmlspecialchars($p['quantidade']) ?></p>
                    <p class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>

                    <form action="adicionar_carrinho.php" method="POST" class="form-inline">
                        <input type="hidden" name="produto_id" value="<?= (int)$p['id'] ?>">
                        <label>Qtd:
                            <input type="number" name="quantidade" min="1" max="<?= (int)$p['quantidade'] ?>" value="1" required>
                        </label>
                        <button type="submit" <?= $p['quantidade'] <= 0 ? 'disabled' : '' ?>>Adicionar</button>
                    </form>

                    <div class="acoes">
                        <a href="tela_produtos.php?id=<?= $p['id'] ?>">Editar</a>
                        <a href="excluir_produto.php?id=<?= $p['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum produto cadastrado.</p>
        <?php endif; ?>
    </section>

    <hr>

    <section class="form-cadastro">
        <h2>Cadastrar novo produto</h2>
        <form action="processar_cadastro.php" method="POST">
            <label>Descrição: <input type="text" name="descricao" required></label>
            <label>Categoria: <input type="text" name="categoria" required></label>
            <label>Tipo:
                <select name="tipo" required>
                    <option value="vinil">vinil</option>
                    <option value="cd">cd</option>
                </select>
            </label>
            <label>Quantidade: <input type="number" name="quantidade" min="0" value="1" required></label>
            <label>Preço: <input type="number" step="0.01" name="preco" min="0.01" value="0.01" required></label>
            <button type="submit">Cadastrar Produto</button>
        </form>
    </section>
</main>

<footer class="rodape">
    <p>Loja de Discos</p>
</footer>
</body>
</html>
