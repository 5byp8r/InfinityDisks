<?php // conexao.php - conexão com o banco (PDO)
class Conexao
{
    private $host = 'localhost';
    private $dbname = 'db_web_loja';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct(){
        $this->openConnection();
    }

    public function openConnection()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            die('Erro na conexão com o banco de dados: ' . $e->getMessage());
        }
    }

    public function closeConnection(){
        $this->pdo = null;
    }

	public function getPdo() { return $this->pdo; }
}