createCards(1);

function createCards(status) {
    const url = `db_functions/cat_category.php?action=all&status=${status}`;
    const listCategory = document.querySelector('#listCategory');
    // hacemos la peticion fetch a la url
    fetch(url)
        .then((res) => res.json())
        .then((data) => {
            let datos = data.data;
            if (data.status) {
                // recorremos el array de objetos
                let html = '';
                datos.forEach((item) => {
                    // creamos el elemento card
                    html += `<a href="?view=ver_todo&category=${item.cat_name}" class="col-6 p-0">
                    <div class="card card-style">
                    <div class="card-top">
                    <!-- <span class="bg-pink-dark float-end me-2 mt-2 px-2 font-600 line-height-s rounded-xs d-block font-10">OFERTA</span> -->
                    </div>
                    <img src="${item.cat_image}" class="card-img-top img-fluid">
                    <h1 class="pt-4 font-22">${item.cat_name}</h1>
                    </div>
                    </a>`;
                    
                });
                listCategory.innerHTML = html;
            } else {
                listCategory.innerHTML = `<div class="alert alert-danger" role="alert">
                ${data.message}
                </div>`;
            }
        }).catch((err) => {
            console.log(err);
        }) // catch por si hay algun error
}

// function view(id) {
//     // abriri modal
//     $('#modal_master').modal('show');

//     if (id !== '') {

//         const url = `db_functions/operator.php?action=view`;
//         let datos = new FormData();
//         // Agregar el ID al FormData
//         datos.append('id', id);
//         fetch(url, {
//             method: 'post',
//             body: datos,
//         })
//             .then((res) => res.json())
//             .then((data) => {

//                 if (data.status) {
//                     const attr = {
//                         modal: {
//                             title: 'Modificar datos del operador',
//                             button: 'Guardar cambios',
//                         },
//                         form: {
//                             action: 'operator',
//                             type: 'update',
//                             data: data.message,
//                             select: {
//                                 data: {
//                                     ope_fkstatus_infonavit: 'cat_status_infonavit'
//                                 },
//                                 hidden: {}
//                             }
//                         }
//                     }

//                     modalFormulario(attr);
//                     // MODAL RENDERIZADO, COLOCAR DATA

//                 } else {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Oops...',
//                         text: 'No se pudo cargar la información del operador',
//                     })
//                 }
//             })

//         return;
//     }

//     const attr = {
//         modal: {
//             title: 'Nuevo operador',
//             button: 'Guardar operador',
//         },
//         form: {
//             action: 'operator',
//             type: 'create',
//             select: {
//                 data: {
//                     ope_fkstatus_infonavit: 'cat_status_infonavit'
//                 },
//                 hidden: {}
//             },
//             data: {}
//         }
//     }
//     modalFormulario(attr);
//     // MODAL RENDERIZADO, COLOCAR DATA
// }

// function create() {

//     startLoad('');

//     const form = document.querySelector('#form');
//     if (form) {
//         const url = `db_functions/operator.php?action=create`;
//         const formUsuario = document.querySelector('#form');
//         let datos = new FormData(formUsuario);

//         for (const [clave, valor] of datos.entries()) {
//             console.log(`Clave: ${clave}, Valor: ${valor}`);
//         }

//         fetch(url, {
//             method: 'post',
//             body: datos,
//         })
//             .then((res) => res.json())
//             .then((data) => {
//                 console.log(data);
//                 if (data.status) {
//                     message(data.status, data.message);
//                     // recargar el datatable sin recargar la pagina
//                     $('#tabla').DataTable().ajax.reload();
//                 } else {
//                     message(data.status, data.message);
//                     endLoad('Volver a intentar', '')
//                 }
//             })
//     }

// }

// function update(id) {
//     console.log(id);
//     startLoad('');

//     const form = document.querySelector('#form');

//     if (form) {
//         const url = `db_functions/operator.php?action=update`;
//         let datos = new FormData(form);
//         // Agregar el ID al FormData
//         datos.append('id', id);
//         fetch(url, {
//             method: 'post',
//             body: datos,
//         })
//             .then((res) => res.json())
//             .then((data) => {
//                 console.log(data);

//                 if (data.status) {
//                     message(data.status, data.message);
//                     // recargar el datatable sin recargar la pagina
//                     $('#tabla').DataTable().ajax.reload();
//                 } else {
//                     message(data.status, data.message);
//                     endLoad('Volver a intentar', '')
//                 }
//             })
//         return;
//     }

// }

// function desactivate(id) {
//     const url = `db_functions/operator.php?action=desactivate`;
//     let datos = new FormData();
//     // Agregar el ID al FormData
//     datos.append('ope_id', id);
//     fetch(url, {
//         method: 'post',
//         body: datos,
//     })
//         .then((res) => res.json())
//         .then((data) => {
//             if (data.status) {
//                 message(data.status, data.message);
//                 // recargar el datatable sin recargar la pagina
//                 $('#tabla').DataTable().ajax.reload();
//             } else {
//                 message(data.status, data.message);
//             }
//         })
// }

// opcion elegida para el select
// function filtro() {
//     let selectElement = document.getElementById('select_filtro');
//     let selectedValue = selectElement.value;
//     createTable(selectedValue);
// }