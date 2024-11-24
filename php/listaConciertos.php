<?php

$conn = new mysqli("localhost", "root", "", "gestion_articulos");

if ($conn->connect_error) {
    die("Error al establecer la conexión: " . $conn->connect_error);
}


$sql = "SELECT * from articulos";

$result = $conn->query($sql);

class Articulo
{
    public $articulo = array();

    function __construct($articulo)
    {
        $this->articulo=$articulo;
    }

}

$arrayArticulos = array();


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nombre = $row['nombre'];
        $codArticulo = $row['codArticulo'];
        $pvp=$row['pvp'];
        $iva = $row['iva'];
        $cantidad = $row['cantidad'];
        $cantidadMinima=$row['cantidadMinima'];
        $correoProveedor=$row['correoProveedor'];
        $articulo = array(
            
            array("nombre"=>$nombre, "codArticulo"=>$codArticulo, "pvp"=>$pvp, "iva"=>$iva, "cantidad"=>$cantidad, "cantidadMinima"=>$cantidadMinima, "correoProveedor"=>$correoProveedor
        ));

        $arrayArticulos[] = new Articulo($articulo);
    }
}

$jsonarticulos = json_encode($arrayArticulos);
echo $jsonarticulos;




?>