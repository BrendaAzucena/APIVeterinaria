<?php
require_once "../conexion/conexion.php";

class pacientes extends conexion {

    private $table = "cliente";
    private $idCliente = "idCliente";
    private $nombre = "nombre";
    private $apellidoP = "apellidoP";
    private $apellidoM = "apellidoM";
    private $telefono = "telefono";
    private $sexo = "sexo";
    private $edad = "edad"; 
    
    public function lisClientes(){  
        $query = "SELECT * FROM " . $this->table ;
        $datos = parent::obtenerDatos($query); 
        return ($datos);
    }
    public function obtenerId($id){
        $query = "SELECT * FROM " . $this->table . " WHERE idCliente = '$id'";
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
                    if(isset($datos['sexo'])) { $this->sexo = $datos['sexo']; }
                    if(isset($datos['edad'])) { $this->edad = $datos['edad']; }
                    $resp = $this->inserCliente();
                    if($resp){
                        $respuesta[] = array(
                            "idCliente" => $resp
                        );
                        return $respuesta;
                    }else{
                    }
                }

            }
    private function inserCliente(){
        $query = "INSERT INTO " . $this->table . " (nombre,apellidoP,apellidoM,telefono,sexo,edad)
        values
        ('" . $this->nombre . "','" . $this->apellidoP . "','" . $this->apellidoM ."','" . $this->telefono . "','"  . $this->sexo . "','" . $this->edad . "')"; 
        $resp = parent::nonQueryId($query);
        if($resp){
             return $resp;
        }else{
            return 0;
        }
    }    
    public function put($j){
        $datos = json_decode($j,true);
                if(!isset($datos['idCliente'])){
                }else{
                    $this->idCliente = $datos['idCliente'];
                    if(isset($datos['nombre'])) { $this->nombre = $datos['nombre']; }
                    if(isset($datos['apellidoP'])) { $this->apellidoP = $datos['apellidoP']; }
                    if(isset($datos['apellidoM'])) { $this->apellidoM = $datos['apellidoM']; }
                    if(isset($datos['telefono'])) { $this->telefono = $datos['telefono']; }
                    if(isset($datos['sexo'])) { $this->sexo = $datos['sexo']; }
                    if(isset($datos['edad'])) { $this->edad = $datos['edad']; }
                   
                    
                    $resp = $this->modiCliente();
                    if($resp){
                        $respuesta[] = array(
                            "idCliente" => $this->idCliente
                        );
                        return $respuesta;
                    }else{
                    }
                }

            }
    private function modiCliente(){
        $query = "UPDATE " . $this->table . " SET nombre ='" . $this->nombre . "',apellidoP = '" . $this->apellidoP . "', apellidoM = '" . 
        $this->apellidoM . "', telefono = '" . $this->telefono . "', sexo = '" . $this->sexo . "', edad = '" . 
        $this->edad . "' WHERE idCliente = '" . $this->idCliente . "'"; 
        $resp = parent::nonQuery($query);
        if($resp >= 1){
             return $resp;
        }else{
            return 0;
        }
    }
    public function delete($sa){
        $datos = json_decode($sa,true);
                if(!isset($datos['idCliente'])){
                }else{
                    $this->idCliente = $datos['idCliente'];
                    $resp = $this->elimiCliente();
                    if($resp){
                        $respuesta[] = array(
                            "idCliente" => $this->idCliente
                        );
                        return $respuesta;
                    }else{
                    }
                }
    }
    private function elimiCliente(){
        $query = "DELETE FROM " . $this->table . " WHERE idCliente= '" . $this->idCliente . "'";
        $resp = parent::nonQuery($query);
        if($resp >= 1 ){
            return $resp;
        }else{
            return 0;
        }
    }
}





?>