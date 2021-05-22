<?php
class Categorias{
    private $codCat;

    private $nombreCat;

    private $descripcion;

    public function __construct($codCat, $nombreCat, $descripcion)
    {
        $this->codCat = $codCat;
        $this->nombreCat = $nombreCat;
        $this->descripcion = $descripcion;
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

   
    public function getNombreCat()
    {
        return $this->nombreCat;
    }

    
    public function setNombreCat($nombreCat)
    {
        $this->nombreCat = $nombreCat;

        return $this;
    }

   
    public function getDescripcion()
    {
        return $this->descripcion;
    }

   
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}




	
?>