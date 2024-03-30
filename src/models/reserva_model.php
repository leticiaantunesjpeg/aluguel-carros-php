<?php

class Reserva {
	private $id;
    private $data_inicio;
    private $data_fim;
	private $id_veiculo;
	private $nome_cliente;
	private $doc_cliente;
	
	public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}
}

?>