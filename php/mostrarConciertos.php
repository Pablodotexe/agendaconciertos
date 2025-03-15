<?php
header("Content-Type: application/json; charset=UTF-8");




$conn = new mysqli("sql112.infinityfree.com", "if0_37790823", "26G5hrP31G", "if0_37790823_conciertos");


if ($conn->connect_error) {
    die("Error al conectar con la BD: " . $conn->connect_error);
}


$arrayConciertos = array();
$fecha_inicio = $_GET['fecha_inicio'];
$fecha_fin = $_GET['fecha_fin'];
$genero = $_GET['genero'];
$ciudad = $_GET['ciudad'];


$sql = "SELECT conciertos.id,
               conciertos.fecha_concierto,
               conciertos.hora,
               bandas.nombre AS banda_nombre,
               conciertos.cartel AS banda_imagen,  /* NUEVA COLUMNA DE IMAGEN */
               salas.nombre AS sala_nombre,
               ciudades.nombre AS ciudad_nombre  /* NUEVA COLUMNA PARA EL NOMBRE DE LA CIUDAD */
        FROM conciertos
        JOIN bandas ON conciertos.banda_id = bandas.id
        JOIN salas ON conciertos.sala_id = salas.id
        JOIN ciudades ON salas.ciudad_id = ciudades.id
        WHERE conciertos.fecha_concierto BETWEEN '$fecha_inicio' AND '$fecha_fin'
          AND bandas.genero = '$genero'
          AND ciudades.nombre = '$ciudad'
        ORDER BY conciertos.fecha_concierto ASC";



$result = $conn->query($sql);

class Conciertos{
    public $datos = array();

    public function __construct($datos)
    {
        $this->datos = $datos;
    }
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $idConcierto = $row["id"];
        $banda = $row['banda_nombre'];
        $sala = $row['sala_nombre'];
        $fecha_concierto = $row['fecha_concierto'];
        $banda_imagen = $row['banda_imagen'];/* NUEVA VARIABLE PARA LA IMAGEN */
        $ciudad = $row["ciudad_nombre"];  
        
        $datos = array(
            array(
                "id_concierto"=>$idConcierto,
                "banda_nombre" => $banda,
                "sala_nombre" => $sala,
                "fecha_concierto" => $fecha_concierto,
                "banda_imagen" => $banda_imagen,
                "ciudad" => $ciudad
            )
        );
        $arrayConciertos[] = new Conciertos($datos);
    }
}

$conn->close();
$jsonConciertos = json_encode($arrayConciertos);
echo $jsonConciertos;


?>
