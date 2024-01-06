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
    default:
        // Acción desconocida, puedes manejar el caso de error aquí
        break;
}


# ------------------------- FIN DE IFS ------------------------
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
            $query1 = "INSERT INTO cat_category (cat_name, cat_description, cat_image) VALUES (?, ?, ?)";
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

// function eliminarPuntos($numero) {
//     // Reemplaza los puntos con una cadena vacía
//     $numeroSinPuntos = str_replace('.', '', $numero);
//     return $numeroSinPuntos;
// }

function calculateOrderAmount(array $items,$link): int
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
        $montoPagar = calculateOrderAmount($jsonObj->items,$link);

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


    /*require_once '../vendor/autoload.php';

    $stripeSecretKey = 'sk_test_51LQRsFCEr4e1NxgfEGYbRD51eDK90TuoVnqn7B8ha6OjUvmTCsHOWhK0Jt0HL1wzizslrtBpsTaljB0Or1Hp2kuj00p9E86o64';

    \Stripe\Stripe::setApiKey($stripeSecretKey);
    header('Content-Type: application/json');

    $YOUR_DOMAIN = 'http://localhost/jiza-are/index.php';

    $checkout_session = \Stripe\Checkout\Session::create([
        'line_items' => [[
            # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
            'price' => '400',
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . '?view=succes',
        'cancel_url' => $YOUR_DOMAIN . '?view=error',
    ]);

    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);*/
}
