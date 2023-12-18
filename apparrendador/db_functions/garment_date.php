<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
}

$action = $_REQUEST['action']; # ACCION PARA IR A LA FUNCION CORRECTA

include('../config/db.php'); # CONEXIÓN DE LA BD 


# --------------- IF PARA IR A LA FUNCION CORRECTA -----------
switch ($action) {
    case 'listarFechasPrendaId':
        listarFechasPrendaId($link);
        break;
        case 'delete':
            delete($link);
            break;
    default:
        // Acción desconocida, puedes manejar el caso de error aquí
        break;
}

# ------------------------- FIN DE IFS ------------------------

function listarFechasPrendaId($link)
{

    $gar_id = $_POST['id']; // 

   
    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT * FROM garment_date WHERE gardat_fkgarment = ?";

    $stmt = $link->prepare($sql);

    if (!$stmt) {
        // Manejar errores en la preparación de la consulta
        $data = array(
            'data'            => array(),
            'status'          => false,
            'message'         => 'Error en la preparación de la consulta.'
        );
        echo json_encode($data);
        return;
    }

   
    $stmt->bind_param("i", $gar_id);

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
                'status' => true,
                'message' => ''
            );
        } else {
            $data = array(
                'data' => array(),
                'status' => false,
                'message' => 'No se encontraron resultados.'
            );
        }
    } else {
        // Manejar errores en la ejecución de la consulta
        $data = array(
            'data' => array(),
            'status' => false,
            'message' => 'Error en la ejecución de la consulta.'
        );
    }

    header('Content-Type: application/json');

    echo json_encode($data);

    // Cerrar la declaración
    $stmt->close();
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