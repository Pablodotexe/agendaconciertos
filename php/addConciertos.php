<?php
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "aaaa", "conciertos");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Error al establecer la conexión: " . $conn->connect_error]);
    exit();
}

// Recogemos los datos de la solicitud POST
$banda = $_POST["addBanda"];
$ciudad = $_POST["addCiudad"];
$sala = trim($_POST["addSala"]);
$ciudad = trim($_POST["addCiudad"]);
$genero = $_POST["addGenero"];
$fecha = $_POST["addFecha"];
$cartel = $_POST["addCartel"];
$hora = $_POST["addHora"];



$insercion = false;
$idBanda;
$idSala;
$idCiudad;

file_put_contents("php_log.txt", print_r($_POST, true), FILE_APPEND);

if(empty($banda) || empty($ciudad) || empty($sala) || empty($genero) || empty($fecha) || empty($cartel) || empty($hora)){
    echo json_encode(["success"=> false,"message"=> "No se pueden dejar campos en blanco. Por favor, revise los datos introducidos"]);
}else{
// Intentar insertar la banda y, si ya existe, no realizar cambios
$insertarBanda = "INSERT INTO bandas (nombre, genero) VALUES ('$banda', '$genero') ON DUPLICATE KEY UPDATE id=id";
$conn->query($insertarBanda);

// Obtener el ID de la banda
$sqlbanda = "SELECT id FROM bandas WHERE nombre = '$banda'";
$resultbanda = $conn->query($sqlbanda);
if ($resultbanda->num_rows > 0) {
    $rowBanda = $resultbanda->fetch_assoc();
    $idBanda = $rowBanda["id"];
}

$sqlciudad = "SELECT id FROM ciudades WHERE nombre = '$ciudad'";
$resultCiudad = $conn->query($sqlciudad);
if ($resultCiudad->num_rows > 0) {
    $rowCiudad = $resultCiudad->fetch_assoc();
    $idCiudad = $rowCiudad["id"];
}

// Obtener el ID de la sala
$sqlSala = "SELECT id FROM salas WHERE nombre = '$sala'";
$resultSala = $conn->query($sqlSala);



if ($resultSala->num_rows > 0) {
    $rowSala = $resultSala->fetch_assoc();
    $idSala = $rowSala["id"];
    file_put_contents("php_log.txt", "ID de la sala encontrado: " . $idSala . PHP_EOL, FILE_APPEND);
} else {
    file_put_contents("php_log.txt", "Consulta SQL: " . $sqlSala . PHP_EOL, FILE_APPEND);
    file_put_contents("php_log.txt", "Error: Sala no encontrada en la base de datos." . PHP_EOL, FILE_APPEND);
}

if (!isset($idSala)) {
    
    echo json_encode(["success" => false, "message" => "No se pudo obtener el ID de la sala"]);
    exit();
}

// Verificar que los IDs no sean NULL antes de insertar
if ($idBanda !== null && $idSala !== null) {
    $sql = "INSERT INTO conciertos (banda_id, sala_id, fecha_concierto, hora, cartel) 
            VALUES ('$idBanda', '$idSala', '$fecha', '$hora', '$cartel')";

    if ($conn->query($sql) === true) {
        echo json_encode(["success" => true, "message" => "Concierto añadido correctamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al insertar el concierto: " . $conn->error]);
    }
} else {
    // Indicar si la banda o la sala no fueron encontrados
    if ($idBanda === null) {
        echo json_encode(["success" => false, "message" => "La banda especificada no existe en la base de datos"]);
    }
    if ($idSala === null) {
        echo json_encode(["success" => false, "message" => "La sala especificada no existe en la base de datos"]);
    }
}

echo "Concierto añadido a la base de datos";
}



$conn->close();
?>
