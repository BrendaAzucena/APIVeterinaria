<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST,DELETE,PUT ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require_once '../Models/Consultas.php';

$consulta = new Consultas;


if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["p"])){
        $lista = $consulta->lisConsulta();
        http_response_code(200);
    }else if(isset($_GET['id'])){
        $idconsulta = $_GET['id'];
        $datosC = $consulta->obtenerId($idconsulta);
        http_response_code(200);
    }
    
}else if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_GET["agregar"])){
    $p = file_get_contents("php://input");
    $arr = $consulta->post($p);
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
      $arr = $consulta->put($p);
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
        if(isset($he["idconsulta"])){
            $send = [
                "idconsulta" =>$he["idconsulta"]
            ];
            $p = json_encode($send);
        }else{
            $p = file_get_contents("php://input");
        }
    
        $arr = $consulta->delete($p);
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