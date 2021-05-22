<?php
include "../Modelo/DAOProductos.php";
include "../Modelo/DAOCategorias.php";
$dao = new DAOProductos();
$cat = new DAOCategorias();

if ($_POST) {
    if (isset($_POST["btnGuardar"])) {
        $prod = new Productos(
        $_REQUEST["txtCodigo"],
        $_REQUEST["txtNombre"],
        $_REQUEST["txtPrecio"],
        $_REQUEST["txtExistencia"],
        $_REQUEST["cmbCodCat"]
        );
        $dao->insertar($prod);
        header("location: vProd.php");
    }
    if (isset($_POST["btnEliminar"])) {
        $prod = new Productos(
        $_REQUEST["txtCodigo"],
        $_REQUEST["txtNombre"],
        $_REQUEST["txtPrecio"],
        $_REQUEST["txtExistencia"],
        $_REQUEST["cmbCodCat"]
        );
        

        if ($_REQUEST["eliminacion"]=="si") {
            $dao->eliminar($prod);
            header("location: vProd.php");
        }
    }
    if (isset($_POST["btnModificar"])) {
        $prod = new Productos(
        $_REQUEST["txtCodigo"],
        $_REQUEST["txtNombre"],
        $_REQUEST["txtPrecio"],
        $_REQUEST["txtExistencia"],
        $_REQUEST["cmbCodCat"]
        );
        

        if ($_REQUEST["modificacion"]=="si") {
            $dao->modificar($prod);
            header("location: vProd.php");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <script>
        function cargarDel(cod, nomb, pre, exi, cat){
            cat--;
            document.getElementById("txtCodigo").value=cod;
            document.getElementById("txtNombre").value=nomb;
            document.getElementById("txtPrecio").value=pre;
            document.getElementById("txtExistencia").value=exi;
            document.getElementById("cmbCodCat").selectedIndex=cat;

            $("#btnEliminar").show();
            $("#btnModificar").hide();
            $("#btnGuardar").hide();
        }

        function confirmarDel(){
            if (confirm("Estas seguro que deseas eliminar este registro?")) {
                document.getElementById("eliminacion").value="si";
            }else{
                document.getElementById("eliminacion").value="no";
            }
        }

        function cargarMod(cod, nomb, pre, exi, cat){
            cat--;
            document.getElementById("txtCodigo").value=cod;
            document.getElementById("txtNombre").value=nomb;
            document.getElementById("txtPrecio").value=pre;
            document.getElementById("txtExistencia").value=exi;
            document.getElementById("cmbCodCat").selectedIndex=cat;

            $("#btnEliminar").hide();
            $("#btnModificar").show();
            $("#btnGuardar").hide();
        }

        function confirmarMod(){
            if (confirm("Estas seguro que deseas modificar este registro?")) {
                document.getElementById("modificacion").value="si";
            }else{
                document.getElementById("modificacion").value="no";
            }
        }

        $(document).ready(function(){
            $("#btnNuevo").on("click",function(){
                $("#btnEliminar").hide();
                $("#btnModificar").hide();
                $("#btnGuardar").show();
            });
        });
    </script>


    <title>Document</title>
</head>

<body>
    <h3>Vista Producto</h3>

    <input type="button" class="btn btn-success" value="Nuevo Registro" id="btnNuevo" data-toggle="modal" data-target="#modal1">

    <hr>

    <label class="label label-info">Contenido de la tabla</label>
    <?php
    echo $dao->obtenerTabla();
    ?>



    <!-- Modal -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="vProd.php" method="POST">
                        <label class="label label-danger">Codigo</label>
                        <input type="text" name="txtCodigo" id="txtCodigo" class="form-control">

                        <label class="label label-danger">Nombre producto</label>
                        <input type="text" name="txtNombre" id="txtNombre" class="form-control">

                        <label class="label label-danger">Precio</label>
                        <input type="text" name="txtPrecio" id="txtPrecio" class="form-control">

                        <label class="label label-danger">Existencia</label>
                        <input type="text" name="txtExistencia" id="txtExistencia" class="form-control">

                        <label class="label label-danger">Categoria</label>
                        <select name="cmbCodCat" id="cmbCodCat" class="form-control">
                            <?php
                            $data = $cat->obtenerComboCategorias();
                            foreach ($data as $indice => $valor) {
                                echo '<option value="' . $indice . '">' . $valor . '</option>';
                            }
                            ?>
                        </select>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" value="Guardar" name="btnGuardar" id="btnGuardar" class="btn btn-success">
                            <input type="submit" onclick="confirmarDel()" value="Eliminar" name="btnEliminar" id="btnEliminar" class="btn btn-danger">
                            <input type="submit" onclick="confirmarMod()" value="Modificar" name="btnModificar" id="btnModificar" class="btn btn-info">
                        </div>
                            <!-- dos hidden para verificar si se va a eliminar o modificar -->
                        <input type="hidden" id="eliminacion" name="eliminacion" value="">
                        <input type="hidden" id="modificacion" name="modificacion" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>