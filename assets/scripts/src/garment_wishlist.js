

function getGarmentWhislist() {
    const setGarment = document.getElementById('setGarment');

    let url = `db_functions/garment_wishlist.php?action=getWhislistUsuario`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let datos = data.data;
            let html = '';
            if (data.status) {

                datos.forEach(item => {

                    let isWishList = item.is_wishlist;

                    let estrellas = '';
                    // poner calificacion en estrellas
                    let calificacion = item.garment_qualification.promedio_calificaciones;
                    for (let i = 0; i < calificacion; i++) {
                        estrellas += '<i class="fa fa-star color-yellow-dark"></i>';
                    }

                    for (let i = 0; i < 5 - calificacion; i++) {
                        estrellas += '<i class="fa fa-star color-yellow-dark opacity-30"></i>';
                    }

                    html += `<div class="card card-style mx-3 div${item.garwis_id}">
                <img src="${item.imagenes[0].garima_url}" class="img-fluid my-3">
                <div class="content">
                <h3 class="mb-0">${item.gar_name}</h3>
                <a href="#">
                ${estrellas}
                <span class="font-11 ps-2 color-theme opacity-30">${item.garment_qualification.promedio_calificaciones} calificación</span>
                </a>
                </a>
                <h5 class="font-13 font-600 opacity-50 pt-1 pb-2">${item.gar_description}...</h5>
                <div class="divider mb-2"></div>
                <span class="d-block color-green-dark font-700">Veces rentado: ${item.times_rented > 0 ? item.times_rented : 0}</span>
                <div class="divider mb-2"></div>
                
                <div class="d-flex">
                <div class="align-self-center">
                <h1 class="mt-1 mb-n2 font-800">${item.gar_price}€</h1>
                </div>
                <div class="d-flex align-items-center ms-auto">

                <button type="button" onclick="deleteGarmentWishlist(${item.garwis_id})" class="icon icon-s bg-theme rounded-l shadow-xl rounded-m ms-2 color-theme"><i class="fa fa-heart btnWishList${item.gar_id} ${isWishList == true ? 'color-red-dark' : ''} font-14"></i></button>
                <a href="#" onclick="getGarmentById(${item.gar_id})" style="width: 100%" class="ms-2 custom-btn btn-11 btn-s bg-highlight rounded-sm font-700 text-uppercase" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Rentar</a>
                </div>
                </div>
                </div>
                </div>`;


                });
            } else {
                html += `<div class="d-flex justify-content-center">
                    <img src="assets/images/wishlistEmpty.png" class="rounded-m shadow-xl" width="200">
                    </div>  
                    <div class="d-flex justify-content-center">
                    <h5 class="font-600 opacity-50">No tienes prendas en tu lista de favoritos</h5>
                    </div>`;
            }

            setGarment.innerHTML = html;

        }).catch(err => {
            console.log(err);
        });

}

function addGarmentWhislist(gar_id) {
    let url = `db_functions/garment_wishlist.php?action=create`;

    let data = new FormData();
    data.append('garwis_fkgarment', gar_id);


    fetch(url, {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            mensajeWishList(data.message);
            // poner la clase de favorito
            let btnWishList = document.querySelector(`.btnWishList${gar_id}`);
            btnWishList.classList.add('color-red-dark');


        }).catch(err => {
            console.log(err);
            mensajeWishList('Ocurrio un error al agregarlo a la lista de favoritos');

        });


}

function deleteGarmentWishlist(garwis_id) {

    let url = `db_functions/garment_wishlist.php?action=delete`;

    let data = new FormData();
    data.append('garwis_id', garwis_id);

    fetch(url, {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            mensajeWishList(data.message);
            // quitar el div de la lista de favoritos
            let divGarment = document.querySelector(`.div${garwis_id}`);
            divGarment.remove();

            // checar si hay prendas en la lista de favoritos'
            let setGarment = document.getElementById('setGarment');
            if (setGarment.innerHTML == '') {
                setGarment.innerHTML = `<div class="d-flex justify-content-center">
                <img src="assets/images/wishlistEmpty.png" class="rounded-m shadow-xl" width="200">
                </div>  
                <div class="d-flex justify-content-center">
                <h5 class="font-600 opacity-50">No tienes prendas en tu lista de favoritos</h5>
                </div>`;
            }


        }).catch(err => {
            console.log(err);
            mensajeWishList('Ocurrio un error al eliminarlo de la lista de favoritos');
        });

}


function mensajeWishList(mensaje) {
    const activeWishList = document.getElementById('active-snackbar-favorites');
    activeWishList.click();
    const messageWishList = document.getElementById('messageWishList');
    messageWishList.textContent = mensaje;

}