<?php
require_once('./reserva_model.php');
require_once('./conexao.php');
require_once('./reserva_service.php'); // Adicione esta linha para incluir o serviço de reserva

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

$reservas = $reservaService->listarReservas();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <!-- Adicione o jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Reservas</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>ID Veículo</th>
                <th>Nome Cliente</th>
                <th>Documento Cliente</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $reserva) : ?>
                <tr>
                    <td><?php echo $reserva['id']; ?></td>
                    <td><?php echo $reserva['data_inicio']; ?></td>
                    <td><?php echo $reserva['data_fim']; ?></td>
                    <td><?php echo $reserva['id_veiculo']; ?></td>
                    <td><?php echo $reserva['nome_cliente']; ?></td>
                    <td><?php echo $reserva['doc_cliente']; ?></td>
                    <td>
                        <!-- Botão de Excluir Reserva -->
                        <button class="btn-excluir-reserva" data-id="<?php echo $reserva['id']; ?>">Excluir Reserva</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function(){
            $('.btn-excluir-reserva').click(function(){
                var idReserva = $(this).data('id');
                $.ajax({
                    url: 'reserva_service.php',
                    type: 'POST',
                    data: { action: 'excluirReserva', id_reserva: idReserva },
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            alert('Reserva excluída com sucesso!');
                            location.reload(); // Atualizar a página após a exclusão
                        } else {
                            alert('Erro ao excluir reserva. Por favor, tente novamente.');
                        }
                    },
                    error: function(){
                        alert('Erro ao processar a solicitação. Por favor, tente novamente.');
                    }
                });
            });
        });
    </script>
</body>
</html>
