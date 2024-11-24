<?php
session_start();

$conn = new mysqli("localhost", "root", "aaaa", "conciertos");

if ($conn->connect_error) {
    die("Error al establecer la conexión" . $conn->connect_error);
}

// Recogemos el usuario y contraseña
$nombre = $_POST["nombre"];
$pass = $_POST["pass"];
$sesion = false;

// Hacemos SELECT para recoger el usuario en caso de que exista con ese nombre
$sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($nombre == $row['nombre'] && $pass == $row['pass']) {
        $_SESSION['nombre'] = $nombre;
        
        $sesion = true;
        /*header("Location: conciertos.php");
        exit();*/
    }else{
        $sesion=false;
    }


} else {

    $sesion = false;
}

// Devolvemos la respuesta en formato JSON para uso en AJAX si es necesario
echo json_encode($sesion);

$conn->close();
?>