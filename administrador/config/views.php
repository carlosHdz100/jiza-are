<?php

$view = $_GET['view'];
// $idUsuario = $usuario->usu_id;
// $rol = $usuario->use_fkrol;

if ($view == '') {
    include('views/inicio.php');

} else if ($view == 'usuarios') {
    include('views/usuario/index.php');

} else if ($view == 'clientes') {
    include('views/customers/index.php');

} else if ($view == 'arrendadores') {
    include('views/owners/index.php');

} else if ($view == 'categorias') {
    include('views/cat_category/index.php');

} else if ($view == 'tiendas') {
    include('views/tiendas.php');

} else if ($view == 'productos') {
    include('views/productos.php');

} else {
    # ERROR DEBE VOLVER AL INICIO | no esta logueado
    redireccion();
}


function redireccion()
{
    echo "<script> window.location.href='index.php?view='; </script>";
}
