
// createCardsGarmentCategory(1);

function createCardsGarment(status) {
const url = `db_functions/garment.php?action=allGarment`;
// console.log("Ejecutando funcion Garment...");
const listGarment = document.querySelector("#listGarment");
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
        <div class="card card-style mx-0">
            <div class="card card-style mx-2 mt-2" data-card-height="400" style="background-image:url('${item.imagenes[0].garima_url}')">
                <div class="card-top p-3 pe-2 pt-2">
                    <div id="liveAlertPlaceholder2"></div>
                    <a href="#" id="agregarAFavoritos" data-toast="snackbar-favorites" class="float-end">
                        <span class="bg-theme color-theme px-2 py-2 rounded-sm hidden" id="icon1">
                            <i class="fa fa-heart color-red-dark pe-1"></i>
                            Fav
                        </span>
                        <span class="bg-theme color-theme px-2 py-2 rounded-sm" id="icon2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fd0061" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                            </svg>
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
                            <h1 class="pt-2">€${item.gar_price}.<sup class="font-14 font-400 opacity-50">99</sup></h1>
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
            <span class="d-block opacity-70 font-1 mt-n2 color-theme">${item.garment_qualification.promedio_calificaciones} calificaciones</span>
        </div>
        <div class="align-self-center ms-auto">
            <a href="#" data-toast="snackbar-cart" class="custom-btn btn-11 btn-s bg-highlight rounded-sm font-700 text-uppercase" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Rentar ahora</a>
        </div>
                </div>
            </div>
        </div>`;
    });
    listGarment.innerHTML = html;
    } else {
    listGarment.innerHTML = `<div class="alert alert-danger" role="alert">
            ${data.message}
            </div>`;
    }
})
.catch((err) => {
    console.log(err);
}) // catch por si hay algun error
}

function createCardsPackage(status) {
const url = `db_functions/garment.php?action=allPackage`;
const listPackage = document.querySelector("#listPackage");
// hacemos la peticion fetch a la url
fetch(url)
.then((res) => res.json())
.then((data) => {
    let datos = data.data;
    if (data.status) {
    // recorremos el array de objetos
    let html = "";
    datos.forEach((item) => {
        // creamos el elemento card
        html += `
        <div class="card card-style mx-0">
            <div class="content mt-3 mb-0">
                <div class="d-flex mb-3">
                    <div class="w-100 me-3">
                        <div class="card card-style m-0" data-card-height="250" style="background-image:url('${item.imagenes[0].garima_url}')">
                            <div class="card-bottom text-center pb-2">

                                <a href="#" data-toast="snackbar-favorites" class="icon icon-xxs bg-theme rounded-l shadow-xl rounded-m mx-2 color-theme" id="icon1"><i class="fa fa-heart color-red-dark font-12"></i></a>
                                <a href="#" data-toast="snackbar-cart" class="icon icon-xxs bg-theme rounded-l shadow-xl rounded-m mx-2 color-theme"><i class="fa fa-shopping-bag font-12"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="ms-auto w-100">
                        <h5 class="font-600 font-16 line-height-sm">${item.gar_name}</h5>
                        <!-- <span class="color-green-dark d-block font-11 font-600"><i class="fa fa-truck"></i> - Entrega en 2 días</span> -->
                        <h2 class="pt-2 mt-n1">Renta desde €${item.gar_price}.<sup class="font-14 font-400 opacity-50">99</sup></h2>
                        <a href="?view=vestido" data-toast="snackbar-cart" class="custom-btn btn-11 btn-s bg-highlight rounded-sm font-700 text-uppercase mt-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Rentar ahora</a>
                    </div>
                </div>

                <div class="divider mt-4 mb-4"></div>
            </div>
        </div>
    `;
    });
    listPackage.innerHTML = html;
    } else {
    listPackage.innerHTML = `<div class="alert alert-danger" role="alert">
                ${data.message}
                </div>`;
    }
})
.catch((err) => {
    console.log(err);
}) // catch por si hay algun error
}

function createCardsGarmentPackage(status) {
const url = `db_functions/garment.php?action=all`;
console.log("Ejecutando funcion GarmentPackage ...");
const listGarmentPackage = document.querySelector('#listGarmentPackage');
// hacemos la peticion fetch a la url
fetch(url)
.then((res) => res.json())
.then((data) => {
    let datos = data.data;
    console.log(data);
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
            <div class="card card-style mx-2 mt-2" data-card-height="400">
                <div class="card-top p-3 pe-2 pt-2">
                    <div id="liveAlertPlaceholder2"></div>
                    <a href="#" id="agregarAFavoritos" data-toast="snackbar-favorites" class="float-end">
                        <span class="bg-theme color-theme px-2 py-2 rounded-sm hidden" id="icon1">
                            <i class="fa fa-heart color-red-dark pe-1"></i>
                            Fav
                        </span>
                        <span class="bg-theme color-theme px-2 py-2 rounded-sm" id="icon2">
                            <!-- <i class="fa fa-heart color-dark pe-1"></i> -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fd0061" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                            </svg>
                            Fav
                        </span>
                    </a>
                </div>
                <div class="card-image">
                    <img src="${item.cat_image}" alt="">
                </div>
            </div>
            <div class="content mt-n3">
                <div class="d-flex">
                    <div class="me-auto align-self-center">
                        <h2 class="mb-n1">${item.gar_name}</h2>
                        <span class="d-block color-green-dark font-700">Veces rentado: +${item.times_rented}</span>
                    </div>
                    <div class="ms-auto align-self-center">
                        <h1 class="pt-2">€${item.gar_price}.<sup class="font-14 font-400 opacity-50">99</sup></h1>
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
                    <a href="#" data-toast="snackbar-cart" class="custom-btn btn-11 btn-s bg-highlight rounded-sm font-700 text-uppercase" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Rentar ahora</a>
                </div>
            </div>
        </div>
    </div>
    `;
    });
    listGarmentPackage.innerHTML = html;
    } else {
    listGarmentPackage.innerHTML = `<div class="alert alert-danger" role="alert">
            ${data.message}
            </div>`;
    }
})
// catch por si hay algun error
}

