<div class="page-content mt-3">

    <div class="card card-style">
        <div class="content mb-0">
            <h2>Nueva prenda</h2> <br>

            <form id="form" onsubmit="create(); return false;">

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
                    <input type="number" name="gar_price" class="form-control validate-name" id="gar_price" placeholder="">
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

                <button type="submit" class="btn btn-full bg-green-dark btn-m text-uppercase rounded-sm shadow-l mb-3 mt-4 font-900 w-100">Guardar</button>
            </form>
        </div>
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
    });
</script>



<!-- <div id="calendar"></div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date(); // Obtener la fecha actual

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            validRange: {
                start: today // Solo permite fechas a partir de la fecha actual
            },
            locale: 'es',
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                // week: 'Semana',
                // day: 'Día',
                // list: 'Lista'
                // Puedes agregar más traducciones según sea necesario
            },
            // initialDate: '2023-01-12',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,
            select: function(arg) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.addEvent({
                        title: title,
                        start: arg.start,
                        end: arg.end,
                        allDay: arg.allDay
                    })
                }
                calendar.unselect()
            },
            eventClick: function(arg) {
                if (confirm('Are you sure you want to delete this event?')) {
                    arg.event.remove()
                }
            },
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: []
        });

        calendar.render();
    });
</script> -->

<!--

<script>
    initCalendar();

    function initCalendar() {
        var calendarEl = document.getElementById('calendar1');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            // initialDate: '2023-01-12',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectMirror: true,
            select: function(arg) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.addEvent({
                        title: title,
                        start: arg.start,
                        end: arg.end,
                        allDay: arg.allDay
                    })
                }
                calendar.unselect()
            },
            eventClick: function(arg) {
                if (confirm('Are you sure you want to delete this event?')) {
                    arg.event.remove()
                }
            },
            editable: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: [{
                    title: 'All Day Event',
                    start: '2023-01-01'
                },
                {
                    title: 'Long Event',
                    start: '2023-01-07',
                    end: '2023-01-10'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2023-01-09T16:00:00'
                },
                {
                    groupId: 999,
                    title: 'Repeating Event',
                    start: '2023-01-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2023-01-11',
                    end: '2023-01-13'
                },
                {
                    title: 'Meeting',
                    start: '2023-01-12T10:30:00',
                    end: '2023-01-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2023-01-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2023-01-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2023-01-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2023-01-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2023-01-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2023-01-28'
                }
            ]
        });

        calendar.render();
    }
</script> -->