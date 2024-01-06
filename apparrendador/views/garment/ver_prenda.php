<?php $gar_id = $_REQUEST['gar_id']; ?>
<style>
    /* Estilos CSS para las fechas pasadas */
    .fc-day-past {
        opacity: 0.5 !important;
        /* Ajusta la opacidad según tu preferencia */
        pointer-events: none;
        /* Deshabilita la interacción con fechas pasadas */
        background-color: #E4E5E4 !important;
    }
</style>
<div class="page-content mt-3">

    <div class="card card-style">
        <div class="content mb-0">
            <h2>Modificar datos</h2> <br>

            <form id="form" onsubmit="update(); return false;">

                <div class="input-style input-style-always-active has-borders has-icon validate-field">
                    <input type="text" name="gar_name" class="form-control validate-name" id="gar_name" placeholder="">
                    <label for="gar_name" class="color-blue-dark font-13">Nombre de la prenda</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(Requerido)</em>
                </div>
                <div class="input-style input-style-always-active has-borders has-icon validate-field mt-4">
                    <textarea name="gar_description" class="form-control validate-name" id="gar_description" cols="30" rows="10"></textarea>
                    <label for="gar_description" class="color-blue-dark font-13">Descripción</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(Requerido)</em>
                </div>
                <div class="input-style input-style-always-active has-borders has-icon validate-field">
                    <i class="fa fa-coins font-12"></i>
                    <input type="number" step="0.01" min="0" name="gar_price" class="form-control validate-name" id="gar_price" placeholder="">
                    <label for="gar_price" class="color-blue-dark font-13">Precio</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(Requerido)</em>
                </div>
                <div class="input-style input-style-always-active has-borders no-icon validate-field">
                    <select class="form-control validate-text" name="gar_fkcat_category" id="gar_fkcat_category">
                        <option selected value="">Selecciona una categoria</option>
                    </select>
                    <label for="gar_fkcat_category" class="color-blue-dark font-12">Categoria</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>

                <div class="input-style input-style-always-active has-borders no-icon validate-field">
                    <select class="form-control validate-text" name="gar_fkcat_person" id="gar_fkcat_person">
                        <option selected value="">¿La prenda es para?</option>
                    </select>
                    <label for="gar_fkcat_person" class="color-blue-dark font-12">Tipo persona</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>

                <div class="input-style input-style-always-active has-borders no-icon validate-field">
                    <select class="form-control validate-text" name="gar_fkcat_type_publication" id="gar_fkcat_type_publication">
                        <option selected value="">¿Es prenda o paquete?</option>
                    </select>
                    <label for="gar_fkcat_type_publication" class="color-blue-dark font-12">Tipo de piblicación</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(required)</em>
                </div>

                <div class="input-style input-style-always-active has-borders has-icon validate-field">
                    <i class="fa fa-camera font-12"></i>
                    <div class="dropzone" id="media2Dropzone"></div>
                    <label for="f1" class="color-blue-dark font-13">Imagenes de la publicación</label>
                    <i class="fa fa-times disabled invalid color-red-dark"></i>
                    <i class="fa fa-check disabled valid color-green-dark"></i>
                    <em>(Requerido)</em>
                </div>
                <input type="hidden" name="gar_id" id="gar_id">

                <button type="submit" class="btn btn-full bg-green-dark btn-m text-uppercase rounded-sm shadow-l mb-3 mt-4 font-900 w-100">Guardar</button>
            </form>
        </div>
    </div>

    <div class="card card-style">
        <div class="content mb-0">
            <h2>Imagenes actuales</h2>
            <p>
                Estas son las imagenes que se muestran a tus potenciales clientes
            </p>

            <div class="row text-center row-cols-3 mb-0" id="listImagenes"></div>
        </div>
    </div>




    <div class="card card-style">

        <h2 class="mx-1 my-3">Elije las fechas que estara disponible la prenda</h2>
        <div id="calendar"></div>
        <hr>
        <div class="container">
            <h2>Fechas seleccionadas</h2>
        </div>
        <div id="fechas-seleccionadas" class="container"></div>
        <button id="guardar-btn" onclick="guardarFechas(<?= $gar_id ?>)" class="btn btn-success">Guardar cambios</button>
    </div>

</div>


<script>
    // Configuración del primer dropzone para iamgenes de ofertas
    Dropzone.options.media2Dropzone = {
        url: '/',
        dictDefaultMessage: "Arrastra los archivos aquí para subirlos",
        maxFilesize: 6,
        maxFiles: 7,
        acceptedFiles: 'image/jpeg, image/png,image/jpg,image/webp',
        addRemoveLinks: true,
        dictRemoveFile: 'Quitar X'
    };
</script>

<script src="assets/scripts/src/garment.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        cat_category();
        cat_person();
        cat_type_publication();
        view(<?= $gar_id ?>);
    });
</script>


