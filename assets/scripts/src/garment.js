function getGarment() {
    const setGarment = document.getElementById('setGarment');
    const url = 'db_functions/garment.php?action=allGarment';
    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let datos = data.data;
            let html = '';

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

                html += `<div class="card card-style mx-3 position-relative">
                <div class="position-absolute top-0 start-0 bg-highlight px-2 py-1">${item.gar_fkcat_type_publication == 1 ? 'Prenda' : 'Paquete'}</div>

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
                <span class="d-block color-gray-dark font-700">Por: ${item.usu_nombre} ${item.usu_apellido}</span>
                <div class="divider mb-2"></div>
                
                <div class="d-flex">
                <div class="align-self-center">
                <h1 class="mt-1 mb-n2 font-800">${item.gar_price}€</h1>
                </div>
                <div class="d-flex align-items-center ms-auto">

                <button type="button" onclick="addGarmentWhislist(${item.gar_id})" class="icon icon-s bg-theme rounded-l shadow-xl rounded-m ms-2 color-theme"><i class="fa fa-heart btnWishList${item.gar_id} ${isWishList == true ? 'color-red-dark' : ''} font-14"></i></button>
                <a href="#" onclick="getGarmentById(${item.gar_id})" style="width: 100%" class="ms-2 custom-btn btn-11 btn-s bg-highlight rounded-sm font-700 text-uppercase" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Rentar</a>
                </div>
                </div>
                </div>
                </div>`;

                setGarment.innerHTML = html;

            });
        })
        .catch(err => console.log(err));

}

function getPackaje() {
    const setPackaje = document.getElementById('setPackaje');
    const url = 'db_functions/garment.php?action=allPackage';
    fetch(url)
        .then(response => response.json())
        .then(data => {
            let datos = data.data;
            let html = '';


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

                html += `<div class="card card-style mx-3 position-relative">
                <div class="position-absolute top-0 start-0 bg-highlight px-2 py-1">${item.gar_fkcat_type_publication == 1 ? 'Prenda' : 'Paquete'}</div>

                <img src="${item.imagenes[0].garima_url}" class="img-fluid my-3">
                <div class="content">
                <h3 class="mb-0">${item.gar_name}</h3>
                <a href="#">
                ${estrellas}
                <span class="font-11 ps-2 color-theme opacity-30">${item.garment_qualification.promedio_calificaciones} calificación</span>
                </a>
                <h5 class="font-13 font-600 opacity-50 pt-1 pb-2">${item.gar_description}...</h5>
                <div class="divider mb-2"></div>
                <span class="d-block color-green-dark font-700">Veces rentado: ${item.times_rented > 0 ? item.times_rented : 0}</span>
                <span class="d-block color-gray-dark font-700">Por: ${item.usu_nombre} ${item.usu_apellido}</span>

                <div class="divider mb-2"></div>
                
                <div class="d-flex">
                <div class="align-self-center">
                <h1 class="mt-1 mb-n2 font-800">${item.gar_price}€</h1>
                </div>
                <div class="d-flex align-items-center ms-auto">
                <button type="button" onclick="addGarmentWhislist(${item.gar_id})" class="icon icon-s bg-theme rounded-l shadow-xl rounded-m ms-2 color-theme"><i class="fa fa-heart btnWishList${item.gar_id} ${isWishList == true ? 'color-red-dark' : ''} font-14"></i></button>
                <a href="#" onclick="getGarmentById(${item.gar_id})" data-toast="snackbar-cart" style="width: 100%" class="ms-2 custom-btn btn-11 btn-s bg-highlight rounded-sm font-700 text-uppercase" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Rentar</a>
                </div>
                </div>
                </div>
                </div>`;
            });

            setPackaje.innerHTML = html;
        })
        .catch(err => console.log(err));

}

function getAllGarment() {

}

function getGarmentAleatorio() {
}

function getPackajeAleatorio() {

}

function getGarmentById(id) {

    const url = `db_functions/garment.php?action=view&id=${id}`;

    const garName = document.getElementById('garName');
    const garImages = document.getElementById('garImages');
    const vecesRentado = document.getElementById('vecesRentado');
    const garDescription = document.getElementById('garDescription');
    const estrellas = document.getElementById('estrellas');
    const calificaciones = document.getElementById('calificaciones');
    const garPrice = document.getElementById('garPrice');
    const btnRenderCalendar = document.getElementById('btnRenderCalendar');
    garImages.innerHTML = '';
    estrellas.innerHTML = '';
    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let datos = data.message[0];
            // let isWishList = datos.is_wishlist;

            let imagenes = datos.imagenes;
            garName.textContent = datos.gar_name;

            imagenes.forEach((item, index) => {
                garImages.innerHTML += `<div class="carousel-item ${index == 0 ? 'active' : ''}">
                <img src="${item.garima_url}" class="d-block w-100" alt="...">
            </div>`;
            });

            vecesRentado.textContent = datos.times_rented > 0 ? datos.times_rented : 0;
            garDescription.textContent = datos.gar_description;

            let estrellasHtml = '';
            // poner calificacion en estrellas
            let calificacion = datos.garment_qualification.promedio_calificaciones;
            for (let i = 0; i < calificacion; i++) {
                estrellasHtml += '<i class="fa fa-star color-yellow-dark"></i>';
            }

            for (let i = 0; i < 5 - calificacion; i++) {
                estrellasHtml += '<i class="fa fa-star color-yellow-dark opacity-30"></i>';
            }

            estrellas.innerHTML = estrellasHtml;
            calificaciones.textContent = datos.garment_qualification.promedio_calificaciones;
            garPrice.textContent = `${datos.gar_price}€`;

            btnRenderCalendar.setAttribute('onclick', `renderCalendarf(${datos.gar_id})`);
        });

}

function getGarmentFiltro(category) {
    const setGarment = document.getElementById('setGarment');
    const url = 'db_functions/garment.php?action=allGarment';
    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let datos = data.data;
            let html = '';

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

                html += `<div class="card card-style mx-3">
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
                <span class="d-block color-gray-dark font-700">Por: ${item.usu_nombre} ${item.usu_apellido}</span>
                <div class="divider mb-2"></div>
                
                <div class="d-flex">
                <div class="align-self-center">
                <h1 class="mt-1 mb-n2 font-800">${item.gar_price}€</h1>
                </div>
                <div class="d-flex align-items-center ms-auto">

                <button type="button" onclick="addGarmentWhislist(${item.gar_id})" class="icon icon-s bg-theme rounded-l shadow-xl rounded-m ms-2 color-theme"><i class="fa fa-heart btnWishList${item.gar_id} ${isWishList == true ? 'color-red-dark' : ''} font-14"></i></button>
                <a href="#" onclick="getGarmentById(${item.gar_id})" style="width: 100%" class="ms-2 custom-btn btn-11 btn-s bg-highlight rounded-sm font-700 text-uppercase" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Rentar</a>
                </div>
                </div>
                </div>
                </div>`;

                setGarment.innerHTML = html;

            });
        })
        .catch(err => console.log(err));

}