<!-- protected.php -->
 <?php
 session_start();

 if (!isset($_SESSION['nombre'])) {
  // Si no hay sesión iniciada, redirige a la página de inicio de sesión
  header("Location: ../index.php");
  print($_SESSION['nombre']);
  exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Próximos Conciertos</title>
    <link rel="stylesheet" href="../styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
            <h1>Agenda de Conciertos</h1>
            <form id="concert-form">

                <div class="form-group">
                    <label for="city">Ciudad:</label>
                        <select id="city" name="city">
                            <option value="OVIEDO">OVIEDO</option>
                            <option value="GIJON">GIJON</option>
                            <option value="AVILES">AVILES</option>
                        </select>
                </div>

                <div class="form-group">
                    <label for="genre">Estilo Musical:</label>
                        <select id="genre" name="genre">
                            <option value="metal">metal</option>
                            <option value="rock">rock</option>
                            <option value="pop">pop</option>
                            <option value="rap">rap</option>
                        </select>
                </div>

                <div class="form-group">
                    <label for="start-date">Fecha de Inicio:</label>
                    <input type="date" id="start-date" name="start-date" required>
                </div>

                <div class="form-group">
                    <label for="end-date">Fecha de Fin:</label>
                    <input type="date" id="end-date" name="end-date" required>
                </div>
                
                <div><input type="button" id="boton" value="BUSCAR CONCIERTOS" onclick="consultaBDD()"></input></div>
                
            </form>
        
    </div>
    <div id="conciertos" class="conciertos-container"></div>

    <script src="../scripts/consulta.js"></script>
</body>
</html>
