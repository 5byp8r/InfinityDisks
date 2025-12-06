<?php
    class CDs
    {
        private $id, $descricao, $categoria, $tipo, $quantidade, $preco, $data_cadastro;

        public function __construct(int $id, string $descricao, string $categoria, string $tipo, int $quantidade, float $preco, $data_cadastro)
        {
            $this->id = $id;
            $this->descricao = $descricao;
            $this->categoria = $categoria;
            $this->tipo = $tipo;
            $this->quantidade = $quantidade;
            $this->preco = $preco;
            $this->data_cadastro = $data_cadastro;
        }

        public function getAll(PDO $conn)
        {
            $stmt = $conn->prepare("SELECT * FROM produtos");
            $stmt->execute();
            $result = [];

            while($linha = $stmt->fetch(PDO::FETCH_ASSOC)){
                $cd = new CDs($linha['id'], $linha['descricao'], $linha['categoria'], $linha['tipo'], $linha['quantidade'], $linha['preco'], $linha['data_cadastro']);
                $result[] = $cd;
            }

            return $result;
        }

        public function __tostring()
        {
            return $this->id . ";" . $this->descricao . ";" . $this->categoria . ";" . $this->tipo . ";" . $this->quantidade . ";" . $this->preco . ";" . $this->data_cadastro;
        }

        public function getDescricao() { return $this->descricao; }
        public function getCategoria() { return $this->categoria; }
        public function getTipo() { return $this->tipo; }
        public function getQuantidade() { return $this->quantidade; }
        public function getPreco() { return $this->preco; }
        public function getData() { return $this->data_cadastro; }

        public function setDescricao($descricao) { $this->descricao = $descricao; }
        public function setCategoria($categoria) { $this->categoria = $categoria; }
        public function setTipo($tipo) { $this->tipo = $tipo; }
        public function setQuantidade($quantidade) { $this->quantidade = $quantidade; }
        public function setPreco($preco) { $this->preco = $preco; }
        public function setData($data) { $this->data_cadastro = $data; }
    }
?>