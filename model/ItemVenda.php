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

	public static function getAll(?int $id_venda = null)
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM itensVenda" . is_null($id_venda) ? "" : " WHERE id_venda = :id_venda");
            if (!is_null($id_venda)) $stmt->bindParam(':id_venda', $id_venda, PDO::PARAM_INT);
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
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM itensVenda WHERE id = :id");
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
            $stmt = self::$conexao->getPDO()->prepare("INSERT INTO itensVenda (quantidade, id_cd) VALUES (:quantidade, :id_cd);");
            $stmt->bindParam(':quantidade', $this->quantidade);
            $id_cd = $this->cd->getId();
			$stmt->bindParam(':id_cd', $id_cd, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $this->id = self::$conexao->getPDO()->lastInsertId();
                return true;
            }
            else {}
        } catch (PDOException $th) {}
        return false;
    }
    
    private function update()
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("UPDATE itensVenda SET quantidade = :quantidade, id_cd = :id_cd WHERE id = :id;");
            $stmt->bindParam(':quantidade', $this->quantidade);
			$id_cd = $this->cd->getId();
			$stmt->bindParam(':id_cd', $id_cd, PDO::PARAM_INT);
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
            $stmt = self::$conexao->getPDO()->prepare("DELETE FROM itensVenda WHERE id = :id");
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