<?php

$action = $_REQUEST['action']; # ACCION PARA IR A LA FUNCION CORRECTA

include('../config/db.php'); # CONEXIÓN DE LA BD 


# --------------- IF PARA IR A LA FUNCION CORRECTA -----------
switch ($action) {
    case 'all':
        all($link);
        break;
    case 'allGarment':
        allGarment($link);
        break;
    case 'allPack':
        allPack($link);
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
    $columns     = array('gar_name');

    // Búsqueda
    $searchValue = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $condicion   = ($status == $todos) ? "gar_status IN (?, ?)" : "gar_status = ?";
    $condicion2  = ($status == $todos) ? "gar_status IN ($activo, $inactivo)" : "gar_status = $status";

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT * FROM garment INNER JOIN usuario ON usu_id = gar_fkusuario INNER JOIN cat_category ON cat_id = gar_fkcat_category INNER JOIN cat_person ON per_id = gar_fkcat_person WHERE $condicion";

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
                'recordsFiltered' => mysqli_num_rows(mysqli_query($link, "SELECT * FROM garment WHERE $condicion2")), // Total de registros después del filtrado
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

function allGarment($link)
{
    // Consulta SQL con una consulta preparada para seleccionar datos y mostrarlo en datatable
    $inactivo = 0;
    $activo   = 1;
    $todos    = 2;
    $status   = isset($_REQUEST['status']) ? $_REQUEST['status'] : $activo;

    $gar_fkcat_type_publication = 1;
    
    // Datos para la paginación
    $start  = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;

    // Columna por la cual se ordenará
    $orderColumn = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $orderDir    = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'ASC';
    $columns     = array('gar_name');

    // Búsqueda
    $searchValue = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $condicion   = ($status == $todos) ? "gar_status IN (?, ?)" : "gar_status = ?";
    $condicion2  = ($status == $todos) ? "gar_status IN ($activo, $inactivo)" : "gar_status = $status";

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT * FROM garment INNER JOIN usuario ON usu_id = gar_fkusuario INNER JOIN cat_category ON cat_id = gar_fkcat_category INNER JOIN cat_person ON per_id = gar_fkcat_person WHERE $condicion";

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

    
    $sql .= " AND gar_fkcat_type_publication = $gar_fkcat_type_publication";

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
                'recordsFiltered' => mysqli_num_rows(mysqli_query($link, "SELECT * FROM garment WHERE $condicion2")), // Total de registros después del filtrado
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

function allPack($link)
{
    // Consulta SQL con una consulta preparada para seleccionar datos y mostrarlo en datatable
    $inactivo = 0;
    $activo   = 1;
    $todos    = 2;
    $status   = isset($_REQUEST['status']) ? $_REQUEST['status'] : $activo;

    $gar_fkcat_type_publication = 2;


    // Datos para la paginación
    $start  = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;

    // Columna por la cual se ordenará
    $orderColumn = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $orderDir    = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'ASC';
    $columns     = array('gar_name');

    // Búsqueda
    $searchValue = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $condicion   = ($status == $todos) ? "gar_status IN (?, ?)" : "gar_status = ?";
    $condicion2  = ($status == $todos) ? "gar_status IN ($activo, $inactivo)" : "gar_status = $status";

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT * FROM garment INNER JOIN usuario ON usu_id = gar_fkusuario INNER JOIN cat_category ON cat_id = gar_fkcat_category INNER JOIN cat_person ON per_id = gar_fkcat_person WHERE $condicion";

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

    $sql .= " AND gar_fkcat_type_publication = $gar_fkcat_type_publication";


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
                'recordsFiltered' => mysqli_num_rows(mysqli_query($link, "SELECT * FROM garment WHERE $condicion2")), // Total de registros después del filtrado
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
    $gar_id = $_REQUEST['id'];

    # VALIDACION DE DATOS
    if (empty($gar_id)) {
        $data = array(
            'status' => false,
            'message' => 'Datos incompletos. Por favor, completa todos los campos.'
        );
        echo json_encode($data);
        return;
    }

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT * FROM garment INNER JOIN usuario ON usu_id = gar_fkusuario INNER JOIN cat_category ON cat_id = gar_fkcat_category INNER JOIN cat_person ON per_id = gar_fkcat_person WHERE gar_id = ?";

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
    $stmt->bind_param("i", $gar_id);

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

        $cat_name        = $_POST['cat_name'];
        $cat_description = $_POST['cat_description'];

        // Archivo recibido desde el input file
        $app_image = $_FILES['app_image_value'];

        // Verificar si se ha subido alguna imagen
        $image_uploaded = !empty($app_image['name']);

        # VALIDACION DE DATOS
        if (empty($cat_name) || empty($cat_description)) {
            $data = array(
                'status'  => false,
                'message' => 'Datos incompletos. Por favor, completa todos los campos obligatorios.',
            );
            echo json_encode($data);
            return;
        }

        // Si se ha subido una imagen, procesarla
        if ($image_uploaded) {
            // Obtener detalles del archivo
            $file_name        = $app_image['name'];
            $file_tmp         = $app_image['tmp_name'];
            $file_destination = 'garment/' . $file_name; // Ruta de destino para guardar la imagen

            // Intentar mover el archivo a la carpeta 'application'
            if (move_uploaded_file($file_tmp, "../assets/images/$file_destination")) {
                $app_image_path = $file_destination;
            } else {
                // Si falla la carga del archivo
                $response = array(
                    'status' => false,
                    'message' => 'Error al cargar la imagen. Por favor, inténtalo de nuevo.'
                );
                echo json_encode($response);
                return;
            }
        } else {
            $app_image_path = null; // Si no se sube ninguna imagen, guardar como NULL en la base de datos
        }

        // Iniciar la transacción
        $link->begin_transaction();

        try {

            // Consulta 1: GUARDAR registro en la tabla operator
            $query1 = "INSERT INTO garment (cat_name, cat_description, cat_image) VALUES (?, ?, ?)";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("sss", $cat_name, $cat_description, $app_image_path);
            $stmt1->execute();

            // Confirmar la transacción
            $link->commit();

            $response = array(
                'status' => true,
                'message' => 'Se guardó exitosamente.'
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
        $gar_id          = $_POST['gar_id'];
        $cat_name        = $_POST['cat_name'];
        $cat_description = $_POST['cat_description'];
        $cat_image       = $_POST['cat_image'];
        $app_imageDB     = $_POST['cat_url'];

        # VALIDACION DE DATOS
        if (empty($cat_name) || empty($cat_description)) {
            $data = array(
                'status' => false,
                'message' => 'Datos incompletos. Por favor, completa todos los campos obligatorios.'
            );
            echo json_encode($data);
            return;
        }


        // Archivo recibido desde el input file
        $app_image = $_FILES['app_image_value'];

        // Verificar si se ha subido alguna imagen
        $image_uploaded = !empty($app_image['name']);

        // Iniciar la transacción
        $link->begin_transaction();

        try {
            // Consulta 1: Actualizar registro en la tabla 'operator'
            $query1 = "UPDATE garment SET kinper_name = ? WHERE gar_id = ?";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("si", $cat_name, $gar_id);
            $stmt1->execute();

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
        $gar_id = $_POST['gar_id'];

        // Iniciar la transacción
        $link->begin_transaction();

        try {
            // Consulta 1: Eliminar registro en la tabla 'operator'
            $query1 = "DELETE FROM garment WHERE gar_id = ?";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("i", $gar_id);
            $stmt1->execute();

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
        $gar_id = $_POST['gar_id'];

        // Consulta SQL con una consulta preparada para seleccionar el estado actual
        $sql = "SELECT gar_status FROM garment WHERE gar_id = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("i", $gar_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $gar_status = $row['gar_status'] == 1 ? 0 : 1;

        // Iniciar la transacción
        $link->begin_transaction();

        try {
            // Consulta 1: Actualizar estado en la tabla 'operator'
            $query1 = "UPDATE garment SET gar_status = ? WHERE gar_id = ?";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("ii", $gar_status, $gar_id);
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
