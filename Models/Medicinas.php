<?php
require_once "../conexion/conexion.php";

class medicinas extends conexion {

    private $table = "medicina";
    private $idMedicina = "idMedicina";
    private $nombreM = "nombreM";
    private $costo = "costo";
    private $codigoM = "codigoM";
    private $presentacion = "presentacion";
    private $NGenerico = "NGenerico";

    public function lisMedicina(){
        $query = "SELECT * FROM " . $this->table ;
        $datos = parent::obtenerDatos($query); 
        return ($datos);
    }
    public function obtenerId($id){
        $query = "SELECT * FROM " . $this->table . " WHERE idMedicina = '$id'";
        return parent::obtenerDatos($query);

    }
    public function post($j){
        $datos = json_decode($j,true);
                if(!isset($datos['nombreM']) || !isset($datos['costo']) || !isset($datos['codigoM'])){
                }else{
                    $this->nombreM = $datos['nombreM'];
                    $this->costo = $datos['costo'];
                    $this->codigoM = $datos['codigoM'];
                    if(isset($datos['presentacion'])) { $this->presentacion = $datos['presentacion']; }
                    if(isset($datos['NGenerico'])) { $this->NGenerico = $datos['NGenerico']; }
                    $resp = $this->inserMedicina();
                    if($resp){
                        $respuesta[] = array(
                            "idMedicina" => $resp
                        );
                        return $respuesta;
                    }
                }
 
            }
        
    private function inserMedicina(){
        $query = "INSERT INTO " . $this->table . " (nombreM, costo, codigoM, presentacion, NGenerico)
        values
        ('" . $this->nombreM . "','" . $this->costo . "','" . $this->codigoM ."','" . $this->presentacion . "','"  . $this->NGenerico.  "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }

    public function put($j){
        $datos = json_decode($j,true);
                if(!isset($datos['idMedicina'])){
                }else{
                    $this->idMedicina = $datos['idMedicina'];
                    if(isset($datos['nombreM'])) { $this->nombreM = $datos['nombreM']; }
                    if(isset($datos['costo'])) { $this->costo = $datos['costo']; }
                    if(isset($datos['codigoM'])) { $this->codigoM = $datos['codigoM']; }
                    if(isset($datos['presentacion'])) { $this->presentacion = $datos['presentacion']; }
                    if(isset($datos['NGenerico'])) { $this->NGenerico = $datos['NGenerico']; }           
                    
                    $resp = $this->modiMedicina();
                    if($resp){
                        $respuesta[] = array(
                            "idMedicina" => $this->idMedicina
                        );
                        return $respuesta;
                    }
                }

            }
           
    
        private function modiMedicina(){
         $query = "UPDATE " . $this->table . " SET nombreM ='" . $this->nombreM . "', costo = '" . $this->costo . "', codigoM= '" . 
         $this->codigoM . "', presentacion = '" . $this->presentacion . "', NGenerico = '" . $this->NGenerico . "' WHERE idMedicina = '" . $this->idMedicina . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }

    public function delete($sa){
        $datos = json_decode($sa,true);
                if(!isset($datos['idMedicina'])){
                }else{
                    $this->idMedicina = $datos['idMedicina'];
                    $resp = $this->elimiMedicina();
                    if($resp){
                        $respuesta["result"] = array(
                            "idMedicina" => $this->idMedicina
                        );
                        return $respuesta;
                    }
                }
    }


    private function elimiMedicina(){
        $query = "DELETE FROM " . $this->table . " WHERE idMedicina = '" . $this->idMedicina . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }
}

?>