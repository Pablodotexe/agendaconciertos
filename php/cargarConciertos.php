<?php
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "aaaa", "conciertos");

if ($conn->connect_error) {
    die("Error al establecer la conexión: " . $conn->connect_error);
}


//$sql = "SELECT * from conciertos";

$sql = "SELECT 
    c.id, 
    c.banda_id, 
    s.nombre AS sala_nombre, 
    b.nombre AS banda_nombre, 
    c.fecha_concierto, 
    c.hora 
FROM 
    conciertos c
JOIN 
    bandas b ON c.banda_id = b.id
JOIN 
    salas s ON c.sala_id = s.id";



$result = $conn->query($sql);

class Articulo
{
    public $concierto = array();

    function __construct($concierto)
    {
        $this->concierto=$concierto;
    }

}

$arrayConciertos = array();


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $banda_id = $row['banda_id'];
        $sala_nombre=$row['sala_nombre'];
       
        $banda_nombre = $row['banda_nombre'];
        $fecha_concierto = $row['fecha_concierto'];
        $hora=$row['hora'];
        
        $concierto = array(
            array("id"=>$id, "banda_nombre" => $banda_nombre, 
            "banda_id"=>$banda_id, "sala_nombre"=>$sala_nombre, 
            "fecha_concierto"=>$fecha_concierto,
            "hora"=>$hora
        ));

        $arrayConciertos[] = new Articulo($concierto);
    }
}

$jsonconciertos = json_encode($arrayConciertos);
echo $jsonconciertos;

$conn->close();




?>