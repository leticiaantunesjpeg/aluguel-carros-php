<?php

class Cliente {
	private $id;
	private $id_veiculo;
	private $nome;
	private $cpf;
	private $telefone;
	private $endereco;
	
	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}
}

?>