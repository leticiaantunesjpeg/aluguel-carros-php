<?php
require_once('./reserva_model.php');
require_once('./veiculo_model.php');
require_once('./veiculo_service.php');
require_once('./reserva_service.php');
require_once('./conexao.php');

$conexao = new Conexao();

$veiculoService = new VeiculoService($conexao, new Veiculo());
$reservaService = new ReservaService($conexao, new Reserva());
$veiculos = $veiculoService->recuperarVeiculos();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Aluguel de Carros</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="aluguel.css">
    <style>
        .owl-carousel .owl-nav button.owl-prev,
        .owl-carousel .owl-nav button.owl-next {
            z-index: 1;
            width: 50px;
            height: 50px;
            background-color: #fff;
            border-radius: 50%;
            top: 50%;
        }

        .owl-carousel .owl-nav button.owl-prev:hover,
        .owl-carousel .owl-nav button.owl-next:hover {
            background-color: #ffdcbf;
        }

        .owl-nav button span {
            font-size: 40px;
            height: 100%;
            width: 100%;
            color: #ff6219;
        }

        .owl-dots {
            display: none;
        }
    </style>
</head>

<body>
    <div style="min-height: 500px;">
        <div class="container" id="car-selection-form">
            <div class="form-container">
                <h4 style="text-align: center;">Preencha as informações</h4>
                <hr>
                <label>Carro</label>
                <select id="car-type-select" class="form-control mb-3" style="cursor: pointer;" required>
                    <option value="">Selecione</option>
                    <?php foreach ($veiculos as $veiculo) : ?>
                        <option value="<?php echo $veiculo->id; ?>"><?php echo $veiculo->marca . ' ' . $veiculo->modelo; ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="form-group">
                    <label for="start-date">Data de Início</label>
                    <input type="date" class="form-control" id="start-date" style="cursor: pointer;" required>
                </div>
                <div class="form-group">
                    <label for="end-date">Data de Fim</label>
                    <input type="date" class="form-control" id="end-date" style="cursor: pointer;" required>
                </div>
                <div id="error-message" style="display: none; margin-bottom: 10px; color: red;">Por favor, preencha todos os campos
                    obrigatórios.</div>

                <button id="continue-reservation-btn" class="btn btn-primary btn-block">Continuar Reserva</button>
            </div>
            <div class="carousel-container">
                <div class="owl-carousel owl-theme"></div>
            </div>
        </div>

        <div class="container" id="customer-info-form" style="display: none; width: 1496px;">
            <div class="form-container" style="width: 60%">
                <form id="customer-form" class="customer-form">
                    <h4 style="text-align: center;">Finalize a reserva</h4>
                    <hr>
                    <label for="customer-car" style="color:black;">Carro selecionado</label>
                    <select class="form-control continue-reservation-inputs" id="customer-car" disabled>
                        <?php foreach ($veiculos as $veiculo) : ?>
                            <?php if ($veiculo->id == $selectedCarId) : ?>
                                <option value="<?php echo $veiculo->id; ?>" selected><?php echo $veiculo->marca . ' ' . $veiculo->modelo; ?></option>
                            <?php else : ?>
                                <option value="<?php echo $veiculo->id; ?>"><?php echo $veiculo->marca . ' ' . $veiculo->modelo; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>

                    <label for="customer-startDate" style="color:black;">Início da reserva</label>
                    <input type="text" class="form-control continue-reservation-inputs" id="customer-startDate" value="<?php echo $selectedStartDate; ?>" disabled>

                    <label for="customer-endDate" style="color:black;">Fim da reserva</label>
                    <input type="text" class="form-control continue-reservation-inputs" id="customer-endDate" value="<?php echo $selectedEndDate; ?>" disabled>

                    <label for="customer-name" style="color:black;">Nome do Cliente</label>
                    <input type="text" class="form-control continue-reservation-inputs" id="customer-name" required>

                    <label for="customer-cpf" style="color:black;">CPF</label>
                    <input type="text" class="form-control continue-reservation-inputs" id="customer-cpf" required><br>

                    <div id="customer-error-message" style="display: none; margin-bottom: 15px; margin-top: -20px; color: red;">Por favor, preencha todos os campos obrigatórios.</div>

                    <button id="back-to-car-selection-btn" class="btn btn-secondary costumer-back-button">Voltar</button>
                    <button id="confirm-reservation-btn" class="btn  costumer-next-button">Finalizar</button>
                </form>
            </div>
        </div>

        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Sucesso!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        A reserva foi salva com sucesso!
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Erro!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Houve um erro ao salvar a reserva. Por favor, tente novamente.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        var selectedCarId;
        var selectedStartDate;
        var selectedEndDate;

        $(document).ready(function() {
            var cars = <?php echo json_encode($veiculos); ?>;

            var selectOptions = '';
            var carouselItems = '';

            $.each(cars, function(index, car) {
                selectOptions += '<option value="' + car.id + '">' + car.marca + ' ' + car.modelo + '</option>';
                carouselItems += '<div class="item"><img src="/aluguel-carros-php/assets/imagens/' + car.imagem + '.png" alt="' + car.marca + ' ' + car.modelo + '"></div>';
            });

            $('#car-type-select').append(selectOptions);
            $('.owl-carousel').html(carouselItems);

            $(".owl-carousel").owlCarousel({
                items: 1,
                loop: true,
                nav: true,
                dots: true,
                autoplay: true,
                autoplaySpeed: 1000,
                smartSpeed: 1500,
                autoplayHoverPause: true
            });

            $('#car-type-select').on('change', function() {
                selectedCarId = $(this).val();
                $('.owl-carousel').trigger('to.owl.carousel', [selectedCarId - 1, 500]);
            });

            $('#continue-reservation-btn').on('click', function(event) {
                event.preventDefault();
                var selectedCar = document.getElementById('car-type-select').value;
                var startDate = document.getElementById('start-date').value;
                var endDate = document.getElementById('end-date').value;

                if (selectedCar === "" || startDate === "" || endDate === "") {
                    $('#error-message').show();
                    return false;
                }

                selectedCarId = selectedCar;
                selectedStartDate = startDate;
                selectedEndDate = endDate;

                onContinueCarReservation();
            });

            $('#back-to-car-selection-btn').on('click', function(event) {
                event.preventDefault();
                onBackToCarSelection();
            });
        });

        function onContinueCarReservation() {
            $('#car-selection-form').hide();
            $('#customer-info-form').show();
            $('#customer-car').val(selectedCarId);
            $('#customer-startDate').val(selectedStartDate);
            $('#customer-endDate').val(selectedEndDate);
        }

        function onBackToCarSelection() {
            $('#customer-info-form').hide();
            $('#car-selection-form').show();
        }

        $('#confirm-reservation-btn').on('click', function(event) {
            event.preventDefault();

            var nomeCliente = $('#customer-name').val();
            var docCliente = $('#customer-cpf').val();

            if (!nomeCliente || !docCliente) {
                $('#customer-error-message').show();
                return false;
            } else {
                $('#customer-error-message').hide();
            }

            var dataInicio = $('#start-date').val();
            var dataFim = $('#end-date').val();
            var idVeiculo = selectedCarId;

            // Verificar disponibilidade do veículo
            $.ajax({
                url: 'veiculo_service.php',
                method: 'POST',
                data: {
                    action: 'verificarDisponibilidade',
                    id_veiculo: idVeiculo
                },
                success: function(disponibilidade) {
                    if (disponibilidade == 1) {
                        // Disponibilidade igual a 1, pode prosseguir com a reserva
                        $.ajax({
                            url: 'reserva_service.php',
                            method: 'POST',
                            data: {
                                action: 'salvarReserva',
                                data_inicio: dataInicio,
                                data_fim: dataFim,
                                id_veiculo: idVeiculo,
                                nome_cliente: nomeCliente,
                                doc_cliente: docCliente
                            },
                            success: function(response) {
                                // Após a reserva ser salva com sucesso, atualize a disponibilidade do veículo
                                $.ajax({
                                    url: 'veiculo_service.php',
                                    method: 'POST',
                                    data: {
                                        action: 'atualizarDisponibilidade',
                                        id_veiculo: idVeiculo
                                    },
                                    success: function(response) {
                                        $('#successModal').modal('show');
                                    },
                                    error: function(xhr, status, error) {
                                        $('#errorModal').modal('show');
                                        console.error(error);
                                    }
                                });
                            },
                            error: function(xhr, status, error) {
                                $('#errorModal').modal('show');
                                console.error(error);
                            }
                        });
                    } else {
                        // Disponibilidade diferente de 1, exibir mensagem de erro
                        $('#errorModal').modal('show').find('.modal-body').text('O veículo selecionado não está disponível para reserva.');
                    }
                },
                error: function(xhr, status, error) {
                    $('#errorModal').modal('show');
                    console.error(error);
                }
            });
        });

    </script>






</body>

</html>
