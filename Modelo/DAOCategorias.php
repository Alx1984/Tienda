<?php
include_once "credenciales.php";
include "categorias.php";
class DAOCategorias
{
    private $conexion;
    public function __constructor() { 

	}
    private function conectar(){
        try {
            $this->conexion = new mysqli(SERVER,USER,PASS,BD);
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }
    }

    private function desconectar()
    {
        $this->conexion->close();
    }

    public function obtenerComboCategorias(){
        $sql = "SELECT codCat, nombreCat FROM categorias";
        $this->conectar();
        $resultado = $this->conexion->query($sql);

        $data = array();
        while($fila = mysqli_fetch_assoc($resultado)) {
            $data[$fila["codCat"]] = $fila["nombreCat"];
        }

        $resultado->close();
        $this->desconectar();
        return $data;

    }

    

}


?>