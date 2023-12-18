<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
}

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
    case 'allPackage':
        allPackage($link);
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
    case 'whishlist':
        whishlist($link);
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

    $category = $_REQUEST['category'];

    // Datos para la paginación
    $start       = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length      = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;

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

    // si hay una categoria la agregamos a la consulta
    if (!empty($category)) {
        $sql .= " AND cat_name = '$category'";
    }

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
            'data'            => array(),
            'recordsTotal'    => 0,
            'recordsFiltered' => 0,
            'status'          => false,
            'message'         => 'Error en la preparación de la consulta.'
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
                $row['times_rented']          = timesRented($link, $row['gar_id']);
                $row['garment_qualification'] = garmentQualification($link, $row['gar_id']);
                $row['imagenes']              = imagesGarment($link, $row['gar_id']);

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


    $use_id = $_SESSION['id'];

    // obtener el usu_id del usuario logueado

    $sql = "SELECT usu_id FROM usuario WHERE usu_fkuser = ?";

    $stmt = $link->prepare($sql);

    if (!$stmt) {
        // Manejar errores en la preparación de la consulta
        $data = array(
            'data'            => array(),
            'recordsTotal'    => 0,
            'recordsFiltered' => 0,
            'status'          => false,
            'message'         => 'Error en la preparación de la consulta.'
        );
        echo json_encode($data);
        return;
    }

    // Vincular el valor del estado al parámetro de la consulta preparada
    $stmt->bind_param("i", $use_id);

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Obtener los resultados de la consulta
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $usu_id = $row['usu_id'];
    }


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

    $sql .= " AND gar_fkusuario = $usu_id";
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
                $row['times_rented']          = timesRented($link, $row['gar_id']);
                $row['garment_qualification'] = garmentQualification($link, $row['gar_id']);
                $row['imagenes']              = imagesGarment($link, $row['gar_id']);

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

