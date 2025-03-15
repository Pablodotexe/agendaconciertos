<?php
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("sql112.infinityfree.com", "if0_37790823", "26G5hrP31G", "if0_37790823_conciertos");

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Error al establecer la conexión: " . $conn->connect_error]);
    exit();
}

// Recogemos los datos de la solicitud POST

// Pasamos el nombre de la banda a mayúsculas ya que en la BDD todos los nombres
// de bandas están escritos así. De esta forma nos evitamos posibles dobles inserciones,
// por ejemplo: Metallica y METALLICA
$banda = strtoupper($_POST["addBanda"]);
$ciudad = $_POST["addCiudad"];
// Quitamos espacios a ambos lados del string con trim
$sala = trim($_POST["addSala"]);
$ciudad = trim($_POST["addCiudad"]);
$genero = $_POST["addGenero"];
$fecha = $_POST["addFecha"];
$cartel = $_POST["addCartel"];
$hora = $_POST["addHora"];

// En estas variables guardaremos los IDs que necesitaremos insertar más tarde
// tras rescatarlos de sus correspondientes consultas
$idBanda;
$idSala;
$idCiudad;

//file_put_contents("php_log.txt", print_r($_POST, true), FILE_APPEND);

// Validamos que no haya ningún campo vacío. De ser así, mandamos un mensaje al usuario.
if (empty($banda) || empty($ciudad) || empty($sala) ||
empty($genero) || empty($fecha) || empty($cartel) || empty($hora)) {
    echo "No se pueden dejar campos en blanco. Por favor, revise los datos introducidos";
} else {
    // Intentar insertar la banda y, si ya existe, no realizar la inserción
    $insertarBanda = "INSERT INTO bandas (nombre, genero) VALUES ('$banda', '$genero')
    ON DUPLICATE KEY UPDATE id=id";
    $conn->query($insertarBanda);

    // Obtenemos el ID de la banda
    $sqlbanda = "SELECT id FROM bandas WHERE nombre = '$banda'";
    $resultbanda = $conn->query($sqlbanda);
    if ($resultbanda->num_rows > 0) {
        $rowBanda = $resultbanda->fetch_assoc();
        $idBanda = $rowBanda["id"];
    }

    // Obtenemos el ID de la ciudad
    /*$sqlciudad = "SELECT id FROM ciudades WHERE nombre = '$ciudad'";
    $resultCiudad = $conn->query($sqlciudad);
    if ($resultCiudad->num_rows > 0) {
        $rowCiudad = $resultCiudad->fetch_assoc();
        $idCiudad = $rowCiudad["id"];
    }*/

    // Obtenemos el ID de la sala
    $sqlSala = "SELECT id FROM salas WHERE nombre = '$sala'";
    $resultSala = $conn->query($sqlSala);
    if ($resultSala->num_rows > 0) {
        $rowSala = $resultSala->fetch_assoc();
        $idSala = $rowSala["id"];
    }

    // Verificamos que los IDs no sean NULL antes de insertar
    if ($idBanda !== null && $idSala !== null) {
        $sql = "INSERT INTO conciertos (banda_id, sala_id, fecha_concierto, hora, cartel) 
            VALUES ('$idBanda', '$idSala', '$fecha', '$hora', '$cartel')";

        if ($conn->query($sql) === true) {
            echo "Concierto añadido correctamente";
        } else {
            echo "Error al insertar el concierto: " . $conn->error;
        }
    } else {
        // Indicar si la banda o la sala no fueron encontrados
        if ($idBanda === null) {
            echo "La banda especificada no existe en la base de datos";
        }
        if ($idSala === null) {
            echo "La sala especificada no existe en la base de datos";
        }
    }

  
}



$conn->close();
?>
