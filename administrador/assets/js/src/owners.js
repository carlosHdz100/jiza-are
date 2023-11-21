createTable(1);

function createTable(status) {
    const url = `db_functions/usuario.php?action=all&status=${status}`;

    // Utilizamos DataTables para manejar la tabla
    $('#tabla').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json',
            paginate: {
                previous: "<<",
                next: ">>"
            }
        },
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: url,
            type: 'GET',
            dataType: 'json',
            dataSrc: 'data',
            error: function (xhr, status, error) {
                // Manejo de errores si la solicitud AJAX falla.

            },
        },
        columns: [{
            data: null,
            render: function (data, type, row, meta) {
                // Calcula el número de fila utilizando meta.row + 1
                return meta.row + 1;
            }
        },
        {
            data: 'null',
            render: function (data, type, row) {
                // Aquí 'data' es el objeto que representa la fila actual
                let nombre = `${row.usu_nombre} ${row.usu_apellido}`;
                return nombre;
            }
        },
        {
            data: 'use_correo',
        },
        {
            data: 'rol_nombre',
        },
        {
            data: 'null',
            render: function (data, type, row) {
                // Aquí 'data' es el objeto que representa la fila actual
                // Mostrar estatus
                let status = '';
                if (row.use_status == 1) {
                    status = `<span class="badge badge-sm bg-gradient-success">ACTIVO</span>`;
                } else {
                    status = `<span class="badge badge-sm bg-gradient-danger">INACTIVO</span>`;
                }
                return status;
            }
        },
        {
            data: 'null',
            render: function (data, type, row) {
                // Aquí 'data' es el objeto que representa la fila actual
                // Mostrar acciones
                let title = row.use_status == 1 ? '¿Desea Desactivar el usuario?' : '¿Desea activar el usuario?';
                let text = row.use_status == 1 ? 'El usuario se Desactivara de la lista' : 'El usuario se activará nuevamente';
                let confirmButtonText = row.use_status == 1 ? 'Desactivar' : 'Activar';
                let id = row.use_id;
                let isActivoBtn = row.use_status == 1 ? 'danger' : 'success';
                let isActivoIcon = row.use_status == 1 ? 'down' : 'up';

                let acciones = `
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-warning" onclick="view(${row.use_id})"><i class="fa fa-pencil"></i></button>
                    <button type="button" class="btn btn-${isActivoBtn}" onclick="showAlert('${title}', '${text}', '${confirmButtonText}', ${id})"><i class="fa fa-chevron-${isActivoIcon}"></i></button>
                </div>
                `;
                return acciones;
            }
        }
        ],
    });

    // Agregar el evento para ver la respuesta de la petición
    //  $('#tabla').on('xhr.dt', function (e, settings, json, xhr) {

    //     console.log(json);

    //  });
}

function view(id) {
    // abriri modal
    $('#modal_master').modal('show');

    if (id !== '') {

        const url = `db_functions/usuario.php?action=view`;
        let datos = new FormData();
        // Agregar el ID al FormData
        datos.append('use_id', id);
        fetch(url, {
            method: 'post',
            body: datos,
        })
            .then((res) => res.json())
            .then((data) => {

                if (data.status) {
                    const attr = {
                        modal: {
                            title: 'Modificar datos del usuario',
                            button: 'Guardar cambios',
                        },
                        form: {
                            action: 'usuario',
                            type: 'update',
                            data: data.message,
                            select: {
                                data: {
                                    use_fkrol: 'cat_rol',
                                },
                                hidden: {}

                            }
                        }
                    }

                    modalFormulario(attr);
                    // MODAL RENDERIZADO, COLOCAR DATA

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No se pudo cargar la información del usuario',
                    })
                }
            })

        return;
    }

    const attr = {
        modal: {
            title: 'Nuevo arrendador',
            button: 'Guardar arrendador',
        },
        form: {
            action: 'usuario',
            type: 'create',
            select: {
                data: {
                    use_fkrol: 'cat_rol',
                },
                hidden: {}

            },
            data: {}
        }
    }
    modalFormulario(attr);
    // MODAL RENDERIZADO, COLOCAR DATA
}

function create() {

    startLoad('');

    const form = document.querySelector('#form');
    if (form) {
        const url = `db_functions/usuario.php?action=create`;
        const formUsuario = document.querySelector('#form');
        let datos = new FormData(formUsuario);

        fetch(url, {
            method: 'post',
            body: datos,
        })
            .then((res) => res.json())
            .then((data) => {
                console.log(data);
                if (data.status) {
                    message(data.status, data.message);
                    // recargar el datatable sin recargar la pagina
                    $('#tabla').DataTable().ajax.reload();
                } else {
                    message(data.status, data.message);
                    endLoad('Volver a intentar', '')
                }
            })
    }

}

function update(id) {
    console.log(id);
    startLoad('');

    const form = document.querySelector('#form');

    if (form) {
        const url = `db_functions/usuario.php?action=update`;
        let datos = new FormData(form);
        // Agregar el ID al FormData
        datos.append('id', id);
        fetch(url, {
            method: 'post',
            body: datos,
        })
            .then((res) => res.json())
            .then((data) => {
                console.log(data);

                if (data.status) {
                    message(data.status, data.message);
                    // recargar el datatable sin recargar la pagina
                    $('#tabla').DataTable().ajax.reload();
                } else {
                    message(data.status, data.message);
                    endLoad('Volver a intentar', '')
                }
            })
        return;
    }

}

function desactivate(id) {
    const url = `db_functions/usuario.php?action=desactivate`;
    let datos = new FormData();
    // Agregar el ID al FormData
    datos.append('use_id', id);
    fetch(url, {
        method: 'post',
        body: datos,
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.status) {
                message(data.status, data.message);
                // recargar el datatable sin recargar la pagina
                $('#tabla').DataTable().ajax.reload();
            } else {
                message(data.status, data.message);
            }
        })
}

// opcion elegida para el select
function filtro() {
    let selectElement = document.getElementById('select_filtro');
    let selectedValue = selectElement.value;
    createTable(selectedValue);
}