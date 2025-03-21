<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Próximos Conciertos</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">Agenda</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              <a class="nav-link" href="paginas/registro.php">Registrarse</a>
              <a class="nav-link" href="index.php">Iniciar sesión</a>
              <a class="nav-link" href="paginas/conciertos.php">Consultar agenda</a>
              <a class="nav-link" href="paginas/actualizarBdd.php">Modificar datos</a>
              <?php if (isset($_SESSION['nombre'])): ?>
                    <!-- Mostrar botón Cerrar Sesión si hay un usuario logueado -->
                    <a id="botonCerrarSesion" class="nav-link btn btn-danger text-white ms-3" href="php/logout.php">Cerrar Sesión (<?= htmlspecialchars($_SESSION['nombre']) ?>)</a>
                <?php endif; ?>
              <!--<a class="nav-link disabled" aria-disabled="true">Disabled</a>-->
            </div>
          </div>
        </div>
      </nav>
    
    <div class="container">
        <h1>Inicio de sesión</h1>

      <div class="form-group" id="formregistro">
            
          <span>Escriba su nombre de usuario:</span>
          <input type="text" id="nombreUsuario" required>
          <span>Escriba su contraseña:</span>
          <input type="password" id="pass" required>

          <div class="button-container">
              <input id="boton" type="button" value="INICIAR SESIÓN" onclick="iniciarSesion()">
          </div>
            
      </div>
    </div>

    <!--<div id="mensaje"></div>

    </div>-->


    <script src="scripts/sesion.js"></script>

    
    </script>
</body>
</html>
