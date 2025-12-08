<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once 'Model/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cadastro_usuario.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$senha_conf = $_POST['senha_conf'] ?? '';

$erros = [];
if ($nome === '') $erros[] = 'Nome é obrigatório.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = 'Email inválido.';
if (strlen($senha) < 6) $erros[] = 'Senha deve ter pelo menos 6 caracteres.';
if ($senha !== $senha_conf) $erros[] = 'Senhas não conferem.';

if ($erros) {
    $_SESSION['erros_cadastro_usuario'] = $erros;
    header('Location: cadastro_usuario.php');
    exit;
}

try {
    // verifica email
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    if ($stmt->fetch()) {
        $_SESSION['erros_cadastro_usuario'] = ['Email já cadastrado.'];
        header('Location: cadastro_usuario.php');
        exit;
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, data_criacao) VALUES (:nome, :email, :senha, NOW())");
    $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senha_hash
    ]);

    $_SESSION['mensagem'] = ['Registro realizado com sucesso. Faça login.'];
    header('Location: login.php');
    exit;

}
catch (PDOException $e) {
    $_SESSION['erros_cadastro_usuario'] = ['Erro ao registrar usuário: ' . $e->getMessage()];
    header('Location: cadastro_usuario.php');
    exit;
}
?>