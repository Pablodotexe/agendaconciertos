<?php
$conn = new mysqli("sql112.infinityfree.com", "if0_37790823", "26G5hrP31G", "if0_37790823_conciertos");

if ($conn->connect_error) {
    die("Error al establecer la conexión: " . $conn->connect_error);
}

// Recogemos el ID del concierto desde el formulario
$idConcierto = $_POST["idConcierto"];

// Validamos que se ha proporcionado elegido un concierto en el select
if (!is_numeric($idConcierto)) {
    echo "Debe seleccionar un concierto";
    die();
}

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
