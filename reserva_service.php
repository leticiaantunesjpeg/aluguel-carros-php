<?php
require_once('./reserva_model.php');
require_once('./conexao.php');
require_once('./veiculo_service.php');

class ReservaService
{
    private $conexao;
    private $reserva;

    public function __construct($conexao, $reserva)
    {
        $this->conexao = $conexao;
        $this->reserva = $reserva;
    }

    public function salvarReserva($dataInicio, $dataFim, $idVeiculo, $nomeCliente, $docCliente)
    {
        try {
            $query = "INSERT INTO reserva (data_inicio, data_fim, id_veiculo, nome_cliente, doc_cliente) VALUES (:dataInicio, :dataFim, :idVeiculo, :nomeCliente, :docCliente)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':dataInicio', $dataInicio);
            $stmt->bindParam(':dataFim', $dataFim);
            $stmt->bindParam(':idVeiculo', $idVeiculo);
            $stmt->bindParam(':nomeCliente', $nomeCliente);
            $stmt->bindParam(':docCliente', $docCliente);
            $stmt->execute();

            // Atualizar a disponibilidade do veículo para 0 (indisponível)
            $veiculoService = new VeiculoService(new Conexao(), new Veiculo());
            $veiculoService->atualizarDisponibilidadeVeiculo($idVeiculo, 0);

            echo json_encode(["success" => true]); // Retorna sucesso como JSON
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Erro ao salvar reserva: " . $e->getMessage()]); // Retorna erro como JSON
        }
    }
    public function excluirReserva($idReserva)
    {
        try {
            $query = "SELECT id_veiculo FROM reserva WHERE id = :idReserva";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':idReserva', $idReserva);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && isset($result['id_veiculo'])) {
                $idVeiculo = $result['id_veiculo'];

                $query = "DELETE FROM reserva WHERE id = :idReserva";
                $stmt = $this->conexao->prepare($query);
                $stmt->bindParam(':idReserva', $idReserva);
                $stmt->execute();

                $veiculoService = new VeiculoService(new Conexao(), new Veiculo());
                $veiculoService->atualizarDisponibilidadeVeiculo($idVeiculo, 1);

                echo json_encode(["success" => true]); // Retorna sucesso como JSON
            } else {
                echo json_encode(["success" => false, "message" => "Reserva não encontrada ou dados inválidos."]); // Retorna erro como JSON
            }
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Erro ao excluir reserva: " . $e->getMessage()]); // Retorna erro como JSON
        }
    }
    public function listarReservas()
    {
        try {
            $query = "SELECT * FROM reserva";
            $stmt = $this->conexao->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao listar reservas: " . $e->getMessage();
            return false;
        }
    }
    public function handleRequest()
    {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'salvarReserva':
                    $dataInicio = $_POST['data_inicio'];
                    $dataFim = $_POST['data_fim'];
                    $idVeiculo = $_POST['id_veiculo'];
                    $nomeCliente = $_POST['nome_cliente'];
                    $docCliente = $_POST['doc_cliente'];
                    $this->salvarReserva($dataInicio, $dataFim, $idVeiculo, $nomeCliente, $docCliente);
                    break;
                case 'excluirReserva':
                    $idReserva = $_POST['id_reserva'];
                    $this->excluirReserva($idReserva);
                    break;
                default:
                    echo json_encode(["success" => false, "message" => "Ação desconhecida"]);
                    break;
            }
            exit;
        }
    }
    
}

// Instanciar a classe ReservaService e tratar a solicitação
$conexao = new Conexao();
$reservaService = new ReservaService($conexao->conectar(), new Reserva());
$reservaService->handleRequest();
?>
