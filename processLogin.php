<?php
if (empty($_POST['correo']) && isset($_POST['correo']) || empty($_POST['pass']) && isset($_POST['pass'])) {
    $datos = array('0', 'correo o contraseña vacios!');
    echo json_encode($datos);
    exit;
} else {
    //Si entra éste script, se redirecciona con JAVASCRIPT
    //conecxion a la base de datos
    include('config/db.php');

    $correo   = mysqli_real_escape_string($link, $_POST["correo"]);
    $password = mysqli_real_escape_string($link, $_POST["pass"]);

    // Validación de formatos
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $datos = array('0', 'correo ingresado no es valido!');
        echo json_encode($datos);
        exit;
    }


    $consulta = mysqli_query($link, "SELECT use_id,use_correo,use_password,use_fkrol,rol_nombre FROM user INNER JOIN cat_rol ON rol_id = use_fkrol  WHERE use_correo = '$correo' AND use_status = '1'");

    //verificamos si el user exite con un condicional
    if ($row = mysqli_fetch_array($consulta)) {
        $use_id       = $row['use_id'];
        $rol_nombre   = $row['rol_nombre'];
        $use_password = $row['use_password'];
        $use_fkrol    = $row['use_fkrol'];

        if (password_verify($password, $use_password)) {
            session_start();
            $_SESSION['id']        = $use_id;
            $_SESSION['rol']       = $rol_nombre;
            $_SESSION['use_fkrol'] = $use_fkrol;

            // bitacora($use_id, $link);

            $datos = array('1', 'Bienvenido..'); // hasta el nombre podemos poner
            echo json_encode($datos);
        } else {
            $datos = array('0', 'correo o password incorrecto.');
            echo json_encode($datos);
        }
    } else {
        $datos = array('0', 'El correo ingresado no existe.');
        echo json_encode($datos);
    }
}


function bitacora($use_id, $link)
{
    $sql = "INSERT INTO bitacora (bit_fecha_logueo, bit_fkuser) VALUES (NOW(),'$use_id')";
    $result = mysqli_query($link, $sql);
}
