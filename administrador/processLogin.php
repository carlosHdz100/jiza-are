<?php

if (empty($_POST['telefono']) && isset($_POST['telefono']) || empty($_POST['pass']) && isset($_POST['pass'])) {
    $datos = array('0', 'telefono o contraseña vacios!');
    echo json_encode($datos);
    exit;
} else {
    //Si entra éste script, se redirecciona con JAVASCRIPT
    //conecxion a la base de datos
    include('config/db.php');

    $telefono = mysqli_real_escape_string($link, $_POST["telefono"]);
    $password = mysqli_real_escape_string($link, $_POST["pass"]);

    // Validación de formatos
    if (!filter_var($telefono, FILTER_VALIDATE_INT) || strlen($telefono) != 10) {
        $datos = array('0', '¡Teléfono ingresado no es valido o no tiene 10 digitos!');
        echo json_encode($datos);
        exit;
    }


    $consulta = mysqli_query($link, "SELECT use_id,usu_telefono,use_password,use_fkrol FROM user INNER JOIN usuario ON usu_fkuser = use_id WHERE usu_telefono = '$telefono'");

    //verificamos si el user exite con un condicional
    if ($row = mysqli_fetch_array($consulta)) {
        $use_id       = $row['use_id'];
        $use_rol      = $row['use_fkrol'];
        $use_password = $row['use_password'];

        if (password_verify($password, $use_password)) {
            session_start();
            $_SESSION['id'] = $use_id;

            $ruta = '';
            if ($use_rol == 3) {
                $ruta = 'pasajero';
            } else {
                $ruta = 'conductor';
            }


            $datos = array('1', 'Bienvenido..', $ruta); // hasta el nombre podemos poner
            echo json_encode($datos);
        } else {
            $datos = array('0', 'Teléfono o password incorrecto.');
            echo json_encode($datos);
        }
    } else {
        $datos = array('0', 'El Teléfono ingresado no existe.');
        echo json_encode($datos);
    }
}
?>
