<div class="page-content mt-4">
    <div class="card card-style">
        <div class="content text-center">
            <h1 class="font-700 mb-1">Rentas</h1>
            <div class="tab-controls tabs-small rounded mt-2" data-highlight="bg-blue-dark">
                <a href="#" data-active="" onclick="listarRentas(0)" data-bs-toggle="collapse" data-bs-target="#tab-1" class="bg-blue-dark no-click" aria-expanded="true">Por entregar</a>
                <a href="#" data-bs-toggle="collapse" onclick="listarRentas(3)" data-bs-target="#tab-2" class="collapsed" aria-expanded="false">En proceso</a>
                <a href="#" data-bs-toggle="collapse" onclick="listarRentas(1)" data-bs-target="#tab-3" class="collapsed" aria-expanded="false">Finalizadas</a>
                <a href="#" data-bs-toggle="collapse" onclick="listarRentas(2)" data-bs-target="#tab-4" class="collapsed" aria-expanded="false">Canceladas</a>
            </div>
        </div>
    </div>

    <div class="card card-style bg-theme pb-0">
        <div id="tab-group-1">
            <div id="listRentasProceso"></div>

            <!-- <div data-bs-parent="#tab-group-1" class="pt-3 collapse show" id="tab-1" style="">
                <div class="mx-3 content">
                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">Laura Gómez</h1>
                            <p class="font-11 opacity-60">8 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">720.50€</h2>
                            <p class="font-12 opacity-50">16/11/2023 09:45:18</p>
                        </div>
                    </a>

                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">Carlos Pérez</h1>
                            <p class="font-11 opacity-60">3 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">250.00€</h2>
                            <p class="font-12 opacity-50">14/11/2023 15:30:05</p>
                        </div>
                    </a>
                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">María López</h1>
                            <p class="font-11 opacity-60">6 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">480.75€</h2>
                            <p class="font-12 opacity-50">15/11/2023 11:20:22</p>
                        </div>
                    </a>
                </div>

            </div> -->
            <!-- <div data-bs-parent="#tab-group-1" class="pt-3 collapse" id="tab-2" style="">
                <div class="mx-3 content">
                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">Sofía Ramírez</h1>
                            <p class="font-11 opacity-60">4 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">380.20€</h2>
                            <p class="font-12 opacity-50">13/11/2023 10:15:30</p>
                        </div>
                    </a>

                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">Javier Martínez</h1>
                            <p class="font-11 opacity-60">7 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">610.80€</h2>
                            <p class="font-12 opacity-50">14/11/2023 16:40:55</p>
                        </div>
                    </a>
                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">Elena Rodríguez</h1>
                            <p class="font-11 opacity-60">2 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">150.60€</h2>
                            <p class="font-12 opacity-50">17/11/2023 09:00:10</p>
                        </div>
                    </a>
                </div>

            </div>
            <div data-bs-parent="#tab-group-1" class="pt-3 collapse" id="tab-3" style="">
                <div class="mx-3 content">
                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">Laura Gómez</h1>
                            <p class="font-11 opacity-60">8 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">720.50€</h2>
                            <p class="font-12 opacity-50">16/11/2023 09:45:18</p>
                        </div>
                    </a>

                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">Carlos Pérez</h1>
                            <p class="font-11 opacity-60">3 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">250.00€</h2>
                            <p class="font-12 opacity-50">14/11/2023 15:30:05</p>
                        </div>
                    </a>
                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">María López</h1>
                            <p class="font-11 opacity-60">6 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">480.75€</h2>
                            <p class="font-12 opacity-50">15/11/2023 11:20:22</p>
                        </div>
                    </a>
                </div>
            </div>
            <div data-bs-parent="#tab-group-1" class="pt-3 collapse" id="tab-4" style="">
                <div class="mx-3 content">
                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">Sofía Ramírez</h1>
                            <p class="font-11 opacity-60">4 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">380.20€</h2>
                            <p class="font-12 opacity-50">13/11/2023 10:15:30</p>
                        </div>
                    </a>

                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">Javier Martínez</h1>
                            <p class="font-11 opacity-60">7 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">610.80€</h2>
                            <p class="font-12 opacity-50">14/11/2023 16:40:55</p>
                        </div>
                    </a>
                    <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                        <div class="align-self-center">
                            <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                        </div>
                        <div class="align-self-center">
                            <h1 class="mb-n2 font-16">Elena Rodríguez</h1>
                            <p class="font-11 opacity-60">2 productos</p>
                        </div>
                        <div class="align-self-center ms-auto text-end">
                            <h2 class="mb-n1 font-18 color-red-dark">150.60€</h2>
                            <p class="font-12 opacity-50">17/11/2023 09:00:10</p>
                        </div>
                    </a>
                </div>

            </div> -->
        </div>
    </div>
</div>

