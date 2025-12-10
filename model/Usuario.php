<?php

class Usuario
{
    private int $id, $tipo, $data_criacao;
    private string $nome, $email, $senha;
    private static ConexaoBD $conexao;

    public function __construct(int $tipo, string $nome, string $email, string $senha, int $id = 0, int $data_criacao = 0)
    {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->data_criacao = $data_criacao;
        self::$conexao = ConexaoBD::getInstance();
    }

    public static function getAll()
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM usuarios");
            $stmt->execute();
            $result = [];

            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $usuario = new Usuario($linha['tipo'], $linha['nome'], $linha['email'], $linha['senha'], $linha['id'], $linha['data_criacao']);
                $result[] = $usuario;
            }

            return $result;
        } catch (\Throwable $th) {}
        return false;
    }

    public static function find(int $id)
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) return new Usuario($linha['tipo'], $linha['nome'], $linha['email'], $linha['senha'], $linha['id'], $linha['data_criacao']);
        } catch (\Throwable $th) {}
        return false;
    }

    public function save()
    {
        if($this->id == 0)
            return $this->insert();
        else 
            return $this->update();
    }

    private function insert()
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("INSERT INTO usuarios (tipo, nome, email, senha) VALUES (:tipo, :nome, :email, :senha);");
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $this->id = self::$conexao->getPDO()->lastInsertId();
                $this->data_criacao = self::find(self::$conexao->getPDO()->lastInsertId())->getDataCriacao();
                return true;
            }
            else {}
        } catch (PDOException $th) {}
        return false;
    }
    
    private function update()
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("UPDATE usuarios SET tipo = :tipo, nome = :nome, email = :email, senha = :senha WHERE id = :id;");
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) return true;
            else {}
        } catch (PDOException $th) {}
        return false;
    }

    public function delete()
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("DELETE FROM usuarios WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) return true;
            else {}
        } catch (\Throwable $th) {}
        return false;
    }

    public function __tostring()
    {
        return $this->id . ";" . $this->tipo . ";" . $this->nome . ";" . $this->email . ";" . $this->senha . ";" . $this->data_criacao;
    }

    public function getId(): int { return $this->id; }
	public function getTipo(): int { return $this->tipo; }
    public function getNome(): string { return $this->nome; }
    public function getEmail(): string { return $this->email; }
    public function getSenha(): string { return $this->senha; }
    public function getDataCriacao() { return $this->data_criacao; }

	public function setTipo(int $tipo) { if(isset($tipo)) $this->tipo = $tipo; }
    public function setNome(string $nome) { if(isset($nome)) $this->nome = $nome; }
    public function setEmail(string $email) { if(isset($email)) $this->email = $email; }
    public function setSenha(string $senha) { if(isset($senha)) $this->senha = $senha; }
}