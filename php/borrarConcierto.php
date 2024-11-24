<?php
$conn = new mysqli("localhost", "root", "aaaa", "conciertos");

if ($conn->connect_error) {
    die("Error al establecer la conexión: " . $conn->connect_error);
}

// Recogemos el ID del concierto desde el formulario
$idConcierto = $_POST["idConcierto"];

// Comprobamos que el ID no esté vacío
if (!empty($idConcierto)) {
    // Consulta SQL para borrar el concierto
    $sql = "DELETE FROM conciertos WHERE id = '$idConcierto'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Concierto borrado";
    } else {
        echo "Error en el borrado del concierto seleccionado: " . $conn->error;
    }
} else {
    echo "Error: El ID del concierto no puede estar vacío.";
}

$conn->close();
?>
