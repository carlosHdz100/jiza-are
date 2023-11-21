<?php
session_start();

include('config/db.php'); # CONEXIÓN DE LA BD PARA TODO EL PROYECTO
$resultado  = validarSesion();
$isLogueado = $resultado['logueado'];
$idUsuario  = $resultado['idCliente'];


if ($isLogueado) {
    $usuario = usuario($link, $idUsuario); # INFORMACIÓN DEL usuario logueado
    include('layouts/index.php');
} else {
    # SE PUEDE INCLUIR UNA VISTA DE LA CARPETA VIEWS SI EL DISEÑO ES DIFERENTE A LO QUE SE MOSTRARA AL LOGUAERSE : LOGIN U OTRA COSA
    // include('views/login.html'); # PAGINA DE INICIO
    include('layouts/index.php');

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
