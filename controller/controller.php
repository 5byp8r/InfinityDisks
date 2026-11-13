<?php
require_once "../model/Usuario.php";
require_once "../model/CD.php";
require_once "../model/ItemVenda.php";
require_once "../model/Venda.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$acao = "";
if (isset($_REQUEST['action'])) {
    $acao = $_REQUEST['action'];
}

if ($acao == "cadastrar") {

    $nome = $_POST['nome'] ?? "";
    $email = $_POST['email'] ?? "";
    $senha = $_POST['senha'] ?? "";

    if ($nome == "" || $email == "" || $senha == "") {
        $_SESSION['erro'] = "Preencha todos os campos!";
        header("Location: ../view/register.php");
        exit;
    }

    $usuario = new Usuario(1, $nome, $email, $senha);

    if ($usuario->save()) {
        $_SESSION['sucesso'] = "Cadastro realizado com sucesso!";
        header("Location: ../view/catalogo.php");
        exit;
    } else {
        $_SESSION['erro'] = "Erro ao cadastrar!";
        header("Location: ../view/register.php");
        exit;
    }

} else if ($acao == "login") {

    $email = $_POST['email'] ?? "";
    $senha = $_POST['senha'] ?? "";

    if ($email == "" || $senha == "") {
        $_SESSION['erro'] = "Digite email e senha!";
        header("Location: ../view/login.php");
        exit;
    }

    $usuarios = Usuario::getAll();
    $logou = false;

    foreach ($usuarios as $u) {
        if ($u->getEmail() == $email && $u->getSenha() == $senha) {
            $_SESSION['usuario'] = $u;
            $logou = true;
            break;
        }
    }

    if ($logou) {
        header("Location: ../view/home.php");
        exit;
    } else {
        $_SESSION['erro'] = "Email ou senha incorretos!";
        header("Location: ../view/login.php");
        exit;
    }

} else if ($acao == "logout") {

    session_destroy();
    header("Location: ../view/home.php");
    exit;

} else if ($acao == "listarUsuarios") {

    $usuarios = Usuario::getAll();
    $_SESSION['lista_usuarios'] = $usuarios;
    header("Location: ../view/lista_usuarios.php");
    exit;

} else if ($acao == "cadastrarCD") {

    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $tipo = $_POST['tipo'];
    $musicas = $_POST['musicas'];
    $estoque = intval($_POST['estoque']);
    $preco = floatval($_POST['preco']);

    $cd = new CD($descricao, $categoria, $tipo, $musicas, $estoque, $preco);

    if ($cd->save()) {
        $_SESSION['sucesso'] = "CD cadastrado com sucesso.";
    } else {
        $_SESSION['erro'] = "Erro ao cadastrar o CD.";
    }

    header("Location: ../view/admin_cadastro_produto.php");
    exit;

} else if ($acao == "criarVenda") {

    if (!isset($_SESSION['usuario'])) {
        $_SESSION['erro'] = "Você precisa estar logado para iniciar uma venda.";
        header("Location: ../view/login.php");
        exit;
    }

    $usuario = $_SESSION['usuario'];
    $venda = new Venda($usuario);
    $_SESSION['venda_atual'] = $venda;

    header("Location: ../view/carrinho.php");
    exit;

} else if ($acao == "adicionarItemVenda") {

    if (!isset($_SESSION['venda_atual'])) {
        $_SESSION['erro'] = "Nenhuma venda iniciada.";
        header("Location: ../view/carrinho.php");
        exit;
    }

    $id_cd = intval($_POST['id_cd']);
    $qtd = intval($_POST['quantidade']);

    $venda = $_SESSION['venda_atual'];

    if ($venda->adicionarItem($id_cd, $qtd)) {
        $_SESSION['venda_atual'] = $venda;
    } else {
        $_SESSION['erro'] = "Erro ao adicionar item na venda.";
    }

    header("Location: ../view/carrinho.php");
    exit;

} else if ($acao == "removerItemVenda") {

    if (!isset($_SESSION['venda_atual'])) {
        $_SESSION['erro'] = "Nenhuma venda ativa.";
        header("Location: ../view/carrinho.php");
        exit;
    }

    $index = intval($_POST['index']);
    $venda = $_SESSION['venda_atual'];

    $itens = $venda->getItens();

    if (isset($itens[$index])) {
        $venda->retirarItem($itens[$index]);
        $_SESSION['venda_atual'] = $venda;
    }

    header("Location: ../view/carrinho.php");
    exit;

} else if ($acao == "finalizarVenda") {

    if (!isset($_SESSION['venda_atual'])) {
        $_SESSION['erro'] = "Nenhuma venda para finalizar.";
        header("Location: ../view/carrinho.php");
        exit;
    }

    $venda = $_SESSION['venda_atual'];

    if ($venda->save()) {
        unset($_SESSION['venda_atual']);
        $_SESSION['sucesso'] = "Compra realizada com sucesso.";
    } else {
        $_SESSION['erro'] = "Erro ao salvar a venda.";
    }

    header("Location: ../view/catalogo.php");
    exit;

} else if ($acao == "listarVendas") {

    $id_user = $_SESSION['usuario']->getId();
    $vendas = Venda::getAll($id_user);

    $_SESSION['lista_vendas'] = $vendas;

    exit;

} else if ($acao == "detalhesVenda") {

    $id = intval($_GET['id']);
    $venda = Venda::find($id);

    if (!$venda) {
        $_SESSION['erro'] = "Venda não encontrada.";
        header("Location: ../view/lista_vendas.php");
        exit;
    }

    $_SESSION['venda_detalhes'] = $venda;

    header("Location: ../view/detalhe_venda.php");
    exit;

} else if ($acao == "deletarVenda") {

    $id = intval($_POST['id']);
    $venda = Venda::find($id);

    if ($venda && $venda->delete()) {
        $_SESSION['sucesso'] = "Venda excluída.";
    } else {
        $_SESSION['erro'] = "Erro ao excluir a venda.";
    }

    header("Location: ../view/lista_vendas.php");
    exit;

} else if ($acao == "deletarCD") {

    $id = intval($_POST['id']);

    $cd = CD::find($id);

    if ($cd && $cd->delete()) {
        $_SESSION['sucesso'] = "Produto removido com sucesso.";
    } else {
        $_SESSION['erro'] = "Erro ao remover o produto.";
    }

    header("Location: ../view/admin_produtos.php");
    exit;
} else {
    echo "Nenhuma ação válida foi enviada para o controller.";
}
