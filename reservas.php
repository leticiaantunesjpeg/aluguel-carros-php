<?php
require_once('./reserva_model.php');
require_once('./conexao.php');
require_once('./reserva_service.php');

$conexao = new Conexao();
$reservaService = new ReservaService($conexao->conectar(), new Reserva());
$reservas = $reservaService->listarReservas();


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="aluguel.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Reservas</h2>
    <table>
        <thead>
            <tr>
                <th>Data de Início</th>
                <th>Data de Fim</th>
                <th>ID do Veículo</th>
                <th>Nome do Cliente</th>
                <th>CPF do Cliente</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $reserva) : ?>
                <tr>
                    <td><?php echo $reserva['data_inicio']; ?></td>
                    <td><?php echo $reserva['data_fim']; ?></td>
                    <td><?php echo $reserva['id_veiculo']; ?></td>
                    <td><?php echo $reserva['nome_cliente']; ?></td>
                    <td><?php echo $reserva['doc_cliente']; ?></td>
                    <td>
                        <form action="reservas.php" method="post">
                            <input type="hidden" name="action" value="excluirReserva">
                            <input type="hidden" name="id_reserva" value="<?php echo $reserva['id']; ?>">
                            <button type="submit">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>