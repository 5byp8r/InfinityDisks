<?php
require_once "ConexaoBD.php";
require_once "Usuario.php";
require_once "ItemVenda.php";
require_once "CD.php";

class Venda
{
    private int $id;
    private ?string $data_venda;
    private float $valor_venda;
    private Usuario $usuario;
    private array $itens;
    private static ?ConexaoBD $conexao = null;

    public function __construct(Usuario $usuario, array $itens = [], int $id = 0, ?string $data_venda = null)
    {
        $this->id = $id;
        $this->data_venda = $data_venda;
        $this->usuario = $usuario;
        $this->itens = $itens;
        $this->updateValorVenda();

        if (self::$conexao === null)
            self::$conexao = ConexaoBD::getInstance();
    }

    private static function conectar()
    {
        if (self::$conexao === null)
            self::$conexao = ConexaoBD::getInstance();
    }

    public function updateValorVenda()
    {
        $this->valor_venda = 0;
        foreach ($this->itens as $item) {
            $this->valor_venda += $item->getCd()->getPreco() * $item->getQuantidade();
        }
    }

    public function adicionarItem(int $id_cd, int $quantidade)
    {
        if ($cd = CD::find($id_cd)) {
            $this->itens[] = new ItemVenda($quantidade, $cd);
            $this->updateValorVenda();
            return true;
        }
        return false;
    }

    public function retirarItem(ItemVenda $delete)
    {
        foreach ($this->itens as $i => $item) {
            if ($item == $delete) {
                unset($this->itens[$i]);
                $this->itens = array_values($this->itens);
                $this->updateValorVenda();
                return;
            }
        }
    }

    public static function getAll(?int $id_user = null)
    {
        self::conectar();

        try {
            $sql = "SELECT * FROM vendas";
            if ($id_user !== null)
                $sql .= " WHERE id_user = :id_user";

            $stmt = self::$conexao->getPDO()->prepare($sql);
            if ($id_user !== null)
                $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
            $stmt->execute();

            $vendas = [];

            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $user = Usuario::find($linha["id_user"]);
                $itens = ItemVenda::getAll($linha["id"]);

                if ($user && $itens !== false) {
                    $vendas[] = new Venda($user, $itens, $linha["id"], $linha["data_venda"]);
                }
            }

            return $vendas;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function find(int $id)
    {
        self::conectar();
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM vendas WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $usuario = Usuario::find($linha["id_user"]);
                $itens = ItemVenda::getAll($linha["id"]);

                if ($usuario && $itens !== false)
                    return new Venda($usuario, $itens, $linha["id"], $linha["data_venda"]);
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function save()
    {
        if ($this->id == 0)
            return $this->insert();
        else
            return $this->update();
    }

    private function insert()
    {
        self::conectar();

        try {
            $stmt = self::$conexao->getPDO()->prepare(
                "INSERT INTO vendas (valor_venda, id_user) VALUES (:valor_venda, :id_user)"
            );

            $stmt->bindParam(":valor_venda", $this->valor_venda);
            $id_user = $this->usuario->getId();
            $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $this->id = self::$conexao->getPDO()->lastInsertId();

                foreach ($this->itens as $item) {
                    $item->setIdVenda($this->id);
                    if (!$item->save())
                        return false;
                }

                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function update()
    {
        self::conectar();

        try {
            $stmt = self::$conexao->getPDO()->prepare(
                "UPDATE vendas SET valor_venda = :valor_venda, id_user = :id_user WHERE id = :id"
            );

            $stmt->bindParam(":valor_venda", $this->valor_venda);
            $id_user = $this->usuario->getId();
            $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();

            foreach ($this->itens as $item) {
                $item->setIdVenda($this->id);
                if (!$item->save())
                    return false;
            }

            return true;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete()
    {
        self::conectar();
        try {

            foreach ($this->itens as $item)
                if (!$item->delete())
                    return false;

            $stmt = self::$conexao->getPDO()->prepare("DELETE FROM vendas WHERE id = :id");
            $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->id = 0;
                return true;
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getDataVenda(): ?string
    {
        return $this->data_venda;
    }
    public function getValorVenda(): float
    {
        return $this->valor_venda;
    }
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }
    public function getItens(): array
    {
        return $this->itens;
    }
}
