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
    $idcurso = isset($_POST["idcurso"]) ? limpiarCadena($_POST["idcurso"]) : "";
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

        case 'asingar':
            try {
                $rspta = $estudiante->insertarcurso($idcurso, $id);
                echo $rspta != 0 ? 1 : 2;
            } catch (Exception $e) {
                echo 2;
            }
            break;
        case 'eliminarAsignar':
            $idcursoestudiante = isset($_POST["idcursoestudiante"]) ? limpiarCadena($_POST["idcursoestudiante"]) : "";
            $rspta = $estudiante->desactivarcurso($idcursoestudiante);
            echo $rspta ? 1 : 0;
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
                    ' 
                    <a data-bs-toggle="tooltip" data-bs-placement="top" class="me-3" title="Asignar grado" href="' . getBaseUrl() . '/views/estudiante/cursos.php?id=' . $reg->idestudiante . '">
                        <img src="../../assets/img/icons/excel.svg" alt="img"/>
                    </a>
                    <a class="me-3" href="' . getBaseUrl() . '/views/estudiante/edit.php?id=' . $reg->idestudiante . '"><img src="../../assets/img/icons/edit.svg" alt="img" /></a>
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

        case 'listarcursos':
            $idestudiante = isset($_GET["id"]) ? limpiarCadena($_GET["id"]) : "";
            $rspta = $estudiante->listarCursos($idestudiante);
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(

                    "0" => $reg->idcursoestudiante,
                    "1" => $reg->curso,
                    "2" => $reg->estudiante,
                    "3" =>
                    '<a onclick="desactivar(' . $reg->idcursoestudiante . ')" class="me-3 confirm-text" href="#">
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
