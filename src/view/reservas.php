<?php
require_once "./src/controller/reserva_controller.php";

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Reserva</title>
</head>
<body>
    <h1>Adicionar Reserva</h1>

    <form action="../controller/reserva_controller.php?acao=inserir" method="POST">
    
        <label for="data_inicio">Data de Início:</label>
        <input type="date" name="data_inicio" id="data_inicio" required><br><br>

        <label for="data_fim">Data de Fim:</label>
        <input type="date" name="data_fim" id="data_fim" required><br><br>

        <label for="id_veiculo">ID do Veículo:</label>
        <input type="text" name="id_veiculo" id="id_veiculo" required><br><br>

        <label for="nome_cliente">Nome do Cliente:</label>
        <input type="text" name="nome_cliente" id="nome_cliente" required><br><br>

        <label for="doc_cliente">Documento do Cliente:</label>
        <input type="text" name="doc_cliente" id="doc_cliente" required><br><br>

        <input type="submit" value="Adicionar Reserva">
    </form>
</body>
</html>
