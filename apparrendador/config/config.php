<?php
//session_start();

include('config/db.php'); # CONEXIÓN DE LA BD PARA TODO EL PROYECTO
//$resultado  = validarSesion();
$isLogueado = true; //$resultado['logueado'];
//$idUsuario  = $resultado['idCliente'];


if ($isLogueado) {
    //$usuario = usuario($link, $idUsuario); # INFORMACIÓN DEL usuario logueado

    if ($_GET['view']== '') {
        include('views/login.html');
    } else {
        include('layouts/index.php');
    }

} else {
    # SE PUEDE INCLUIR UNA VISTA DE LA CARPETA VIEWS SI EL DISEÑO ES DIFERENTE A LO QUE SE MOSTRARA AL LOGUAERSE : LOGIN U OTRA COSA
    // include('views/login.php'); # PAGINA DE INICIO
    if ($_GET['view']== '') {
        include('views/login.html');
    } else {
        include('layouts/index.php');
    }
}


function validarSesion()
{
    $sesionActiva = $_SESSION['id'];

    if (empty($sesionActiva)) {
        return array(
            'logueado' => false,  // valor booleano
            'idCliente' => ''  // ID DEL USUARIO
        );
    } else {
        return array(
            'logueado' => true,  // valor booleano
            'idCliente' => $sesionActiva  // ID DEL USUARIO
        );
    }
}


function usuario($link, $idUsuario)
{
    $consulta = mysqli_query($link, "SELECT * FROM usuario INNER JOIN user ON use_id = usu_fkuser WHERE use_id = $idUsuario");
    return mysqli_fetch_object($consulta);
}
