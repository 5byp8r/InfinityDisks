<?php
class Usuario
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private $data_criacao;

    public function __construct(int $id, string $nome, string $email, string $senha, $data_criacao)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->data_criacao = $data_criacao;
    }

    public function getAll(PDO $conn)
    {
        $stmt = $conn->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        $result = [];

        while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new Usuario($linha['id'], $linha['nome'], $linha['email'], $linha['senha'], $linha['data_criacao']);
            $result[] = $usuario;
        }

        return $result;
    }

    public function getUsuario(PDO $conn, int $id){
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $linha = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Usuario($linha['id'], $linha['nome'], $linha['email'], $linha['senha'], $linha['data_criacao']);
    }

    public function getId(): int { return $this->id; }
    public function getNome(): string { return $this->nome; }
    public function getEmail(): string { return $this->email; }
    public function getSenha(): string { return $this->senha; }
    public function getDataCriacao() { return $this->data_criacao; }

    public function setId(int $id) { $this->id = $id; }
    public function setNome(string $nome) { $this->nome = $nome; }
    public function setEmail(string $email) { $this->email = $email; }
    public function setSenha(string $senha) { $this->senha = $senha; }
    public function setDataCriacao($data_criacao) { $this->data_criacao = $data_criacao; }
}
?>