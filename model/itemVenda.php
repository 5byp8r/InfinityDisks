<?php

class ItemVenda {
	private int $id, $quantidade;
	private CD $cd;

	public function __construct(int $id, int $quantidade, CD $cd) {
		$this->id = $id;
		$this->quantidade = $quantidade;
		$this->cd = $cd;
	}

	public function getId(): int { return $this->id; }
	public function getQuantidade(): int { return $this->quantidade; }
	public function getCd(): CD { return $this->cd; }

	public function setId(int $id) { $this->id = $id; }
	public function setQuantidade(int $quantidade) { $this->quantidade = $quantidade; }
	public function setCd(CD $cd) { $this->cd = $cd; }
}