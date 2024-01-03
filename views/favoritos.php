<div class="page-content mt-4">
    <div class="card card-style">
        <div class="content">
            <h1 class="text-center font-700 mb-1">Favoritos</h1>
        </div>
    </div>
    <div class="mb-0" id="setGarment"></div>
</div>

<!-- Rentar -->
<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" style="height: auto;">
    <div class="offcanvas-header">

        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">

        <h1 id="garName">Vestido</h1>

        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" id="garImages"></div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <span class="d-block color-green-dark font-700">Veces rentado: <span id="vecesRentado"></span></span>

        <p class="mb-2" id="garDescription">Este hermoso vestido está disponible para alquiler. Es la elección perfecta para ocasiones especiales, como bodas, fiestas de gala y eventos elegantes. Destaca tu estilo con este vestido exclusivo.</p>

        <div class="align-self-center">
            <span id="estrellas"></span>
            <span class="d-block opacity-70 font-11 mt-n2 color-theme" id="calificaciones"></span>
        </div>
        <div class="d-flex justify-content-between">
            <h3>Precio: <strong id="garPrice">€200</strong></h3>
            <button id="btnRenderCalendar" class="custom-btn btn-5" data-menu="menu-event-calendar"><span>Seleccionar Fecha</span></button>
        </div>

        <hr>

        <div id="liveAlertPlaceholder"></div>
        <button type="button" class="custom-btn btn-11" id="agregarAlCarrito" style="width: 100%;">Agregar al carrito<div class="dot"></div></button>
        <br>
    </div>
</div>

<!-- Calendar -->
<div id="menu-event-calendar" class="menu menu-box-bottom menu-box-detached" data-menu-height="450" style="display: block; height: 370px; z-index:7777">
    <div class="calendar bg-theme m-0" style="max-width:100%!important;">
        <div class="cal-header">
            <h4 class="cal-title text-left font-700 bg-highlight color-white">Elige las fechas que necesite rentar</h4>
            <h6 class="cal-title-right color-white close-menu"><i class="fa fa-times"></i></h6>
        </div>
        <div class="clearfix"></div>

        <div id="calendar"></div>
    </div>
</div>

<script src="assets/scripts/src/garment.js"></script>
<script src="assets/scripts/src/garment_wishlist.js"></script>
<script>
    getGarmentWhislist();
</script>

