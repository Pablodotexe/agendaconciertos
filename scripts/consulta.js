

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

/*function listaConciertos(listado) {
    let contenedor = document.getElementById("conciertos");
    contenedor.innerHTML = ''; // Limpiar contenido previo

    if (listado.length === 0) {
        contenedor.innerHTML = 'No se encontraron conciertos en el rango de fechas especificado.';
        return;
    }
    for (let i = 0; i < listado.length; i++) {
        let lista = document.createElement("ul");
        for (let j = 0; j < listado[i].datos.length; j++) {
            let liBanda = document.createElement("li");
            liBanda.textContent = "Banda: " + listado[i].datos[j].banda_nombre;
            lista.appendChild(liBanda);

            let liSala = document.createElement("li");
            liSala.textContent = "Sala: " + listado[i].datos[j].sala_nombre;
            lista.appendChild(liSala);

            let liFecha = document.createElement("li");
            liFecha.textContent = "Fecha: " + listado[i].datos[j].fecha_concierto;
            lista.appendChild(liFecha);
        }
        contenedor.appendChild(lista);

    }
}*/

function listaConciertos(listado) {
    let contenedor = document.getElementById("conciertos");
    contenedor.innerHTML = ''; // Limpiar contenido previo

    if (listado.length === 0) {
        contenedor.innerHTML = '<p>No se encontraron conciertos en el rango de fechas especificado.</p>';
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
        }
        contenedor.appendChild(tarjetaConcierto);
    }
}

