function getMiCarrito() {

    let url = `db_functions/cart.php?action=verMiCarrito`;

    let setCarrito = document.getElementById('setCarrito');
    let html = '';
    setCarrito.innerHTML = '';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let datos = data.data;

            if (data.status) {

                datos.forEach((item, index) => {
                    let allDates = item.added_days; // Array de fechas
                    let datesJoined = allDates.map(function (date, index) {
                        return `Fecha ${index + 1}: ${date} <br>`;
                    }).join('');

                    let count = allDates.length;

                    let busy_days = item.busy_days; // Array de fechas

                    let classDisabled = '';
                    let textAlert = '';
                    if (busy_days.length > 0) {
                        classDisabled = 'miDiv';
                        textAlert = `<div class="alert alert-danger" role="alert"> Algunas fechas seleccioandas ya no estan disponibles</div>`;
                    }

                    html += `<div class="d-flex mb-4 ${classDisabled}">
                    <div>
                        <img src="${item.img_garment[0].garima_url}" class="rounded-m shadow-xl" width="80">
                    </div>
                    <div class="ms-3">
                        <h5 class="font-600 opacity-50">${item.gar_name}</h5>
                        <div class="d-flex justify-content-between align-items-center">
                        <h4 class="pt-1 color-highlight">${item.gar_price}€</h4>
                        <span class="text-muted">(${count} dias)</span>
                        </div>
                        <span type="button" class="text-info d-flex align-items-center" title="Dias rentados" data-toggle="popover" data-bs-content="${datesJoined}"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                      </svg>Ver dias rentados</span>
                    </div>
                </div> ${textAlert} <button onclick="deleteGarment(${item.gar_id})" class="w-100 btn btn-full bg-danger btn-m text-uppercase font-800 rounded-sm text-white">Eliminar</button> <hr>`;
                });
            } else {
                html += `<div class="d-flex justify-content-center">
                <img src="assets/images/empty-cart.png" class="rounded-m shadow-xl" width="200">
                </div>
                <div class="d-flex justify-content-center">
                <h5 class="font-600 opacity-50">No tienes prendas en tu carrito</h5>
                </div>`;

            }


            setCarrito.innerHTML = html;

            $('[data-toggle="popover"]').popover({
                html: true // Permitir HTML dentro del contenido del popover si es necesario
            });
        })
    // .catch(err => console.log(err));


}

function deleteGarment(garment_id) {
    let url = `db_functions/cart.php?action=delete`;

    let data = new FormData();
    data.append('garment_id', garment_id);


    fetch(url, {
        method: 'POST',
        body: data
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status) {
                getMiCarrito();
            }
        })

}