<?php

$action = $_REQUEST['action']; # ACCION PARA IR A LA FUNCION CORRECTA

include('../config/db.php'); # CONEXIÓN DE LA BD 


# --------------- IF PARA IR A LA FUNCION CORRECTA -----------
switch ($action) {
    case 'all':
        all($link);
        break;
    case 'view':
        view($link);
        break;
    case 'create':
        create($link);
        break;
    case 'update':
        update($link);
        break;
    case 'delete':
        delete($link);
        break;
    case 'desactivate':
        desactivate($link);
        break;
    default:
        // Acción desconocida, puedes manejar el caso de error aquí
        break;
}


# ------------------------- FIN DE IFS ------------------------


function all($link)
{
    // Consulta SQL con una consulta preparada para seleccionar datos y mostrarlo en datatable
    $inactivo = 0;
    $activo   = 1;
    $todos    = 2;
    $status   = isset($_REQUEST['status']) ? $_REQUEST['status'] : $activo;

    // Datos para la paginación
    $start  = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;

    // Columna por la cual se ordenará
    $orderColumn = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $orderDir    = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'ASC';
    $columns = array('usu_nombre', 'use_correo', 'rol_nombre', 'use_status');

    // Búsqueda
    $searchValue = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $condicion   = ($status == $todos) ? "use_status IN (?, ?)" : "use_status = ?";
    $condicion2  = ($status == $todos) ? "use_status IN ($activo, $inactivo)" : "use_status = $status";

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT * FROM user INNER JOIN usuario ON use_id = usu_fkuser INNER JOIN cat_rol ON use_fkrol = rol_id WHERE $condicion";

    // Agregamos la condición de búsqueda si se proporciona
    if (!empty($searchValue)) {
        $sql .= " AND (";
        for ($i = 0; $i < count($columns); $i++) {
            $sql .= $columns[$i] . " LIKE '%" . $searchValue . "%'";
            if ($i < count($columns) - 1) {
                $sql .= " OR ";
            }
        }
        $sql .= ")";
    }

    // Agregamos la ordenación
    if (isset($columns[$orderColumn])) {
        $sql .= " ORDER BY " . $columns[$orderColumn] . " " . $orderDir;
    }

    // Agregamos la paginación
    $sql .= " LIMIT " . $length . " OFFSET " . $start;

    $stmt = $link->prepare($sql);

    if (!$stmt) {
        // Manejar errores en la preparación de la consulta
        $data = array(
            'data' => array(),
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'status' => false,
            'message' => 'Error en la preparación de la consulta.'
        );
        echo json_encode($data);
        return;
    }

    // Vincular el valor del estado al parámetro de la consulta preparada
    if ($status == 2) {
        $stmt->bind_param("ii", $inactivo, $activo);
    } else {
        $stmt->bind_param("i", $status);
    }

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Obtener los resultados de la consulta
        $result = $stmt->get_result();

        $datos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = $row;
            }

            $data = array(
                'data' => $datos,
                'recordsTotal' =>  count($datos), // Total de registros sin filtrar
                'recordsFiltered' => mysqli_num_rows(mysqli_query($link, "SELECT * FROM user WHERE $condicion2")), // Total de registros después del filtrado
                'status' => true,
                'message' => ''
            );
        } else {
            $data = array(
                'data' => array(),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'status' => false,
                'message' => 'No se encontraron resultados.'
            );
        }
    } else {
        // Manejar errores en la ejecución de la consulta
        $data = array(
            'data' => array(),
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'status' => false,
            'message' => 'Error en la ejecución de la consulta.'
        );
    }

    header('Content-Type: application/json');

    echo json_encode($data);

    // Cerrar la declaración
    $stmt->close();
}


