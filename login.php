<?php
session_start();
require 'db_config.php'; // Archivo con la configuración de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar datos de entrada
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            // Generar un nuevo ID de sesión para prevenir fijación de sesión
            session_regenerate_id(true);
            $_SESSION['user_id'] = $id;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Usuario o contraseña incorrecta.";
        }
    } else {
        $error = "Usuario o contraseña incorrecta.";
    }
    $stmt->close();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login | Minia - Minimal Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description">
    <meta content="Themesbrand" name="author">
    <!-- preloader css -->
    <link rel="stylesheet" href="static/css/preloader.min-1.css" type="text/css">
    <!-- Bootstrap Css -->
    <link href="static/css/bootstrap.min-1.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="static/css/icons.min-1.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="static/css/app.min-1.css" id="app-style" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="index-1.html" class="d-block auth-logo">
                                        <img src="static/picture/logo-sm-1.svg" alt="" height="28"> <span
                                            class="logo-txt">Ministerio de Educación</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Bienvenido!</h5>
                                        <p class="text-muted mt-2">Ingreso al sitema</p>
                                    </div>
                                    <form method="POST" action="login.php" class="custom-form mt-4 pt-2">
                                        <div class="mb-3">
                                            <label class="form-label">Usuario</label>
                                            <input type="text" name="username" class="form-control" id="username"
                                                placeholder="ingresa tu usuario" required>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label">Contraseña</label>
                                                </div>
                                                <!-- <div class="flex-shrink-0">
                                                    <div class="">
                                                        <a href="auth-recoverpw-1.html" class="text-muted">¿Olvidaste tu contraseña?</a>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" name="password" class="form-control"
                                                    placeholder="ingresa tu contraseña" aria-label="Password"
                                                    aria-describedby="password-addon" required>
                                                <button class="btn btn-light shadow-none ms-0" type="button"
                                                    id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>

                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="remember-check">
                                                    <label class="form-check-label" for="remember-check">
                                                        Recordarme
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (isset($error)) {
                                            echo "<p style='color:red;' class='text-center'>$error</p>";
                                        } ?>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">Ingresar</button>
                                        </div>
                                    </form>
                                    <!-- <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Don't have an account ? <a href="register.php"
                                                class="text-primary fw-semibold"> Signup now </a> </p>
                                    </div> -->
                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">©
                                        <script>document.write(new Date().getFullYear())</script> Todos los derechos reservados MINEDU - DIGESE
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-9 col-lg-8 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                        <div class="row justify-content-center align-items-center">
                            <div class="col-xl-7">
                                <div class="p-0 p-sm-4 px-xl-0">
                                    <!-- Contenido de carrusel (opcional) -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="static/js/jquery.min-1.js"></script>
    <script src="static/js/bootstrap.bundle.min-1.js"></script>
    <script src="static/js/metisMenu.min-1.js"></script>
    <script src="static/js/simplebar.min-1.js"></script>
    <script src="static/js/waves.min-1.js"></script>
    <script src="static/js/feather.min-1.js"></script>
    <!-- pace js -->
    <script src="static/js/pace.min-1.js"></script>
    <!-- password addon init -->
    <script src="static/js/pass-addon.init-1.js"></script>
</body>

</html>