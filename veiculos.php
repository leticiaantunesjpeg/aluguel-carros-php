<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="veiculos.css">
    <title>Veículos</title>
</head>

<body>

    <?php

    require_once('./conexao.php');
    require_once('./veiculo_model.php');
    require_once('./veiculo_service.php');

    $conexao = new Conexao();
    $veiculoService = new VeiculoService($conexao, new Veiculo());
    $veiculos = $veiculoService->recuperarVeiculos();

    if ($veiculos) {
        echo '<h2 class="title">Todos os Veículos</h2>';
        echo '<div class="container">';
        foreach ($veiculos as $veiculo) {
            echo '<div class="card">';
            echo '<div class="item"><img src="/aluguel-carros-php/assets/imagens/' . $veiculo->imagem . '.png" alt="' . $veiculo->marca . ' ' . $veiculo->modelo . '"></div>';
            echo '<div class="card-info">';
            echo '<div class="card-title">' . $veiculo->marca . ' ' . $veiculo->modelo . '</div>';
            echo '<p><strong>Placa:</strong> ' . $veiculo->placa . '</p>';
            echo '<p><strong>Valor:</strong> ' . $veiculo->valor . '</p>';
            if ($veiculo->disponibilidade == 1) {
                echo '<p><strong>Disponibilidade:</strong> <span style="font-weight: bold; color: #4CAF50;">Disponível</span></p>';
            } else {
                echo '<p><strong>Disponibilidade:</strong> <span style="font-weight: bold; color: #F44336;">Indisponível</span></p>';
            }
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>Nenhum veículo encontrado.</p>';
    }
    ?>

</body>

</html>