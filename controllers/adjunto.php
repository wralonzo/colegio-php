<?php


try {
    session_start();
    require_once "../models/Adjunto.php";
    require_once "../models/Task.php";
    require '../config/baseurl.php';
    $file = new Adjunto();

    $id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
    $rol = $_SESSION['rol'] == 3 ? true : false;

    switch ($_GET["op"]) {
        case 'uploadFile':
            $idusuario = $_SESSION['idusuario'];;
            $directorio = '../files/diario/' . "$idusuario";
            $ext = explode(".", $_FILES["imagen"]["name"]);
            $rspta = 0;
            if (end($ext) != '') {
                $imagen = round(microtime(true)) . '.' . end($ext);
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0777);
                }
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio . "/" . $imagen);
                $rspta = $file->insertar($idusuario, $imagen,);
            }
            echo $rspta != 0 ? 1 : 2;
            break;
        case 'desactivar':
            // $dataFile = $file->mostrarFile($id);
            // $path =  '../files/task/' . $dataFile['idtask'] . '/' . $dataFile['nombre'];
            // // var_dump($_SERVER['DOCUMENT_ROOT']);
            // chmod($path, 0777);
            // if (file_exists($path)) {
            //     $delFile = unlink($path);
            //     if ($delFile) {
            //         $rspta = $file->desactivar($id);
            //         echo $rspta ? 1 : 0;
            //         break;
            //     }
            // }
            // echo 0;

            break;
        case 'listar':
            $rspta = $file->listar();
            $data = array();
            while ($reg = $rspta->fetch_object()) {
                $data[] = array(

                    "0" => $reg->iddiario,
                    "1" => $reg->nombre,
                    "2" => $reg->path,
                    "3" => $reg->datecreated,
                    "4" =>
                    ' <a class="me-3" href="' . getBaseUrl() . '/views/diario/edit.php?id=' . $reg->iddiario . '"><img src="../../assets/img/icons/edit.svg" alt="img" /></a>
                            <a onclick="desactivar(' . $reg->iddiario . ')" class="me-3 confirm-text" href="#">
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

        case 'count':
            $rspta = $file->countMonth();
            $valores = array();
            $response = array();
            while ($per = $rspta->fetch_object()) {
                array_push($valores, $per);
            }
            $meses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
            foreach ($meses as $value) {
                $countMonth = 0;
                foreach ($valores as $value2) {
                    if ($value == $value2->month) {
                        $countMonth = intval($value2->user_count);
                    }
                }
                array_push($response, $countMonth);
            }
            echo json_encode($response);
            break;
    }
} catch (Exception $e) {
    var_dump($e);
}
