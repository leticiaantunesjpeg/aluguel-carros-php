<?php

class ClienteService
{
    private $conexao;
    private $cliente;

    public function __construct(Conexao $conexao, Cliente $cliente)
    {
        $this->conexao = $conexao->conectar();
        $this->cliente = $cliente;
    }

    public function inserir()
    {
        $query = 'INSERT INTO cliente(id_veiculo, nome, cpf, telefone, endereco) VALUES (:id_veiculo, :nome, :cpf, :telefone, :endereco)';
        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':id_veiculo', $this->cliente->__get('id_veiculo'));
        $stmt->bindValue(':nome', $this->cliente->__get('nome'));
        $stmt->bindValue(':cpf', $this->cliente->__get('cpf'));
        $stmt->bindValue(':telefone', $this->cliente->__get('telefone'));
        $stmt->bindValue(':endereco', $this->cliente->__get('endereco'));

        $stmt->execute();
    }


		public function atualizar()
	{
		$query = "UPDATE cliente SET id_veiculo = ?, nome = ?, cpf = ?, telefone = ?, endereco = ? WHERE id = ?";
		$stmt = $this->conexao->prepare($query);
		
		$stmt->bindValue(1, $this->cliente->__get('id_veiculo'));
		$stmt->bindValue(2, $this->cliente->__get('nome'));
		$stmt->bindValue(3, $this->cliente->__get('cpf'));
		$stmt->bindValue(4, $this->cliente->__get('telefone'));
		$stmt->bindValue(5, $this->cliente->__get('endereco'));
		$stmt->bindValue(6, $this->cliente->__get('id'));

		return $stmt->execute();
	}



		public function recuperarClientes()
	{
		$query = '
			SELECT 
				c.id, c.id_veiculo, c.nome, c.cpf, c.telefone, c.endereco,
				v.marca, v.modelo, v.ano
			FROM 
				cliente AS c
			LEFT JOIN 
				veiculo AS v ON c.id_veiculo = v.id
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}


    public function remover()
    {
        $query = 'DELETE FROM cliente WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $this->cliente->__get('id'));
        $stmt->execute();
    }
}
