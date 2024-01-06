
<style>
    .miDiv {
        opacity: 0.5;
        /* Aquí puedes ajustar el nivel de opacidad (valores entre 0 y 1) */
    }

    /* Variables */
    * {
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: 16px;
        -webkit-font-smoothing: antialiased;
        display: flex;
        justify-content: center;
        align-content: center;
        height: 100vh;
        width: 100vw;
    }

    form {
        width: 30vw;
        min-width: 500px;
        align-self: center;
        box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
            0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
        border-radius: 7px;
        padding: 40px;
    }

    .hidden {
        display: none;
    }

    #payment-message {
        color: rgb(105, 115, 134);
        font-size: 16px;
        line-height: 20px;
        padding-top: 12px;
        text-align: center;
    }

    #payment-element {
        margin-bottom: 24px;
    }

    /* Buttons and links */
    button {
        background: #FF0080;
        font-family: Arial, sans-serif;
        color: #ffffff;
        border-radius: 4px;
        border: 0;
        padding: 12px 16px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: block;
        transition: all 0.2s ease;
        box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        width: 100%;
    }

    button:hover {
        filter: contrast(115%);
    }

    button:disabled {
        opacity: 0.5;
        cursor: default;
    }

    /* spinner/processing state, errors */
    .spinner,
    .spinner:before,
    .spinner:after {
        border-radius: 50%;
    }

    .spinner {
        color: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        margin: 0px auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }

    .spinner:before,
    .spinner:after {
        position: absolute;
        content: "";
    }

    .spinner:before {
        width: 10.4px;
        height: 20.4px;
        background: #5469d4;
        border-radius: 20.4px 0 0 20.4px;
        top: -0.2px;
        left: -0.2px;
        -webkit-transform-origin: 10.4px 10.2px;
        transform-origin: 10.4px 10.2px;
        -webkit-animation: loading 2s infinite ease 1.5s;
        animation: loading 2s infinite ease 1.5s;
    }

    .spinner:after {
        width: 10.4px;
        height: 10.2px;
        background: #5469d4;
        border-radius: 0 10.2px 10.2px 0;
        top: -0.1px;
        left: 10.2px;
        -webkit-transform-origin: 0px 10.2px;
        transform-origin: 0px 10.2px;
        -webkit-animation: loading 2s infinite ease;
        animation: loading 2s infinite ease;
    }

    @-webkit-keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @media only screen and (max-width: 600px) {
        form {
            width: 80vw;
            min-width: initial;
        }
    }
