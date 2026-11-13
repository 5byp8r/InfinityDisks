<?php // conexao.php - conexão com o banco (PDO)
class ConexaoBD
{
    private static ConexaoBD $conexao;
    private $host = 'localhost';
    private $dbname = 'db_web_loja';
    private $username = 'root';
    private $password = '';
    private $pdo;

    private function __construct(){
        $this->host = getenv('DB_HOST') ?: $this->host;
        $this->dbname = getenv('DB_NAME') ?: $this->dbname;
        $this->username = getenv('DB_USER') ?: $this->username;
        $password = getenv('DB_PASSWORD');
        $this->password = $password === false ? $this->password : $password;
        $this->openConnection();
    }

    public static function getInstance(){
        if(!isset(self::$conexao)){
            self::$conexao = new ConexaoBD();
        }
        return self::$conexao;
    }

    public function openConnection()
    {
        $port = getenv('DB_PORT') ?: '3306';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        if ($sslCa = getenv('DB_SSL_CA')) {
            $options[PDO::MYSQL_ATTR_SSL_CA] = $sslCa;
            $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = true;
        }
        try {
            $this->pdo = new PDO(
                "mysql:host=$this->host;port=$port;dbname=$this->dbname;charset=utf8mb4",
                $this->username,
                $this->password,
                $options
            );
        } catch (PDOException $e) {
            die('Erro na conexão com o banco de dados: ' . $e->getMessage());
        }
    }

    public function closeConnection(){
        $this->pdo = null;
    }

	public function getPDO() { return $this->pdo; }
}
