<?php
header('Content-Type: application/json'); // Asegura que la respuesta sea JSON
// Configuración de la conexión a la base de datos
$conn = new mysqli("localhost", "root", "aaaa", "conciertos");

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$id = $_POST['editId'];
echo $id;
$cartel = $_POST['editCartel'];
echo $cartel;
$fecha = $_POST['editFecha'];
echo $fecha;
$hora = $_POST['editHora'];
echo $hora;
$cambio = false;



// Validar que se ha proporcionado un ID
if (!$id) {
    die("El ID del concierto es obligatorio.");
}

// Construir dinámicamente la consulta de actualización
$fields = [];
if (!empty($cartel)) {
    $fields[] = "cartel = '" . $conn->real_escape_string($cartel) . "'";
}
if (!empty($fecha)) {
    $fields[] = "fecha_concierto = '" . $conn->real_escape_string($fecha) . "'";
}
if (!empty($hora)) {
    $fields[] = "hora = '" . $conn->real_escape_string($hora) . "'";
}

// Si no hay campos para actualizar, salir
if (empty($fields)) {
    die("No se proporcionaron datos para actualizar.");
}

// Construir y ejecutar la consulta SQL
$sql = "UPDATE conciertos SET " . implode(", ", $fields) . " WHERE id = " . intval($id);

if ($conn->query($sql) === TRUE) {
    echo json_encode(array( "success"=>true,"message"=> "cambios realizados"));
} else {
    echo json_encode(array( "success"=>false,"message"=> "No se pudieron realizar los cambios"));
}

echo "Datos recibidos y procesados correctamente";

$conn->close();


// Cerrar la conexión

?>
