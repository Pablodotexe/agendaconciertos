<?php

$conn = new mysqli("localhost", "root", "aaaa", "conciertos");

if ($conn->connect_error) {
    die(json_encode(["error" => "Error al establecer la conexión" . $conn->connect_error]));
}

// Recogemos los datos
$nombre = $_POST["nombreBanda"];
$ciudad = $_POST["ciudad"];
$sala = $_POST["sala"];
$genero = $_POST["genero"];
$fecha = $_POST["fecha"];
$cartel = $_POST["cartel"];
$hora = $_POST["hora"];

$insercion = false;
$idBanda = null;
$idSala = null;

// Insertar o actualizar banda
$insertarBanda = "INSERT INTO bandas (nombre, genero) VALUES ('$nombre', '$genero') ON DUPLICATE KEY UPDATE id=id";
$conn->query($insertarBanda);

// Obtener el ID de la banda
$sqlbanda = "SELECT id FROM bandas WHERE nombre = '$nombre'";
$resultbanda = $conn->query($sqlbanda);

if ($resultbanda->num_rows > 0) {
    $row = $resultbanda->fetch_assoc();
    $idBanda = $row["id"];
}

// Obtener el ID de la sala
$sqlSala = "SELECT id FROM salas WHERE nombre = '$sala'";
$resultSala = $conn->query($sqlSala);
if ($resultSala->num_rows > 0) {
    $row = $resultSala->fetch_assoc();
    $idSala = $row["id"];
}

// Insertar el concierto si la banda y la sala existen
if ($idBanda && $idSala) {
    $sql = "INSERT INTO conciertos (banda_id, sala_id, fecha_concierto, hora, cartel) VALUES ('$idBanda', '$idSala', '$fecha', '$hora', '$cartel')";
    if ($conn->query($sql) === TRUE) {
        $insercion = true;
    }
}

// Devolvemos la respuesta en formato JSON
echo json_encode(["insercion" => $insercion]);

$conn->close();
?>
