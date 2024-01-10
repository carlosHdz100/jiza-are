<style>
    .swal2-container {
        z-index: 99999
    }

    .fc-day-past {
        opacity: 0.5 !important;
        /* Ajusta la opacidad según tu preferencia */
        pointer-events: none;
        /* Deshabilita la interacción con fechas pasadas */
        background-color: #E4E5E4 !important;
    }

    /* Estilo para los días bloqueados */
    .dia-bloqueado {
        background-color: #000000;
        /* Color rojo claro */
        pointer-events: none;
        /* Evitar interacción con los días bloqueados */
    }

    .desactivado {
        opacity: 0.5 !important;
        /* Establecer la opacidad */
        cursor: not-allowed !important;
        /* Cambiar el cursor */
    }
</style>
<div class="page-content mt-2">

    <div class="card preload-img position-fixed w-100" data-card-height="450">
        <!-- Search -->
        <div class="content mt-2 position-absolute start-0 end-0 mx-1">
            <div class="notch-clear"></div>
            <!-- <div class="search-box bg-theme color-theme rounded-m shadow-l mx-2">
                <i class="fa fa-search"></i>
                <input type="text" class="border-0" placeholder="Qué estás buscando?" data-search>
                <input type="text" class="border-0" placeholder="En dónde?" data-search>
                <a href="#" class="clear-search disabled no-click mt-0"></a>
                <a href="#" data-menu="menu-filter" class="color-theme"><i class="fa fa-sliders me-n3"></i></a>
            </div> -->
            <div class="search-box bg-theme color-theme rounded-m shadow-l mx-2 d-flex justify-content-between">
                <span class=""><i class="fa fa-search"></i></span>
                <input type="text" class="border-0" aria-label="busqueda" alt="que estas buscando" class="form-control" placeholder="Qué estás buscando?" data-search>
                <input type="text" class="border-0" aria-label="Lugar" alt="En donde lo estas buscando" class="form-control" placeholder="En dónde?">
                <a href="#" class="clear-search disabled no-click mt-0"></a>

                <a href="#" data-menu="menu-filter" class="color-theme"><i class="fa fa-sliders me-n3"></i></a>
            </div>



            <div class="search-results disabled-search-list mt-3">
                <div class="card card-style mx-2 px-2 mb-0 pt-2">

                    <a href="#" class="d-flex py-2" data-filter-item data-filter-name="all apple watch 42 leather edition white">
                        <div>
                            <img src="images/food/500x500/2.png" class="rounded-sm me-1" width="45" alt="img">
                        </div>
                        <div>
                            <span class="color-highlight font-400 d-block pt-0 mb-n2 font-11">Rentar</span>
                            <strong class="color-theme font-14 d-block mt-n2">Vestido de noche</strong>
                        </div>
                        <div class="ms-auto text-center align-self-center pe-2">
                            <h5 class="line-height-xs font-18 pt-3">$5.<sup class="font-14">50</sup></h5>
                        </div>
                    </a>
                    <a href="#" class="d-flex py-2" data-filter-item data-filter-name="all apple watch lime edition 44 green">
                        <div>
                            <img src="images/food/500x500/3.png" class="rounded-sm me-1" width="45" alt="img">
                        </div>
                        <div>
                            <span class="color-highlight font-400 d-block pt-0 mb-n2 font-11">Accesorio</span>
                            <strong class="color-theme font-14 d-block mt-n2">Aretes brillantes</strong>
                        </div>
                        <div class="ms-auto text-center align-self-center pe-2">
                            <h5 class="line-height-xs font-18 pt-3">$16.<sup class="font-14">50</sup></h5>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <!-- Placing iframe under the header -->
        <iframe src="https://maps.google.com/maps?q=%Sidney%20Opera&t=k&z=17&ie=UTF8&iwloc=&output=embed" style="height:650px; margin-top:-200px;"></iframe>
    </div>

    <!-- Scroll Over Clear Effect-->
    <div class="card bg-transparent shadow-0 border-0 mb-0 no-click" data-card-height="430" style="height: 430px;"></div>

    <div class="card card-style mx-0 pb-5 pt-1">
        <div class="divider mx-auto mt-3 bg-gray-dark opacity-30 rounded-s mb-3" style="height:5px; width:50px;"></div>
        <div class="search-no-results disabled mt-n3">
            <div class="content bg-red-dark p-3 rounded-m">
                <h1 class="color-white">Sin resultados</h1>
                <p class="color-white">
                    No se encontraraon datos conforme a tu busqueda.
                </p>
            </div>
            <div class="divider divider-margins mt-4"></div>
        </div>

        <div id="tab-group">
            <div class="card card-style bg-theme pb-0 mb-3">

                <div class="tab-controls tabs-rounded tabs-large" data-highlight="bg-highlight">
                    <a onclick="getGarment();" href="#" class="font-14 font-600" data-bs-toggle="collapse" data-bs-target="#tab-1" data-active><span class="opacity-80">Prendas</span></a>
                    <a onclick="getPackaje()" href="#" class="font-14 font-600" data-bs-toggle="collapse" data-bs-target="#tab-2"><span class="opacity-80">Paquetes</span></a>
                    <!-- <a href="#" class="font-14 font-600" data-bs-toggle="collapse" data-bs-target="#tab-3"><span class="opacity-80">Accesorios</span></a> -->
                </div>
            </div>

            <!-- Tab 1 -->
            <div data-bs-parent="#tab-group" class="collapse show px-3" id="tab-1">
                <div id="setGarment"></div>
            </div>

            <!-- Tab 2 -->
            <div data-bs-parent="#tab-group" class="collapse px-3" id="tab-2">
                <div id="setPackaje"></div>
            </div>
        </div>


        <div class="d-flex px-3 mb-1">
            <div class="align-self-center">
                <h4 class="mb-0">Más para ver</h4>
            </div>
            <a href="?view=ver_todo" class="align-self-center ms-auto">
                <a href="?view=ver_todo" class="font-14">Ver todo</a>
            </a>
        </div>

        <div class="splide double-slider slider-no-dots visible-slider" id="double-slider-1a">
            <div class="splide__track">

                <div class="splide__list">
                    <div class="splide__slide">
                        <a href="#" class="mx-3" data-menu="menu-reserve" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                            <div class="card card-style me-0 mb-0" style="background-image:url(https://barocsshop.com/wp-content/uploads/2023/06/vestido-cloeh-f.jpg);" data-card-height="250">
                                <div class="card-top p-2">
                                    <!-- <span class="bg-red-dark color-white px-2 py-1 rounded-xs font-11 font-700">-10%</span> -->
                                </div>
                                <div class="card-bottom p-2 px-2">
                                    <h4 class="color-white line-height-s">Conjunto vestido</h4>
                                    <span class="color-white font-10 opacity-60"><i class="fa fa-map-marker pe-2"></i>Ibiza, españa</span>
                                </div>
                                <div class="card-overlay bg-gradient"></div>
                            </div>
                        </a>
                    </div>



                    <div class="splide__slide">
                        <a href="#" class="mx-3" data-menu="menu-reserve" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                            <div class="card card-style me-0 mb-0" style="background-image:url(https://cdn0.bodas.com.mx/cat/vestidos-fiesta/manu-garcia/mg3321--mt20_2x_566275.jpg);" data-card-height="250">
                                <div class="card-top p-2">
                                    <!-- <span class="color-white bg-blue-dark px-2 py-1 rounded-xs font-11 font-700">RENTA</span> -->
                                </div>
                                <div class="card-bottom p-2 px-2">
                                    <h4 class="color-white line-height-s">Prenda minimalista</h4>
                                    <span class="color-white font-10 opacity-60"><i class="fa fa-map-marker pe-2"></i>Ibiza, España</span>
                                </div>
                                <div class="card-overlay bg-gradient"></div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>

