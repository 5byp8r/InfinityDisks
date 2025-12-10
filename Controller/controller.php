<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../Model/ConexaoBD.php";
require_once "../Model/usuario.php";
require_once "../view/catalogo.php";


$acao = "";
if (isset($_REQUEST['action'])) {
    $acao = $_REQUEST['action'];
}
$usuarios = array();
if ($acao == "cadastrar") {

    $nome = "";
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
    }

    $email = "";
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    $senha = "";
    if (isset($_POST['senha'])) {
        $senha = $_POST['senha'];
    }

    if ($nome == "" || $email == "" || $senha == "") {
        $_SESSION['erro'] = "Preencha todos os campos!";
        header("Location: ../view/register.php");
        exit;
    }

    $usuario = new Usuario(1, $nome, $email, $senha);

    if ($usuario->save() == true) {
        $_SESSION['sucesso'] = "Cadastro realizado com sucesso!";
        header("Location: ../view/catalogo.php");
        exit;
    } else {
        $_SESSION['erro'] = "Erro ao cadastrar!";
        header("Location: ../view/register.php");
        exit;
    }

} else if ($acao == "login") {

    $email = "";
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    $senha = "";
    if (isset($_POST['senha'])) {
        $senha = $_POST['senha'];
    }

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

    if ($logou == true) {
        header("Location: ../view/catalogo.php");
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

} else {

    echo "Nenhuma ação válida foi enviada para o controller.";
}
