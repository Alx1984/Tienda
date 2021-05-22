<?php
include_once "credenciales.php";
include "productos.php";
class DAOProductos{

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

    public function obtenerTabla(){
        $sql="SELECT * FROM productos";
        $this->conectar();
        $resultado = $this->conexion->query($sql);
        $this->desconectar();

        //armar tabla

        $tabla = "<table class='table'><thead><tr><th>codigo</th><th>nombre</th><th>precio</th><th>existencia</th><th>codCat</th><th>Acciones</th></tr></thead><tbody>";

        //recorrer resultado

        while ($fila = mysqli_fetch_assoc($resultado)) {
            $tabla .= "<tr>";
            $tabla .= "<td>".$fila["codigo"]."</td>";
            $tabla .= "<td>".$fila["nombre"]."</td>";
            $tabla .= "<td>".$fila["precio"]."</td>";
            $tabla .= "<td>".$fila["existencia"]."</td>";
            $tabla .= "<td>".$fila["codCat"]."</td>";

            //acciones de modificar y eliminar
            $tabla .= "<td><a data-toggle=\"modal\" data-target=\"#modal1\" href='' onclick=\"javascript:cargarDel('".$fila["codigo"]."','".$fila["nombre"]."','".$fila["precio"]."','".$fila["existencia"]."','".$fila["codCat"]."')\">Eliminar</a> / "; 
            $tabla .= "<a data-toggle=\"modal\" data-target=\"#modal1\" href='' onclick=\"javascript:cargarMod('".$fila["codigo"]."','".$fila["nombre"]."','".$fila["precio"]."','".$fila["existencia"]."','".$fila["codCat"]."')\">Modificar</a> </td>"; 

            $tabla .= "</tr>";
        }

        $tabla .= "</tbody></table>";

        $resultado->close();

        return $tabla;

    }

    public function insertar($obj)
    {
        $prod = new Productos('','','','','');
        $prod = $obj;

        $sql = "INSERT INTO productos values (".$prod->getCodigo().",'".$prod->getNombre()."',".$prod->getPrecio().",".$prod->getExistencia().",".$prod->getCodCat().")";
        
        $this->conectar();
        if ($this->conexion->query($sql)) {
            echo "<script>alert('Ingresado con Exito');</script>";
        }else {
            echo "<script>alert('Algo salio mal');</script>";
        }
        $this->desconectar();
    }

    public function eliminar($obj)
    {
        $prod = new Productos('','','','','');
        $prod = $obj;

        $sql = "DELETE FROM productos WHERE codigo=".$prod->getCodigo();
        $this->conectar();
        if ($this->conexion->query($sql)) {
            echo "<script>alert('Eliminado con Exito');</script>";
        }else {
            echo "<script>alert('Algo salio mal');</script>";
        }
        $this->desconectar();
    }
   
    public function modificar($obj)
    {
        $prod = new Productos('','','','','');
        $prod = $obj;

        $sql = "UPDATE productos SET nombre='".$prod->getNombre()."', precio=".$prod->getPrecio().", existencia=".$prod->getExistencia().", codCat=".$prod->getCodCat()." WHERE codigo=".$prod->getCodigo(); //min43

        $this->conectar();
        if ($this->conexion->query($sql)) {
            echo "<script>alert('Modificado con Exito');</script>";
        }else {
            echo "<script>alert('Algo salio mal');</script>";
        }
        $this->desconectar();
    }
}	
?>