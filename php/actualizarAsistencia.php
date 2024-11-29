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
$sqlUsuario = "SELECT id FROM usuarios WHERE nombre = '$nombre'";
$resultUsuario = $conn->query($sqlUsuario);

if ($resultUsuario->num_rows > 0) {
    $row = $resultUsuario->fetch_assoc();
    $usuario_id = $row["id"];
    
} else {
echo "No hay ningún usuario con ese nombre";
}

$sqlCheck = "SELECT * FROM asistencias WHERE usuario_id='$usuario_id' AND concierto_id='$concierto_id'";
$resultCheck = $conn->query($sqlCheck);
if($resultCheck->num_rows>0){
    echo "Ya ha indicado su asistencia a este concierto";
}else{
    $sqlInsert = "INSERT INTO asistencias (usuario_id, concierto_id) VALUES ('$usuario_id', '$concierto_id')";
    if($conn->query($sqlInsert)==TRUE){
        echo "Asistencia registrada";
    }else{
        echo "Error al registrar la asistencia al concierto";
    }
}



// Devolvemos la respuesta en formato JSON para uso en AJAX si es necesario


$conn->close();
?>