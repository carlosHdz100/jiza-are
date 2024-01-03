<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usu_id'])) {
    header('Location: ../index.php');
    return;
}

# ------------------------- INICIO DE IFS ------------------------

$action = $_REQUEST['action']; # ACCION PARA IR A LA FUNCION CORRECTA

include('../config/db.php'); # CONEXIÓN DE LA BD 


# --------------- IF PARA IR A LA FUNCION CORRECTA -----------
switch ($action) {
    case 'verMiCarrito':
        verMiCarrito($link);
        break;
        // case 'view':
        //     view($link);
        //     break;
    case 'create':
        create($link);
        break;
        // case 'update':
        //     update($link);
        //     break;
        case 'delete':
            delete($link);
            break;
        // case 'desactivate':
        //     desactivate($link);
        //     break;
    default:
        // Acción desconocida, puedes manejar el caso de error aquí
        break;
}


# ------------------------- FIN DE IFS ------------------------


function verMiCarrito($link)
{

    $usu_id = $_SESSION['usu_id'];

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT * FROM cart INNER JOIN garment_date ON gardat_id = car_fkgarment_date INNER JOIN garment ON gar_id = gardat_fkgarment WHERE car_fkusuario = ? GROUP BY gar_id";


    $stmt = $link->prepare($sql);

    if (!$stmt) {
        // Manejar errores en la preparación de la consulta
        $data = array(
            'data'    => array(),
            'status'  => false,
            'message' => 'Error en la preparación de la consulta.'
        );
        echo json_encode($data);
        return;
    }

    // Asignar el valor del ID al parámetro de la consulta preparada
    $stmt->bind_param("i", $usu_id);


    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        // Obtener los resultados de la consulta
        $result = $stmt->get_result();

        $datos = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['img_garment'] = imgGarmentOne($link, $row['gar_id']);
                $row['busy_days']   = busy_days($link, $usu_id, $row['gar_id']);
                $row['added_days']  = added_days($link, $usu_id, $row['gar_id']);
                $datos[] = $row;
            }

            $data = array(
                'data'    => $datos,
                'status'  => true,
                'message' => ''
            );
        } else {
            $data = array(
                'data'    => array(),
                'status'  => false,
                'message' => 'No se encontraron resultados.'
            );
        }
    } else {
        // Manejar errores en la ejecución de la consulta
        $data = array(
            'data'    => array(),
            'status'  => false,
            'message' => 'Error en la ejecución de la consulta.'
        );
    }

    header('Content-Type: application/json');

    echo json_encode($data);

    // Cerrar la declaración
    $stmt->close();
}

function imgGarmentOne($link, $gar_id)
{

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT garima_url FROM garment_image WHERE garima_fkgarment = ? LIMIT 1";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $gar_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

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

    return $data;
}

function added_days($link, $usu_id, $gar_id)
{

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql  = "SELECT gardat_date FROM cart INNER JOIN garment_date ON gardat_id = car_fkgarment_date WHERE car_fkusuario = ? AND gardat_fkgarment = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ii", $usu_id, $gar_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $data   = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            // formato de fecha
            $row['gardat_date'] = date("d-m-Y", strtotime($row['gardat_date']));

            $data[] = $row['gardat_date'];
        }
    }

    return $data;
}

function busy_days($link, $usu_id, $gar_id)
{

    // fecha actual y zona horaria españa
    // date_default_timezone_set('Europe/Madrid');
    // zona horaria mexico
    date_default_timezone_set('America/Mexico_City');
    $date = date("Y-m-d");

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql  = "SELECT gardat_date FROM cart INNER JOIN garment_date ON gardat_id = car_fkgarment_date WHERE car_fkusuario = ? AND gardat_fkgarment = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ii", $usu_id, $gar_id);
    $stmt->execute();

    $result = $stmt->get_result();
    $data   = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            if ($row['gardat_date'] < $date || $row['gardat_status'] == 1) {
                // formato de fecha
                $row['gardat_date'] = date("d-m-Y", strtotime($row['gardat_date']));
    
                $data[] = $row['gardat_date'];
            }

        }
    }

    return $data;
}


// function view($link)
// {
//     $cat_id = $_REQUEST['id'];

//     # VALIDACION DE DATOS
//     if (empty($cat_id)) {
//         $data = array(
//             'status' => false,
//             'message' => 'Datos incompletos. Por favor, completa todos los campos.'
//         );
//         echo json_encode($data);
//         return;
//     }

//     // Consulta SQL con una consulta preparada para seleccionar datos
//     $sql = "SELECT * FROM cat_category WHERE cat_id = ?";

//     // Preparar la consulta
//     $stmt = $link->prepare($sql);

//     if (!$stmt) {
//         // Manejar errores en la preparación de la consulta
//         $data = array(
//             'status' => false,
//             'message' => 'Error en la preparación de la consulta.'
//         );
//         echo json_encode($data);
//         return;
//     }

//     // Asignar el valor del ID al parámetro de la consulta preparada
//     $stmt->bind_param("i", $cat_id);

//     // Ejecutar la consulta preparada
//     if ($stmt->execute()) {
//         // Obtener los resultados de la consulta
//         $result = $stmt->get_result();

//         // Verificar si se encontraron resultados
//         if ($result->num_rows > 0) {

//             // Datos de la consulta
//             $row = $result->fetch_assoc();

//             $data = array(
//                 'status' => true,
//                 'message' => $row
//             );
//             echo json_encode($data);
//         } else {

//             // No se encontraron resultados
//             $data = array(
//                 'status' => false,
//                 'message' => 'No se encontraron resultados.'
//             );
//             echo json_encode($data);
//         }
//     } else {
//         // Manejar errores en la ejecución de la consulta
//         $data = array(
//             'status' => false,
//             'message' => 'Error en la ejecución de la consulta.'
//         );
//         echo json_encode($data);
//     }

