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
                    window.reload();
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