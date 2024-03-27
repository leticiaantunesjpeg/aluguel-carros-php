<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veículos</title>
    
</head>
<body>

<?php
// Incluir o arquivo de configuração do banco de dados e as classes necessárias
require_once('./src/controller/conexao.php');
require_once('./src/models/veiculo_model.php');
require_once('./src/services/veiculo_services.php');

// Criar uma instância da classe Conexao
$conexao = new Conexao();

// Criar uma instância da classe VeiculoService
$veiculoService = new VeiculoService($conexao, new Veiculo());

// Recuperar os veículos do banco de dados
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