// function createCardsGarmentCategory(status) {
//     const url = `db_functions/garment.php?action=all&category=${cat_name}`;
//     // const url = `db_functions/garment.php?action=view&id=14`;
//     console.log("Ejecutando funcion GarmentCategory...");
//     const listGarmentPackage = document.querySelector("#listGarmentPackage");
//     // hacemos la peticion fetch a la url
//     fetch(url)
//     .then((res) => res.json())
//     .then((data) => {
//         let datos = data.data;
//         //   console.log(data);
//         if (data.status) {
//         // recorremos el array de objetos
//         let html = "";
//         datos.forEach((item) => {
//             // Obtén la calificación del producto (supongamos que es 3.0)
//             const calificacion = item.garment_qualification.promedio_calificaciones;
//             // Redondea la calificación al número entero más cercano
//             const calificacionRedondeada = Math.round(calificacion);
//             // creamos el elemento card
//             html += `
//             <div class="card card-style mx-0 col-12 col-md-6 col-lg-4">
//                 <div class="card card-style mx-2 mt-2" data-card-height="400">
//                     <div class="card-top p-3 pe-2 pt-2">
//                         <div id="liveAlertPlaceholder2"></div>
//                         <a href="#" id="agregarAFavoritos" data-toast="snackbar-favorites" class="float-end">
//                             <span class="bg-theme color-theme px-2 py-2 rounded-sm hidden" id="icon1">
//                                 <i class="fa fa-heart color-red-dark pe-1"></i>
//                                 Fav
//                             </span>
//                             <span class="bg-theme color-theme px-2 py-2 rounded-sm" id="icon2">
//                                 <!-- <i class="fa fa-heart color-dark pe-1"></i> -->
//                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-heart" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fd0061" fill="none" stroke-linecap="round" stroke-linejoin="round">
//                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
//                                     <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
//                                 </svg>
//                                 Fav
//                             </span>
//                         </a>
//                     </div>
//                     <div class="card-image">
//                         <img src="${item.cat_image}" alt="">
//                     </div>
//                 </div>
//                 <div class="content mt-n3">
//                     <div class="d-flex">
//                         <div class="me-auto align-self-center">
//                             <h2 class="mb-n1">${item.gar_name}</h2>
//                             <span class="d-block color-green-dark font-700">Veces rentado: +${item.times_rented}</span>
//                         </div>
//                         <div class="ms-auto align-self-center">
//                             <h1 class="pt-2">€${item.gar_price}.<sup class="font-14 font-400 opacity-50">99</sup></h1>
//                         </div>
//                     </div>
//                     <p class="font-12 line-height-m pt-2 mb-2">
//                         ${item.gar_description}
//                     </p>
//                     <div class="d-flex">
//                         <div class="align-self-center">
//                             <span>`;
//             for (let i = 1; i <= 5; i++) {
//             html += `<i class="fa fa-star font-12 ${
//                 i <= calificacionRedondeada ? "color-yellow-dark" : "opacity-30"
//             } pe-1"></i>`;
//             }
//             html += `
//             </span>
//                 <span class="d-block opacity-70 font-11 mt-n2 color-theme">${item.garment_qualification.promedio_calificaciones} calificaciones</span>
//                 </div>
//                     <div class="align-self-center ms-auto">
//                         <a href="#" data-toast="snackbar-cart" class="custom-btn btn-11 btn-s bg-highlight rounded-sm font-700 text-uppercase" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Rentar ahora</a>
//                     </div>
//                 </div>
//             </div>
//         </div>
//         `;
//         });
//         listGarmentPackage.innerHTML = html;
//         } else {
//         listGarmentPackage.innerHTML = `<div class="alert alert-danger" role="alert">
//                 ${data.message}
//                 </div>`;
//         }
//     })
//     .catch((err) => {
//         console.log(err);
//     }) // catch por si hay algun error
// }
