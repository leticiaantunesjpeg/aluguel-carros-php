<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluguel de Carros</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-nav .nav-item .nav-link.active {
            color: #FE8330;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/aluguel-carros-php/login.php">ALUGUEL DE CARROS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=aluguel">Aluguel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=reservas">Reservas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=veiculos">Todos os Veículos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <?php
        $acao = 'recuperar';
        include "conexao.php";
        $page = isset ($_GET['page']) ? $_GET['page'] : 'aluguel';

        switch ($page) {
            case 'aluguel':
                include ('aluguel.php');
                break;
            case 'reservas':
                include ('reservas.php');
                break;
            case 'veiculos':
                include ('veiculos.php');
                break;
            default:
                include ('aluguel.php');
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.navbar-nav .nav-link').removeClass('active');

            var currentPage = window.location.search.split('page=')[1] || 'aluguel';

            $('.navbar-nav .nav-link').each(function () {
                var linkPage = $(this).attr('href').split('page=')[1];
                if (linkPage === currentPage) {
                    $(this).addClass('active');
                }
            });
        });

  function recuperarDados() {
    fetch('veiculo_controller.php?acao=recuperar')
        .then(response => response.json())
        .then(data => {
           
            console.log(data);
        })
        .catch(error => console.error('Erro:', error));
    }

    </script>


</body>

</html>