//     // Cerrar la declaración y la conexión
//     $stmt->close();
//     $link->close();
// }

function create($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $arrayGardat_id = $_POST['gardat_id']; // ARRAY DE ID DE FECHAS ELECCIONADA
        // convertir el string en array
        $arrayGardat_id = explode(",", $arrayGardat_id);



        # VALIDACION DE DATOS
        if (empty($arrayGardat_id)) {
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

            foreach ($arrayGardat_id as $gardat_id) {

                // primero verificamos si ya existe el registro
                $sql = "SELECT * FROM cart WHERE car_fkusuario = ? AND car_fkgarment_date = ?";
                $stmt = $link->prepare($sql);
                $stmt->bind_param("ii", $_SESSION['usu_id'], $gardat_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($result->num_rows > 0) {
                    // Si existe, borramos el registro
                    $query1 = "DELETE FROM cart WHERE car_fkusuario = ? AND car_fkgarment_date = ?";
                    $stmt1 = $link->prepare($query1);
                    $stmt1->bind_param("ii", $_SESSION['usu_id'], $gardat_id);
                    $stmt1->execute();
                }


                // Consulta 1: Insertar registro en la tabla 'operator'
                $query1 = "INSERT INTO cart (car_fkusuario, car_fkgarment_date) VALUES (?, ?)";
                $stmt1 = $link->prepare($query1);
                $stmt1->bind_param("ii", $_SESSION['usu_id'], $gardat_id);
                $stmt1->execute();
            }


            // Confirmar la transacción
            $link->commit();

            $response = array(
                'status' => true,
                'message' => 'Se guardó exitosamente.',
                'array' => $arrayGardat_id
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

// function update($link)
// {
//     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//         $cat_id          = $_POST['cat_id'];
//         $cat_name        = $_POST['cat_name'];
//         $cat_description = $_POST['cat_description'];
//         $cat_image       = $_POST['cat_image'];
//         $app_imageDB     = $_POST['cat_url'];

//         # VALIDACION DE DATOS
//         if (empty($cat_name) || empty($cat_description)) {
//             $data = array(
//                 'status' => false,
//                 'message' => 'Datos incompletos. Por favor, completa todos los campos obligatorios.'
//             );
//             echo json_encode($data);
//             return;
//         }


//         // Archivo recibido desde el input file
//         $app_image = $_FILES['app_image_value'];

//         // Verificar si se ha subido alguna imagen
//         $image_uploaded = !empty($app_image['name']);

//         // Iniciar la transacción
//         $link->begin_transaction();

//         try {
//             // Consulta 1: Actualizar registro en la tabla 'operator'
//             $query1 = "UPDATE cat_category SET kinper_name = ? WHERE cat_id = ?";
//             $stmt1 = $link->prepare($query1);
//             $stmt1->bind_param("si", $cat_name, $cat_id);
//             $stmt1->execute();

//             // Confirmar la transacción
//             $link->commit();

//             $response = array(
//                 'status' => true,
//                 'message' => 'Actualización exitosa',
//             );
//         } catch (Exception $e) {
//             // Si ocurre un error, deshacer los cambios y mostrar un mensaje de error
//             $link->rollback();

//             $response = array(
//                 'status' => false,
//                 'message' => 'Error en la actualización: ' . $e->getMessage()
//             );
//         }

//         // Enviar la respuesta como JSON
//         echo json_encode($response);
//     }
// }

function delete($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $garment_id = $_POST['garment_id'];

        // Iniciar la transacción
        $link->begin_transaction();

        try {

            // primero seelccionamos todos los gardat_id de la tabla garment_date donde la prenda  = $garment_id
            $sql = "SELECT gardat_id FROM cart INNER JOIN garment_date ON gardat_id = car_fkgarment_id WHERE gardat_fkgarment = ?";
            $stmt = $link->prepare($sql);
            $stmt->bind_param("i", $garment_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();



            // Consulta 1: Eliminar registro en la tabla 'operator'
            $query1 = "DELETE FROM cart WHERE car_fkgarment_date = ? AND car_fkusuario = ?";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("i", $garment_id);
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

// function desactivate($link)
// {
//     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//         $cat_id = $_POST['cat_id'];

//         // Consulta SQL con una consulta preparada para seleccionar el estado actual
//         $sql = "SELECT cat_status FROM cat_category WHERE cat_id = ?";
//         $stmt = $link->prepare($sql);
//         $stmt->bind_param("i", $cat_id);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         $row = $result->fetch_assoc();
//         $cat_status = $row['cat_status'] == 1 ? 0 : 1;

//         // Iniciar la transacción
//         $link->begin_transaction();

//         try {
//             // Consulta 1: Actualizar estado en la tabla 'operator'
//             $query1 = "UPDATE cat_category SET cat_status = ? WHERE cat_id = ?";
//             $stmt1 = $link->prepare($query1);
//             $stmt1->bind_param("ii", $cat_status, $cat_id);
//             $stmt1->execute();

//             // Confirmar la transacción
//             $link->commit();

//             $response = array(
//                 'status' => true,
//                 'message' => 'Actualización exitosa'
//             );
//         } catch (Exception $e) {
//             // Si ocurre un error, deshacer los cambios y mostrar un mensaje de error
//             $link->rollback();

//             $response = array(
//                 'status' => false,
//                 'message' => 'Error en la actualización: ' . $e->getMessage()
//             );
//         }

//         // Enviar la respuesta como JSON
//         echo json_encode($response);
//     }
// }