<script>
    function renderCalendarf(gar_id) {
        let eventosDelFetch = []; // Almacenar las fechas obtenidas del fetch

        const fechaActual = new Date(); // Obtener la fecha actual

        const fechaAnterior = fechaActual.toISOString().slice(0, 10); // Convertir a formato 'YYYY-MM-DD'

        const formData = new FormData();
        formData.append('id', gar_id);

        // Hacer el fetch de tus datos
        fetch('db_functions/garment_date.php?action=listarFechasPrendaId', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                let datos = data.data;
                // Transformar datos a un formato compatible con FullCalendar
                // let availableEvents = datos.filter(evento => evento.gardat_status === 0);
                // let rentedEvents = datos.filter(evento => evento.gardat_status === 1);
                const eventosDelFetch = datos.map(evento => ({
                    title: evento.gardat_status == 0 ? 'Disponible' : 'Rentado',
                    start: evento.gardat_date, // Asegúrate de que este campo tenga la fecha en formato correcto
                    end: evento.gardat_date, // Asegúrate de que este campo tenga la fecha en formato correcto
                    color: evento.gardat_status == 0 ? 'green' : 'red', // Establecer el color de fondo a verde para las fechas obtenidas
                    gardat_id: evento.gardat_id,
                    gardat_fkgarment: evento.gardat_fkgarment,
                    gardat_status: evento.gardat_status
                }));

                // Inicializar FullCalendar
                const calendarEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    selectable: true, // Habilitar la selección de fechas
                    events: eventosDelFetch,
                    locale: 'es',
                    selectLongPressDelay: 100, // Reducir el tiempo de retardo para dispositivos táctiles

                    select: function(info) {


                        let fechaHoy = new Date();
                        let fechaSeleccionadaDate = new Date(info.startStr);

                        const fechaSeleccionada = info.startStr;
                        let fechaFinSeleccionada = info.endStr;
                        // restarle un dia a la fecha final
                        const fechaFinMenosUnDia = new Date(fechaFinSeleccionada);
                        fechaFinMenosUnDia.setDate(fechaFinMenosUnDia.getDate() - 1);

                        //formatear fecha a yyyy-mm-dd
                        const fechaFinFormateada = new Date(fechaFinMenosUnDia).toISOString().slice(0, 10);

                        //iterar los rangos de fecha en un array de fechaSeleccionada y fechaFinFormateada se sumara 1 dia

                        const fechaInicioIterar = new Date(fechaSeleccionada);
                        const fechaFinIterar = new Date(fechaFinFormateada);

                        let fechasElegidas = [];
                        const diaEnMilisegundos = 24 * 60 * 60 * 1000; // Cantidad de milisegundos en un día

                        for (let fechaIterar = fechaInicioIterar; fechaIterar <= fechaFinIterar; fechaIterar.setDate(fechaIterar.getDate() + 1)) {
                            fechasElegidas.push(new Date(fechaIterar).toISOString().split('T')[0]);
                        }

                        //sacar los id iterando 
                        //este es el array de id de fechas elegidas
                        let arrayGardatIdElegidas = [];
                        let arrayFechasElegidas = [];
                        //este es el array de estatus de fechas seleccionadas para validar mas adalente
                        let arrayStatusDisponiblesValidar = [];
                        //este es el array de boleanos de fechas elegidas se encuantran en la de la DB para validar mas adelante
                        let arrayBoleanoFechasEncontradas = [];

                        let fechasServidor = [];

                        fechasElegidas.forEach(fecha => {

                            eventosDelFetch.forEach(item => {

                                fechasServidor.push(item.start);

                                if (item.start === fecha) {
                                    arrayGardatIdElegidas.push(item.gardat_id);
                                    arrayStatusDisponiblesValidar.push(item.gardat_status);
                                    arrayFechasElegidas.push(item.gardat_date)
                                }
                            });
                        });


                        fechasElegidas.forEach(fecha => {
                            console.log(fecha);

                            if (fechasServidor.includes(fecha)) {
                                arrayBoleanoFechasEncontradas.push('true');
                            } else {
                                arrayBoleanoFechasEncontradas.push('false');

                            }

                        });


                        // const fechaEncontrada = eventosDelFetch.find(evento => evento.start === fechaSeleccionada);

                        let isFechasDisponibles = arrayStatusDisponiblesValidar.includes(1);
                        let isFechasValidas = arrayBoleanoFechasEncontradas.includes('false');


                        if (arrayStatusDisponiblesValidar.length > 0 && arrayGardatIdElegidas.length > 0) {

                            if (isFechasDisponibles) {
                                console.log('todo mal');
                            } else {
                                if (isFechasValidas) {
                                    console.log('todo mal');
                                } else {
                                    console.log('todo bien 3');
                                    mostrarSweetAlert(arrayGardatIdElegidas, arrayFechasElegidas, fechaSeleccionada, fechaFinFormateada);
                                }
                            }
                        } else {
                            console.log('no se puede seguir con vacios');
                        }

                    },
                    selectConstraint: {
                        start: fechaAnterior // Restringe las fechas anteriores al día actual
                    },
                });
                calendar.render();
            })
            .catch(error => {
                console.error('Hubo un problema con la petición fetch:', error);
            });

    }

    function mostrarSweetAlert(arrayGardat_id, arrayFechasElegidas, fechaInicio, fechaFin) {

        swal.fire({
            title: '¿Deseas agendar estas fechas?',
            text: `Fechas seleccionadas: del ${fechaInicio} al ${fechaFin}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmar fechas',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                console.log('Fechas seleccionadas exitosamente');
                agregarCarrito(arrayGardat_id);
            }
        });
    }

    function agregarCarrito(gardat_id) {
        const formData = new FormData();
        formData.append('gardat_id', gardat_id); //gardat_id es array de id de fechas

        fetch('db_functions/cart.php?action=create', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.status) {
                    swal.fire({
                        title: '¡Agregado al carrito!',
                        text: 'Se ha agregado el producto al carrito de compras',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "?view=carrito";
                        }
                    });
                } else {
                    swal.fire({
                        title: '¡Error!',
                        text: 'No se ha podido agregar el producto al carrito de compras, intente nuevamente',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });

    }

</script>