<?php
require_once "../conexion/conexion.php";

class veterinarios extends conexion {

    private $table = "veterinario";
    private $idveterinario = "idveterinario";
    private $nombre = "nombre";
    private $apellidoP = "apellidoP";
    private $apellidoM = "apellidoM";
    private $telefono = "telefono";

    public function lisVeterinario(){
        $query = "SELECT * FROM " . $this->table ;
        $datos = parent::obtenerDatos($query); 
        return ($datos);
    }
    public function obtenerId($id){
        $query = "SELECT * FROM " . $this->table . " WHERE idveterinario = '$id'";
        return parent::obtenerDatos($query);

    }
    public function post($j){
        $datos = json_decode($j,true);
                if(!isset($datos['nombre']) || !isset($datos['apellidoP']) || !isset($datos['apellidoM'])){
                }else{
                    $this->nombre = $datos['nombre'];
                    $this->apellidoP = $datos['apellidoP'];
                    $this->apellidoM = $datos['apellidoM'];
                    if(isset($datos['telefono'])) { $this->telefono = $datos['telefono']; }
                    $resp = $this->inserVeterinario();
                    if($resp){
                        $respuesta[] = array(
                            "idveterinario" => $resp
                        );
                        return $respuesta;
                    }
                }
 
            }
        
    private function inserVeterinario(){
        $query = "INSERT INTO " . $this->table . " (nombre, apellidoP, apellidoM, telefono)
        values
        ('" . $this->nombre . "','" . $this->apellidoP . "','" . $this->apellidoM ."','" . $this->telefono .  "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }

    public function put($j){
        $datos = json_decode($j,true);
                if(!isset($datos['idveterinario'])){
                }else{
                    $this->idveterinario = $datos['idveterinario'];
                    if(isset($datos['nombre'])) { $this->nombre = $datos['nombre']; }
                    if(isset($datos['apellidoP'])) { $this->apellidoP = $datos['apellidoP']; }
                    if(isset($datos['apellidoM'])) { $this->apellidoM = $datos['apellidoM']; }
                    if(isset($datos['telefono'])) { $this->telefono = $datos['telefono']; }
                            
                    $resp = $this->modiVeterinario();
                    if($resp){
                        $respuesta[] = array(
                            "idveterinario" => $this->idveterinario
                        );
                        return $respuesta;
                    }
                }

            }

        private function modiVeterinario(){
         $query = "UPDATE " . $this->table . " SET nombre ='" . $this->nombre . "', apellidoP = '" . $this->apellidoP . "', apellidoM= '" . 
         $this->apellidoM . "', telefono = '" . $this->telefono . "' WHERE idveterinario = '" . $this->idveterinario . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }

    public function delete($sa){
        $datos = json_decode($sa,true);
                if(!isset($datos['idveterinario'])){
                }else{
                    $this->idveterinario = $datos['idveterinario'];
                    $resp = $this->elimiVeterinario();
                    if($resp){
                        $respuesta[] = array(
                            "idveterinario" => $this->idveterinario
                        );
                        return $respuesta;
                    }
                }
    }


    private function elimiVeterinario(){
        $query = "DELETE FROM " . $this->table . " WHERE idveterinario = '" . $this->idveterinario . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }
}

?>