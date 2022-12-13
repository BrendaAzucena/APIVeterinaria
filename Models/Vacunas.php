<?php
require_once "../conexion/conexion.php";

class vacunas extends conexion {

    private $table = "vacuna";
    private $idVacuna = "idVacuna";
    private $nombreV = "nombreV";

    public function lisVacunas(){
        $query = "SELECT idVacuna, nombreV FROM " . $this->table ;
        $query = "SELECT * FROM " . $this->table ;
        $datos = parent::obtenerDatos($query); 
        return ($datos);
    }
    public function obtenerId($id){
        $query = "SELECT * FROM " . $this->table . " WHERE idVacuna = '$id'";
        return parent::obtenerDatos($query);

    }
    public function post($j){
        $datos = json_decode($j,true);
                if(!isset($datos['nombreV'])){
                }else{
                    $this->nombreV = $datos['nombreV'];
                    $resp = $this->inserVacuna();
                    if($resp){
                        $respuesta[] = array(
                            "idVacuna" => $resp
                        );
                        return $respuesta;
                    }
                }
 
            }
        
    private function inserVacuna(){
        $query = "INSERT INTO " . $this->table . " (nombreV)
        values
        ('" . $this->nombreV . "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }
 
    public function put($j){
        $datos = json_decode($j,true);
                if(!isset($datos['idVacuna'])){
                }else{
                    $this->idVacuna = $datos['idVacuna'];
                    if(isset($datos['nombreV'])) { $this->nombreV = $datos['nombreV']; }
                            
                    $resp = $this->modiVacuna();
                    if($resp){
                        $respuesta[] = array(
                            "idVacuna" => $this->idVacuna
                        );
                        return $respuesta;
                    }
                }

            }

        private function modiVacuna(){
         $query = "UPDATE " . $this->table . " SET nombreV ='" . $this->nombreV . "' WHERE idVacuna = '" . $this->idVacuna . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }

    public function delete($sa){
        $datos = json_decode($sa,true);
                if(!isset($datos['idVacuna'])){
                }else{
                    $this->idVacuna = $datos['idVacuna'];
                    $resp = $this->elimiVacuna();
                    if($resp){
                        $respuesta[] = array(
                            "idVacuna" => $this->idVacuna
                        );
                        return $respuesta;
                    }
                }
    }
 
    private function elimiVacuna(){
        $query = "DELETE FROM " . $this->table . " WHERE idVacuna = '" . $this->idVacuna . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }
}

?>