<script>
    const calendarEl = document.getElementById('calendar');
    let selectedDates = []; // Array para almacenar fechas seleccionadas en formato 'YYYY-MM-DD'

    const fechaActual = new Date(); // Obtener la fecha actual
    fechaActual.setDate(fechaActual.getDate() - 1); // Restar un día

    const fechaAnterior = fechaActual.toISOString().slice(0, 10); // Convertir a formato 'YYYY-MM-DD'

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        locale: 'es', // Establecer el idioma español
        selectLongPressDelay: 100, // Reducir el tiempo de retardo para dispositivos táctiles
        select: function(info) {
            const selectedDate = info.start;
            const formattedDate = selectedDate.toISOString().slice(0, 10); // Convertir a formato 'YYYY-MM-DD'

            eliminarFecha(formattedDate);

            if (!selectedDates.includes(formattedDate)) {
                selectedDates.push(formattedDate);
            } else {
                selectedDates = selectedDates.filter(date => date !== formattedDate);
            }
            highlightSelectedDates(calendar);
        },
        // Otros ajustes y configuraciones que necesites
        // ...

        eventClick: function(info) {
            const fechaEliminar = info.event.start.toISOString().slice(0, 10); // Obtener la fecha del evento
            //mostrarSweetAlert(info.event.gardat_fkgarment, fechaEliminar, info.event.gardat_status); // Mostrar SweetAlert para confirmar la eliminación
        },

        selectConstraint: {
            start: fechaAnterior // Restringe las fechas anteriores al día actual
        },
    });

    function highlightSelectedDates(calendar) {
        calendar.removeAllEventSources();
        const events = selectedDates.map(date => ({
            title: 'disp',
            start: date,
            display: 'background',
            color: '#95E800'
        }));
        calendar.addEventSource(events);

        // Añadir texto adicional a las fechas y mostrarlas en un div con saltos de línea
        const fechasSeleccionadasDiv = document.getElementById('fechas-seleccionadas');
        const fechasConTexto = selectedDates.map(date => `Fecha: ${date}`);
        fechasSeleccionadasDiv.innerHTML = fechasConTexto.join('<br>');

    }

    obtenerFechasDesdeServidor(<?= $gar_id ?>);


    function obtenerFechasDesdeServidor(gar_id) {
        const formData = new FormData();
        formData.append('id', gar_id);
        fetch('db_functions/garment_date.php?action=listarFechasPrendaId', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Procesar las fechas recibidas y agregarlas al calendario como eventos
                if (data.status) {
                    let datos = data.data;
                    datos.forEach(fecha => {

                        calendar.addEvent({
                            title: fecha.gardat_status == 1 ? 'Rentado' : 'Disp',
                            start: fecha.gardat_date, // Suponiendo que las fechas están en formato 'YYYY-MM-DD'
                            color: fecha.gardat_status == 1 ? 'red' : 'blue', // Color azul para las fechas de la BD
                            gardat_id: fecha.gardat_id,
                            gardat_fkgarment: fecha.gardat_fkgarment,
                            gardat_status: fecha.gardat_status
                        });
                    });
                }

                calendar.render();
            })

    }

    function eliminarFecha(gardat_id) {
        // Aquí puedes enviar la fecha al servidor para eliminarla de la base de datos
        // Utiliza fetch o algún método similar para realizar la eliminación
        // Luego, actualiza el calendario si la eliminación es exitosa
        const formData = new FormData();
        formData.append('gardat_id', gardat_id);
        fetch('db_functions/garment_date.php?action=eliminarFecha', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Procesar las fechas recibidas y agregarlas al calendario como eventos
                if (data.status) {
                    calendar.refetchEvents();
                }
            })
    }

    function cambiarCancelado(gardat_id) {
        // Aquí puedes enviar la fecha al servidor para eliminarla de la base de datos
        // Utiliza fetch o algún método similar para realizar la eliminación
        // Luego, actualiza el calendario si la eliminación es exitosa
        const formData = new FormData();
        formData.append('gardat_id', gardat_id);
        fetch('db_functions/garment_date.php?action=cambiarCancelado', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Procesar las fechas recibidas y agregarlas al calendario como eventos
                if (data.status) {
                    calendar.refetchEvents();
                }
            })
    }

    function mostrarSweetAlert(gardat_id, fecha, status) {
        // Aquí puedes usar SweetAlert para confirmar la eliminación
        // Mostrar un mensaje al usuario y, si confirma, llamar a eliminarFecha()

        swal.fire({
            title: status == 1 ? '¿Estás seguro?' : '¿Estás seguro de cancelar la renta?',
            text: status == 1 ? 'La fecha ' + fecha + ' será eliminada' : 'La renta con fecha ' + fecha + ' será cancelada',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: status == 1 ? 'Sí, eliminar' : 'Sí, cancelar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                if (status == 0) {
                    // ya esta rentado y solo debemos cancelar la renta
                    cambiarCancelado(gardat_id);
                } else {
                    // esta disponible y debemos eliminarlo
                    eliminarFecha(gardat_id);
                }
            }
        });
    }

    function guardarFechas(gar_id) {
        // Aquí puedes enviar las fechas al servidor para guardarlas en la base de datos
        // Utiliza fetch o algún método similar para realizar la inserción
        // Luego, actualiza el calendario si la inserción es exitosa
        const formData = new FormData();
        formData.append('fechas', JSON.stringify(selectedDates));
        formData.append('gar_id', gar_id);
        fetch('db_functions/garment_date.php?action=create', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Procesar las fechas recibidas y agregarlas al calendario como eventos
                if (data.status) {
                    window.location.reload();
                }
            })

    }


    calendar.render();
</script>