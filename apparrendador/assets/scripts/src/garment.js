function create() {

    const url = 'db_functions/garment.php?action=create';
    const form = document.querySelector('#form');
    let datos = new FormData(form);

    const mediaDropzoneFiles = document.getElementById('media2Dropzone').dropzone.getAcceptedFiles();
    console.log(mediaDropzoneFiles);

    // Agregar los archivos del segundo dropzone al formulario
    mediaDropzoneFiles.forEach(function (file) {
        datos.append('media[]', file);
    });


    //validar que el dropzone tenga al menos un archivo
    if (mediaDropzoneFiles.length < 1) {
        alert('Porfavor agrega al menos una imagen');
        return;
    }

    fetch(url, {
        method: 'POST',
        body: datos
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status) {
                form.reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Guardado',
                    text: data.message,
                })

                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                //sweeetAlert2 de erroR
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                })
            }
        })
        .catch(error => console.error(error));

}

function cat_type_publication() {
    const url = 'db_functions/cat_type_publication.php?action=all';
    const select = document.querySelector('#gar_fkcat_type_publication');

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                data.data.forEach(element => {
                    const option = document.createElement('option');
                    option.value = element.typpub;
                    option.text = element.typpub_name;
                    select.appendChild(option);
                });
            }
        })
        .catch(error => console.error(error));

}

function cat_person() {
    const url = 'db_functions/cat_person.php?action=all';
    const select = document.querySelector('#gar_fkcat_person');

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                data.data.forEach(element => {
                    const option = document.createElement('option');
                    option.value = element.per_id;
                    option.text = element.per_name;
                    select.appendChild(option);
                });
            }
        })
        .catch(error => console.error(error));

}

function cat_category() {
    const url = 'db_functions/cat_category.php?action=all';
    const select = document.querySelector('#gar_fkcat_category');

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                data.data.forEach(element => {
                    const option = document.createElement('option');
                    option.value = element.cat_id;
                    option.text = element.cat_name;
                    select.appendChild(option);
                });
            }
        })
        .catch(error => console.error(error));

}

function getallGarment(status) {
    const url = `db_functions/garment.php?action=allGarment&status=${status}`;
    const setGarment = document.querySelector('#setGarment');

    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status) {
                let containerHTML = '';
                data.data.forEach(item => {

                    let estrellas = '';
                    // poner calificacion en estrellas
                    let calificacion = item.garment_qualification.promedio_calificaciones;
                    for (let i = 0; i < calificacion; i++) {
                        estrellas += '<i class="fa fa-star color-yellow-dark"></i>';
                    }

                    containerHTML += `<div class="row col-12">
                        <div class="col-4 mb-4 pe-0">
                            <a href="#"><img src="${item.imagenes[0].garima_url}" class="rounded-sm shadow-xl img-fluid"></a>
                        </div>
                        <div class="col-8">
                            <a href="#" class="d-block">${estrellas}</a>
                            <a href="#">
                                <h5 class="mb-0">${item.gar_name}</h5>
                            </a>
                            <h2 class="mt-1 mb-n2 font-800">${item.gar_price} €</h2>
                        </div>
                        
                    </div>
                    <div class="row ms-1 d-flex justify-content-center">
                        <a href="?view=ver_prenda&gar_id=${item.gar_id}" class="btn btn-primary col-6"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                        <path d="M16 5l3 3" />
                      </svg> Editar</a>
                        <button class="btn btn-danger col-6" onclick="ocultarGarment(${item.gar_id})"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-cancel" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M12 18c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                        <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M17 21l4 -4" />
                      </svg>  Ocultar</button>
                    </div>
                    <div class="w-100 divider divider-margins"></div>
                    `;
                });

                setGarment.innerHTML = containerHTML;
            } else {
                setGarment.innerHTML = '<h2>No hay prendas</h2>';
            }
        })
        .catch(error => console.error(error));
}

