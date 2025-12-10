<?php

class Venda {
	private int $id;
	private int $data_venda;
	private float $valor_venda;
	private Usuario $usuario;
	private array $itens;
    private static ConexaoBD $conexao;

	public function __construct(Usuario $usuario, array $itens, int $id = 0, int $data_venda = 0) {
		$this->id = $id;
		$this->data_venda = $data_venda;
		$this->usuario = $usuario;
		$this->itens = $itens;
		$this->updateValorVenda();
		self::$conexao = ConexaoBD::getInstance();
	}

	public function updateValorVenda(){
		$this->valor_venda = 0;
		foreach ($this->itens as $item) {
			$this->valor_venda += $item->getCd()->getPreco();
		}
	}

	public function adicionarItem(int $id_cd, int $quantidade){
		if($cd = CD::find($id_cd)) {
			$this->itens[] = new ItemVenda($quantidade, $cd);
			return true;
		}
		return false;
	}

	public function retirarItem(ItemVenda $delete){
		foreach ($this->itens as $i => $item) {
			if ($item == $delete) {
				array_splice($this->itens, $i, 1);
				return;
			}
		}
	}

	public static function getAll()
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM vendas");
            $stmt->execute();
            $result = [];

            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
				if ($user = Usuario::find($linha['id_user'])) {
					$usuario = new Venda($user, ItemVenda::getAll($linha['id']), $linha['id'], $linha['data_venda']);
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
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM vendas WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC))
				if ($user = Usuario::find($linha['id_user']))
					return new Venda($user, ItemVenda::getAll($linha['id']), $linha['id'], $linha['data_venda']);
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
            $stmt = self::$conexao->getPDO()->prepare("INSERT INTO vendas (valor_venda, id_user) VALUES (:valor_venda, :id_user);");
            $stmt->bindParam(':valor_venda', $this->valor_venda);
            $id_user = $this->usuario->getId();
			$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $this->id = self::$conexao->getPDO()->lastInsertId();
                $this->data_criacao = self::find($this->id)->getDataVenda();
                foreach ($this->itens as $item) {
                    if (!$item->save()) return false;
                }
                return true;
            }
            else {}
        } catch (PDOException $th) {}
        return false;
    }
    
    private function update()
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("UPDATE vendas SET (valor_venda = :valor_venda, id_user = :id_user WHERE id = :id;");
            $stmt->bindParam(':valor_venda', $this->valor_venda);
            $id_user = $this->usuario->getId();
			$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                foreach ($this->itens as $item) {
                    if (!$item->save()) return false;
                }
                return true;
            }
            else {}
        } catch (PDOException $th) {}
        return false;
    }

    public function delete()
    {
        try {
            foreach ($this->itens as $item) {
                if (!$item->delete()) return false;
            }
            $stmt = self::$conexao->getPDO()->prepare("DELETE FROM vendas WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) return true;
            else {}
        } catch (\Throwable $th) {}
        return false;
    }

    public function __tostring()
    {
        return $this->id . ";" . $this->data_venda . ";" . $this->valor_venda . ";" . $this->usuario->__tostring() . ";" . $this->itens;
    }

	public function getId(): int { return $this->id; }
	public function getDataVenda(): int { return $this->data_venda; }
	public function getValorVenda(): float { return $this->valor_venda; }
	public function getUsuario(): Usuario { return $this->usuario; }
	public function getItens(): array { return $this->itens; }

	public function setId(int $id) { $this->id = $id; }
	public function setDataVenda(int $data_venda) { $this->data_venda = $data_venda; }
	public function setValorVenda(float $valor_venda) { $this->valor_venda = $valor_venda; }
	public function setUsuario(Usuario $usuario) { $this->usuario = $usuario; }
}
