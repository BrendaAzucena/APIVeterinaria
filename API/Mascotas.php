<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,DELETE,PUT ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require_once '../Models/Mascotas.php';

$mascotas = new mascotas;


if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["p"])){
        $list = $mascotas->lisMascota();
        echo json_encode($list);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $idMascota = $_GET['id'];
        $datosC = $mascotas->obtenerId($idMascota);
        echo json_encode($datosC);
        http_response_code(200);
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_GET["agregar"])){
    $p = file_get_contents("php://input");
    $arr = $mascotas->post($p);
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
      $arr = $mascotas->put($p);
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
        if(isset($he["idMascota"])){
            $send = [
                "idMascota" =>$he["idMascota"]
            ];
            $p = json_encode($send);
        }else{
            $p = file_get_contents("php://input");
        }
    
        $arr = $mascotas->delete($p);
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