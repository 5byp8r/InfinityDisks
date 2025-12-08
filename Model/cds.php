<?php
class CD
{
    private int $id, $estoque;
    private string $descricao, $categoria, $tipo, $musicas;
    private float $preco;
    private $data_cadastro;
    private Conexao $conexao;

    public function __construct(int $id, string $descricao, string $categoria, string $tipo, int $estoque, float $preco, $data_cadastro)
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->categoria = $categoria;
        $this->tipo = $tipo;
        $this->estoque = $estoque;
        $this->preco = $preco;
        $this->data_cadastro = $data_cadastro;
        $this->conexao = Conexao::getInstance();
    }

    public function getAll()
    {
        $stmt = $this->conexao->getPDO()->prepare("SELECT * FROM produtos");
        $stmt->execute();
        $result = [];

        while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cd = new CD($linha['id'], $linha['descricao'], $linha['categoria'], $linha['tipo'], $linha['quantidade'], $linha['preco'], $linha['data_cadastro']);
            $result[] = $cd;
        }

        return $result;
    }

    public function getCD(int $id)
    {
        $stmt = $this->conexao->getPDO()->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $linha = $stmt->fetch(PDO::FETCH_ASSOC);
        return new CD($linha['id'], $linha['descricao'], $linha['categoria'], $linha['tipo'], $linha['quantidade'], $linha['preco'], $linha['data_cadastro']);
    }

    public function __tostring()
    {
        return $this->id . ";" . $this->descricao . ";" . $this->categoria . ";" . $this->tipo . ";" . $this->estoque . ";" . $this->preco . ";" . $this->data_cadastro;
    }

    public function getDescricao() { return $this->descricao; }
    public function getCategoria() { return $this->categoria; }
    public function getTipo() { return $this->tipo; }
    public function getMusicas() { return $this->musicas; }
    public function getEstoque() { return $this->estoque; }
    public function getPreco() { return $this->preco; }
    public function getData() { return $this->data_cadastro; }

    public function setDescricao($descricao) { $this->descricao = $descricao; }
    public function setCategoria($categoria) { $this->categoria = $categoria; }
    public function setTipo($tipo) { $this->tipo = $tipo; }
    public function setMusicas(string $musicas) { $this->musicas = $musicas; }
    public function setEstoque($estoque) { $this->estoque = $estoque; }
    public function setPreco($preco) { $this->preco = $preco; }
    public function setData($data) { $this->data_cadastro = $data; }
}