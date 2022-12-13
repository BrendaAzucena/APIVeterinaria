<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,DELETE,PUT ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require_once '../Models/Mascota_has_Vacuna.php';

$mascota_has_Vacunas = new mascota_has_Vacunas;


if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["p"])){
        $list = $mascota_has_Vacunas->lisMasVa();
        echo json_encode($list);
        http_response_code(200);
    }else if(isset($_GET['Mascota_idMascota'])){
        $Mascota_idMascota = $_GET['Mascota_idMascota'];
        echo json_encode($datosC);
        http_response_code(200);
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_GET["agregar"])){
    $p = file_get_contents("php://input");
    $arr = $mascota_has_Vacunas->post($p);
     if(isset($arr["result"]["error_id"])){
         $res = $arr["result"]["error_id"];
         http_response_code($res);
     }else{
         http_response_code(200);
     }
     echo json_encode($arr);
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "PUT"){
    if(isset($_GET["editar"])){
      $p = file_get_contents("php://input");
      $arr = $mascota_has_Vacunas->put($p);
     if(isset($arr["result"]["error_id"])){
         $res = $arr["result"]["error_id"];
         http_response_code($res);
     }else{
         http_response_code(200);
     }
     echo json_encode($arr);
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "DELETE"){

        $he = getallheaders();
        if(isset($he["Mascota_idMascota"])){
            $send = [
                "Mascota_idMascota" =>$he["Mascota_idMascota"]
            ];
            $p = json_encode($send);
        }else{
            $p = file_get_contents("php://input");
        }
    
        $arr = $mascota_has_Vacunas->delete($p);
        if(isset($arr["result"]["error_id"])){
            $r = $arr["result"]["error_id"];
            http_response_code($r);
        }else{
            http_response_code(200);
        }
        echo json_encode($arr);
       

}else{
    $arr = $r->error_405();
    echo json_encode($arr);
}


?>