function renderFormStripe() {

    // This is your test publishable API key.
    const stripe = Stripe("pk_test_51LQRsFCEr4e1Nxgfg1f0BMuhIUNPgyA2b1A0fk6cA1CLYIpj5czbHFaorhGpGhDZqcbHsVc80XbTKGmW0izVGRJI00JG77wU1k");

    initialize();

    // Create a Checkout Session as soon as the page loads
    async function initialize() {
        const response = await fetch("/checkout.php", {
            method: "POST",
        });

        const { clientSecret } = await response.json();

        const checkout = await stripe.initEmbeddedCheckout({
            clientSecret,
        });

        // Mount Checkout
        checkout.mount('#checkout');
    }
    /*var stripe = Stripe('pk_test_51HxY7jHb2XZq9h7Ygj2tH0J3yG7k4JZfVl7ZJL1qY5Fp2p1K1l4VzYb3Q3M5k2rQj5QwUZ1sZxQZm5r8C7ZQJg9R00Yz5j1JqY');
    var elements = stripe.elements();
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    var card = elements.create('card', {style: style});
    card.mount('#card-element');
    card.on('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        }
        else {
            displayError.textContent = '';
        }
    });
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        stripe.createToken(card).then(function (result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            }
            else {
                stripeTokenHandler(result.token);
            }
        });
    });*/

}


// This is your test publishable API key.
const stripe = Stripe("pk_test_51LQRsFCEr4e1Nxgfg1f0BMuhIUNPgyA2b1A0fk6cA1CLYIpj5czbHFaorhGpGhDZqcbHsVc80XbTKGmW0izVGRJI00JG77wU1k");

// The items the customer wants to buy
const items = [{ id: "xl-tshirt" }];

let elements;

initialize();
checkStatus();

document
    .querySelector("#payment-form")
    .addEventListener("submit", handleSubmit);

// Fetches a payment intent and captures the client secret
async function initialize() {
    const { clientSecret } = await fetch("db_functions/rent.php?action=renderStripe", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ items }),
    }).then((r) => r.json());

    elements = stripe.elements({ clientSecret });

    const paymentElementOptions = {
        layout: "tabs",
    };

    const paymentElement = elements.create("payment", paymentElementOptions);
    paymentElement.mount("#payment-element");
}

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
            showMessage("Payment succeeded!");

            setTimeout(() => {
                reedirecSuccess()
            }, 2000);
            break;
        case "processing":
            showMessage("Your payment is processing.");
            break;
        case "requires_payment_method":
            showMessage("Your payment was not successful, please try again.");
            break;
        default:
            showMessage("Something went wrong.");
            break;
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