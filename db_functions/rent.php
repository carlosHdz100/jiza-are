<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ../index.php');
}


$action = $_REQUEST['action']; # ACCION PARA IR A LA FUNCION CORRECTA

include('../config/db.php'); # CONEXIÓN DE LA BD 


# --------------- IF PARA IR A LA FUNCION CORRECTA -----------
switch ($action) {
    case 'renderStripe':
        renderStripe($link);
        break;
    case 'create':
        create($link);
        break;
    default:
        // Acción desconocida, puedes manejar el caso de error aquí
        break;
}

# ------------------------- FIN DE IFS ------------------------
function create($link)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $paymentIntentId = $_POST['paymentIntentId'];
        $amount          = $_POST['amount'];

        if (empty($paymentIntentId) || empty($amount)) {
            // No se recibieron datos
            $response = array(
                'status'  => false,
                'message' => 'No se recibieron datos'
            );

            // Enviar respuesta
            echo json_encode($response);
            return;
        }

        // Iniciar la transacción
        $link->begin_transaction();

        try {

            // crear la renta
            $query = "INSERT INTO rent (ren_fkusuario,ren_amount,ren_pay_id_stripe) VALUES (?, ?, ?)";
            $stmt = $link->prepare($query);
            $stmt->bind_param("ids", $_SESSION['usu_id'], $amount, $paymentIntentId);
            $stmt->execute();

            // obtener el id de la renta
            $rentId = $link->insert_id;
            $status = 1;

            // obtener los datos del carrito
            $query = "SELECT gar_id,gar_price FROM cart INNER JOIN garment_date ON gardat_id = car_fkgarment_date INNER JOIN garment ON gar_id = gardat_fkgarment WHERE car_fkusuario = ? group by gar_id";
            $stmt = $link->prepare($query);
            $stmt->bind_param("i", $_SESSION['usu_id']);
            $stmt->execute();
            $result = $stmt->get_result();

            // recorrer los datos del carrito
            while ($row = $result->fetch_assoc()) {
                // crear la renta detalle
                $query = "INSERT INTO rent_garment (rengar_fkrent,rengar_fkgarment,rengar_amount) VALUES (?, ?, ?)";
                $stmt = $link->prepare($query);
                $stmt->bind_param("iid", $rentId, $row['gar_id'], $row['gar_price']);
                $stmt->execute();

                // obtener el id de la renta detalle
                $rentGarmentId = $link->insert_id;

                // obtener los datos de las fechas de la prenda
                $query2 = "SELECT gardat_id FROM cart INNER JOIN garment_date ON gardat_id = car_fkgarment_date INNER JOIN garment ON gar_id = gardat_fkgarment WHERE car_fkusuario = ? AND gar_id = ?";
                $stmt2 = $link->prepare($query2);
                $stmt2->bind_param("ii", $_SESSION['usu_id'], $row['gar_id']);
                $stmt2->execute();
                $result2 = $stmt2->get_result();

                // recorrer los datos de las fechas de la prenda
                while ($row2 = $result2->fetch_assoc()) {
                    // crear la renta detalle fecha
                    $query = "INSERT INTO rent_date (rendat_fkrent_garment, rendat_fkgarment_date) VALUES (?, ?)";
                    $stmt = $link->prepare($query);
                    $stmt->bind_param("ii", $rentGarmentId, $row2['gardat_id']);
                    $stmt->execute();

                    // actualizar la prenda
                    $query = "UPDATE garment_date SET gardat_status =  ? WHERE gardat_id = ?";
                    $stmt = $link->prepare($query);
                    $stmt->bind_param("ii", $status, $row2['gardat_id']);
                    $stmt->execute();

                }


                // eliminar los datos del wishlist 
                $query = "DELETE FROM garment_wishlist WHERE garwis_fkgarment = ? AND garwis_fkusuario = ?";
                $stmt = $link->prepare($query);
                $stmt->bind_param("ii", $row['gar_id'], $_SESSION['usu_id']);
                $stmt->execute();
            }

            // eliminar los datos del carrito y si tambien estaba en el wishlist pero solo los que estaban en el carrito
            $query = "DELETE FROM cart WHERE car_fkusuario = ?";
            $stmt = $link->prepare($query);
            $stmt->bind_param("i", $_SESSION['usu_id']);
            $stmt->execute();


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

// function eliminarPuntos($numero) {
//     // Reemplaza los puntos con una cadena vacía
//     $numeroSinPuntos = str_replace('.', '', $numero);
//     return $numeroSinPuntos;
// }

function calculateOrderAmount(array $items, $link): int
{
    $usu_id = $_SESSION['usu_id'];
    $arrayPrice = array();

    // realizar la consulta para obtener el precio de la prenda
    $query = "SELECT gar_price FROM cart INNER JOIN garment_date ON gardat_id = car_fkgarment_date INNER JOIN garment ON gar_id = gardat_fkgarment WHERE car_fkusuario = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("i", $usu_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $arrayPrice[] = str_replace('.', '', $row['gar_price']);
    }

    $total = array_sum($arrayPrice);

    $numeroSinPuntos = str_replace('.', '', $total);

    return $total;
}
function renderStripe($link)
{


    require_once '../vendor/autoload.php';
    $stripeSecretKey = 'sk_test_51LQRsFCEr4e1NxgfEGYbRD51eDK90TuoVnqn7B8ha6OjUvmTCsHOWhK0Jt0HL1wzizslrtBpsTaljB0Or1Hp2kuj00p9E86o64';

    $stripe = new \Stripe\StripeClient($stripeSecretKey);



    header('Content-Type: application/json');
    try {
        // retrieve JSON from POST body
        $jsonStr = file_get_contents('php://input');
        $jsonObj = json_decode($jsonStr);
        $montoPagar = calculateOrderAmount($jsonObj->items, $link);

        // Create a PaymentIntent with amount and currency
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $montoPagar,
            // 'currency' => 'mxn',
            'currency' => 'eur', // Use 'eur' for euros
            'payment_method_types' => ['card'],

            // 'country' => 'ES', // Set country to Spain ('ES' is the country code for Spain)
            //'country' => 'ES', // Set country to Spain ('ES' is the country code for Spain)
            // 'automatic_payment_methods' => [
            //     'enabled' => true,
            // ], // This parameter might not be necessary in newer API versions
        ]);

        // formatear el monto a pagar a un formato de moneda euros
        $montoPagar = number_format($montoPagar / 100, 2, '.', ',');

        $output = [
            'clientSecret' => $paymentIntent->client_secret,
            'amount' => $montoPagar,
        ];

        echo json_encode($output);
    } catch (Error $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
