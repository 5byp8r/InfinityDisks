<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro - Infinity Disks</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header class="header-top">
        <div class="header-logo">
            <a href="../view/home.php"><b>INFINITY DISKS</b></a>
        </div>

        <div class="header-search">
            <input class="barra" type="text" placeholder="Buscar...">
            <button class="pesquisa"><img class="image" src="procurar.svg" alt="Pesquisar"></button>
        </div>
        <div></div>
        <div class="header-actions">
            <a class="lo.ca" href="../view/login.php">LOGIN</a>
            <a class="lo.ca" href="../view/carrinho.php">CARRINHO</a>
        </div>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="../view/catalogo.php">Catálogo</a></li>
            <li><a href="../view/admin_cadastro_produto.php">Cadastrar Produto</a></li>
            <li><a href="../view/admin_produtos.php">Produtos</a></li>
            <li><a href="../view/admin_vendas.php">Vendas</a></li>
            <li><a href="../view/sobre.php">Sobre</a></li>
        </ul>
    </nav>

    <div class="page-container">

        <aside class="sidebar">
            <h3>Novo Usuário</h3>
            <ul>
                <li><a href="../view/login.php">Já tem conta? Entrar</a></li>
                <li><a href="../view/catalogo.php">Voltar ao Catálogo</a></li>
            </ul>
        </aside>

        <section class="products">
            <h2>🆕 Criar Conta</h2>
            <br>

            <div style="max-width: 450px; margin: 0 auto;">
                <form action="../Controller/controller.php" method="POST"
                    style="display:flex; flex-direction:column; gap:15px;">
                    <input type="hidden" name="action" value="cadastrar">
                    <div>
                        <label for="nome" style="display: block; margin-bottom: 8px; font-weight: 600;">Nome
                            Completo:</label>
                        <input type="text" id="nome" name="nome" class="form-control-admin" required>
                    </div>

                    <div>
                        <label for="email" style="display: block; margin-bottom: 8px; font-weight: 600;">Email:</label>
                        <input type="email" id="email" name="email" class="form-control-admin" required>
                    </div>

                    <div>
                        <label for="senha" style="display: block; margin-bottom: 8px; font-weight: 600;">Senha:</label>
                        <input type="password" id="senha" name="senha" class="form-control-admin" required>
                    </div>

                    <button type="submit" class="btn-primary" style="padding: 12px; font-size: 1rem;">Cadastrar</button>
                </form>

                <p style="text-align:center; margin-top:20px;">
                    Já tem conta? <a href="../view/login.php" style="color: #e91e63; font-weight: bold;">Entrar aqui</a>
                </p>
            </div>
        </section>

    </div>

    <footer class="footer">
        <h4>Infinity Disks</h4>
        <p>Todos os direitos reservados.</p>
    </footer>

</body>

</html>