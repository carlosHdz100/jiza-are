<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>Renta de ropa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="assets/styles/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/style.css">
    <link rel="stylesheet" type="text/css" href="assets/styles/plantilla.css">
    
    <!-- Incluye jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/fonts/css/fontawesome-all.min.css">
    <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/app/icons/icon-192x192.png">
</head>

<body class="theme-light" data-highlight="highlight-pink" data-gradient="body-default">

    <div id="preloader">
        <div class="spinner-border color-highlight" role="status"></div>
    </div>

    <div id="page">

        <div class="header header-fixed header-logo-center header-auto-show">
            <a href="#" class="header-title">Renta de ropa</a>
            <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
            <a href="#" data-toggle-theme class="header-icon header-icon-4"><i class="fas fa-lightbulb"></i></a>
        </div>



        <div id="footer-bar" class="footer-bar-1">
            <a href="?view=inicio"><i class="fa fa-home"></i><span>Inicio</span></a>
            <a href="?view=categorias"><i class="fa fa-star"></i><span>Categorías</span></a>
            <a href="?view=favoritos" class="active-nav"><i class="fa fa-heart"></i><span>Favoritos</span></a>
            <a href="?view=carrito"><i class="fa"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M6 2a1 1 0 0 1 .993 .883l.007 .117v1.068l13.071 .935a1 1 0 0 1 .929 1.024l-.01 .114l-1 7a1 1 0 0 1 -.877 .853l-.113 .006h-12v2h10a3 3 0 1 1 -2.995 3.176l-.005 -.176l.005 -.176c.017 -.288 .074 -.564 .166 -.824h-5.342a3 3 0 1 1 -5.824 1.176l-.005 -.176l.005 -.176a3.002 3.002 0 0 1 1.995 -2.654v-12.17h-1a1 1 0 0 1 -.993 -.883l-.007 -.117a1 1 0 0 1 .883 -.993l.117 -.007h2zm0 16a1 1 0 1 0 0 2a1 1 0 0 0 0 -2zm11 0a1 1 0 1 0 0 2a1 1 0 0 0 0 -2z" stroke-width="0" fill="currentColor" />
</svg></i><span>carrito</span></a>
            <a href="#" data-menu="menu-settings"><i class="fa fa-user"></i><span>Perfil</span></a>
        </div>


        <!-- Page Content-->
        <?php include('config/views.php'); ?>
        <!-- End of Page Content-->



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

        <!-- All Menus, Action Sheets, Modals, Notifications, Toasts, Snackbars get Placed outside the <div class="page-content"> -->
        <div id="menu-settings" class="menu menu-box-bottom menu-box-detached">
            <div class="menu-title mt-0 pt-0">
                <h1>Mi perfil</h1>
            </div>
            <div class="divider divider-margins mb-n2"></div>
            <div class="content">
                <div class="list-group list-custom-small">
                    <a href="?view=perfil" class="pb-2 ms-n1">
                        <i class="fa font-12 fa-user rounded-s bg-highlight color-white me-3"></i>
                        <span>Perfil</span>

                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                <div class="list-group list-custom-large">
                    <a href="?view=rentas">
                        <i class="fa font-14 fa-tint bg-green-dark rounded-s"></i>
                        <span>Rentas</span>
                        <i class="fa fa-angle-right"></i>
                    </a>
                    <!-- <a data-menu="menu-backgrounds" href="#" class="border-0">
                        <i class="fa font-14 fa-cog bg-blue-dark rounded-s"></i>
                        <span>Background Color</span>
                        <strong>10 Page Gradients Included</strong>
                        <span class="badge bg-highlight color-white">NEW</span>
                        <i class="fa fa-angle-right"></i>
                    </a> -->
                </div>
            </div>
        </div>




    </div>


    <!-- <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" style="height: auto;">
        <div class="offcanvas-header">

            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">

            <h2>Renta de vestido</h2>

            <img class="img-fluid" src="https://newname.mx/wp-content/uploads/2021/01/AVL7664-1.jpg" alt="Renta de vestido">

            <p>Este hermoso vestido está disponible para alquiler. Es la elección perfecta para ocasiones especiales, como bodas, fiestas de gala y eventos elegantes. Destaca tu estilo con este vestido exclusivo.</p>
            <h3>Precio: <strong>€200</strong></h3>

            <hr>

            <button class="btn btn-dark" style="width: 100%;">Alquilar Ahora</button>
            <br>
        </div>
    </div> -->


    <script type="text/javascript" src="assets/scripts/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


    <!-- <script type="text/javascript" src="assets/scripts/bootstrap.min.js"></script> -->


    <script type="text/javascript" src="assets/scripts/custom.js"></script>
</body>

</html>