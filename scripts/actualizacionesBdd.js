// FUNCIÓN PARA AÑADIR CONCIERTOS A LA BDD
function addConcierto(){
let addBanda = document.getElementById("addBanda").value;
let addSala = document.getElementById("addSala").value;
let addCiudad = document.getElementById("addCiudad").value;
let addGenero = document.getElementById("addGenero").value;
let addFecha = document.getElementById("addFecha").value;
let addHora = document.getElementById("addHora").value;
let addCartel = document.getElementById("addCartel").value;

console.log(addSala);
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/addConciertos.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let respuesta = xhr.responseText;
            //console.log(respuesta);
            alert(respuesta);
        }
    };
    let data = `addBanda=${encodeURIComponent(addBanda)}&addSala=${encodeURIComponent(addSala)}
    &addCiudad=${encodeURIComponent(addCiudad)}&addGenero=${encodeURIComponent(addGenero)}
    &addFecha=${encodeURIComponent(addFecha)}&addHora=${encodeURIComponent(addHora)}
    &addCartel=${encodeURIComponent(addCartel)}`;
    xhr.send(data);
}





function loadConcerts() {
    let xhr = new XMLHttpRequest();
    //xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                let listaConciertos = JSON.parse(xhr.responseText);
                console.log(listaConciertos);  // Para depuración
                mostrarConciertosBorrado(listaConciertos);
                mostrarConciertosEditar(listaConciertos)
            } catch (error) {
                console.error("Error al parsear JSON:", error, xhr.responseText);
            }
        }
    };
    xhr.open("GET", "../php/cargarConciertos.php", true);
    xhr.send();
}

function mostrarConciertosEditar(listaConciertos) {

    let divSelect = document.getElementById("editId");
    
        for (let i = 0; i < listaConciertos.length; i++) {
            for (let j = 0; j < listaConciertos[i].concierto.length; j++) {
                let contador = 1;
                let option = document.createElement("option");
                option.value = listaConciertos[i].concierto[j].id; // Convertimos el objeto a string;
                option.textContent = listaConciertos[i].concierto[j].banda_nombre
                + " - " + listaConciertos[i].concierto[j].sala_nombre
                + " - " + listaConciertos[i].concierto[j].fecha_concierto
                + " - " + listaConciertos[i].concierto[j].hora;
    
                divSelect.appendChild(option);
                contador++;
            }
        }
    }

function editarConcierto(){
    let editId = document.getElementById("editId").value;
    let editFecha = document.getElementById("editFecha").value;
    let editHora = document.getElementById("editHora").value;
    let editCartel = document.getElementById("editCartel").value;
    let xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/editarConcierto.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let respuesta = xhr.responseText;
                //console.log(respuesta);
                alert(respuesta);
            }
        };
        let data = `editId=${encodeURIComponent(editId)}&editFecha=${encodeURIComponent(editFecha)}&editHora=${encodeURIComponent(editHora)}&editCartel=${encodeURIComponent(editCartel)}`;
        xhr.send(data);
    
    }

// Función para borrar el concierto seleccionado
function mostrarConciertosBorrado(listaConciertos) {

let divSelect = document.getElementById("borrarConcierto");

    for (let i = 0; i < listaConciertos.length; i++) {
        for (let j = 0; j < listaConciertos[i].concierto.length; j++) {
            let contador = 1;
            let option = document.createElement("option");
            option.value = listaConciertos[i].concierto[j].id; // Convertimos el objeto a string;
            option.textContent = listaConciertos[i].concierto[j].banda_nombre
            + " - " + listaConciertos[i].concierto[j].sala_nombre
            + " - " + listaConciertos[i].concierto[j].fecha_concierto
            + " - " + listaConciertos[i].concierto[j].hora;

            divSelect.appendChild(option);
            contador++;
        }
    }
}

function borrarConciertos(){
    let idConcierto = document.getElementById("borrarConcierto").value;
    console.log(idConcierto)
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/borrarConcierto.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let respuesta = xhr.responseText;
            //console.log(respuesta);
            alert(respuesta);
        }
    }
    let data = `idConcierto=${encodeURIComponent(idConcierto)}`
    xhr.send(data);
}


// Cargar conciertos cuando la página esté lista
window.onload = loadConcerts;
