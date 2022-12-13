<?php
require_once "../conexion/conexion.php";

class mascotas extends conexion {

    private $table = "mascota";
    private $idMascota = "idMascota";
    private $nombreM = "nombreM";
    private $tipoM = "tipoM";
    private $sexo = "sexo";
    private $color = "color";
    private $fechaN = "fechaN";
    private $Cliente_idCliente = "Cliente_idCliente";

    public function lisMascota(){
        $query = "SELECT * FROM " . $this->table ;
        $datos = parent::obtenerDatos($query); 
        return ($datos);
    }
    public function obtenerId($id){
        $query = "SELECT * FROM " . $this->table . " WHERE idMascota = '$id'";
        return parent::obtenerDatos($query);

    }
    public function post($j){
        $datos = json_decode($j,true);
                if(!isset($datos['nombreM']) || !isset($datos['tipoM']) || !isset($datos['sexo'])){
                }else{
                    $this->nombreM = $datos['nombreM'];
                    $this->tipoM = $datos['tipoM'];
                    $this->sexo = $datos['sexo'];
                    if(isset($datos['color'])) { $this->color = $datos['color']; }
                    if(isset($datos['fechaN'])) { $this->fechaN = $datos['fechaN']; }
                    if(isset($datos['Cliente_idCliente'])) { $this->Cliente_idCliente = $datos['Cliente_idCliente']; }
                    $resp = $this->inserMascota();
                    if($resp){
        
                        $respuesta[] = array(
                            "idMascota" => $resp
                        );
                        return $respuesta;
                    }
                }
 
            }
        
    private function inserMascota(){
        $query = "INSERT INTO " . $this->table . " (nombreM, tipoM, sexo, color, fechaN, Cliente_idCliente)
        values
        ('" . $this->nombreM . "','" . $this->tipoM . "','" . $this->sexo ."','" . $this->color . "','"  . $this->fechaN . "','"  . $this->Cliente_idCliente . "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }

    public function put($j){
        $datos = json_decode($j,true);
                if(!isset($datos['idMascota'])){
                }else{
                    $this->idMascota = $datos['idMascota'];
                    if(isset($datos['nombreM'])) { $this->nombreM = $datos['nombreM']; }
                    if(isset($datos['tipoM'])) { $this->tipoM = $datos['tipoM']; }
                    if(isset($datos['sexo'])) { $this->sexo = $datos['sexo']; }
                    if(isset($datos['color'])) { $this->color = $datos['color']; }
                    if(isset($datos['fechaN'])) { $this->fechaN = $datos['fechaN']; } 
                    if(isset($datos['Cliente_idCliente'])) { $this->Cliente_idCliente = $datos['Cliente_idCliente']; }          
                    
                    $resp = $this->modiMascota();
                    if($resp){
                        $respuesta[] = array(
                            "idMascota" => $this->idMascota
                        );
                        return $respuesta;
                    }
                }

            }

    private function modiMascota(){
        $query = "UPDATE " . $this->table . " SET nombreM ='" . $this->nombreM . "',tipoM = '" . 
        $this->tipoM . "', tipoM = '" . $this->tipoM . "', sexo = '" . $this->sexo . "', color = '" . 
        $this->color .  "', fechaN = '" . $this->fechaN . "', Cliente_idCliente = '" . 
        $this->Cliente_idCliente . "' WHERE idMascota = '" . $this->idMascota . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }

    public function delete($sa){
        $datos = json_decode($sa,true);
                if(!isset($datos['idMascota'])){
                }else{
                    $this->idMascota = $datos['idMascota'];
                    $resp = $this->elimiMascota();
                    if($resp){
            
                        $respuesta[] = array(
                            "idMascota" => $this->idMascota
                        );
                        return $respuesta;
                    }
                }
    }


    private function elimiMascota(){
        $query = "DELETE FROM " . $this->table . " WHERE idMascota = '" . $this->idMascota . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }
}

?>