</style>
<div class="page-content pt-4">

    <div class="card card-style">
        <div class="content">
            <h2 class="mb-3">Articulos</h2>

            <div id="setCarrito"></div>
        </div>
    </div>

    <div class="card card-style">
        <div class="content">

            <div class="divider"></div>

            <h2>Proceso de pago</h2>

            <!-- <div class="input-style has-borders no-icon validate-field">
                <input type="text" class="form-control focus-blue validate-text" id="f2" placeholder="Nombre del propietario">
                <label for="f2" class="color-blue-dark">Nombre del propietario</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(Requerido)</em>
            </div>
            <div class="input-style has-borders no-icon validate-field">
                <input type="number" class="form-control focus-blue validate-text" id="f2a" placeholder="Número de tarjeta">
                <label for="f2a" class="color-blue-dark">Número de tarjeta</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(Requerido)</em>
            </div>

            <div class="row mb-0">
                <div class="col-7">
                    <div class="input-style has-borders no-icon validate-field">
                        <input type="text" class="form-control focus-blue validate-text" id="f2c" placeholder="Fecha vencimiento">
                        <label for="f2c" class="color-blue-dark">Fecha vencimiento</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(Requerido)</em>
                    </div>
                </div>
                <div class="col-5">
                    <div class="input-style has-borders no-icon validate-field">
                        <input type="number" class="form-control focus-blue validate-text" id="f2d" placeholder="CCV">
                        <label for="f2d" class="color-blue-dark">CCV</label>
                        <i class="fa fa-times disabled invalid color-red-dark"></i>
                        <i class="fa fa-check disabled valid color-green-dark"></i>
                        <em>(Requerido)</em>
                    </div>
                </div>
            </div> -->

            <form class="" id="payment-form">
                <div id="payment-element">
                    <!--Stripe.js injects the Payment Element-->
                    <span id="text-noValido"></span>
                </div>
                <button class="btnSubmit hidden" id="submit">
                    <div class="spinner hidden" id="spinner"></div>
                    <span id="button-text" class="">Rentar ahora</span>
                </button>
                <div id="payment-message" class="hidden"></div>
            </form>

            <div class="divider"></div>

            <div class="d-flex mb-3">
                <div class="me-3">
                    <h4 class="font-18">Total</h4>
                </div>
                <div class="ms-auto">
                    <h4 class="font-18" id="setPrice"></h4>
                </div>
            </div>
            <!-- <div class="d-flex mb-3">
                <div class="me-3">
                    <h4 class="font-18">Shipping</h4>
                </div>
                <div class="ms-auto">
                    <h4 class="font-18">FREE</h4>
                </div>
            </div> -->
            <!-- <div class="divider mb-3"></div>
            <div class="d-flex mb-3">
                <div class="me-3">
                    <h4 class="font-16 color-highlight">Est Delivery</h4>
                </div>
                <div class="ms-auto">
                    <h4 class="font-16 color-highlight">1 Hour, 25 Min</h4>
                </div>
            </div> -->
            <div class="divider"></div>
        </div>
    </div>



</div>
<!-- End of Page Content-->

<!-- Menu Settings Highlights-->
<div id="menu-highlights" class="menu menu-box-bottom menu-box-detached">
    <div class="menu-title">
        <h1>Highlights</h1>
        <p class="color-highlight">Any Element can have a Highlight Color</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a>
    </div>
    <div class="divider divider-margins mb-n2"></div>
    <div class="content">
        <div class="highlight-changer">
            <a href="#" data-change-highlight="blue"><i class="fa fa-circle color-blue-dark"></i><span class="color-blue-light">Default</span></a>
            <a href="#" data-change-highlight="red"><i class="fa fa-circle color-red-dark"></i><span class="color-red-light">Red</span></a>
            <a href="#" data-change-highlight="orange"><i class="fa fa-circle color-orange-dark"></i><span class="color-orange-light">Orange</span></a>
            <a href="#" data-change-highlight="pink2"><i class="fa fa-circle color-pink2-dark"></i><span class="color-pink-dark">Pink</span></a>
            <a href="#" data-change-highlight="magenta"><i class="fa fa-circle color-magenta-dark"></i><span class="color-magenta-light">Purple</span></a>
            <a href="#" data-change-highlight="aqua"><i class="fa fa-circle color-aqua-dark"></i><span class="color-aqua-light">Aqua</span></a>
            <a href="#" data-change-highlight="teal"><i class="fa fa-circle color-teal-dark"></i><span class="color-teal-light">Teal</span></a>
            <a href="#" data-change-highlight="mint"><i class="fa fa-circle color-mint-dark"></i><span class="color-mint-light">Mint</span></a>
            <a href="#" data-change-highlight="green"><i class="fa fa-circle color-green-light"></i><span class="color-green-light">Green</span></a>
            <a href="#" data-change-highlight="grass"><i class="fa fa-circle color-green-dark"></i><span class="color-green-dark">Grass</span></a>
            <a href="#" data-change-highlight="sunny"><i class="fa fa-circle color-yellow-light"></i><span class="color-yellow-light">Sunny</span></a>
            <a href="#" data-change-highlight="yellow"><i class="fa fa-circle color-yellow-dark"></i><span class="color-yellow-light">Goldish</span></a>
            <a href="#" data-change-highlight="brown"><i class="fa fa-circle color-brown-dark"></i><span class="color-brown-light">Wood</span></a>
            <a href="#" data-change-highlight="night"><i class="fa fa-circle color-dark-dark"></i><span class="color-dark-light">Night</span></a>
            <a href="#" data-change-highlight="dark"><i class="fa fa-circle color-dark-light"></i><span class="color-dark-light">Dark</span></a>
            <div class="clearfix"></div>
        </div>
        <a href="#" data-menu="menu-backgrounds" class="mb-3 btn btn-full btn-m rounded-sm bg-highlight shadow-xl text-uppercase font-900 mt-4">Back to Settings</a>
    </div>
