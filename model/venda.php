<?php

class Venda {
	private int $id;
	private string $data_venda;
	private float $valor_venda;
	private Usuario $usuario;
	private array $itens;

	public function __construct(int $id, string $data_venda, Usuario $usuario, array $itens) {
		$this->id = $id;
		$this->data_venda = $data_venda;
		$this->usuario = $usuario;
		$this->itens = $itens;
		$this->updateValorVenda();
	}

	public function updateValorVenda(){
		$this->valor_venda = 0;
		foreach ($this->itens as $item) {
			$this->valor_venda += $item->getCd()->getPreco();
		}
	}

	// public function adicionarItem(CD $cd, int $quantidade){
	// 	$this->itens[] = new ItemVenda($quantidade, $cd);
	// }

	// public function retirarItem(ItemVenda $delete){
	// 	foreach ($this->itens as $i => $item) {
	// 		if ($item == $delete) {
	// 			array_splice($this->itens, $i,1);
	// 			return;
	// 		}
	// 	}
	// }

	public function getId(): int { return $this->id; }
	public function getDataVenda(): string { return $this->data_venda; }
	public function getValorVenda(): float { return $this->valor_venda; }
	public function getUsuario(): Usuario { return $this->usuario; }
	public function getItens(): array { return $this->itens; }

	public function setId(int $id) { $this->id = $id; }
	public function setDataVenda(string $data_venda) { $this->data_venda = $data_venda; }
	public function setValorVenda(float $valor_venda) { $this->valor_venda = $valor_venda; }
	public function setUsuario(Usuario $usuario) { $this->usuario = $usuario; }
}
