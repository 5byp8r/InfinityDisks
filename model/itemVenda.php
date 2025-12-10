<?php

class ItemVenda {
	private int $id, $quantidade;
	private CD $cd;
	private static ConexaoBD $conexao;

	public function __construct(int $quantidade, CD $cd, int $id = 0) {
		$this->id = $id;
		$this->quantidade = $quantidade;
		$this->cd = $cd;
		self::$conexao = ConexaoBD::getInstance();
	}

	public static function getAll()
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM itemVenda");
            $stmt->execute();
            $result = [];

            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
				if ($cd = CD::find($linha['id_cd'])){
					$usuario = new ItemVenda($linha['quantidade'], $cd, $linha['id']);
					$result[] = $usuario;
				}
            }

            return $result;
        } catch (\Throwable $th) {}
        return false;
    }

    public static function find(int $id)
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM itemVenda WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC))
				if ($cd = CD::find($linha['id_cd']))
					return new ItemVenda($linha['quantidade'], $cd, $linha['id']);
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
            $stmt = $this->conexao->getPDO()->prepare("INSERT INTO itemVenda (quantidade, id_cd) VALUES (:quantidade, :id_cd);");
            $stmt->bindParam(':quantidade', $this->quantidade);
			$stmt->bindParam(':id_cd', $this->cd->getId(), PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $this->id = $this->conexao->getPDO()->lastInsertId();
                return true;
            }
            else {}
        } catch (PDOException $th) {}
        return false;
    }
    
    private function update()
    {
        try {
            $stmt = $this->conexao->getPDO()->prepare("UPDATE itemVenda SET quantidade = :quantidade, id_cd = :id_cd WHERE id = :id;");
            $stmt->bindParam(':quantidade', $this->quantidade);
			$stmt->bindParam(':id_cd', $this->cd->getId(), PDO::PARAM_INT);
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
            $stmt = $this->conexao->getPDO()->prepare("DELETE FROM itemVenda WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) return true;
            else {}
        } catch (\Throwable $th) {}
        return false;
    }

    public function __tostring()
    {
        return $this->id . ";" . $this->cd->__tostring() . ";"  . $this->quantidade;
    }

	public function getId(): int { return $this->id; }
	public function getQuantidade(): int { return $this->quantidade; }
	public function getCd(): CD { return $this->cd; }

	public function setId(int $id) { $this->id = $id; }
	public function setQuantidade(int $quantidade) { $this->quantidade = $quantidade; }
	public function setCd(CD $cd) { $this->cd = $cd; }
}