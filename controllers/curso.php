<?php


try {
    session_start();
    require_once "../models/Curso.php";
    require '../config/baseurl.php';
    $task = new Curso();

    $id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
    $idcurso = isset($_POST["idcurso"]) ? limpiarCadena($_POST["idcurso"]) : "";
    $nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
    $idasignatura = isset($_POST["idasignatura"]) ? limpiarCadena($_POST["idasignatura"]) : "";

    switch ($_GET["op"]) {
        case 'guardaryeditar':
            if (empty($id)) {
                try {
                    $rspta = $task->insertar($nombre);
                    echo $rspta != 0 ? 1 : 2;
                } catch (Exception $e) {
                    echo 2;
                }
            } else {
                $rspta = $task->editar($id, $nombre);
                echo $rspta ? 3 : 4;
            }
            break;

        case 'agregarAsignatura':
            try {
                $rspta = $task->insertarAsignatura($idcurso, $idasignatura);
                echo $rspta != 0 ? 1 : 2;
            } catch (Exception $e) {
                echo 2;
            }
            break;
        case 'eliminarAsignatura':
            $rspta = $task->desactivarAsignatura($id);
            echo $rspta ? 1 : 0;
            break;

        case 'desactivar':
            $rspta = $task->desactivar($id);
            echo $rspta ? 1 : 0;
            break;
        case 'mostrar':
            $rspta = $task->mostrar($id);
            //Codificar el resultado utilizando json
            echo json_encode($rspta);
            break;

        case 'all':
            $rspta = $task->listar();
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                array_push($data, $reg);
            }
            echo json_encode($data);
            break;
        case 'listar':
            $rspta = $task->listar();
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(

                    "0" => $reg->idcurso,
                    "1" => $reg->nombre,
                    "2" =>
                    '
                    <a data-bs-toggle="tooltip" data-bs-placement="top" class="me-3" title="Asignar clases" href="' . getBaseUrl() . '/views/curso/asignatura.php?id=' . $reg->idcurso . '">
                        <img src="../../assets/img/icons/excel.svg" alt="img"/>
                    </a>
                    <a class="me-3" href="' . getBaseUrl() . '/views/curso/edit.php?id=' . $reg->idcurso . '"><img src="../../assets/img/icons/edit.svg" alt="img" /></a>
					    <a onclick="desactivar(' . $reg->idcurso . ')" class="me-3 confirm-text" href="#">
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

        case 'listarAsignaturas':
            $idcat = $_GET["id"];
            $rspta = $task->mostrarAsignaturas($idcat);
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(

                    "0" => $reg->idasignaturacurso,
                    "1" => $reg->curso,
                    "2" => $reg->asignatura,
                    "3" =>
                    '<a onclick="desactivar(' . $reg->idasignaturacurso . ')" class="me-3 confirm-text" href="#">
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
        case 'estudianteCurso':
            $idcat = $_GET["id"];
            $rspta = $task->cursosEstudiantes($idcat);
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                array_push($data, $reg);
            }
            echo json_encode($data);
            break;

        case 'asignaturaCursos':
            $idcat = $_GET["id"];
            $rspta = $task->cursoAsignaturas($idcat);
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                array_push($data, $reg);
            }
            echo json_encode($data);
            break;
        case 'count':
            $rspta = $task->countMonth();
            $fetch = $rspta->fetch_object();
            echo json_encode($fetch);
            break;
    }
} catch (Exception $e) {
    var_dump($e);
}
