<?php

$conn = new mysqli("sql112.infinityfree.com", "if0_37790823", "26G5hrP31G", "if0_37790823_conciertos");
// Verifica si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error al conectar con la BD: " . $conn->connect_error);
}

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$pass = $_POST['pass'];

$hashed_password = hash('sha256', $pass);

try {
    // Verificar si el nombre de usuario ya existe
    $checkUserSql = "SELECT COUNT(*) AS count FROM usuarios WHERE nombre = '$nombre'";
    $result = $conn->query($checkUserSql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        throw new Exception("El nombre de usuario ya está registrado.");
    }
    
    // Verificar si el correo electrónico ya existe
    $checkEmailSql = "SELECT COUNT(*) AS count FROM usuarios WHERE correo = '$email'";
    $result = $conn->query($checkEmailSql);
    $row = $result->fetch_assoc();
    if ($row['count'] > 0) {
        throw new Exception("El correo electrónico ya está registrado.");
    }

    // Insertar el nuevo usuario si el nombre y el correo no existen
    $sql = "INSERT INTO usuarios (nombre, pass, correo) VALUES ('$nombre', '$hashed_password', '$email')";
    if ($conn->query($sql) === true) {
        echo "Usuario registrado correctamente";
    } else {
        throw new Exception("Fallo al registrar el usuario: " . $conn->error);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

$conn->close();
?>

