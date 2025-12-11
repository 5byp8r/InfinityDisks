<?php
require_once "ConexaoBD.php";
require_once "CD.php";

class ItemVenda {
    private int $id, $id_venda, $quantidade;
    private CD $cd;
    private static ?ConexaoBD $conexao = null;

    private static function initConexao() {
        if (self::$conexao === null) {
            self::$conexao = ConexaoBD::getInstance();
        }
    }

    public function __construct(int $quantidade, CD $cd, int $id_venda = 0, int $id = 0) {
        $this->id = $id;
        $this->id_venda = $id_venda;
        $this->quantidade = $quantidade;
        $this->cd = $cd;
        self::initConexao();
    }

    public static function getAll(?int $id_venda = null, ?int $id_cd = null)
    {
        self::initConexao();
        try {
            $stmt = self::$conexao->getPDO()->prepare(
                "SELECT * FROM itensVenda" .
                (($id_venda === null and $id_cd === null) ? "" : " WHERE ") .
                ($id_venda === null ? "" : "id_venda = :id_venda") .
                (($id_venda !== null and $id_cd !== null) ? " AND " : "") .
                ($id_cd === null ? "" : "id_cd = :id_cd")
            );
            
            if ($id_venda !== null) $stmt->bindParam(':id_venda', $id_venda, PDO::PARAM_INT);
            if ($id_cd !== null) $stmt->bindParam(':id_cd', $id_cd, PDO::PARAM_INT);

            $stmt->execute();
            $result = [];

            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($cd = CD::find($linha['id_cd'])) {
                    $result[] = new ItemVenda(
                        $linha['quantidade'],
                        $cd,
                        $linha['id_venda'],
                        $linha['id']
                    );
                }
            }

            return $result;
        } catch (PDOException $th) { echo $th->getMessage(); }
        return false;
    }

    public static function find(int $id)
    {
        self::initConexao();
        try {
            $stmt = self::$conexao->getPDO()->prepare("SELECT * FROM itensVenda WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($linha = $stmt->fetch(PDO::FETCH_ASSOC))
                if ($cd = CD::find($linha['id_cd']))
                    return new ItemVenda($linha['quantidade'], $cd, $linha['id_venda'], $linha['id']);

        } catch (PDOException $th) { echo $th->getMessage(); }
        return false;
    }

    public function save()
    {
        self::initConexao();

        if ($this->id == 0)
            return $this->insert();
        else if ($this != self::find($this->id))
            return $this->update();
        else 
            return true;
    }

    private function insert()
    {
        self::initConexao();
        try {
            $stmt = self::$conexao->getPDO()->prepare(
                "INSERT INTO itensVenda (quantidade, id_cd, id_venda) 
                 VALUES (:quantidade, :id_cd, :id_venda);"
            );

            $stmt->bindParam(':quantidade', $this->quantidade, PDO::PARAM_INT);
            $id_cd = $this->cd->getId();
            $stmt->bindParam(':id_cd', $id_cd, PDO::PARAM_INT);
            $stmt->bindParam(':id_venda', $this->id_venda, PDO::PARAM_INT);

            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $this->id = self::$conexao->getPDO()->lastInsertId();
                return true;
            }

        } catch (PDOException $th) { echo $th->getMessage(); }
        return false;
    }
    
    private function update()
    {
        self::initConexao();
        try {
            $stmt = self::$conexao->getPDO()->prepare(
                "UPDATE itensVenda 
                 SET quantidade = :quantidade, id_cd = :id_cd, id_venda = :id_venda 
                 WHERE id = :id;"
            );

            $stmt->bindParam(':quantidade', $this->quantidade, PDO::PARAM_INT);
            $id_cd = $this->cd->getId();
            $stmt->bindParam(':id_cd', $id_cd, PDO::PARAM_INT);
            $stmt->bindParam(':id_venda', $this->id_venda, PDO::PARAM_INT);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            $stmt->execute();
            
            return $stmt->rowCount() > 0;

        } catch (PDOException $th) { echo $th->getMessage(); }
        return false;
    }

    public function delete()
    {
        self::initConexao();
        try {
            $stmt = self::$conexao->getPDO()->prepare("DELETE FROM itensVenda WHERE id = :id");
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $this->id = 0;
                return true;
            }

        } catch (PDOException $th) { echo $th->getMessage(); }

        return false;
    }

    public function __tostring()
    {
        return $this->id . ";" . $this->cd->__tostring() . ";" . $this->quantidade;
    }

    public function getId(): int { return $this->id; }
    public function getIdVenda(): int { return $this->id_venda; }
    public function getQuantidade(): int { return $this->quantidade; }
    public function getCd(): CD { return $this->cd; }

    public function setId(int $id) { $this->id = $id; }
    public function setIdVenda(int $id_venda) { $this->id_venda = $id_venda; }
    public function setQuantidade(int $quantidade) { $this->quantidade = $quantidade; }
    public function setCd(CD $cd) { $this->cd = $cd; }
}
