<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - School</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <div class="login-userset">
                        <div class="login-logo">
                            <img src="assets/img/favicon.jpg" alt="img">
                        </div>
                        <div class="login-userheading">
                            <h3>Login Sistema de Notas</h3>
                            <h4>Por favor ingresar tus credenciales</h4>
                        </div>
                        <form method="post" id="frmAcceso">
                            <div class="form-login">
                                <label>Correo</label>
                                <div class="form-addons">
                                    <input name="username" id="username" type="text" placeholder="Enter your email address">
                                    <img src="assets/img/icons/mail.svg" alt="img">
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input name="password" type="password" id="password" class="pass-input" placeholder="Enter your password">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>

                            <div class="form-login">
                                <button type="submit" class="btn btn-login" href="index.html">Iniciar sesión</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="login-img">
                    <img src="assets/img/login.jpg" alt="img">
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/sweetalert2@9.js"></script>

    <script>
        $("#frmAcceso").on('submit', function(e) {
            e.preventDefault();
            logina = $("#username").val();
            clavea = $("#password").val();

            $.post("./controllers/login.php?op=verificar", {
                    "username": logina,
                    "password": clavea
                },
                function(data) {
                    if (data == 2) {
                        Swal.fire("Credenciales no válidas", "Por favor revise sus credenciales e intente de nuevo", "error");
                        //$(location).attr("href", "home.php");

                    } else {
                        $(location).attr("href", "./views");
                    }
                });
        })
    </script>
</body>

</html>