<?php

require_once "./conexao.php";
require_once "./src/models/reserva_model.php";
require_once "./src/services/reserva_services.php";


$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

if ($acao == 'inserir') {
    // Captura os dados do formulário
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $id_veiculo = $_POST['id_veiculo'];
    $nome_cliente = $_POST['nome_cliente'];
    $doc_cliente = $_POST['doc_cliente'];

    // Cria um objeto Reserva e atribui os valores dos campos
    $reserva = new Reserva();
    $reserva->__set('data_inicio', $data_inicio)
           ->__set('data_fim', $data_fim)
           ->__set('id_veiculo', $id_veiculo)
           ->__set('nome_cliente', $nome_cliente)
           ->__set('doc_cliente', $doc_cliente);

    // Instancia a conexão com o banco de dados
    $conexao = new Conexao();
    // Instancia a classe ReservaService
    $reservaService = new ReservaService($conexao, $reserva);
    // Chama o método inserir da classe ReservaService para salvar a reserva no banco de dados
    $reservaService->inserir();

    // Redireciona para a página listar_reservas.php após inserção
    header('Location: aluguel.php');
    exit;
} elseif ($acao == 'atualizar') {
    // Verifica se o ID da reserva foi passado via POST
    if (isset($_POST['id'])) {
        // Captura os dados do formulário
        $id = $_POST['id'];
        $data_inicio = $_POST['data_inicio'];
        $data_fim = $_POST['data_fim'];
        $id_veiculo = $_POST['id_veiculo'];
        $nome_cliente = $_POST['nome_cliente'];
        $doc_cliente = $_POST['doc_cliente'];

        // Cria um objeto Reserva e atribui os valores dos campos
        $reserva = new Reserva();
        $reserva->__set('id', $id)
               ->__set('data_inicio', $data_inicio)
               ->__set('data_fim', $data_fim)
               ->__set('id_veiculo', $id_veiculo)
               ->__set('nome_cliente', $nome_cliente)
               ->__set('doc_cliente', $doc_cliente);

        // Instancia a conexão com o banco de dados
        $conexao = new Conexao();
        // Instancia a classe ReservaService
        $reservaService = new ReservaService($conexao, $reserva);
        // Chama o método atualizar da classe ReservaService para atualizar a reserva no banco de dados
        $reservaService->atualizar();

        // Redireciona para a página listar_reservas.php após atualização
        header('Location: aluguel.php');
        exit;
    } else {
        echo "ID da reserva não fornecido.";
        exit;
    }
} elseif ($acao == 'recuperar') {
    // Instancia a conexão com o banco de dados
    $conexao = new Conexao();
    // Instancia a classe ReservaService
    $reservaService = new ReservaService($conexao, new Reserva());
    // Chama o método recuperarReservas da classe ReservaService para recuperar todas as reservas
    $reservas = $reservaService->recuperarReservas();
    // Retorna as reservas no formato JSON
    echo json_encode($reservas);
    exit;
} elseif ($acao == 'excluir') {
    // Verifica se o ID da reserva foi passado via GET
    if (isset($_GET['id'])) {
        // Captura o ID da reserva
        $id = $_GET['id'];

        // Cria um objeto Reserva e atribui o ID da reserva
        $reserva = new Reserva();
        $reserva->__set('id', $id);

        // Instancia a conexão com o banco de dados
        $conexao = new Conexao();
        // Instancia a classe ReservaService
        $reservaService = new ReservaService($conexao, $reserva);
        // Chama o método remover da classe ReservaService para excluir a reserva do banco de dados
        $reservaService->remover();

        // Redireciona para a página listar_reservas.php após exclusão
        header('Location: aluguel.php');
        exit;
    } else {
        echo "ID da reserva não fornecido.";
        exit;
    }
} else {
    echo "Ação não reconhecida.";
    exit;
}
?>
