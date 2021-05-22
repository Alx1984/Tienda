<?php
class Productos{
    private $codigo;
    private $nombre;
    private $precio;
    private $existencia;
    private $codCat;

    public function __construct($codigo, $nombre, $precio, $existencia, $codCat)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->existencia = $existencia;
        $this->codCat = $codCat;
    }
  
    public function getCodigo()
    {
        return $this->codigo;
    }

    
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    
    public function getNombre()
    {
        return $this->nombre;
    }

    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    
    public function getPrecio()
    {
        return $this->precio;
    }

    
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    public function getExistencia()
    {
        return $this->existencia;
    }

  
    public function setExistencia($existencia)
    {
        $this->existencia = $existencia;

        return $this;
    }

    
    public function getCodCat()
    {
        return $this->codCat;
    }

   
    public function setCodCat($codCat)
    {
        $this->codCat = $codCat;

        return $this;
    }
}

?>