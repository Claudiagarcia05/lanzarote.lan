function fetchJSON(url, modo = "") {

    let ventanaModalLabel     = document.getElementById('ventanaModalLabel');
    let contenidoVentanaModal = document.getElementById('contenidoVentanaModal');
    let formData = '';

    if (modo == 'formulario') {
        let formulario = document.getElementById("formGeneral");
        formData = new FormData(formulario);
    }

    fetch(url, {
        method: 'POST',
        body: formData
    }).then(response => {
        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        ventanaModalLabel.innerHTML = data.titulo;
        contenidoVentanaModal.innerHTML = data.contenido;
    })
    .catch(error => {
        ventanaModalLabel.innerHTML = 'Error inesperado';
        contenidoVentanaModal.innerHTML = `<p style="color: red;">Error:
        ${error.message}</p>`;
    });
}

function fetchHTML(url, id, modo = "") {

    let formData = '';

    if (modo == 'formulario') {
        let formulario = document.getElementById("formGeneral");
        formData = new FormData(formulario);
    }

    fetch(url, {
        method: 'POST',
        body: formData
    }).then(response => {
        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }
        return response.text();
    })
    .then(data => {
        id.innerHTML = data;
    })
    .catch(error => {
        id.innerHTML = `<p style="color: red;">Error inesperado<br />Error:
        ${error.message}</p>`;
    });
}

const selectCurso = document.querySelector("#idcalendario_curso");

if (selectCurso) {
    selectCurso.addEventListener("change", (evento) => {
        fetchHTML(
            BASE_URL + '/calendario/' + evento.target.value,
            document.getElementById('place_calendario')
        );
    });
}