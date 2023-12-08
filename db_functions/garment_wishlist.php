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


    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT * FROM garment_wishlist WHERE garwis_fkusuario = ?";

    // Preparar la consulta
    $stmt = $link->prepare($sql);

    // Indicar el parámetro de la consulta
    $stmt->bind_param("i", $_SESSION['id']);

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
                'recordsFiltered' => mysqli_num_rows(mysqli_query($link, "SELECT * FROM garment_wishlist WHERE $")), // Total de registros después del filtrado
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



function create($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $garwis_fkgarment = $_POST['garwis_fkgarment'];
        $garwis_fkusuario = $_POST['garwis_fkusuario'];



        # VALIDACION DE DATOS
        if (empty($garwis_fkgarment) || empty($garwis_fkusuario)) {
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

            // Consulta 1: Insertar registro en la tabla 'garment_wishlist'
            $query1 = "INSERT INTO garment_wishlist (garwis_fkgarment, garwis_fkusuario) VALUES (?, ?)";
            $stmt1 = $link->prepare($query1);
            $stmt1->bind_param("ii", $garwis_fkgarment, $garwis_fkusuario);

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
