<?php
require_once "ConexaoBD.php";
require_once "Usuario.php";
require_once "ItemVenda.php";

class Venda {
	private int $id;
	private ?string $data_venda;
	private float $valor_venda;
	private Usuario $usuario;
	private array $itens;
    private static ConexaoBD $conexao;

	public function __construct(Usuario $usuario, array $itens = [], int $id = 0, ?string $data_venda = null) {
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
			$this->valor_venda += $item->getCd()->getPreco() * $item->getQuantidade();
		}
	}

	public function adicionarItem(int $id_cd, int $quantidade){
		if($cd = CD::find($id_cd)) {
			$this->itens[] = new ItemVenda($quantidade, $cd);
            self::updateValorVenda();
			return true;
		}
		return false;
	}

	public function retirarItem(ItemVenda $delete){
		foreach ($this->itens as $i => $item) {
			if ($item == $delete) {
				array_splice($this->itens, $i, 1);
                self::updateValorVenda();
				return;
			}
		}
	}

	public static function getAll(?int $id_user = null)
    {
        if (!isset(self::$conexao)) self::$conexao = ConexaoBD::getInstance();
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM vendas" . ($id_user === null ? ";" : " WHERE id_user = :id_user"));
            if ($id_user !== null) $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();
            $result = [];

            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
				if ($user = Usuario::find($linha['id_user']) and $itensVenda = ItemVenda::getAll($linha['id'])) {
					$usuario = new Venda($user, $itensVenda, $linha['id'], $linha['data_venda']);
					$result[] = $usuario;
				}
            }

            return $result;
        } catch (PDOException $th) { echo $th->getMessage(); }
        return false;
    }

    public static function find(int $id)
    {
        if (!isset(self::$conexao)) self::$conexao = ConexaoBD::getInstance();
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM vendas WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC))
				if ($user = Usuario::find($linha['id_user'])  and $itensVenda = ItemVenda::getAll($linha['id']))
					return new Venda($user, $itensVenda, $linha['id'], $linha['data_venda']);
        } catch (PDOException $th) { echo $th->getMessage(); }
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
                if (($self = self::find($this->id)) instanceof Venda){
                    $this->data_venda = $self->getDataVenda();
                }

                foreach ($this->itens as $item) {
                    $item->setIdVenda($this->id);
                    if ($item->save() == false) return false;
                }
                return true;
            }
            else {}
        } catch (PDOException $th) { echo $th->getMessage(); }
        return false;
    }
    
    private function update()
    {
        try {
            $stmt = self::$conexao->getPDO()->prepare("UPDATE vendas SET valor_venda = :valor_venda, id_user = :id_user WHERE id = :id;");
            $stmt->bindParam(':valor_venda', $this->valor_venda);
            $id_user = $this->usuario->getId();
			$stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                foreach ($this->itens as $item) {
                    $item->setIdVenda($this->id);
                    if ($item->save() == false) return false;
                }
                return true;
            }
            else {}
        } catch (PDOException $th) { echo $th->getMessage(); }
        return false;
    }

    public function delete()
    {
        try {
            foreach ($this->itens as $item) {
                if (!$item->delete()) return false;
            }
            $stmt = self::$conexao->getPDO()->prepare("DELETE FROM vendas WHERE id = :id");
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->id = 0;
                return true;
            }
            else {}
        } catch (PDOException $th) { echo $th->getMessage(); }
        return false;
    }

    public function __tostring()
    {
        $itens_str = "";
        foreach ($this->itens as $item) {
            $itens_str .= ";" . $item->__tostring();
        }
        return $this->id . ";" . $this->data_venda . ";" . $this->valor_venda . ";" . $this->usuario->__tostring() . $itens_str;
    }

	public function getId(): int { return $this->id; }
	public function getDataVenda(): string { return $this->data_venda; }
	public function getValorVenda(): float { return $this->valor_venda; }
	public function getUsuario(): Usuario { return $this->usuario; }
	public function getItens(): array { return $this->itens; }

	public function setId(int $id) { $this->id = $id; }
	public function setDataVenda(int $data_venda) { $this->data_venda = $data_venda; }
	public function setValorVenda(float $valor_venda) { $this->valor_venda = $valor_venda; }
	public function setUsuario(Usuario $usuario) { $this->usuario = $usuario; }
}
