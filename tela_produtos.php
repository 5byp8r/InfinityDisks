<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'leitura_produtos.php';

$erros = isset($_SESSION['erros_cadastro']) ? $_SESSION['erros_cadastro'] : [];
$mensagens = isset($_SESSION['mensagem']) ? $_SESSION['mensagem'] : [];
$tipo_mensagem = isset($_SESSION['tipo_mensagem']) ? $_SESSION['tipo_mensagem'] : '';
unset($_SESSION['erros_cadastro'], $_SESSION['mensagem'], $_SESSION['tipo_mensagem'], $_SESSION['produtos']);

$produtos = isset($produtos) ? $produtos : [];
$modo_edicao = false;
$produto_edicao = null;
$titulo_pagina = 'Cadastrar Produto';
$texto_botao_principal = 'Cadastrar Produto';

if (isset($_GET['id']) && filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT)) {
    $id_edicao = intval($_GET['id']);
    foreach ($produtos as $p) {
        if (intval($p['id']) === $id_edicao) {
            $produto_edicao = $p;
            break;
        }
    }
    if ($produto_edicao) {
        $modo_edicao = true;
        $titulo_pagina = 'Atualizar Produto';
        $texto_botao_principal = 'Salvar Alterações';
    }
    else {
        $erros[] = 'Produto para edição não encontrado.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Loja de Discos - Gerenciar Produtos</title>
</head>
<body>
    <h1><?php echo $titulo_pagina; ?></h1>

    <?php if (!empty($erros)): ?>
        <div style="color:darkred;">
            <ul>
            <?php foreach ($erros as $e): ?>
                <li><?php echo htmlspecialchars($e); ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($mensagens)): ?>
        <div>
            <ul>
            <?php foreach ($mensagens as $m): ?>
                <li><?php echo htmlspecialchars($m); ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo $modo_edicao ? 'processar_atualizacao.php' : 'processar_cadastro.php'; ?>" method="POST">
        <?php if ($modo_edicao): ?>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto_edicao['id']); ?>">
        <?php endif; ?>

        <label>Descrição:<br>
            <input type="text" name="descricao" required value="<?php echo $modo_edicao ? htmlspecialchars($produto_edicao['descricao']) : ''; ?>">
        </label><br>

        <label>Categoria:<br>
            <input type="text" name="categoria" required value="<?php echo $modo_edicao ? htmlspecialchars($produto_edicao['categoria']) : ''; ?>">
        </label><br>

        <label>Tipo (vinil / cd):<br>
            <input type="text" name="tipo" required value="<?php echo $modo_edicao ? htmlspecialchars($produto_edicao['tipo']) : 'vinil'; ?>">
        </label><br>

        <label>Quantidade:<br>
            <input type="number" name="quantidade" required min="0" value="<?php echo $modo_edicao ? htmlspecialchars($produto_edicao['quantidade']) : '1'; ?>">
        </label><br>

        <label>Preço (ex: 49.90):<br>
            <input type="number" step="0.01" name="preco" required value="<?php echo $modo_edicao ? htmlspecialchars($produto_edicao['preco']) : '0.01'; ?>">
        </label><br>

        <button type="submit"><?php echo $texto_botao_principal; ?></button>
        <?php if ($modo_edicao): ?>
            <a href="tela_produtos.php">Cancelar edição</a>
        <?php else: ?>
            <button type="reset">Limpar</button>
        <?php endif; ?>
    </form>

    <hr>

    <h2>Lista de Produtos</h2>

    <?php if (!empty($produtos)): ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Tipo</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($produto['id']); ?></td>
                        <td><?php echo htmlspecialchars($produto['descricao']); ?></td>
                        <td><?php echo htmlspecialchars($produto['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($produto['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($produto['quantidade']); ?></td>
                        <td>R$ <?php echo htmlspecialchars(number_format($produto['preco'], 2, ',', '.')); ?></td>
                        <td><?php echo htmlspecialchars($produto['data_cadastro']); ?></td>
                        <td>
                            <a href="tela_produtos.php?id=<?php echo $produto['id']; ?>">Editar</a>
                            |
                            <a href="excluir_produto.php?id=<?php echo $produto['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum produto cadastrado.</p>
    <?php endif; ?>

</body>
</html>