<!-- Menu Sidebar Sidebar Filters-->
<div id="menu-filter" class="menu menu-box-left" data-menu-height="cover" data-menu-width="cover">
    <div class="notch-clear"></div>
    <div class="menu-title ms-n1">
        <h1>Filtros</h1>
        <p class="color-highlight">Filtra tus resultados</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a>
    </div>
    <p class="mb-3 mx-3 mt-n1">
        Selecciona opciones para poder buscar y obtener resultados filtrados
    </p>
    <div class="divider divider-margins"></div>
    <div class="content mt-n3 ps-1 mb-0">




        <!-- Price Range -->
        <h5 class="mb-3 font-15 mt-2">Rango de precio</h5>
        <div class="row mb-0">
            <div class="col-6">
                <div class="input-style has-borders no-icon mb-4 input-style-always-active">
                    <label for="form-4" class="color-highlight text-uppercase font-700 font-11">Precio min</label>
                    <select id="form-4">
                        <option value="default" disabled>Desde</option>
                        <option value="1a">$10</option>
                        <option value="2a">$50</option>
                        <option value="3a" selected>$100</option>
                        <option value="4a">$250</option>
                        <option value="5a">$500</option>
                    </select>
                    <span><i class="fa fa-chevron-down"></i></span>
                </div>
            </div>
            <div class="col-6">
                <div class="input-style has-borders no-icon mb-4 input-style-always-active">
                    <label for="form-4" class="color-highlight text-uppercase font-700 font-11">Precio max</label>
                    <select id="form-4">
                        <option value="default" disabled>Hasta</option>
                        <option value="1a">$15</option>
                        <option value="2a">$25</option>
                        <option value="3a">$100</option>
                        <option value="4a" selected>$250</option>
                        <option value="5a">$500</option>
                    </select>
                    <span><i class="fa fa-chevron-down"></i></span>
                </div>
            </div>
        </div>
        <!-- Property Facts -->
        <h5 class="mb-3 font-15">Talla</h5>
        <div class="row mb-0">
            <div class="col-12">
                <div class="input-style has-borders no-icon mb-4 input-style-always-active">
                    <label for="form-4b" class="color-highlight text-uppercase font-700 font-11">Talla.</label>
                    <select id="form-4b">
                        <option value="default" disabled>Elige</option>
                        <option value="1a" selected>SMALL</option>
                        <option value="2a">MEDIANA</option>
                        <option value="3a">GRANDE</option>
                        <option value="4a">X. GRANDE</option>
                    </select>
                    <span><i class="fa fa-chevron-down"></i></span>
                </div>
            </div>
        </div>

        <div class="divider mt-2 mb-3"></div>

        <!-- Sort By -->
        <div class="list-group list-custom-small list-icon-0">
            <a data-bs-toggle="collapse" class="border-0" href="#collapse-filter-1">
                <span class="font-15 font-600">Ordenar por</span>
                <i class="fa fa-angle-down"></i>
            </a>
        </div>
        <div class="collapse" id="collapse-filter-1">
            <div class="form-check icon-check">
                <input class="form-check-input" type="checkbox" value="" id="check412" checked>
                <label class="form-check-label font-14" for="check412">Precio: Mas bajo a más alto</label>
                <i class="icon-check-1 far fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-green-dark"></i>
            </div>

            <div class="form-check icon-check">
                <input class="form-check-input" type="checkbox" value="" id="check434">
                <label class="form-check-label font-14" for="check434">Precio: Más alto a más bajo</label>
                <i class="icon-check-1 far fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-green-dark"></i>
            </div>

            <div class="mb-3"></div>
        </div>

        <!-- Category -->
        <div class="list-group list-custom-small list-icon-0">
            <a data-bs-toggle="collapse" class="border-0" href="#collapse-filter-1a">
                <span class="font-15 font-600">Categoría</span>
                <i class="fa fa-angle-down"></i>
            </a>
        </div>
        <div class="collapse" id="collapse-filter-1a">
            <div class="form-check icon-check">
                <input class="form-check-input" type="checkbox" value="" id="check412a" checked>
                <label class="form-check-label font-14" for="check412a">Vestidos</label>
                <i class="icon-check-1 far fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-green-dark"></i>
            </div>
            <div class="form-check icon-check">
                <input class="form-check-input" type="checkbox" value="" id="check434b">
                <label class="form-check-label font-14" for="check434b">Accesorios</label>
                <i class="icon-check-1 far fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-green-dark"></i>
            </div>
            <div class="mb-3"></div>
        </div>


        <!-- Rating-->
        <div class="list-group list-custom-small list-icon-0">
            <a data-bs-toggle="collapse" class="border-0" href="#collapse-filter-3">
                <span class="font-15 font-600">Rating</span>
                <i class="fa fa-angle-down"></i>
            </a>
        </div>
        <div class="collapse" id="collapse-filter-3">
            <div class="form-check icon-check">
                <input class="form-check-input" type="checkbox" value="" id="check412adg" checked>
                <label class="form-check-label font-14" for="check412adg">
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                </label>
                <i class="icon-check-1 far fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-green-dark"></i>
            </div>
            <div class="form-check icon-check">
                <input class="form-check-input" type="checkbox" value="" id="check434bdg">
                <label class="form-check-label font-14" for="check434bdg">
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-gray-light me-n1" style="transform:translateY(-2px);"></i>
                </label>
                <i class="icon-check-1 far fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-green-dark"></i>
            </div>
            <div class="form-check icon-check">
                <input class="form-check-input" type="checkbox" value="" id="check435cdg">
                <label class="form-check-label font-14" for="check435cdg">
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-gray-light me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-gray-light me-n1" style="transform:translateY(-2px);"></i>
                </label>
                <i class="icon-check-1 far fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-green-dark"></i>
            </div>
            <div class="form-check icon-check">
                <input class="form-check-input" type="checkbox" value="" id="check435cdga">
                <label class="form-check-label font-14" for="check435cdga">
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-gray-light me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-gray-light me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-gray-light me-n1" style="transform:translateY(-2px);"></i>
                </label>
                <i class="icon-check-1 far fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-green-dark"></i>
            </div>
            <div class="form-check icon-check">
                <input class="form-check-input" type="checkbox" value="" id="check435cdgb">
                <label class="form-check-label font-14" for="check435cdgb">
                    <i class="fa fa-star position-relative start-0 color-yellow-dark me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-gray-light me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-gray-light me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-gray-light me-n1" style="transform:translateY(-2px);"></i>
                    <i class="fa fa-star position-relative start-0 color-gray-light me-n1" style="transform:translateY(-2px);"></i>
                </label>
                <i class="icon-check-1 far fa-circle color-gray-dark font-16"></i>
                <i class="icon-check-2 fa fa-check-circle font-16 color-green-dark"></i>
            </div>
            <div class="mb-3"></div>
        </div>
    </div>
    <div class="divider divider-margins mt-2 mb-4"></div>
    <a href="#" class="close-menu btn btn-full mx-3 btn-m text-white rounded-sm font-700 text-uppercase" style="background-color: #FF0080;">Aplicar filtros</a>
    <div class="divider divider-margins mt-4 mb-4"></div>

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

<script type="text/javascript" src="assets/scripts/custom.js"></script>
<script src="assets/scripts/src/garment.js"></script>
<script src="assets/scripts/src/garment_wishlist.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        getGarment();
    });


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