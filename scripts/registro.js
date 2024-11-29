function registrarUsuario() {
    nombre = document.getElementById("nombreUsuario").value;
    email = document.getElementById("email").value;
    pass = document.getElementById("pass").value;
    passrepeat = document.getElementById("passrepeat").value;

    if (!nombre || !email || !pass || !passrepeat) {
        alert("Por favor, rellena todos los campos.");
        return; // Detener la ejecución si algún campo está vacío
    }

    // Validar formato del correo electrónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("El email no tiene el formato adecuado.");
        return; // Detener la ejecución si el email no es válido
    }

    // Verificar que las contraseñas coincidan
    if (pass !== passrepeat) {
        alert("Las contraseñas no coinciden. Por favor, vuelve a intentarlo.");
        return; // Detener la ejecución si las contraseñas no coinciden
    }
    

    

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/registrarUsuario.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
           
            document.getElementById("mensaje").innerHTML = xhr.responseText;
            alert(xhr.responseText);
            window.location.href = "../paginas/conciertos.php";
        }
    }
    

    xhr.send("nombre="+nombre+"&email="+email+"&pass="+pass);

}
  
    

    
