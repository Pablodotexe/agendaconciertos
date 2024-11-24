function registrarUsuario() {
    nombre = document.getElementById("nombreUsuario").value;
    email = document.getElementById("email").value;
    pass = document.getElementById("pass").value;
    passrepeat = document.getElementById("passrepeat").value;

    if (pass !== passrepeat) {
        alert('Las contraseñas no coinciden. Por favor, vuelva a intentarlo');
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/registrarUsuario.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
           
            document.getElementById("mensaje").innerHTML = xhr.responseText;
        }
    }
    

    xhr.send("nombre="+nombre+"&email="+email+"&pass="+pass);

}
