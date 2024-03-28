<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluguel de Carros</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="./src/view/css/aluguel.css">
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

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div style="
            min-height: 500px;">
        <div class="container" id="car-selection-form">
            <div class="form-container">
                <h4 style="text-align: center;">Preencha as informações</h4>
                <hr>
                <label>Carro</label>
                <select id="car-type-select" class="form-control mb-3" style="cursor: pointer;" required>
                    <option value="0">Selecione</option>
                </select>
                <div class="form-group">
                    <label for="start-date">Data de Início</label>
                    <input type="date" class="form-control" id="start-date" style="cursor: pointer;" required>
                </div>
                <div class="form-group">
                    <label for="end-date">Data de Fim</label>
                    <input type="date" class="form-control" id="end-date" style="cursor: pointer;" required>
                </div>
                <button id="continue-reservation-btn" class="btn btn-primary btn-block">Continuar Reserva</button>
            </div>
            <div class="carousel-container">
                <div class="owl-carousel owl-theme"></div>
            </div>
        </div>


        <div class="container" id="customer-info-form" style="display: none; width: 1496px; height:700px;">
            <div class="form-container">
                <form id="customer-form">

                    <label for="customer-car" style="color:black;">Carro selecionado</label>
                    <input type="text" value="carro-selecionado" class="form-control" id="customer-car">

                    <label for="customer-startDate" style="color:black;">Início da reserva</label>
                    <input type="text" value="data-inicial-selecionada" class="form-control" id="customer-startDate">

                    <label for="customer-endDate" style="color:black;">Fim da reserva</label>
                    <input type="text" value="data-final-selecionada" class="form-control" id="customer-endDate">

                    <label for="customer-name" style="color:black;">Nome do Cliente</label>
                    <input type="text" class="form-control" id="customer-name" required><br>

                    <label for="customer-cpf" style="color:black;">CPF</label>
                    <input type="text" class="form-control" id="customer-cpf" required><br>

                    <label for="customer-address" style="color:black;">Endereço</label>
                    <input type="text" class="form-control" id="customer-address" required><br>

                    <button id="back-to-car-selection-btn" class="btn btn-secondary">Voltar para seleção de
                        carro</button>
                    <button id="confirm-reservation-btn" class="btn btn-primary">Confirmar Reserva</button>
                </form>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script>
            var selectedCarId;
            var selectedStartDate;
            var selectedEndDate;

            $(document).ready(function () {
                var cars = [
                    {
                        "id": 1,
                        "marca": "Camaro",
                        "modelo": "",
                        "placa": "ABC-1234",
                        "valor": 78000,
                        "disponibilidade": true,
                        "imagem": "jaguar"
                    },
                    {
                        "id": 2,
                        "marca": "Chevette",
                        "modelo": "",
                        "placa": "DEF-5678",
                        "valor": 45000,
                        "disponibilidade": false,
                        "imagem": "chevrolet_chevette"
                    },
                    {
                        "id": 3,
                        "marca": "corvette",
                        "modelo": "",
                        "placa": "GHI-9012",
                        "valor": 55000,
                        "disponibilidade": true,
                        "imagem": "chevrolet_corvette"
                    }
                ];

                var selectOptions = '';
                var carouselItems = '';

                $.each(cars, function (index, car) {
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

                $('#car-type-select').on('change', function () {
                    selectedCarId = $(this).val();
                    $('.owl-carousel').trigger('to.owl.carousel', [selectedCarId - 1, 500]);
                });


                $('#continue-reservation-btn').on('click', function (event) {
                    event.preventDefault();
                    onContinueCarReservation();
                });

                $('#back-to-car-selection-btn').on('click', function (event) {
                    event.preventDefault();
                    onBackToCarSelection();
                });
            });

            function onContinueCarReservation() {
                selectedStartDate = $('#start-date').val();
                selectedEndDate = $('#end-date').val();
                $('#car-selection-form').hide();
                $('#customer-info-form').show();
            }

            function onBackToCarSelection() {
                $('#customer-info-form').hide();
                $('#car-selection-form').show();
            }
        </script>
</body>

</html>