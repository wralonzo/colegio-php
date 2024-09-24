<?php


try {
    session_start();
    require_once "../models/Estudiante.php";
    require '../config/baseurl.php';
    $estudiante = new Estudiante();

    $id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
    $nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
    $papeleria = isset($_POST["papeleria"]) ? limpiarCadena($_POST["papeleria"]) : "";
    $numero = isset($_POST["numero"]) ? limpiarCadena($_POST["numero"]) : "";
    $edad = isset($_POST["edad"]) ? limpiarCadena($_POST["edad"]) : "";
    $direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
    switch ($_GET["op"]) {
        case 'guardaryeditar':
            if (empty($id)) {
                try {
                    $rspta = $estudiante->insertar($nombre, $papeleria, $numero, $direccion, $edad);
                    echo $rspta != 0 ? 1 : 2;
                } catch (Exception $e) {
                    echo 2;
                }
            } else {
                $rspta = $estudiante->editar($id, $nombre, $papeleria, $numero, $direccion, $edad);
                echo $rspta ? 3 : 4;
            }
            break;

        case 'desactivar':
            $rspta = $estudiante->desactivar($id);
            echo $rspta ? 1 : 0;
            break;
        case 'mostrar':
            $rspta = $estudiante->mostrar($id);
            echo json_encode($rspta);
            break;
        case 'all':
            $rspta = $estudiante->listar();
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                array_push($data, $reg);
            }
            echo json_encode($data);
            break;
        case 'listar':
            $rspta = $estudiante->listar();
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(

                    "0" => $reg->idestudiante,
                    "1" => $reg->nombres,
                    "2" => $reg->papeleria,
                    "3" => $reg->numero,
                    "4" => $reg->direccion,
                    "5" => $reg->edad,
                    "6" =>
                    ' <a class="me-3" href="' . getBaseUrl() . '/views/estudiante/edit.php?id=' . $reg->idestudiante . '"><img src="../../assets/img/icons/edit.svg" alt="img" /></a>
					    <a onclick="desactivar(' . $reg->idestudiante . ')" class="me-3 confirm-text" href="#">
						    <img src="../../assets/img/icons/delete.svg" alt="img" />
						</a>',
                );
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecords" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data
            );
            echo json_encode($results);

            break;
    }
} catch (Exception $e) {
    var_dump($e);
}
