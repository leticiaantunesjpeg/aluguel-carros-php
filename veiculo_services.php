<?php

require_once('veiculo_model.php');

class VeiculoService
{
    private $conexao;
    private $veiculo;

    public function __construct(Conexao $conexao, Veiculo $veiculo)
    {
        $this->conexao = $conexao->conectar();
        $this->veiculo = $veiculo;
    }

    public function recuperarVeiculos()
    {
        $query = 'SELECT * FROM veiculo';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function atualizarDisponibilidadeVeiculo($id_veiculo, $disponibilidade)
    {
        try {
            $query = "UPDATE veiculo SET disponibilidade = :disponibilidade WHERE id = :id_veiculo";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':disponibilidade', $disponibilidade);
            $stmt->bindParam(':id_veiculo', $id_veiculo);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erro ao atualizar disponibilidade do veículo: " . $e->getMessage();
            return false;
        }
    }
}


?>
