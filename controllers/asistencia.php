<?php


try {
    session_start();
    require_once "../models/Asistencia.php";
    require '../config/baseurl.php';
    $task = new Asistencia();

    $id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
    $idestudiante = isset($_POST["idestudiante"]) ? limpiarCadena($_POST["idestudiante"]) : "";
    $nota = isset($_POST["nota"]) ? limpiarCadena($_POST["nota"]) : "";
    $idcurso = isset($_POST["idcurso"]) ? limpiarCadena($_POST["idcurso"]) : "";
    $fecha = isset($_POST["fecha"]) ? limpiarCadena($_POST["fecha"]) : "";
    $estado = isset($_POST["estado"]) ? limpiarCadena($_POST["estado"]) : "";

    switch ($_GET["op"]) {
        case 'guardaryeditar':
            $notas = $_POST['notas'];
            if (empty($id)) {
                try {
                    $rspta = 0;
                    foreach ($_POST['estudiantes'] as $idestudiante => $data) {
                        // Obtener la fecha y el estado de asistencia de cada estudiante
                        $fecha = $data['fecha'];
                        $idcurso = $data['idcurso'];
                        $asistencia = $data['estado'];
                        $rspta = $task->insertar($idestudiante, $idcurso, $fecha, $asistencia);
                    }
                    $rspta != 0 ? 1 : 2;
                    echo json_encode($rspta);
                } catch (Exception $e) {
                    echo json_encode(2);
                }
            } else {
                $rspta = $task->editar($id, $idestudiante, $idcurso, $fecha, $estado);
                $rspta ? 3 : 4;
                echo json_encode($rspta);
            }
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

                    "0" => $reg->idasistencia,
                    "1" => $reg->fecha,
                    "2" => $reg->estado,
                    "3" => $reg->estudiante,
                    "4" => $reg->curso,
                    // "5" =>
                    // '<a onclick="desactivar(' . $reg->idnota . ')" class="me-3 confirm-text" href="#">
                    // 	<img src="../../assets/img/icons/delete.svg" alt="img" />
                    // </a>',
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
