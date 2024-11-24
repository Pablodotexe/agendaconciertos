function iniciarSesion() {
    nombre = document.getElementById("nombreUsuario").value;
    pass = document.getElementById("pass").value;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/iniciarSesion.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);

            // Convierte la respuesta en JSON a un valor booleano
            const sesion = JSON.parse(xhr.responseText);
            console.log(sesion)
            if (sesion === true) {
                console.log("Sesión iniciada, redirigiendo...");
                alert("Bienvenido, " + nombre);
                window.location.href = "paginas/conciertos.php";
            } else {
                alert("Usuario o contraseña erróneos. Por favor, vuelva a intentarlo");
            }
        }
    };

    xhr.send("nombre=" + nombre + "&pass=" + pass);
}
