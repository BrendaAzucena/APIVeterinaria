<?php

class conexion {

    private $server =  "localhost";
    private $user = "root";
    private $password = "1234";
    private $database = "veterinaria";

    private $conexion;


    function __construct(){
        $this->conexion = new mysqli($this->server,$this->user,$this->password,$this->database);
        if($this->conexion->connect_errno){
            echo "Error en la conexion";
        }

    }

    public function obtenerDatos($sqlstr){
        $results = $this->conexion->query($sqlstr);
        $resultArray = array();
        foreach ($results as $key) {
            $resultArray[] = $key;
        }
        return $resultArray;

    }

    public function nonQuery($sqlstr){
       $this->conexion->query($sqlstr);
        return $this->conexion->affected_rows;
    }

    public function nonQueryId($sqlstr){
        $this->conexion->query($sqlstr);
         $filas = $this->conexion->affected_rows;
         if($filas >= 1){
            return $this->conexion->insert_id;
         }else{
             return 0;
         }
    }
     

}



?>