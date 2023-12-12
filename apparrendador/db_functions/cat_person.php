<?php

$action = $_REQUEST['action']; # ACCION PARA IR A LA FUNCION CORRECTA

include('../config/db.php'); # CONEXIÓN DE LA BD 


# --------------- IF PARA IR A LA FUNCION CORRECTA -----------
switch ($action) {
    case 'all':
        all($link);
        break;
        // case 'view':
        //     view($link);
        //     break;
        // case 'create':
        //     create($link);
        //     break;
        // case 'update':
        //     update($link);
        //     break;
        // case 'delete':
        //     delete($link);
        //     break;
        // case 'desactivate':
        //     desactivate($link);
        //     break;
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
    $columns     = array('per_id', 'per_name');

    // Búsqueda
    $searchValue = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

    $condicion   = ($status == $todos) ? "per_status IN (?, ?)" : "per_status = ?";
    $condicion2  = ($status == $todos) ? "per_status IN ($activo, $inactivo)" : "per_status = $status";

    // Consulta SQL con una consulta preparada para seleccionar datos
    $sql = "SELECT * FROM cat_person WHERE $condicion";

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
    //$sql .= " LIMIT " . $length . " OFFSET " . $start;

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
                'recordsFiltered' => mysqli_num_rows(mysqli_query($link, "SELECT * FROM cat_person WHERE $condicion2")), // Total de registros después del filtrado
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
