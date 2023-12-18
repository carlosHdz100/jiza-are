createCardsWishlist(1);

function createCardsWishlist(status) {
const url = `db_functions/garment.php?action=whishlist`;
// console.log("Ejecutando funcion wishlist...");
const wishlist = document.querySelector("#wishlist");
// hacemos la peticion fetch a la url
fetch(url)
.then((res) => res.json())
.then((data) => {
    let datos = data.data;
    // console.log(data);
    if (data.status) {
    // recorremos el array de objetos
    let html = "";
    datos.forEach((item) => {
        // Obtén la calificación del producto (supongamos que es 3.0)
        const calificacion = item.garment_qualification.promedio_calificaciones;
        // Redondea la calificación al número entero más cercano
        const calificacionRedondeada = Math.round(calificacion);
        // creamos el elemento card
        html += `
        <div class="card card-style mx-0 col-12 col-md-6 col-lg-4">
            <div class="card card-style mx-2 mt-2" data-card-height="400" style="background-image:url('${item.cat_image}')">
                <div class="card-top p-3 pe-2 pt-2">
                    <a href="#" data-toast="snackbar-favorites" class="float-end">
                        <span class="bg-theme color-theme px-2 py-2 rounded-sm">
                            <i class="fa fa-heart color-red-dark pe-1"></i>
                            Fav
                        </span>
                    </a>
                </div>
            </div>
            <div class="content mt-n3">
                <div class="d-flex">
                    <div class="me-auto align-self-center">
                        <h2 class="mb-n1">${item.gar_name}</h2>
                        <span class="d-block color-green-dark font-700">Veces rentado: +${item.times_rented}</span>
                    </div>
                    <div class="ms-auto align-self-center">
                        <h1 class="pt-2">€${item.gar_price}</sup></h1>
                    </div>
                </div>
                <p class="font-12 line-height-m pt-2 mb-2">
                ${item.gar_description}
                </p>
                <div class="d-flex">
                    <div class="align-self-center">
                        <span>`;
        for (let i = 1; i <= 5; i++) {
        html += `<i class="fa fa-star font-12 ${
            i <= calificacionRedondeada ? "color-yellow-dark" : "opacity-30"
        } pe-1"></i>`;
        }
        html += `
        </span>
            <span class="d-block opacity-70 font-11 mt-n2 color-theme">${item.garment_qualification.promedio_calificaciones} calificaciones</span>
        </div>
        <div class="align-self-center ms-auto">
            <a href="#" data-toast="snackbar-cart" class="btn btn-s bg-highlight rounded-sm font-700 text-uppercase" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Rentar ahora</a>
        </div>
                </div>
            </div>
        </div>
    `;
    });
    wishlist.innerHTML = html;
    } else {
    wishlist.innerHTML = `<div class="alert alert-danger" role="alert">
                ${data.message}
                </div>`;
    }
})
.catch((err) => {
    console.log(err);
}); // catch por si hay algun error
}
