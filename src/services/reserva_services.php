<?php
class ReservaService
{
    private $conexao;
    private $reserva;

    public function __construct(Conexao $conexao, Reserva $reserva)
    {
        $this->conexao = $conexao->conectar();
        $this->reserva = $reserva;
    }

    // Inserir uma nova reserva
    public function inserir()
    {
        $query = 'INSERT INTO reserva(data_inicio, data_fim, id_veiculo, id_cliente) VALUES (:data_inicio, :data_fim, :id_veiculo, :id_cliente)';
        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(':data_inicio', $this->reserva->__get('data_inicio'));
        $stmt->bindValue(':data_fim', $this->reserva->__get('data_fim'));
        $stmt->bindValue(':id_veiculo', $this->reserva->__get('id_veiculo'));
        $stmt->bindValue(':id_cliente', $this->reserva->__get('id_cliente'));

        $stmt->execute();
    }

    // Atualizar uma reserva existente
    public function atualizar()
    {
        $query = "UPDATE reserva SET data_inicio = ?, data_fim = ?, id_veiculo = ?, id_cliente = ? WHERE id = ?";
        $stmt = $this->conexao->prepare($query);

        $stmt->bindValue(1, $this->reserva->__get('data_inicio'));
        $stmt->bindValue(2, $this->reserva->__get('data_fim'));
        $stmt->bindValue(3, $this->reserva->__get('id_veiculo'));
        $stmt->bindValue(4, $this->reserva->__get('id_cliente'));
        $stmt->bindValue(5, $this->reserva->__get('id'));

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
