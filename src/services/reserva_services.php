<?php
require_once "./src/controller/reserva_controller.php";
require_once "./src/models/reserva_model.php";
require_once "./src/controller/conexao.php";
class ReservaService
{
    private $conexao;
    private $reserva;

    public function __construct(Conexao $conexao, Reserva $reserva)
{
    $this->conexao = $conexao->conectar(); // Obtém o objeto PDO da conexão
    $this->reserva = $reserva;
}


    // Inserir uma nova reserva
    public function inserir()
    {
        $query = 'INSERT INTO reserva(data_inicio, data_fim, id_veiculo, nome_cliente, doc_cliente) VALUES (:data_inicio, :data_fim, :id_veiculo, :nome_cliente, :doc_cliente)';
        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':data_inicio', $this->reserva->__get('data_inicio'));
        $stmt->bindValue(':data_fim', $this->reserva->__get('data_fim'));
        $stmt->bindValue(':id_veiculo', $this->reserva->__get('id_veiculo'));
        $stmt->bindValue(':nome_cliente', $this->reserva->__get('nome_cliente'));
        $stmt->bindValue(':doc_cliente', $this->reserva->__get('doc_cliente'));

        $stmt->execute();
    }

    // Atualizar uma reserva existente
    public function atualizar()
    {
        $query = "UPDATE reserva SET data_inicio = :data_inicio, data_fim = :data_fim, id_veiculo = :id_veiculo, nome_cliente = :nome_cliente, doc_cliente = :doc_cliente WHERE id = :id";
        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':data_inicio', $this->reserva->__get('data_inicio'));
        $stmt->bindValue(':data_fim', $this->reserva->__get('data_fim'));
        $stmt->bindValue(':id_veiculo', $this->reserva->__get('id_veiculo'));
        $stmt->bindValue(':nome_cliente', $this->reserva->__get('nome_cliente'));
        $stmt->bindValue(':doc_cliente', $this->reserva->__get('doc_cliente'));
        $stmt->bindValue(':id', $this->reserva->__get('id'));

        return $stmt->execute();
    }

    // Recuperar todas as reservas
    public function recuperarReservas()
    {
        $query = 'SELECT * FROM reserva';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Remover uma reserva
    public function remover()
    {
        $query = 'DELETE FROM reserva WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $this->reserva->__get('id'));
        $stmt->execute();
    }
}

?>