</div>
<!-- Menu Settings Backgrounds-->
<div id="menu-backgrounds" class="menu menu-box-bottom menu-box-detached">
    <div class="menu-title">
        <h1>Backgrounds</h1>
        <p class="color-highlight">Change Page Color Behind Content Boxes</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a>
    </div>
    <div class="divider divider-margins mb-n2"></div>
    <div class="content">
        <div class="background-changer">
            <a href="#" data-change-background="default"><i class="bg-theme"></i><span class="color-dark-dark">Default</span></a>
            <a href="#" data-change-background="plum"><i class="body-plum"></i><span class="color-plum-dark">Plum</span></a>
            <a href="#" data-change-background="magenta"><i class="body-magenta"></i><span class="color-dark-dark">Magenta</span></a>
            <a href="#" data-change-background="dark"><i class="body-dark"></i><span class="color-dark-dark">Dark</span></a>
            <a href="#" data-change-background="violet"><i class="body-violet"></i><span class="color-violet-dark">Violet</span></a>
            <a href="#" data-change-background="red"><i class="body-red"></i><span class="color-red-dark">Red</span></a>
            <a href="#" data-change-background="green"><i class="body-green"></i><span class="color-green-dark">Green</span></a>
            <a href="#" data-change-background="sky"><i class="body-sky"></i><span class="color-sky-dark">Sky</span></a>
            <a href="#" data-change-background="orange"><i class="body-orange"></i><span class="color-orange-dark">Orange</span></a>
            <a href="#" data-change-background="yellow"><i class="body-yellow"></i><span class="color-yellow-dark">Yellow</span></a>
            <div class="clearfix"></div>
        </div>
        <a href="#" data-menu="menu-settings" class="mb-3 btn btn-full btn-m rounded-sm bg-highlight shadow-xl text-uppercase font-900 mt-4">Back to Settings</a>
    </div>
</div>
<!-- Menu Share -->
<div id="menu-share" class="menu menu-box-bottom menu-box-detached">
    <div class="menu-title mt-n1">
        <h1>Share the Love</h1>
        <p class="color-highlight">Just Tap the Social Icon. We'll add the Link</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a>
    </div>
    <div class="content mb-0">
        <div class="divider mb-0"></div>
        <div class="list-group list-custom-small list-icon-0">
            <a href="auto_generated" class="shareToFacebook external-link">
                <i class="font-18 fab fa-facebook-square color-facebook"></i>
                <span class="font-13">Facebook</span>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="auto_generated" class="shareToTwitter external-link">
                <i class="font-18 fab fa-twitter-square color-twitter"></i>
                <span class="font-13">Twitter</span>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="auto_generated" class="shareToLinkedIn external-link">
                <i class="font-18 fab fa-linkedin color-linkedin"></i>
                <span class="font-13">LinkedIn</span>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="auto_generated" class="shareToWhatsApp external-link">
                <i class="font-18 fab fa-whatsapp-square color-whatsapp"></i>
                <span class="font-13">WhatsApp</span>
                <i class="fa fa-angle-right"></i>
            </a>
            <a href="auto_generated" class="shareToMail external-link border-0">
                <i class="font-18 fa fa-envelope-square color-mail"></i>
                <span class="font-13">Email</span>
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
</div>

<script src="assets/scripts/src/cart.js"></script>
<script src="assets/scripts/src/rent.js"></script>
<script>
    getMiCarrito();
</script>