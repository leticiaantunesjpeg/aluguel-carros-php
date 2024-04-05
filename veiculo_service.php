<?php
require_once('./veiculo_model.php');
require_once('./conexao.php');

class VeiculoService
{
    private $conexao;
    private $veiculo;

    public function __construct($conexao, Veiculo $veiculo)
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

    public function recuperarVeiculosDisponiveis() {
        $query = 'SELECT * FROM veiculo WHERE disponibilidade = 1';
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

    public function verificarDisponibilidadeVeiculo($id_veiculo)
    {
        try {
            $query = "SELECT disponibilidade FROM veiculo WHERE id = :id_veiculo";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':id_veiculo', $id_veiculo);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['disponibilidade'];
        } catch (PDOException $e) {
            echo "Erro ao verificar disponibilidade do veículo: " . $e->getMessage();
            return false;
        }
    }

    // Tratamento da solicitação AJAX
    public function handleRequest()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'verificarDisponibilidade') {
            $idVeiculo = $_POST['id_veiculo'];
            $disponibilidade = $this->verificarDisponibilidadeVeiculo($idVeiculo);
            echo $disponibilidade;
            exit; // Encerrar a execução após enviar a resposta AJAX
        }
    }
}

// Instanciar a classe VeiculoService e tratar a solicitação
$conexao = new Conexao();
$veiculoService = new VeiculoService($conexao, new Veiculo());
$veiculoService->handleRequest();
