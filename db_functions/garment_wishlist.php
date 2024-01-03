<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
    return;
}

$action = $_REQUEST['action']; # ACCION PARA IR A LA FUNCION CORRECTA

include('../config/db.php'); # CONEXIÓN DE LA BD 


# --------------- IF PARA IR A LA FUNCION CORRECTA -----------
switch ($action) {
    case 'create':
        create($link);
        break;

    case 'delete':
        delete($link);
        break;

    case 'getWhislistUsuario':
        getWhislistUsuario($link);
        break;

    default:
        // Acción desconocida, puedes manejar el caso de error aquí
        break;
}


# ------------------------- FIN DE IFS ------------------------



function create($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $garwis_fkgarment = $_POST['garwis_fkgarment'];
        // $garwis_fkusuario = $_POST['garwis_fkusuario'];


        $usu_id = $_SESSION['usu_id'];

        // obtener el usu_id del usuario logueado

        # VALIDACION DE DATOS
        if (empty($garwis_fkgarment)) {
            $data = array(
                'status'  => false,
                'message' => 'Datos incompletos. Por favor, completa todos los campos obligatorios.',
            );
            echo json_encode($data);
            return;
        }

        // revisar que garwis_fkgarment y garwis_fkusuario no exista en la tabla garment_wishlist

        $queryRevisar = "SELECT garwis_fkgarment,garwis_fkusuario FROM garment_wishlist WHERE garwis_fkgarment = ? AND garwis_fkusuario = ?";
        $stmtRevisar = $link->prepare($queryRevisar);
        $stmtRevisar->bind_param("ii", $garwis_fkgarment, $usu_id);
        $stmtRevisar->execute();
        $stmtRevisar->store_result();
        $num = $stmtRevisar->num_rows;
        $stmtRevisar->close();

        if ($num > 0) {
            $data = array(
                'status'  => false,
                'message' => 'Esta prenda ya está en tu lista de deseos.',
            );
            echo json_encode($data);
            return;
        }




        // Iniciar la transacción
        $link->begin_transaction();

        try {

            // Consulta 1: Insertar registro en la tabla 'garment_wishlist'
            $query1 = "INSERT INTO garment_wishlist (garwis_fkgarment, garwis_fkusuario) VALUES (?, ?)";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("ii", $garwis_fkgarment, $usu_id);

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


function delete($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $garwis_id = $_POST['garwis_id'];

        // Iniciar la transacción
        $link->begin_transaction();

        try {
            // Consulta 1: Eliminar registro en la tabla 'operator'
            $query1 = "DELETE FROM garment_wishlist WHERE garwis_id = ?";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("i", $garwis_id);
            $stmt1->execute();

            // Confirmar la transacción
            $link->commit();

            $response = array(
                'status' => true,
                'message' => 'Se eliminó exitosamente de tu lista de deseos.'
            );
        } catch (Exception $e) {
            // Si ocurre un error, deshacer los cambios y mostrar un mensaje de error
            $link->rollback();

            $response = array(
                'status' => false,
                'message' => 'Ocurrió un error al intentar eliminar la prenda: ' . $e->getMessage()
            );
        }

        // Enviar la respuesta como JSON
        echo json_encode($response);
    }
}

function getWhislistUsuario($link)
{
    $usu_id = $_SESSION['usu_id'];

    // Consulta SQL con una consulta preparada para seleccionar datos y mostrarlo en datatable
    $inactivo = 0;
    $activo   = 1;
    $todos    = 2;
    $status   = isset($_REQUEST['status']) ? $_REQUEST['status'] : $activo;

    $category = isset($_REQUEST['category']) ? $_REQUEST['category'] : '';

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
    $sql = "SELECT * FROM garment INNER JOIN garment_wishlist ON garwis_fkgarment = gar_id INNER JOIN usuario ON usu_id = gar_fkusuario INNER JOIN cat_category ON cat_id = gar_fkcat_category INNER JOIN cat_person ON per_id = gar_fkcat_person WHERE $condicion";

    // si hay una categoria la agregamos a la consulta
    if (!empty($category)) {
        $sql .= " AND cat_name = '$category'";
    }

    $sql .= " AND garwis_fkusuario = '$usu_id'";


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
                $row['is_wishlist']           = isWishlist($link, $row['gar_id']);
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

function isWishlist($link, $gar_id)
{
    // funcion que retorna si la prenda esta en la lista de deseos del usuario
    $usu_id = $_SESSION['usu_id'];

    $sql = "SELECT * FROM garment_wishlist WHERE garwis_fkgarment = ? AND garwis_fkusuario = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ii", $gar_id, $usu_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

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
                $url = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $path . '/apparrendador/assets/images/garment' . $row['garima_url'];
            }

            $row['garima_url'] =  $url;

            $data[] = $row;
        }
    }

    return $data;
}
