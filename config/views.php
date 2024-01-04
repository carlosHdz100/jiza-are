<?php

$view = $_GET['view'];
// $idUsuario = $usuario->usu_id;
// $rol = $usuario->use_fkrol;

switch ($view) {
    case '':
        include('views/inicio.php');
        break;
    case 'categorias':
        include('views/categorias.php');
        break;
    case 'carrito':
        include('views/carrito.php');
        break;
    case 'perfil':
        include('views/perfil.php');
        break;
    case 'historial':
        include('views/historial.php');
        break;
    case 'rentas':
        include('views/rentas.php');
        break;
    case 'renta_detalle':
        include('views/renta_detalle.php');
        break;
    case 'favoritos':
        include('views/favoritos.php');
        break;
    case 'accionesymodales':
        include('views/accionesymodales.php');
        break;
    case 'ver_prenda':
        include('views/garment/ver_todo.php');
        break;
    case 'success':
        include('views/success.php');
        break;
    case 'error':
        include('views/error.php');
        break;
    default:
        # ERROR DEBE VOLVER AL INICIO | no esta logueado
        redireccion();
        break;
}



function redireccion()
{
    echo "<script> window.location.href='index.php?view='; </script>";
}

// function permiso($rol, $view, $link, $tipo)
// {
//     # permisos a vistas del proyecto
//     $sql = "SELECT $tipo FROM permiso INNER JOIN view ON vie_id = per_fkview WHERE per_fkrol = '$rol' AND vie_nombre = '$view'";
//     $result = mysqli_query($link, $sql);
//     if (mysqli_num_rows($result) > 0) {
//         if ($row = mysqli_fetch_array($result)) {
//             if ($row[$tipo] == 0) {
//                 return false;
//             } else {
//                 return true;
//             }
//         }
//     } else {
//         return false;
//     }
// }
