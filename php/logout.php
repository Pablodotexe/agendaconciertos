<?php
session_start();
session_unset(); // Limpiar las variables de sesión
session_destroy(); // Destruir la sesión
header("Location: ../index.php"); // Redirigir al inicio de sesión
exit();
?>
