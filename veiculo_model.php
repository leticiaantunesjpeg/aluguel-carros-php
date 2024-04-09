<?php

class Veiculo {
	private $id;
	private $marca;
	private $modelo;
	private $placa;
	private $valor;
    private $disponibilidade;
    private $imagem;
	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}
}

?>