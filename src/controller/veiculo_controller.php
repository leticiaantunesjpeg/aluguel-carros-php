<?php

require_once "./conexao.php";
require_once "./src/models/veiculo_model.php";
require_once "./src/services/veiculo_services.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

if ($acao == 'inserir') {
    // Captura os dados do formulário
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];
    $valor = $_POST['valor'];
    $disponibilidade = $_POST['disponibilidade'];

    // Cria um objeto Veiculo e atribui os valores dos campos
    $veiculo = new Veiculo();
    $veiculo->__set('marca', $marca)
           ->__set('modelo', $modelo)
           ->__set('placa', $placa)
           ->__set('valor', $valor)
           ->__set('disponibilidade', $disponibilidade);

    // Instancia a conexão com o banco de dados
    $conexao = new Conexao();
    // Instancia a classe VeiculoService
    $veiculoService = new VeiculoService($conexao, $veiculo);
    // Chama o método inserir da classe VeiculoService para salvar o veículo no banco de dados
    $veiculoService->inserir();

    // Redireciona para a página listar_veiculos.php após inserção
    header('Location: listar_veiculos.php');
    exit;
} elseif ($acao == 'atualizar') {
    // Verifica se o ID do veículo foi passado via POST
    if (isset($_POST['id'])) {
        // Captura os dados do formulário
        $id = $_POST['id'];
        $disponibilidade = $_POST['disponibilidade'];

        // Cria um objeto Veiculo e atribui os valores dos campos
        $veiculo = new Veiculo();
        $veiculo->__set('id', $id)
               ->__set('disponibilidade', $disponibilidade);

        // Instancia a conexão com o banco de dados
        $conexao = new Conexao();
        // Instancia a classe VeiculoService
        $veiculoService = new VeiculoService($conexao, $veiculo);
        // Chama o método atualizar da classe VeiculoService para atualizar o veículo no banco de dados
        $veiculoService->atualizar();

        // Redireciona para a página listar_veiculos.php após atualização
        header('Location: listar_veiculos.php');
        exit;
    } else {
        echo "ID do veículo não fornecido.";
        exit;
    }
} elseif ($acao == 'recuperar') {
    // Instancia a conexão com o banco de dados
    $conexao = new Conexao();
    // Instancia a classe VeiculoService
    $veiculoService = new VeiculoService($conexao, new Veiculo());
    // Chama o método recuperarVeiculos da classe VeiculoService para recuperar todos os veículos
    $veiculos = $veiculoService->recuperarVeiculos();
    // Retorna os veículos no formato JSON
    echo json_encode($veiculos);
    exit;
} elseif ($acao == 'excluir') {
    // Verifica se o ID do veículo foi passado via GET
    if (isset($_GET['id'])) {
        // Captura o ID do veículo
        $id = $_GET['id'];

        // Cria um objeto Veiculo e atribui o ID do veículo
        $veiculo = new Veiculo();
        $veiculo->__set('id', $id);

        // Instancia a conexão com o banco de dados
        $conexao = new Conexao();
        // Instancia a classe VeiculoService
        $veiculoService = new VeiculoService($conexao, $veiculo);
        // Chama o método remover da classe VeiculoService para excluir o veículo do banco de dados
        $veiculoService->remover();

        // Redireciona para a página listar_veiculos.php após exclusão
        header('Location: listar_veiculos.php');
        exit;
    } else {
        echo "ID do veículo não fornecido.";
        exit;
    }
} else {
    echo "Ação não reconhecida.";
    exit;
}
?>
