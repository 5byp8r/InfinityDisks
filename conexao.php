<?php // conexao.php - conexão com o banco (PDO)
$host = 'localhost';
$dbname = 'db_web_loja';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
}
catch (PDOException $e) {
    die('Erro na conexão com o banco de dados: ' . $e->getMessage());
}
?>
