<?php
require_once "../conexion/conexion.php";

class consultas extends conexion {

    private $table = "consulta";
    private $idconsulta = "idconsulta";
    private $fechaC = "fechaC";
    private $sintomas = "sintomas";
    private $peso = "peso";
    private $veterinario_idveterinario = "veterinario_idveterinario";
    private $Medicina_idMedicina = "Medicina_idMedicina";

    public function lisConsulta(){
        $query = "SELECT * FROM " . $this->table ;
        $datos = parent::obtenerDatos($query); 
        return ($datos);
    }

    public function obtenerId($id){
        $query = "SELECT * FROM " . $this->table . " WHERE idconsulta = '$id'";
        return parent::obtenerDatos($query);

    }
   
    public function post($j){
        $datos = json_decode($j,true);
                if(!isset($datos['fechaC']) || !isset($datos['sintomas']) || !isset($datos['peso'])){
                }else{
                    $this->fechaC = $datos['fechaC'];
                    $this->sintomas = $datos['sintomas'];
                    $this->peso = $datos['peso'];
                    if(isset($datos['veterinario_idveterinario'])) { $this->veterinario_idveterinario = $datos['veterinario_idveterinario']; }
                    if(isset($datos['Medicina_idMedicina'])) { $this->Medicina_idMedicina = $datos['Medicina_idMedicina']; }
                    $resp = $this->inserConsulta();
                    if($resp){
                        $respuesta[] = array(
                            "idconsulta" => $resp
                        );
                        return $respuesta;
                    }
                }

            }
        
    private function inserConsulta(){
        $query = "INSERT INTO " . $this->table . " (fechaC, sintomas, peso, veterinario_idveterinario, Medicina_idMedicina)
        values
        ('" . $this->fechaC . "','" . $this->sintomas . "','" . $this->peso ."','" . $this->veterinario_idveterinario . "','"  . $this->Medicina_idMedicina .  "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }

    public function put($j){
        $datos = json_decode($j,true);
                if(!isset($datos['idconsulta'])){
                }else{
                    $this->idconsulta = $datos['idconsulta'];
                    if(isset($datos['fechaC'])) { $this->fechaC = $datos['fechaC']; }
                    if(isset($datos['sintomas'])) { $this->sintomas = $datos['sintomas']; }
                    if(isset($datos['peso'])) { $this->peso = $datos['peso']; }
                    if(isset($datos['veterinario_idveterinario'])) { $this->veterinario_idveterinario = $datos['veterinario_idveterinario']; }
                    if(isset($datos['Medicina_idMedicina'])) { $this->Medicina_idMedicina = $datos['Medicina_idMedicina']; }       
                    
                    $resp = $this->modiConsulta();
                    if($resp){
                        $respuesta[] = array(
                            "idconsulta" => $this->idconsulta
                        );
                        return $respuesta;
                    }
                }

            }

    private function modiConsulta(){
        $query = "UPDATE " . $this->table . " SET fechaC ='" . $this->fechaC . "',sintomas = '" . 
        $this->sintomas . "', peso = '" . $this->peso . "', veterinario_idveterinario = '" . 
        $this->veterinario_idveterinario . "', Medicina_idMedicina = '" . 
        $this->Medicina_idMedicina . "' WHERE idconsulta = '" . $this->idconsulta . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }

    public function delete($sa){
        $datos = json_decode($sa,true);
                if(!isset($datos['idconsulta'])){
                }else{
                    $this->idconsulta = $datos['idconsulta'];
                    $resp = $this->elimiConsulta();
                    if($resp){
                        $respuesta[] = array(
                            "idconsulta" => $this->idconsulta
                        );
                        return $respuesta;
                    }
                }
    }


    private function elimiConsulta(){
        $query = "DELETE FROM " . $this->table . " WHERE idconsulta= '" . $this->idconsulta . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }
}

?>