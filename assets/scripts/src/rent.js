
// This is your test publishable API key.
const stripe = Stripe("pk_test_51LQRsFCEr4e1Nxgfg1f0BMuhIUNPgyA2b1A0fk6cA1CLYIpj5czbHFaorhGpGhDZqcbHsVc80XbTKGmW0izVGRJI00JG77wU1k");

// The items the customer wants to buy
const items = [{ id: "xl-tshirt" }];
const setPrice = document.querySelector("#setPrice");

let elements;

initialize();
checkStatus();

document
    .querySelector("#payment-form")
    .addEventListener("submit", handleSubmit);


// Fetches a payment intent and captures the client secret
async function initialize() {
    try {
        const { clientSecret, amount } = await fetch("db_functions/rent.php?action=renderStripe", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ items }),
        }).then((r) => r.json());

        elements = stripe.elements({ clientSecret });

        console.log(amount); // Esto mostrará en la consola lo que se obtiene como clientSecret
        const paymentElementOptions = {
            layout: "tabs",
        };

        const paymentElement = elements.create("payment", paymentElementOptions);
        paymentElement.mount("#payment-element");
        document.querySelector(".btnSubmit").classList.remove("hidden");
        setPrice.textContent = `${amount}€`;

    } catch (error) {
        console.error("Error fetching clientSecret:", error);
        // Si hay un error, ocultar el botón
        document.querySelector(".btnSubmit").classList.add("hidden");
        setPrice.textContent = `0€`;
    }
}

// También puedes añadir un código para mostrar un mensaje de error o tomar otras acciones necesarias en lugar de simplemente ocultar el botón.


async function handleSubmit(e) {
    e.preventDefault();
    setLoading(true);

    const { error } = await stripe.confirmPayment({
        elements,
        confirmParams: {
            // Make sure to change this to your payment completion page
            return_url: "http://localhost/jiza-are/index.php?view=carrito",
        },
    });

    // This point will only be reached if there is an immediate error when
    // confirming the payment. Otherwise, your customer will be redirected to
    // your `return_url`. For some payment methods like iDEAL, your customer will
    // be redirected to an intermediate site first to authorize the payment, then
    // redirected to the `return_url`.
    if (error.type === "card_error" || error.type === "validation_error") {
        showMessage(error.message);
    } else {
        showMessage("An unexpected error occurred.");
    }

    setLoading(false);
}

// Fetches the payment intent status after payment submission
async function checkStatus() {
    const clientSecret = new URLSearchParams(window.location.search).get(
        "payment_intent_client_secret"
    );

    if (!clientSecret) {
        return;
    }

    const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

    switch (paymentIntent.status) {
        case "succeeded":
            showMessage("¡Pago exitoso!");
            saveTransactionDetails(paymentIntent);
            // Guardar en la base de datos
            break;
        case "processing":
            showMessage("Su pago se está procesando.");
            break;
        case "requires_payment_method":
            showMessage("Su pago no fue exitoso, inténtelo nuevamente.");
            break;
        default:
            showMessage("Algo salió mal.");
            break;
    }
}

async function saveTransactionDetails(paymentIntent) {
    try {
        console.log(paymentIntent);

        let datos = new FormData();
        datos.append("paymentIntentId", paymentIntent.id);
        datos.append("amount", paymentIntent.amount);
        // Llamada a tu backend para guardar los detalles de la transacción
        const response = await fetch("db_functions/rent.php?action=create", {
            method: "POST",
            body: datos,
        });

        if (response.ok) {
            const responseData = await response.json();
            console.log(responseData);
            console.log("Detalles de la transacción guardados en la base de datos.");
            reedirecSuccess()
        } else {
            console.error("Error al guardar detalles de la transacción.");
        }
    } catch (error) {
        console.error("Error al intentar guardar detalles de la transacción:", error);
    }
}

// ------- UI helpers -------

function showMessage(messageText) {
    const messageContainer = document.querySelector("#payment-message");

    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;

    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageContainer.textContent = "";
    }, 4000);
}

// Show a spinner on payment submission
function setLoading(isLoading) {
    if (isLoading) {
        // Disable the button and show a spinner
        document.querySelector("#submit").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#button-text").classList.add("hidden");
    } else {
        document.querySelector("#submit").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#button-text").classList.remove("hidden");
    }
}

function reedirecSuccess() {
    window.location.href = "http://localhost/jiza-are/index.php?view=success";
}