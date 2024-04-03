<?php
require_once('reserva_model.php');
require_once('conexao.php');

class ReservaService{
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
            return true;
        } catch (PDOException $e) {
            echo "Erro ao salvar reserva: " . $e->getMessage();
            return false;
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
}

$conexao = new Conexao();
$reservaService = new ReservaService($conexao->conectar(), new Reserva());
if (isset($_POST['action']) && $_POST['action'] == 'salvarReserva') {
    
    $dataInicio = $_POST['data_inicio'];
    $dataFim = $_POST['data_fim'];
    $idVeiculo = $_POST['id_veiculo'];
    $nomeCliente = $_POST['nome_cliente'];
    $docCliente = $_POST['doc_cliente'];

    $resultado = $reservaService->salvarReserva($dataInicio, $dataFim, $idVeiculo, $nomeCliente, $docCliente);
    if ($resultado) {
        echo "Reserva salva com sucesso!";
    } else {
        echo "Erro ao salvar reserva. Por favor, tente novamente.";
    }
}
?>
