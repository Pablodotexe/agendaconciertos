<?php

$conn = new mysqli("localhost", "root", "aaaa", "conciertos");


if ($conn->connect_error) {
    die("Error al conectar con la BD: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$pass = $_POST['pass'];

$hashed_password = password_hash($pass, PASSWORD_BCRYPT);

$sql = "INSERT INTO usuarios (nombre, pass, correo) VALUES ('$nombre', '$pass', '$email')";

if ($conn->query($sql)===true){
        echo "Usuario registrado correctamente";
    }else{
        echo "Fallo al registrar el usuario: " . $conn->error;
    }

    $conn->close()

?>