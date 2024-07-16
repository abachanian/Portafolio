<?php

class conexion{

    private $server="localhost";
    private $usuario="root";
    private $password="";
    private $conexion;
    private $base="album";

    public function __construct(){
        
        try{
            $this->conexion=new PDO("mysql:host=$this->server;dbname=$this->base", $this->usuario, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        
        catch(PDOException $error) {
            echo "Falló la conexión".$error;
        }
    }

    public function ejecutar($sql){ //  Insertar/delete/Actualizar

        $this->conexion->exec($sql);
        return $this->conexion->lastInsertId();
    }

    public function consultar($sql){

        $sentencia=$this->conexion->prepare($sql);
        $sentencia->execute();//ejecuta la sentencia sql
        return $sentencia->fetchAll();//retorna todos los registros de la consulta sql
    }


}
?>