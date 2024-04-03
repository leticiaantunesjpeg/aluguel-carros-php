<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" rel="stylesheet">
</head>

<body>

    <section class="vh-100" style="background-color: #FFD8B1;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="/aluguel-carros-php/assets/login-image.png" alt="formulario de login"
                                    class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form>

                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3"
                                                style="color: #ff6219; margin-right: 0.5rem;"></i>
                                            <span class="h2 fw-bold mb-0"> Aluguel de carros</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Faça login na sua
                                            conta</h5>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">E-mail</label>
                                            <input type="email" id="form2Example17"
                                                class="form-control form-control-lg" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Senha</label>
                                            <input type="password" id="form2Example27"
                                                class="form-control form-control-lg" />
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="button">Login</button>
                                            <a href="/aluguel-carros-php/view/home.php" class="btn btn-dark btn-lg btn-block">Login</a>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>