function allPackage($link)
{
    // Consulta SQL con una consulta preparada para seleccionar datos y mostrarlo en datatable
    $inactivo = 0;
    $activo   = 1;
    $todos    = 2;
    $status   = isset($_REQUEST['status']) ? $_REQUEST['status'] : $activo;

    $gar_fkcat_type_publication = 2;


    $use_id = $_SESSION['id'];

    // obtener el usu_id del usuario logueado

    $sql = "SELECT usu_id FROM usuario WHERE usu_fkuser = ?";

    $stmt = $link->prepare($sql);

    if (!$stmt) {
        // Manejar errores en la preparación de la consulta
        $data = array(
            'data'            => array(),
            'recordsTotal'    => 0,
            'recordsFiltered' => 0,
            'status'          => false,
            'message'         => 'Error en la preparación de la consulta.'
        );
        echo json_encode($data);
        return;
    }

    // Vincular el valor del estado al parámetro de la consulta preparada
    $stmt->bind_param("i", $use_id);

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Obtener los resultados de la consulta
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $usu_id = $row['usu_id'];
    }


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

    $sql .= " AND gar_fkusuario = $usu_id";
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
                $row['times_rented']          = timesRented($link, $row['gar_id']);
                $row['garment_qualification'] = garmentQualification($link, $row['gar_id']);
                $row['imagenes']              = imagesGarment($link, $row['gar_id']);
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

        $datos = array();

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {

            // Datos de la consulta
            while ($row = $result->fetch_assoc()) {

                $row['times_rented']          = timesRented($link, $gar_id);
                $row['garment_qualification'] = garmentQualification($link, $gar_id);
                $row['imagenes']              = imagesGarment($link, $gar_id);
                $datos[]                      = $row;
            }

            $data = array(
                'status' => true,
                'message' => $datos
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

        $gar_fkcat_category         = $_POST['gar_fkcat_category'];
        $gar_fkcat_person           = $_POST['gar_fkcat_person'];
        $gar_fkcat_type_publication = $_POST['gar_fkcat_type_publication'];
        $gar_name                   = $_POST['gar_name'];
        $gar_price                  = $_POST['gar_price'];
        $gar_description            = $_POST['gar_description'];



        $use_id = $_SESSION['id'];

        // obtener el usu_id del usuario logueado

        $sql = "SELECT usu_id FROM usuario WHERE usu_fkuser = ?";

        $stmt = $link->prepare($sql);

        if (!$stmt) {
            // Manejar errores en la preparación de la consulta
            $data = array(
                'data'            => array(),
                'recordsTotal'    => 0,
                'recordsFiltered' => 0,
                'status'          => false,
                'message'         => 'Error en la preparación de la consulta.'
            );
            echo json_encode($data);
            return;
        }

        // Vincular el valor del estado al parámetro de la consulta preparada
        $stmt->bind_param("i", $use_id);

        // Ejecutar la consulta preparada
        if ($stmt->execute()) {
            // Obtener los resultados de la consulta
            $result = $stmt->get_result();

            $row = $result->fetch_assoc();

            $usu_id = $row['usu_id'];
        }



        # VALIDACION DE DATOS
        if (empty($gar_fkcat_category) || empty($gar_fkcat_person) || empty($gar_fkcat_type_publication) || empty($gar_name) || empty($gar_price) || empty($gar_description)) {
            $data = array(
                'status'  => false,
                'message' => 'Datos incompletos. Por favor, completa todos los campos obligatorios.',
            );
            echo json_encode($data);
            return;
        }



        // Iniciar la transacción
        $link->begin_transaction();

        try {

            // Consulta 1: GUARDAR registro en la tabla operator
            $query1 = "INSERT INTO garment (gar_fkusuario,gar_fkcat_category,gar_fkcat_person,gar_fkcat_type_publication,gar_name,gar_price,gar_description) VALUES (?,?,?,?,?,?,?)";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("iiiisds", $usu_id, $gar_fkcat_category, $gar_fkcat_person, $gar_fkcat_type_publication, $gar_name, $gar_price, $gar_description);
            $stmt1->execute();

            // Consulta 2: Obtener el ID del registro insertado
            $gar_id = $link->insert_id;


            ## guardado de imagenes
            $mediaFiles = $_FILES['media'];

            foreach ($mediaFiles['name'] as $index => $fileName) {
                $targetDir = "../assets/images/garment/";

                $tmpName = $mediaFiles['tmp_name'][$index];
                $fileType = $mediaFiles['type'][$index];
                $fileSize = $mediaFiles['size'][$index];
                // Procesar el archivo...

                $type = substr($mediaFiles['type'][$index], 0, 5);

                // Verifica si el archivo se subió correctamente
                if (is_uploaded_file($mediaFiles['tmp_name'][$index])) {
                    // Genera un nombre único para el archivo
                    $unico = uniqid();
                    $targetFile =  $unico . '_' . $mediaFiles['name'][$index];
                    $targetFileBD = '/' . $unico . '_' . $mediaFiles['name'][$index];
                    // Mueve el archivo a la carpeta de destino
                    move_uploaded_file($mediaFiles['tmp_name'][$index], $targetDir . $targetFile);
                    mysqli_query($link, "INSERT INTO garment_image (garima_fkgarment,garima_url) VALUES ('$gar_id','$targetFileBD')");
                }
            }

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

        $gar_id                     = $_POST['gar_id'];
        $gar_fkcat_category         = $_POST['gar_fkcat_category'];
        $gar_fkcat_person           = $_POST['gar_fkcat_person'];
        $gar_fkcat_type_publication = $_POST['gar_fkcat_type_publication'];
        $gar_name                   = $_POST['gar_name'];
        $gar_price                  = $_POST['gar_price'];
        $gar_description            = $_POST['gar_description'];


        # VALIDACION DE DATOS
        if (empty($gar_id) || empty($gar_fkcat_category) || empty($gar_fkcat_person) || empty($gar_fkcat_type_publication) || empty($gar_name) || empty($gar_price) || empty($gar_description)) {
            $data = array(
                'status' => false,
                'message' => 'Datos incompletos. Por favor, completa todos los campos obligatorios.'
            );
            echo json_encode($data);
            return;
        }




        // Iniciar la transacción
        $link->begin_transaction();

        try {

            ## guardado de imagenes
            $mediaFiles = $_FILES['media'];

            foreach ($mediaFiles['name'] as $index => $fileName) {
                $targetDir = "../assets/images/garment/";

                $tmpName = $mediaFiles['tmp_name'][$index];
                $fileType = $mediaFiles['type'][$index];
                $fileSize = $mediaFiles['size'][$index];
                // Procesar el archivo...

                $type = substr($mediaFiles['type'][$index], 0, 5);

                // Verifica si el archivo se subió correctamente
                if (is_uploaded_file($mediaFiles['tmp_name'][$index])) {
                    // Genera un nombre único para el archivo
                    $unico = uniqid();
                    $targetFile =  $unico . '_' . $mediaFiles['name'][$index];
                    $targetFileBD = '/' . $unico . '_' . $mediaFiles['name'][$index];
                    // Mueve el archivo a la carpeta de destino
                    move_uploaded_file($mediaFiles['tmp_name'][$index], $targetDir . $targetFile);
                    mysqli_query($link, "INSERT INTO garment_image (garima_fkgarment,garima_url) VALUES ('$gar_id','$targetFileBD')");
                }
            }


            // Consulta 1: Actualizar registro en la tabla 'operator'
            $query1 = "UPDATE garment SET gar_fkcat_category = ?, gar_fkcat_person = ?, gar_fkcat_type_publication = ?, gar_name = ?, gar_price = ?, gar_description = ? WHERE gar_id = ?";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("iiisdsi", $gar_fkcat_category, $gar_fkcat_person, $gar_fkcat_type_publication, $gar_name, $gar_price, $gar_description, $gar_id);
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
/*
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

function whishlist($link)
{
    // Consulta SQL con una consulta preparada para seleccionar datos y mostrarlo en datatable
    $inactivo = 0;
    $activo   = 1;
    $todos    = 2;
    $status   = isset($_REQUEST['status']) ? $_REQUEST['status'] : $activo;

    $use_id   = $_SESSION['id'];

    // obtener el usu_id del usuario logueado

    $sql = "SELECT usu_id FROM usuario WHERE usu_fkuser = ?";

    $stmt = $link->prepare($sql);

    if (!$stmt) {
        // Manejar errores en la preparación de la consulta
        $data = array(
            'data'            => array(),
            'recordsTotal'    => 0,
            'recordsFiltered' => 0,
            'status'          => false,
            'message'         => 'Error en la preparación de la consulta.'
        );
        echo json_encode($data);
        return;
    }

    // Vincular el valor del estado al parámetro de la consulta preparada
    $stmt->bind_param("i", $use_id);

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Obtener los resultados de la consulta
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $usu_id = $row['usu_id'];
    }





    // Datos para la paginación
    $start       = isset($_REQUEST['start']) ? $_REQUEST['start'] : 0;
    $length      = isset($_REQUEST['length']) ? $_REQUEST['length'] : 10;

    // Columna por la cual se ordenará
    $orderColumn = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : 0;
    $orderDir    = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : 'ASC';
    $columns     = array('gar_name');

    // Búsqueda
    $searchValue = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $condicion   = ($status == $todos) ? "gar_status IN (?, ?)" : "gar_status = ?";
    $condicion2  = ($status == $todos) ? "gar_status IN ($activo, $inactivo)" : "gar_status = $status";

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT * FROM garment_wishlist INNER JOIN garment ON gar_id = garwis_fkgarment INNER JOIN usuario ON usu_id = gar_fkusuario INNER JOIN cat_category ON cat_id = gar_fkcat_category INNER JOIN cat_person ON per_id = gar_fkcat_person WHERE $condicion";

    // si hay una categoria la agregamos a la consulta
    if (!empty($usu_id)) {
        $sql .= " AND garwis_fkusuario = '$usu_id'";
    }

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
            'data'            => array(),
            'recordsTotal'    => 0,
            'recordsFiltered' => 0,
            'status'          => false,
            'message'         => 'Error en la preparación de la consulta.'
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
                $row['times_rented'] = timesRented($link, $row['gar_id']);
                $row['garment_qualification'] = garmentQualification($link, $row['gar_id']);
                $datos[] = $row;
            }

            $data = array(
                'data' => $datos,
                'recordsTotal' =>  count($datos), // Total de registros sin filtrar
                'recordsFiltered' => mysqli_num_rows(mysqli_query($link, "SELECT * FROM garment_wishlist INNER JOIN garment ON gar_id = garwis_fkgarment WHERE $condicion2")), // Total de registros después del filtrado
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
*/


function timesRented($link, $gar_id)
{
    // funcion que retorna cuantas veces fue rentado la prenda

    $sql = "SELECT COUNT(*) AS total FROM rent_garment WHERE rengar_fkgarment = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $gar_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total = $row['total'];

    return $total;
}

function garmentQualification($link, $gar_id)
{
    $sql = "SELECT COUNT(*) AS total_reseñas, IFNULL(ROUND(AVG(garrat_rating), 1), 0) AS promedio_calificaciones FROM garment_rating WHERE garrat_fkgarment = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $gar_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $total_reseñas = $row['total_reseñas'];
    $promedio_calificaciones = $row['promedio_calificaciones'];

    $data = array(
        'total_reseñas' => $total_reseñas,
        'promedio_calificaciones' => $promedio_calificaciones
    );

    return $data;
}

function imagesGarment($link, $gar_id)
{
    $sql  = "SELECT garima_url FROM garment_image WHERE garima_fkgarment = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $gar_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $url = $row['garima_url'];

            if (strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {

                $url = $row['garima_url'];
            } else {
                $currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $parsedUrl = parse_url($currentUrl);

                $segmentsToRemove = ['/index.php', '/db_functions/garment.php'];

                // Eliminar segmentos de la ruta si están presentes
                $path = $parsedUrl['path'];
                foreach ($segmentsToRemove as $segment) {
                    $path = str_replace($segment, '', $path);
                }

                // Reconstruir la URL sin /index.php
                $url = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $path .'/assets/images/garment'. $row['garima_url'];
            }

            $row['garima_url'] =  $url;

            $data[] = $row;
        }
    }

    return $data;
}
