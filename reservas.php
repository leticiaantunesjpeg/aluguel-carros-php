<?php
require_once('./reserva_model.php');
require_once('./conexao.php');
require_once('./reserva_service.php');
require_once('./veiculo_service.php');

$conexao = new Conexao();
$veiculoService = new VeiculoService($conexao, new Veiculo());
$veiculos = $veiculoService->recuperarVeiculos();

$reservaService = new ReservaService($conexao->conectar(), new Reserva());
$reservas = $reservaService->listarReservas();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    
    <link rel="stylesheet" href="reservas.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1 class="title">Reservas</h1>
    <div class="container">
        <?php foreach ($reservas as $reserva) : ?>
            <div class="reserva-card">
                <div class="reserva-info">
                    <p><span class="info-label">Nome:</span> <?php echo $reserva['nome_cliente']; ?></p>
                    <p><span class="info-label">CPF:</span> <?php echo $reserva['doc_cliente']; ?></p>
                    <p><span class="info-label">Data Início:</span> <?php echo $reserva['data_inicio']; ?></p>
                    <p><span class="info-label">Data Fim:</span> <?php echo $reserva['data_fim']; ?></p>
                    <p><span class="info-label">Valor:</span> 
                    <?php 
                        foreach ($veiculos as $veiculo) {
                            if ($veiculo->id == $reserva['id_veiculo']) {
                                echo $veiculo->valor;
                                break; 
                            }
                        }
                    ?>
                    </p>
                    <div class="reserva-actions">
                        
                        <button class="btn-excluir-reserva" data-id="<?php echo $reserva['id']; ?>">Excluir Reserva</button>
                    </div>
                </div>

                <div class="reserva-image">
                    <?php 
                    foreach ($veiculos as $veiculo) {
                        if ($veiculo->id == $reserva['id_veiculo']) {
                            echo '<div class="item"><img src="/aluguel-carros-php/assets/imagens/' . $veiculo->imagem .'.png"></div>';
                            break;
                        }
                    }
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

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
                            location.reload(); 
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
