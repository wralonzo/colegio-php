<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
function getBaseUrl()
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];
    return
        $protocol . $domainName . "/school";
}
if (!isset($_SESSION["nombre"])) {
    header("Location: " . getBaseUrl());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="POS - Bootstrap Admin Template" />
    <meta
        name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Colegio</title>

    <link
        rel="shortcut icon"
        type="image/x-icon"
        href="<?= getBaseUrl() ?>/assets/img/favicon.jpg" />

    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/animate.css" />

    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/plugins/select2/css/select2.min.css" />

    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/dataTables.bootstrap4.min.css" />
    <link
        rel="stylesheet"
        href="<?= getBaseUrl() ?>/assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/plugins/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="<?= getBaseUrl() ?>/assets/css/style.css" />
</head>

<body class="">

    <body>
        <div id="global-loader">
            <div class="whirly-loader"></div>
        </div>

        <div class="main-wrapper">
            <div class="header">
                <div class="header-left active">
                    <a href="index.html" class="logo">
                        <img src="<?= getBaseUrl() ?>/assets/img/logo.png" alt="" />
                    </a>
                    <a href="index.html" class="logo-small">
                        <img src="<?= getBaseUrl() ?>/assets/img/favicon.jpg" alt="" />
                    </a>
                    <a id="toggle_btn" href="javascript:void(0);"> </a>
                </div>

                <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>

                <ul class="nav user-menu">

                    <li class="nav-item dropdown has-arrow main-drop">
                        <a
                            href="javascript:void(0);"
                            class="dropdown-toggle nav-link userset"
                            data-bs-toggle="dropdown">
                            <span class="user-img"><img src="<?php echo isset($_SESSION["imagen"]) ? getBaseUrl() . '/files/usuarios/' . $_SESSION["imagen"] : getBaseUrl() . '/assets/img/profiles/avator1.jpg' ?>" alt="" />
                                <span class="status online"></span></span>
                        </a>
                        <div class="dropdown-menu menu-drop-user">
                            <div class="profilename">
                                <div class="profileset">
                                    <span class="user-img"><img src="<?php echo isset($_SESSION["imagen"]) ? getBaseUrl() . '/files/usuarios/' . $_SESSION["imagen"] : getBaseUrl() . '/assets/img/profiles/avator1.jpg' ?>" alt="" />
                                        <span class="status online"></span></span>
                                    <div class="profilesets">
                                        <h6><?= isset($_SESSION["correo"]) ? $_SESSION["correo"] : '' ?></h6>
                                        <h5><?= isset($_SESSION["login"]) ? $_SESSION["login"] : '' ?></h5>
                                    </div>
                                </div>
                                <hr class="m-0" />
                                <a class="dropdown-item" href="profile.html">
                                    <i class="me-2" data-feather="user"></i><?= isset($_SESSION["login"]) ? $_SESSION["login"] : '' ?></a>
                                <hr class="m-0" />
                                <a class="dropdown-item logout pb-0" href="<?= getBaseUrl() ?>/controllers/login.php?op=salir"><img
                                        src="<?= getBaseUrl() ?>/assets/img/icons/log-out.svg"
                                        class="me-2"
                                        alt="img" />Cerrar sesión</a>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="dropdown mobile-user-menu">
                    <a
                        href="javascript:void(0);"
                        class="nav-link dropdown-toggle"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="profile.html">Mi perfil</a>
                        <a class="dropdown-item" href="<?= getBaseUrl() ?>/controllers/login.php?op=salir">Logout</a>
                    </div>
                </div>
            </div>

            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li class="active">
                                <a href="<?= getBaseUrl() ?>/views/"><img src="<?= getBaseUrl() ?>/assets/img/icons/dashboard.svg" alt="img" /><span>
                                        Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= getBaseUrl() ?>/views/estudiante"><i data-feather="user"></i><span>Estudiantes</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= getBaseUrl() ?>/views/notas"><i data-feather="list"></i><span>Notas</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= getBaseUrl() ?>/views/diario"><i data-feather="book"></i><span>Diario pedagogico</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= getBaseUrl() ?>/views/asistencia"><i data-feather="check"></i><span>Asistencias</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= getBaseUrl() ?>/views/curso"><i data-feather="list"></i><span>Grados</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= getBaseUrl() ?>/views/asignatura"><i data-feather="book"></i><span>Asignaturas</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= getBaseUrl() ?>/views/user"><i data-feather="users"></i><span>Usuarios</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>