function view($link)
{
    $use_id = $_POST['use_id'];

    # VALIDACION DE DATOS
    if (empty($use_id)) {
        $data = array(
            'status' => false,
            'message' => 'Datos incompletos. Por favor, completa todos los campos.'
        );
        echo json_encode($data);
        return;
    }

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT * FROM user INNER JOIN usuario ON use_id = usu_fkuser INNER JOIN cat_rol  ON rol_id = use_fkrol WHERE use_id = ?";
    // Preparar la consulta
    $stmt = $link->prepare($sql);

    if (!$stmt) {
        // Manejar errores en la preparación de la consulta
        $data = array(
            'status' => false,
            'message' => 'Error en la preparación de la consulta.'
        );
        echo json_encode($data);
        return;
    }

    // Asignar el valor del ID al parámetro de la consulta preparada
    $stmt->bind_param("i", $use_id);

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Obtener los resultados de la consulta
        $result = $stmt->get_result();

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {

            // Datos de la consulta
            $row = $result->fetch_assoc();

            $data = array(
                'status' => true,
                'message' => $row
            );
            echo json_encode($data);
        } else {

            // No se encontraron resultados
            $data = array(
                'status' => false,
                'message' => 'No se encontraron resultados.'
            );
            echo json_encode($data);
        }
    } else {
        // Manejar errores en la ejecución de la consulta
        $data = array(
            'status' => false,
            'message' => 'Error en la ejecución de la consulta.'
        );
        echo json_encode($data);
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $link->close();
}

function create($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $usu_nombre   = $_POST['usu_nombre'];
        $usu_apellido = $_POST['usu_apellido'];
        $use_correo   = $_POST['use_correo'];
        $use_password = $_POST['use_password'];
        $use_password2 = $_POST['use_password2'];
        $use_fkrol    = 3; // 3 =  USUARIO

        # VALIDACION DE DATOS
        if (empty($usu_nombre) || empty($usu_apellido)  || empty($use_correo) || empty($use_password) || empty($use_fkrol) || empty($use_password2)) {
            $data = array(
                'status'  => false,
                'message' => 'Datos incompletos. Por favor, completa todos los campos obligatorios.',
            );
            echo json_encode($data);
            return;
        }

        if ($use_password !== $use_password2) {
            $data = array(
                'status'  => false,
                'message' => 'Las contraseñas no coinciden.',
            );
            echo json_encode($data);
            return;
        }

        // verificar que no exista alguien con el mismo correo
        $sql = "SELECT use_correo FROM user WHERE use_correo = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("s", $use_correo);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $use_correo_actual = $row['use_correo'];

        if ($use_correo_actual == $use_correo) {
            $data = array(
                'status'  => false,
                'message' => 'El correo ya existe, intenta con otro.',
            );
            echo json_encode($data);
            return;
        }

        ## HASH DEL PASSWORD
        $use_password = password_hash($use_password, PASSWORD_DEFAULT);
        ## FIN HASH PASSWORD


        // Iniciar la transacción
        $link->begin_transaction();

        try {

            // Consulta 1: GUARDAR registro en la tabla operator
            $query1 = "INSERT INTO user (use_correo,use_password,use_fkrol) VALUES (?, ?, ?)";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("ssi", $use_correo, $use_password, $use_fkrol);
            $stmt1->execute();
            $id_ultimo = $link->insert_id;

            $query2 = "INSERT INTO usuario (usu_nombre,usu_apellido,usu_fkuser) VALUES (?, ?, ?)";
            $stmt2 = $link->prepare($query2);
            $stmt2->bind_param("ssi", $usu_nombre, $usu_apellido, $id_ultimo);
            $stmt2->execute();

            // Confirmar la transacción
            $link->commit();

            $response = array(
                'status' => true,
                'message' => 'Te registraste exitosamente, inicia sesión.'
            );
        } catch (Exception $e) {
            // Si ocurre un error, deshacer los cambios y mostrar un mensaje de error
            $link->rollback();

            $response = array(
                'status' => false,
                'message' => 'Ocurrió un error al intentar guardar los datos: ' . $e->getMessage()
            );
        }

        // Enviar la respuesta como JSON
        echo json_encode($response);
    }
}


