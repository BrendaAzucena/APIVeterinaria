<?php
require_once "../conexion/conexion.php";

class mascota_has_Vacunas extends conexion {

    private $table = "mascota_has_Vacuna";
    private $Mascota_idMascota = "Mascota_idMascota";
    private $Vacuna_idVacuna = "Vacuna_idVacuna";
    private $fechaV = "fechaV";

    public function lisMasVa(){
        $query = "SELECT * FROM " . $this->table ;
        $datos = parent::obtenerDatos($query); 
        return ($datos);
    }
    public function obtenerId($id){
        $query = "SELECT * FROM " . $this->table . " WHERE Mascota_idMascota = '$id'";
        return parent::obtenerDatos($query);

    }

    public function post($j){
        $datos = json_decode($j,true);
                if(!isset($datos['Vacuna_idVacuna']) || !isset($datos['fechaV'])){
                }else{
                    $this->Vacuna_idVacuna = $datos['Vacuna_idVacuna'];
                    $this->fechaV = $datos['fechaV'];
                    $resp = $this->inserMasVa();
                    if($resp){
                        $respuesta[] = array(
                            "Mascota_idMascota" => $resp
                        );
                        return $respuesta;
                    }
                }
 
            }
        
    private function inserMasVa(){
        $query = "INSERT INTO " . $this->table . " (Vacuna_idVacuna, fechaV)
        values
        ('" . $this->Vacuna_idVacuna . "','" . $this->fechaV . "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }
 
    public function put($j){
       $datos = json_decode($j,true);
                if(!isset($datos['Mascota_idMascota'])){
                }else{
                    $this->Mascota_idMascota = $datos['Mascota_idMascota'];
                    if(isset($datos['Vacuna_idVacuna'])) { $this->Vacuna_idVacuna = $datos['Vacuna_idVacuna']; }
                    if(isset($datos[' fechaV'])) { $this-> fechaV = $datos[' fechaV']; }
                    $resp = $this->modiMasVa();
                    if($resp){
                        $respuesta[] = array(
                            "Mascota_idMascota" => $this->Mascota_idMascota
                        );
                        return $respuesta;
                    
                    }
                }

            }

        private function modiMasVa(){
         $query = "UPDATE " . $this->table . " SET Vacuna_idVacuna ='" . $this->Vacuna_idVacuna . "',fechaV = '" . $this->fechaV .  "' WHERE Mascota_idMascota = '" . $this->Mascota_idMascota . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }

    public function delete($sa){
        $datos = json_decode($sa,true);
                if(!isset($datos['Mascota_idMascota'])){
                }else{
                    $this->Mascota_idMascota = $datos['Mascota_idMascota'];
                    $resp = $this->elimiMasVa();
                    if($resp){
                        $respuesta[] = array(
                            "Mascota_idMascota" => $this->Mascota_idMascota
                        );
                        return $respuesta;
                    }
                }
    }
 
    private function elimiMasVa(){
        $query = "DELETE FROM " . $this->table . " WHERE Mascota_idMascota = '" . $this->Mascota_idMascota . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }
}

?>