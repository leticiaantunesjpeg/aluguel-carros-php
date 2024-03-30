<?php
require_once './reserva_model.php';
require_once './conexao.php';



class Reserva {
    public $id;
    public $data_inicio;
    public $data_fim;
    public $id_veiculo;
    public $nome_cliente;
    public $doc_cliente;
}



// Função para escapar caracteres especiais para evitar injeção de SQL
function limpar_dados($dados) {
    return htmlspecialchars(strip_tags($dados));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conexao = new Conexao();
    $db = $conexao->conectar();

    $reserva = new Reserva();
    $reserva->__set('data_inicio', limpar_dados($_POST['data_inicio']));
    $reserva->__set('data_fim', limpar_dados($_POST['data_fim']));
    $reserva->__set('id_veiculo', limpar_dados($_POST['id_veiculo']));
    $reserva->__set('nome_cliente', limpar_dados($_POST['nome_cliente']));
    $reserva->__set('doc_cliente', limpar_dados($_POST['doc_cliente']));

    $stmt = $db->prepare("INSERT INTO reserva (data_inicio, data_fim, id_veiculo, nome_cliente, doc_cliente) VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $reserva->data_inicio);
    $stmt->bindParam(2, $reserva->data_fim);
    $stmt->bindParam(3, $reserva->id_veiculo);
    $stmt->bindParam(4, $reserva->nome_cliente);
    $stmt->bindParam(5, $reserva->doc_cliente);

    if ($stmt->execute()) {
        echo "Reserva realizada com sucesso!<br>";
        echo "Dados inseridos na tabela:<br>";
        echo "Data de Início: " . $reserva->data_inicio . "<br>";
        echo "Data de Fim: " . $reserva->data_fim . "<br>";
        echo "ID do Veículo: " . $reserva->id_veiculo . "<br>";
        echo "Nome do Cliente: " . $reserva->nome_cliente . "<br>";
        echo "Documento do Cliente (CPF): " . $reserva->doc_cliente . "<br>";
    } else {
        echo "Erro ao realizar a reserva.";
    }
}
?>
