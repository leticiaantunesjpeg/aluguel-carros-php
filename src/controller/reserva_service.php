<?php

require_once('./src/models/reserva_model.php');
require_once('./src/services/conexao.php');

class ReservaService
{
    private $conexao;
    private $reserva;

    public function __construct(Conexao $conexao, Reserva $reserva)
    {
        $this->conexao = $conexao->conectar();
        $this->reserva = $reserva;
    }

    public function salvarReserva($data_inicio, $data_fim, $id_veiculo, $nome_cliente, $doc_cliente)
    {
        try {
            $query = "INSERT INTO reserva (data_inicio, data_fim, id_veiculo, nome_cliente, doc_cliente) VALUES (:data_inicio, :data_fim, :id_veiculo, :nome_cliente, :doc_cliente)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':data_inicio', $data_inicio);
            $stmt->bindParam(':data_fim', $data_fim);
            $stmt->bindParam(':id_veiculo', $id_veiculo);
            $stmt->bindParam(':nome_cliente', $nome_cliente);
            $stmt->bindParam(':doc_cliente', $doc_cliente);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao salvar reserva: " . $e->getMessage();
            return false;
        }
    }
}

?>
