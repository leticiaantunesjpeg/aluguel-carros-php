<?php


//CRUD
class ClienteService
{

	private $id;
	private $id_veiculo;
	private $nome;
	private $cpf;
	private $telefone;
	private $endereco;
    private $conexao;
    private $cliente;

	public function __construct(Conexao $conexao, Cliente $nome )
	{
		$this->conexao= $conexao->conectar();
		$this->nome = $nome;
		
	}

	public function inserir()
	{
		// Query para inserir uma nova tarefa com sua categoria na tabela tb_tarefas
		$query = 'INSERT INTO cliente(nome) VALUES (:nome)';
		$stmt = $this->conexao->prepare($query);

		// Vincular os valores das variáveis tarefa e categoria aos parâmetros da consulta
		$stmt->bindValue(':nome', $this->nome->__get('nome'));
		
		// Executar a consulta preparada
		$stmt->execute();
	}


    public function recuperarClientes()
    {
        $query = '
            SELECT 
                c.id, c.nome, c.cpf, c.telefone, c.endereco
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
	{ //delete

		$query = 'delete from cliente where id = :id';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id', $this->cliente->__get('id'));
		$stmt->execute();
	}

}