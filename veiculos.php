<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veículos</title>
    
</head>
<body>

<?php

require_once('./conexao.php');
require_once('./veiculo_model.php');
require_once('./veiculo_services.php');


$conexao = new Conexao();


$veiculoService = new VeiculoService($conexao, new Veiculo());


$veiculos = $veiculoService->recuperarVeiculos();

if ($veiculos) {
    echo '<h2>Lista de Veículos</h2>';
    echo '<table>';
    echo '<tr><th>Marca</th><th>Modelo</th><th>Placa</th><th>Valor</th><th>Disponibilidade</th><th>Imagem</th></tr>';
    foreach ($veiculos as $veiculo) {
        echo '<tr>';
        echo '<td>' . $veiculo->marca . '</td>';
        echo '<td>' . $veiculo->modelo . '</td>';
        echo '<td>' . $veiculo->placa . '</td>';
        echo '<td>' . $veiculo->valor . '</td>';
        echo '<td>' . $veiculo->disponibilidade . '</td>';
        echo '<td>' . $veiculo->imagem . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    
    // JavaScript para exibir veículos no console
    echo '<script>';
    echo 'console.log("Veículos:");';
    echo 'console.table(' . json_encode($veiculos) . ');';
    echo '</script>';
} else {
    echo '<p>Nenhum veículo encontrado.</p>';
}
?>

</body>
</html>
