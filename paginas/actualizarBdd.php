<?php
session_start();

// Verificar si el usuario ha iniciado sesión y es admin
if (!isset($_SESSION['nombre']) || $_SESSION['nombre'] !== 'admin') {
    // Redirigir al inicio de sesión o mostrar un mensaje de error
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Conciertos</title>
  <link rel="stylesheet" href="../styles.css">
  <link rel="stylesheet" href="../styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>

<nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">Agenda</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                <a class="nav-link" href="registro.php">Registrarse</a>
                <a class="nav-link" href="../index.php">Iniciar sesión</a>
                <a class="nav-link" href="conciertos.php">Consultar agenda</a>
                <a class="nav-link" href="actualizarBdd.php">Modificar datos</a>
                
                <?php if (isset($_SESSION['nombre'])): ?>
                    <!-- Mostrar botón Cerrar Sesión si hay un usuario logueado -->
                    <a id="botonCerrarSesion" class="nav-link btn btn-danger text-white ms-3" href="../php/logout.php">Cerrar Sesión (<?= htmlspecialchars($_SESSION['nombre']) ?>)</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

  <div class="container">

    <h1>Gestión de Conciertos</h1>

    <!-- Formulario para añadir un concierto -->

    <h2>Añadir Concierto</h2>
    <form id="addConcertForm">
      <div id="form-group">
        <label for="addBanda">Nombre Banda:</label>
        <input type="text" id="addBanda" name="addBanda" required>

        <label for="addCiudad">Ciudad:</label>
        <select id="addCiudad" name="addCiudad">
          <option value="OVIEDO">OVIEDO</option>
          <option value="GIJON">GIJON</option>
          <option value="AVILES">AVILES</option>
        </select>

        <label for="addSala">Sala:</label>
        <select id="addSala" name="addSala">
          <option value="GONG">GONG</option>
          <option value="LATA DE ZINC">LATA DE ZINC</option>
          <option value="CASINO">CASINO</option>
          <option value="MALECON">MALECON</option>
        </select>

        <label for="addGenero">Estilo musical:</label>
        <select id="addGenero" name="addGenero">
          <option value="metal">metal</option>
          <option value="rock">rock</option>
          <option value="pop">pop</option>
          <option value="rap">rap</option>
        </select>

        <label for="addCartel">Cartel concierto</label>
        <input type="text" id="addCartel">

        <label for="addFecha">Fecha:</label>
        <input type="date" id="addFecha" name="addFecha" required>

        <label for="addHora">Hora:</label>
        <input type="time" id="addHora" name="addHora" required>
        <div class="button-container">
              <input id="boton" type="button" value="AÑADIR CONCIERTO" onclick="addConcierto()">
          </div>

      </div>

      

    </form>


    <!-- Formulario para editar un concierto -->

    <h2>Editar Concierto</h2>
    <form id="editConcertForm">
      <div id="form-group">
        <label for="editId">ID del Concierto:</label>
        <input type="text" id="editId" name="id" required>

        <label for="editCartel">Cartel concierto</label>
        <input type="text" id="editCartel">

        <label for="editFecha">Fecha:</label>
        <input type="date" id="editFecha" name="fecha">

        <label for="editHora">Hora:</label>
        <input type="time" id="editHora" name="hora">

        <div class="button-container">
              <input id="boton" type="button" value="EDITAR CONCIERTO" onclick="editarConcierto()">
          </div>
      </div>
      
    </form>


    <!-- Formulario para borrar un concierto -->

    <h2>Borrar Concierto</h2>
    <form id="deleteConcertForm">
      <div id="form-group">
        <label for="borrarConcierto">Selecciona Concierto:</label>
        <select id="borrarConcierto" name="borrarConcierto" required>
          <option value="">Elija concierto:</option>
        </select>
        <div class="button-container">
              <input id="boton" type="button" value="BORRAR CONCIERTO" onclick="borrarConcierto()">
          </div>

      </div>
      
    </form>


  </div>


  <script src="../scripts/actualizacionesBdd.js"></script>
</body>

</html>