function update($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $use_id       = $_POST['use_id'];
        $usu_nombre   = $_POST['usu_nombre'];
        $usu_apellido = $_POST['usu_apellido'];
        $use_correo   = $_POST['use_correo'];
        $use_password = $_POST['use_password'];
        $use_fkrol    = 3; // Asigna el valor a una variable | 1 = rol admin

        # VALIDACION DE DATOS
        if (empty($use_id) || empty($usu_nombre) || empty($usu_apellido)  || empty($use_correo) || empty($use_password)) {
            $data = array(
                'status' => false,
                'message' => 'Datos incompletos. Por favor, completa todos los campos obligatorios.'
            );
            echo json_encode($data);
            return;
        }

        // cossulta para ver traer el password actual coincide con el que se envia

        $sql = "SELECT use_password FROM user WHERE use_id = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $use_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $use_password_actual = $row['use_password'];

        if ($use_password_actual !== $use_password) {
            # hash del password nuevo
            ## HASH DEL PASSWORD
            $use_password = password_hash($use_password, PASSWORD_DEFAULT);
            ## FIN HASH PASSWORD
        }


        // Iniciar la transacción
        $link->begin_transaction();

        try {
            // Consulta 1: Actualizar registro en la tabla 'operator'
            $query1 = "UPDATE user SET use_correo = ?,use_password = ?, use_fkrol = ? WHERE use_id = ?";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("ssii", $use_correo, $use_password, $use_fkrol, $use_id);
            $stmt1->execute();

            $query2 = "UPDATE usuario SET usu_nombre = ?, usu_apellido = ? WHERE usu_fkuser = ?";
            $stmt2 = $link->prepare($query2);
            $stmt2->bind_param("ssi", $usu_nombre, $usu_apellido, $use_id);
            $stmt2->execute();


            // Confirmar la transacción
            $link->commit();

            $response = array(
                'status' => true,
                'message' => 'Actualización exitosa',
            );
        } catch (Exception $e) {
            // Si ocurre un error, deshacer los cambios y mostrar un mensaje de error
            $link->rollback();

            $response = array(
                'status' => false,
                'message' => 'Error en la actualización: ' . $e->getMessage()
            );
        }
        // Enviar la respuesta como JSON
        echo json_encode($response);
    }
}

function delete($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $use_id = $_POST['use_id'];

        // Iniciar la transacción
        $link->begin_transaction();

        try {
            // Consulta 1: Eliminar registro en la tabla 'operator'
            $query1 = "DELETE FROM usuario WHERE usu_fkuser = ?";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("i", $use_id);
            $stmt1->execute();

            $query2 = "DELETE FROM user WHERE use_id = ?";
            $stmt2 = $link->prepare($query2);
            $stmt2->bind_param("i", $use_id);
            $stmt2->execute();



            // Confirmar la transacción
            $link->commit();

            $response = array(
                'status' => true,
                'message' => 'El registro se eliminó exitosamente'
            );
        } catch (Exception $e) {
            // Si ocurre un error, deshacer los cambios y mostrar un mensaje de error
            $link->rollback();

            $response = array(
                'status' => false,
                'message' => 'Ocurrió un error al intentar eliminar el registro: ' . $e->getMessage()
            );
        }

        // Enviar la respuesta como JSON
        echo json_encode($response);
    }
}


function desactivate($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $use_id = $_POST['use_id'];

        // Consulta SQL con una consulta preparada para seleccionar el estado actual
        $sql = "SELECT use_status FROM user WHERE use_id = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $use_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $use_status = $row['use_status'] == 1 ? 0 : 1;

        // Iniciar la transacción
        $link->begin_transaction();

        try {
            // Consulta 1: Actualizar estado en la tabla 'operator'
            $query1 = "UPDATE user SET use_status = ? WHERE use_id = ?";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("ii", $use_status, $use_id);
            $stmt1->execute();

            // Confirmar la transacción
            $link->commit();

            $response = array(
                'status' => true,
                'message' => 'Actualización exitosa'
            );
        } catch (Exception $e) {
            // Si ocurre un error, deshacer los cambios y mostrar un mensaje de error
            $link->rollback();

            $response = array(
                'status' => false,
                'message' => 'Error en la actualización: ' . $e->getMessage()
            );
        }

        // Enviar la respuesta como JSON
        echo json_encode($response);
    }
}
