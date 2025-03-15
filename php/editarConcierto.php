<?php
header('Content-Type: application/json'); // Asegura que la respuesta sea JSON
// Configuración de la conexión a la base de datos
$conn = new mysqli("sql112.infinityfree.com", "if0_37790823", "26G5hrP31G", "if0_37790823_conciertos");

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibimos datos del formulario
$id = $_POST['editId'];
$cartel = $_POST['editCartel'];
$fecha = $_POST['editFecha'];
$hora = $_POST['editHora'];


// Validamos que se ha proporcionado elegido un concierto en el select
if (!is_numeric($id)) {
    echo "Debe seleccionar un concierto";
    die();
}

// Construimos dinámicamente la consulta de actualización, ya que algunos campos pueden estar vacíos
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

// Si no hay campos para actualizar, salimos
if (empty($fields)) {
    echo "No se proporcionaron datos para actualizar.";
    die();
}

// Construimos y ejecutamos la consulta SQL
$sql = "UPDATE conciertos SET " . implode(", ", $fields) . " WHERE id = " . intval($id);

if ($conn->query($sql) === TRUE) {
    //echo json_encode(array( "success"=>true,"message"=> "cambios realizados"));
    echo "Datos recibidos y procesados correctamente";
} else {
    //echo json_encode(array( "success"=>false,"message"=> "No se pudieron realizar los cambios"));
    echo "No se pudieron realizar los cambios";
}

//echo "Datos recibidos y procesados correctamente";

$conn->close();


// Cerrar la conexión

?>