<!-- <div id="menu-transaction-1" class="menu menu-box-bottom menu-box-detached" style="display: block;">
    <div class="menu-title">
        <h1>Información de la renta</h1>
        <p class="color-highlight">#55</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a>
    </div>
    <div class="divider divider-margins mb-1 mt-3"></div>
    <div class="content">
        <div class="row mb-0">
            <div class="col-3">
                <img src="assets/images/user.png" width="80" class="rounded-xl">
            </div>
            <div class="col-9 ps-4">
                <div class="d-flex">
                    <div>
                        <p class="font-700 color-theme">Cliente:</p>
                    </div>
                    <div class="ms-auto">
                        <p>Jorge Ramos Villanueva</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div>
                        <p class="font-700 color-theme">Rentado del</p>
                    </div>
                    <div class="ms-auto">
                        <p>15/11/2023</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div>
                        <p class="font-700 color-theme">Al</p>
                    </div>
                    <div class="ms-auto">
                        <p>17/11/2023</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider mt-3 mb-3"></div>
        <div class="row mb-0">
            <div class="col-12">
                <a href="?view=ver_renta" class="default-link btn btn-l rounded-sm btn-full bg-highlight text-uppercase font-800 btn-icon mb-3"><i class="fa fa-eye"></i>Ver mas</a>
            </div>

            <div class="divider divider-margins w-100 mt-2 mb-2"></div>
            <div class="col-6">
                <h4 class="font-14 mt-1">Monto pagado</h4>
            </div>
            <div class="col-6">
                <h4 class="font-14 text-end mt-1">530.24€</h4>
            </div>
            <div class="divider divider-margins w-100 mt-2 mb-2"></div>
            <div class="col-6">
                <h4 class="font-14 mt-1">ID renta</h4>
            </div>
            <div class="col-6">
                <h4 class="font-14 text-end mt-1">#450</h4>
            </div>
            <div class="divider divider-margins w-100 mt-2 mb-2"></div>
            <div class="col-6">
                <h4 class="font-14 mt-1">Estatus</h4>
            </div>
            <div class="col-6">
                <h4 class="font-14 text-end mt-1 color-green-dark">Pagado</h4>
            </div>
            <div class="divider divider-margins w-100 mt-2 mb-3"></div>

            <div class="col-12"><a href="https://wa.me/9933770652" class="default-link btn btn-l rounded-sm btn-full bg-green-white text-uppercase font-800 btn-icon mb-3"><i class="fa"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                            <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                        </svg></i>Enviar whatsApp <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l14 0" />
                        <path d="M15 16l4 -4" />
                        <path d="M15 8l4 4" />
                    </svg></a></div>

            <div class="col-12"><a href="tel:+1 234 567 890" class="default-link btn btn-l rounded-sm btn-full bg-green-dark text-uppercase font-800 btn-icon mb-3"><i class="fa fa-phone"></i>Llamar ahora +52 993 377 0652</a></div>

        </div>
    </div>
</div> -->
<div id="menu-transaction-1" class="menu menu-box-bottom menu-box-detached" style="display: block; height: 580px; overflow:auto">
    <div class="menu-title">
        <h1>Información de la renta</h1>
        <a href="#" class="close-menu"><i class="fa fa-times"></i></a>
    </div>
    <div class="divider divider-margins mb-1 mt-3"></div>
    <div class="content">
        <div class="row mb-0">
            <div class="col-3">
                <img id="userImage" src="assets/images/user.png" width="80" class="rounded-xl">
            </div>
            <div class="col-9 ps-4">
                <div class="d-flex">
                    <div>
                        <p class="font-700 color-theme">Cliente:</p>
                    </div>
                    <div class="ms-auto">
                        <p id="usu_name"></p>
                    </div>
                </div>
                <div class="d-flex">
                    <div>
                        <p class="font-700 color-theme">Rentado del</p>
                    </div>
                    <div class="ms-auto">
                        <p id="dateStart"></p>
                    </div>
                </div>
                <div class="d-flex">
                    <div>
                        <p class="font-700 color-theme">Al</p>
                    </div>
                    <div class="ms-auto">
                        <p id="dateEnd"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider mt-3 mb-3"></div>
        <div class="row mb-0">
            <div class="col-12">
                <a id="urlPrendas" href="?view=ver_renta" class="default-link btn btn-l rounded-sm btn-full bg-highlight text-uppercase font-800 btn-icon mb-3"><i class="fa fa-eye"></i>Ver prendas rentadas</a>
            </div>

            <div class="divider divider-margins w-100 mt-2 mb-2"></div>
            <div class="col-6">
                <h4 class="font-14 mt-1">Monto pagado</h4>
            </div>
            <div class="col-6">
                <h4 class="font-14 text-end mt-1" id="ren_amount"></h4>
            </div>
            <div class="divider divider-margins w-100 mt-2 mb-2"></div>
            <div class="col-6">
                <h4 class="font-14 mt-1">ID renta</h4>
            </div>
            <div class="col-6">
                <h4 class="font-14 text-end mt-1" id="rent_id"></h4>
            </div>
            <div class="divider divider-margins w-100 mt-2 mb-2"></div>
            <div class="col-6">
                <h4 class="font-14 mt-1">Estatus</h4>
            </div>
            <div class="col-6">
                <h4 class="font-14 text-end mt-1 color-green-dark">Pagado</h4>
            </div>
            <div class="divider divider-margins w-100 mt-2 mb-3"></div>
            <div id="codigoEntrega"></div>
            <div class="divider divider-margins w-100 mt-2 mb-3"></div>

            <div class="col-12"><a id="usu_telefono" href="https://wa.me/9933770652" class="default-link btn btn-l rounded-sm btn-full bg-green-white text-uppercase font-800 btn-icon mb-3"><i class="fa"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                            <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                        </svg></i>Enviar whatsApp <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l14 0" />
                        <path d="M15 16l4 -4" />
                        <path d="M15 8l4 4" />
                    </svg></a></div>

            <div class="col-12"><a id="usu_telefono2" href="tel:+1 234 567 890" class="default-link btn btn-l rounded-sm btn-full bg-green-dark text-uppercase font-800 btn-icon mb-3"><i class="fa fa-phone"></i>Llamar ahora <span id="usu_telefono3"></span></a></div>

        </div>
    </div>
</div>

<script src="assets/scripts/src/inicio.js"></script>
<script>
    listarRentas(0);
</script>