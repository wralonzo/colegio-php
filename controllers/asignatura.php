<?php


try {
    session_start();
    require_once "../models/Asignatura.php";
    require '../config/baseurl.php';
    $task = new Asignatura();

    $id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
    $nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";

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

                    "0" => $reg->idasignatura,
                    "1" => $reg->nombre,
                    "2" =>
                    ' <a class="me-3" href="' . getBaseUrl() . '/views/asignatura/edit.php?id=' . $reg->idasignatura . '"><img src="../../assets/img/icons/edit.svg" alt="img" /></a>
					    <a onclick="desactivar(' . $reg->idasignatura . ')" class="me-3 confirm-text" href="#">
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
