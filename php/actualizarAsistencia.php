<?php
session_start();

$conn = new mysqli("localhost", "root", "aaaa", "conciertos");

if ($conn->connect_error) {
    die("Error al establecer la conexión" . $conn->connect_error);
}

// Recogemos el usuario y contraseña
$nombre = $_POST["nombre"];
$concierto_id = $_POST["concierto_id"];
$usuario_id;

// Hacemos SELECT para recoger el usuario en caso de que exista con ese nombre
$sql = "SELECT id FROM usuarios WHERE nombre = '$nombre'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $usuario_id = $row["id"];
    
} else {
echo "No hay ningún usuario con ese nombre";
}

$sqlInsert = "INSERT INTO asistencias (usuario_id, concierto_id) VALUES ('$usuario_id', '$concierto_id')";
if($conn->query($sqlInsert)==TRUE){
    echo "Asistencia registrada";
}else{
    echo "Error al registrar la asistencia al concierto";
}

// Devolvemos la respuesta en formato JSON para uso en AJAX si es necesario


$conn->close();
?>