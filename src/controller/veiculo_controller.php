<?php

require_once "./conexao.php";
require_once "./src/models/veiculo_model.php";
require_once "./src/services/veiculo_services.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';



    
if ($acao == 'recuperar') {
    // Instancia a conexão com o banco de dados
    $conexao = new Conexao();
    // Instancia a classe VeiculoService
    $veiculoService = new VeiculoService($conexao, new Veiculo());
    // Chama o método recuperarVeiculos da classe VeiculoService para recuperar todos os veículos
    $veiculos = $veiculoService->recuperarVeiculos();
    // Retorna os veículos no formato JSON
    echo json_encode($veiculos);
    exit;
} 
 else {
    echo "Ação não reconhecida.";
    exit;
}
?>
