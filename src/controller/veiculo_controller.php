<?php

require_once "../controller/conexao.php";
require_once "../models/veiculo.model.php";
require_once "../services/veiculo_services.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';


if ($acao == 'atualizar') {

    $disponibilidade = $_POST['disponibilidade'];

    $veiculo = new Veiculo();
    $veiculo->__set('id', $id)

        ->__set('disponibilidade', $disponibilidade);

    $conexao = new Conexao();
    $veiculoService = new VeiculoService($conexao, $veiculo);
    $veiculoService->atualizar();

    header('Location: listar_veiculos.php');
    exit;
}elseif ($acao == 'recuperar') {
    $conexao = new Conexao();
    $veiculoService = new VeiculoService($conexao, new Veiculo());
    $veiculos = $veiculoService->recuperarVeiculos();
    echo json_encode($veiculos);
    exit;
}
else {
    echo "Ação não reconhecida.";
    exit;
}
