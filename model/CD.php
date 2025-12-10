<?php

class CD
{
    private int $id, $estoque, $data_cadastro;
    private string $descricao, $categoria, $tipo, $musicas;
    private float $preco;
    private static ConexaoBD $conexao;

    public function __construct(string $descricao, string $categoria, string $tipo, string $musicas, int $estoque, float $preco, int $id = 0, int $data_cadastro = 0)
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->categoria = $categoria;
        $this->tipo = $tipo;
        $this->musicas = $musicas;
        $this->estoque = $estoque;
        $this->preco = $preco;
        $this->data_cadastro = $data_cadastro;
        self::$conexao = ConexaoBD::getInstance();
    }

    public static function getAll()
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM cds");
            $stmt->execute();
            $result = [];

            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $cd = new CD($linha['descricao'], $linha['categoria'], $linha['tipo'], $linha['musicas'], $linha['estoque'], $linha['preco'], $linha['id'], $linha['data_cadastro']);
                $result[] = $cd;
            }

            return $result;
        } catch (\Throwable $th) {}
        return false;
    }

    public static function find(int $id)
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM cds WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) return new CD($linha['descricao'], $linha['categoria'], $linha['tipo'], $linha['musicas'], $linha['estoque'], $linha['preco'], $linha['id'], $linha['data_cadastro']);
            else {}
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
            $stmt = $this->conexao->getPDO()->prepare("INSERT INTO cds (descricao, categoria, tipo, musicas, estoque, preco) VALUES (:descricao, :categoria, :tipo, :musicas, :estoque, :preco);");
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':categoria', $this->categoria);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':musicas', $this->musicas);
            $stmt->bindParam(':estoque', $this->estoque, PDO::PARAM_INT);
            $stmt->bindParam(':preco', $this->preco);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $this->id = $this->conexao->getPDO()->lastInsertId();
                $this->data_cadastro = self::find($this->conexao->getPDO()->lastInsertId())->getData();
                return true;
            }
            else {}
        } catch (PDOException $th) {}
        return false;
    }

    private function update()
    {
        try {
            $stmt = $this->conexao->getPDO()->prepare("UPDATE cds SET descricao = :descricao, categoria = :categoria, tipo = :tipo, musicas = :musicas, estoque = :estoque, preco = :preco WHERE id = :id;");
            $stmt->bindParam(':descricao', $this->descricao);
            $stmt->bindParam(':categoria', $this->categoria);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->bindParam(':musicas', $this->musicas);
            $stmt->bindParam(':estoque', $this->estoque, PDO::PARAM_INT);
            $stmt->bindParam(':preco', $this->preco);
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
            $stmt = $this->conexao->getPDO()->prepare("DELETE FROM cds WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) return true;
            else {}
        } catch (\Throwable $th) {}
        return false;
    }

    public function __tostring()
    {
        return $this->id . ";" . $this->descricao . ";" . $this->categoria . ";" . $this->tipo . ";" . $this->musicas . ";" . $this->estoque . ";" . $this->preco . ";" . $this->data_cadastro;
    }

    public function getId() { return $this->id; }
    public function getDescricao() { return $this->descricao; }
    public function getCategoria() { return $this->categoria; }
    public function getTipo() { return $this->tipo; }
    public function getMusicas() { return $this->musicas; }
    public function getEstoque() { return $this->estoque; }
    public function getPreco() { return $this->preco; }
    public function getData() { return $this->data_cadastro; }

    public function setDescricao(string $descricao) { if(isset($descricao)) $this->descricao = $descricao; }
    public function setCategoria(string $categoria) { if(isset($categoria))  $this->categoria = $categoria; }
    public function setTipo(string $tipo) { if(isset($tipo)) $this->tipo = $tipo; }
    public function setMusicas(string $musicas) { if(isset($musicas)) $this->musicas = $musicas; }
    public function setEstoque(int $estoque) { if(isset($estoque)) $this->estoque = $estoque; }
    public function setPreco(float $preco) { if(isset($preco)) $this->preco = $preco; }
}