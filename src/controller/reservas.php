

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Veículo</title>
</head>
<body>
    <h2>Reservar Veículo</h2>
    <form action="reserva_services.php" method="post">
        <label for="data_inicio">Data de Início:</label><br>
        <input type="date" id="data_inicio" name="data_inicio" required><br><br>

        <label for="data_fim">Data de Fim:</label><br>
        <input type="date" id="data_fim" name="data_fim" required><br><br>

        <label for="id_veiculo">ID do Veículo:</label><br>
        <input type="text" id="id_veiculo" name="id_veiculo" required><br><br>

        <label for="nome_cliente">Nome do Cliente:</label><br>
        <input type="text" id="nome_cliente" name="nome_cliente" required><br><br>

        <label for="doc_cliente">Documento do Cliente (CPF):</label><br>
        <input type="text" id="doc_cliente" name="doc_cliente" required><br><br>

        <input type="submit" value="Reservar">
    </form>
</body>
</html>
