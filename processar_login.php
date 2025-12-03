<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

$erros = [];
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = 'Email inválido.';
if ($senha === '') $erros[] = 'Senha obrigatória.';

if ($erros) {
    $_SESSION['erros_login'] = $erros;
    header('Location: login.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, nome, email, senha FROM usuarios WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($senha, $user['senha'])) {
        $_SESSION['erros_login'] = ['Email ou senha inválidos.'];
        header('Location: login.php');
        exit;
    }

    // gravar info mínima do usuário na sessão
    $_SESSION['usuario'] = [
        'id' => $user['id'],
        'nome' => $user['nome'],
        'email' => $user['email']
    ];

    $_SESSION['mensagem'] = ['Login realizado com sucesso.'];
    header('Location: tela_produtos.php');
    exit;
}
catch (PDOException $e) {
    $_SESSION['erros_login'] = ['Erro ao processar login.'];
    header('Location: login.php');
    exit;
}
?>