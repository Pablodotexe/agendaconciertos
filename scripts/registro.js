

// Función que consulta en la BDD los conciertos que se encuentran dentro de los
// parámetros solicitados por el usuario
function consultaBDD() {


let fecha_inicio = document.getElementById("start-date").value;
let fecha_fin = document.getElementById("end-date").value;
let genero = document.getElementById("genre").value;
let ciudad = document.getElementById("city").value;

console.log(fecha_inicio, fecha_fin, genero, ciudad);


    if (!fecha_inicio || !fecha_fin) {
        alert('Por favor, selecciona ambas fechas.');
        return;
    }
    let xhr = new XMLHttpRequest();
    xhr.open("GET", `../php/mostrarConciertos.php?fecha_inicio=${fecha_inicio}&fecha_fin=${fecha_fin}&genero=${genero}&ciudad=${ciudad}`, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if ((xhr.status === 200) && (xhr.readyState === 4)) {
            let listado = JSON.parse(xhr.responseText);
            console.log(listado);
            listaConciertos(listado);
        }
    };
    
    xhr.send();
}


function listaConciertos(listado) {
    
    let contenedor = document.getElementById("conciertos");
    contenedor.innerHTML = ''; // Limpiar contenido previo

    if (listado.length === 0) {
        alert("No se encontraron conciertos en el rango de fechas especificado.");
        return;
    }

    for (let i = 0; i < listado.length; i++) {
        let tarjetaConcierto = document.createElement("div");
        tarjetaConcierto.className = "tarjeta-concierto";

        for (let j = 0; j < listado[i].datos.length; j++) {
            
            let liBanda = document.createElement("p");
            liBanda.textContent = "Banda: " + listado[i].datos[j].banda_nombre;
            tarjetaConcierto.appendChild(liBanda);

            let liSala = document.createElement("p");
            liSala.textContent = "Sala: " + listado[i].datos[j].sala_nombre;
            tarjetaConcierto.appendChild(liSala);

            let liCiudad = document.createElement("p");
            liCiudad.textContent = "Ciudad: " + listado[i].datos[j].ciudad;
            tarjetaConcierto.appendChild(liCiudad);

            let liFecha = document.createElement("p");
            liFecha.textContent = "Fecha: " + listado[i].datos[j].fecha_concierto;
            tarjetaConcierto.appendChild(liFecha);

            // Crear un elemento de imagen para la banda
            let imagen = document.createElement("img");
            imagen.src = listado[i].datos[j].banda_imagen; // Ruta de la imagen
            imagen.alt = "Imagen de " + listado[i].datos[j].banda_nombre;
            tarjetaConcierto.appendChild(imagen);

            let botonAsistir = document.createElement("button");
botonAsistir.className = "boton"; // Usa una clase para estilizar o seleccionar
botonAsistir.setAttribute("data-id", listado[i].datos[j].id_concierto); // Usa data-id para almacenar el ID del concierto
botonAsistir.textContent = "ASISTIRÉ";
botonAsistir.addEventListener("click", actualizarAsistencia);
tarjetaConcierto.appendChild(botonAsistir);
            
           
            

        }
        contenedor.appendChild(tarjetaConcierto);
    }
    contenedor.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function actualizarAsistencia(){
    const boton = event.target;
    const concierto_id = boton.getAttribute("data-id");
    //alert(concierto_id);
    
    let nombre = document.body.getAttribute("data-user-id");
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/actualizarAsistencia.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
   
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let respuesta = xhr.responseText;
                alert(respuesta);
            }
        };
    

    xhr.send("concierto_id="+concierto_id+"&nombre="+nombre);
}