function getallPackage(status) {
    const url = `db_functions/garment.php?action=allPackage&status=${status}`;
    const setGarment = document.querySelector('#setGarment');

    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status) {
                let containerHTML = '';
                data.data.forEach(item => {

                    let estrellas = '';
                    // poner calificacion en estrellas
                    let calificacion = item.garment_qualification.promedio_calificaciones;
                    for (let i = 0; i < calificacion; i++) {
                        estrellas += '<i class="fa fa-star color-yellow-dark"></i>';
                    }

                    containerHTML += `<div class="row col-12">
                        <div class="col-4 mb-4 pe-0">
                            <a href="#"><img src="${item.imagenes[0].garima_url}" class="rounded-sm shadow-xl img-fluid"></a>
                        </div>
                        <div class="col-8">
                            <a href="#" class="d-block">${estrellas}</a>
                            <a href="#">
                                <h5 class="mb-0">${item.gar_name}</h5>
                            </a>
                            <h2 class="mt-1 mb-n2 font-800">${item.gar_price} €</h2>
                        </div>
                        
                    </div>
                    <div class="row ms-1 d-flex justify-content-center">
                        <a href="?view=ver_prenda&gar_id=${item.gar_id}" class="btn btn-primary col-6"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                        <path d="M16 5l3 3" />
                      </svg> Editar</a>
                        <button class="btn btn-danger col-6" onclick="ocultarGarment(${item.gar_id})"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-cancel" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M12 18c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                        <path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M17 21l4 -4" />
                      </svg>  Ocultar</button>
                    </div>
                    <div class="w-100 divider divider-margins"></div>
                    `;
                });

                setGarment.innerHTML = containerHTML;
            } else {
                setGarment.innerHTML = '<h2>No hay paquetes</h2>';
            }
        })
        .catch(error => console.error(error));
}

function view(id) {
    const url = `db_functions/garment.php?action=view&id=${id}`;

    let htmlImagenes = '';

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.status) {
                const datos = data.message[0];
                const gar_name = document.querySelector('#gar_name');
                const gar_description = document.querySelector('#gar_description');
                const gar_price = document.querySelector('#gar_price');
                const gar_fkcat_type_publication = document.querySelector('#gar_fkcat_type_publication');
                const gar_fkcat_person = document.querySelector('#gar_fkcat_person');
                const gar_fkcat_category = document.querySelector('#gar_fkcat_category');
                const listImagenes = document.querySelector('#listImagenes');
                const gar_id = document.querySelector('#gar_id');
                // form.gar_id.value = data.data.gar_id;
                gar_name.value = datos.gar_name;
                gar_description.value = datos.gar_description;
                gar_price.value = datos.gar_price;
                gar_fkcat_type_publication.value = datos.gar_fkcat_type_publication;
                gar_fkcat_person.value = datos.gar_fkcat_person;
                gar_fkcat_category.value = datos.gar_fkcat_category;
                gar_id.value = datos.gar_id;




                // Agregar las imagenes al dropzone
                datos.imagenes.forEach(function (file) {
                    htmlImagenes += ` <div class="col mb-4 position-relative" data-gallery="gallery-1" href="#" title="Vynil and Typerwritter">
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger fw-2">
                    x
                    <span class="visually-hidden"></span>
                </span>
                    <img src="${file.garima_url}" data-src="${file.garima_url}" class="img-fluid rounded-m preload-img entered loaded" alt="img" data-ll-status="loaded">
                </div>`;
                });

                listImagenes.innerHTML = htmlImagenes;

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                })
            }
        })
        .catch(error => console.error(error));

}

function update() {

    const url = 'db_functions/garment.php?action=update';
    const form = document.querySelector('#form');
    let datos = new FormData(form);

    const mediaDropzoneFiles = document.getElementById('media2Dropzone').dropzone.getAcceptedFiles();
    console.log(mediaDropzoneFiles);

    // Agregar los archivos del segundo dropzone al formulario
    mediaDropzoneFiles.forEach(function (file) {
        datos.append('media[]', file);
    });


    fetch(url, {
        method: 'POST',
        body: datos
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status) {
                form.reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Guardado',
                    text: data.message,
                })

                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                //sweeetAlert2 de erroR
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message,
                })
            }
        })
        .catch(error => console.error(error));

}
