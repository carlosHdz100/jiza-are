<div class="page-content mt-4" style="transform: translateX(0px);">

    <div class="content mt-0">
        <div class="d-flex">
            <div class="align-self-center">
                <p class="mb-n2 font-12">Hola de nuevo,</p>
                <h1 class="font-30"><?= "$usuario->usu_nombre  $usuario->usu_apellido" ?></h1>
            </div>
            <!-- <div class="align-self-center ms-auto">
                <a href="#" data-menu="menu-add-funds" class="icon icon-m gradient-blue color-white rounded-m shadow-l rounded-m ms-2"><i class="fa fa-plus font-14"></i></a>
            </div> -->
        </div>
    </div>

    <div data-card-height="130" class="card card-style rounded-m shadow-xl preload-img entered loaded" data-src="images/pictures/11w.jpg" data-ll-status="loaded" style="height: 240px; background-image: url(&quot;images/pictures/11w.jpg&quot;);">
        <!-- <div class="card-top mt-4 ms-3">
            <h1 class="color-white mb-0 mb-n2 font-22">Karla ramos</h1>
            <p class="bottom-0 color-white opacity-50 under-heading font-11 font-700">1234 5678 9012 3456</p> 
        </div>-->
        <!-- <div class="card-top mt-4 me-3">
            <a href="#" data-menu="menu-add-funds" class="mt-1 float-end text-uppercase font-900 font-11 btn btn-s rounded-s shadow-l bg-highlight">Add Funds</a>
        </div> -->
        <div class="card-center text-center">
            <h1 class="color-white fa-4x">18.178 €</h1>
            <p class="color-white opacity-70 font-11 mb-n5">Ingresos de noviembre</p>
        </div>
        <!-- <div class="card-bottom">
            <p class="ms-3 font-10 font-500 opacity-50 color-white mb-2">Exp: 10/22</p>
        </div>
        <div class="card-bottom">
            <p class="text-end me-3 font-10 font-500 opacity-50 color-white mb-2"><i class="fab fa-cc-visa font-20 rotate-90"></i></p>
        </div> -->
        <div class="card-overlay bg-black opacity-90"></div>
    </div>

    <div class="card card-style">
        <div class="content text-center">
            <h1 class="font-21">Rentas por entregar</h1>
            <div class="tab-controls tabs-medium tabs-rounded" data-highlight="bg-highlight">
                <a href="#" class="font-600 bg-highlight no-click" data-active="" data-bs-toggle="collapse" data-bs-target="#tab-1" aria-expanded="true">Por entregar</a>
                <a href="#" class="font-600 collapsed" data-bs-toggle="collapse" data-bs-target="#tab-2" aria-expanded="false">En renta</a>
            </div>
        </div>
    </div>
    <div class="card card-style" data-card-height="280">
        <div class="content mb-0" id="tab-group-1">
            <!-- <div class="tab-controls tabs-medium tabs-rounded" data-highlight="bg-highlight">
                <a href="#" class="font-600 bg-highlight no-click" data-active="" data-bs-toggle="collapse" data-bs-target="#tab-1" aria-expanded="true">Action Sheets</a>
                <a href="#" class="font-600 collapsed" data-bs-toggle="collapse" data-bs-target="#tab-2" aria-expanded="false">Action Modals</a>
            </div> -->
            <div class="clearfix mb-3"></div>
            <div data-bs-parent="#tab-group-1" class="collapse show" id="tab-1" style="">

                <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                    <div class="align-self-center">
                        <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                    </div>
                    <div class="align-self-center">
                        <h1 class="mb-n2 font-16">Raul patricio</h1>
                        <p class="font-11 opacity-60">5 productos</p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h2 class="mb-n1 font-18 color-red-dark">530.24€</h2>
                        <p class="font-12 opacity-50">15/11/2023 11:20:22</p>
                    </div>
                </a>
                <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                    <div class="align-self-center">
                        <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                    </div>
                    <div class="align-self-center">
                        <h1 class="mb-n2 font-16">Luis Naranjos</h1>
                        <p class="font-11 opacity-60">5 productos</p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h2 class="mb-n1 font-18 color-red-dark">530.24€</h2>
                        <p class="font-12 opacity-50">15/11/2023 11:20:22</p>
                    </div>
                </a>

                <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                    <div class="align-self-center">
                        <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                    </div>
                    <div class="align-self-center">
                        <h1 class="mb-n2 font-16">Alejandra Hernandez</h1>
                        <p class="font-11 opacity-60">5 productos</p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h2 class="mb-n1 font-18 color-red-dark">530.24€</h2>
                        <p class="font-12 opacity-50">15/11/2023 11:20:22</p>
                    </div>
                </a>
            </div>
            <div data-bs-parent="#tab-group-1" class="collapse" id="tab-2" style="">
                <a href="#" data-menu="menu-transaction-1" class="d-flex mb-3">
                    <div class="align-self-center">
                        <img src="assets/images/user.png" width="40" class="rounded-xl me-3">
                    </div>
                    <div class="align-self-center">
                        <h1 class="mb-n2 font-16">Manuel jimenez</h1>
                        <p class="font-11 opacity-60">6 productos</p>
                    </div>
                    <div class="align-self-center ms-auto text-end">
                        <h2 class="mb-n1 font-18 color-red-dark">530.24€</h2>
                        <p class="font-12 opacity-50">15/11/2023 11:20:22</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div id="menu-transaction-1" class="menu menu-box-bottom menu-box-detached" style="display: block;">
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
</div>