<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,DELETE,PUT ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require_once '../Models/Veterinarios.php';

$veterinarios = new veterinarios;


if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["p"])){
        $list = $veterinarios->lisVeterinario();
        echo json_encode($list);
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $idveterinario = $_GET['id'];
        $datosC = $veterinarios->obtenerId($idveterinario);
        echo json_encode($datosC);
        http_response_code(200);
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_GET["agregar"])){
    $p = file_get_contents("php://input");
    $arr = $veterinarios->post($p);
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
      $arr = $veterinarios->put($p);
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
        if(isset($he["idveterinario"])){
            $send = [
                "idveterinario" =>$he["idveterinario"]
            ];
            $p = json_encode($send);
        }else{
            $p = file_get_contents("php://input");
        }
    
        $arr = $veterinarios->delete($p);
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