
function modalFormulario(attr) {
    const renderModal = document.querySelector('#renderModal');
    const url = `views/${attr.form.action}/${attr.form.formArchive == undefined ? 'form' : attr.form.formArchive}.php`;

    fetch(url)
        .then((res) => res.text())
        .then((data) => {
            const titleModal = document.querySelector('#titleModal');
            const modalDialog = document.querySelector('.modal_master_config');
            titleModal.textContent = attr.modal.title;
            renderModal.innerHTML = data;

            if (attr.modal.size !== undefined) {
                modalDialog.classList.add(`modal-${attr.modal.size}`);
            } else {
                modalDialog.classList.add('modal-s');
            }

            const btnModal = document.querySelector('#btnSubmit');
            const form = document.querySelector('#form');
            form.setAttribute('onsubmit', `${attr.form.type}(); return false;`);
            btnModal.textContent = attr.modal.button;

            let dataForm = attr.form.data;
            let dataSelect = attr.form.select.data;
            let dataSelectHidden = attr.form.select.hidden;

            if (Object.entries(dataForm).length !== 0) {

                Object.entries(dataForm).forEach(([key, value]) => {
                    const element = document.querySelector(`#${key}`);

                    if (element) {
                        if (element.tagName === "SELECT") {
                            Object.entries(dataSelect).forEach(([keySelect, valueSelect]) => {
                                if (key === keySelect) {
                                    if (element.multiple) {
                                        selectDinamicMultiple(key, valueSelect, value, attr.form.id, attr.form.action, dataSelectHidden[keySelect]);
                                    } else {

                                        selectDinamic(key, valueSelect, value, dataSelectHidden[keySelect], attr.form.id);
                                    }
                                }
                            });
                        }
                        element.value = value;
                    }
                });
            } else if (Object.entries(dataSelect).length !== 0) {
                Object.entries(dataSelect).forEach(([key, value]) => {

                    if (document.querySelector('.js-example-basic-single') || document.querySelector('.js-example-basic-multiple')) {
                        setTimeout(() => {
                            select2(key, value, dataSelectHidden[key], '')
                        }, 200);

                    } else {
                        selectDinamic(key, value, undefined, dataSelectHidden[key], attr.form.id);
                    }

                });
            }
            formWizard();
        });
}

function selectDinamicMultiple(select, table, optionSelect, id, tableSelected, hidden) {

    const url1 = `db_functions/${tableSelected}.php?action=selected`;
    let datos = new FormData();
    datos.append('id', id);

    fetch(url1, {
        method: 'POST',
        body: datos
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.status) {
                const values = Object.values(data.data).map(obj => Object.values(obj)[0]);

                const selectElement = document.querySelector(`#${select}`);
                const url = `db_functions/${table}.php?action=all`;

                fetch(url)
                    .then((res) => res.json())
                    .then((data) => {
                        if (data.status) {
                            let datos = data.data;
                            let valores = datos.map(obj => Object.values(obj));

                            valores.forEach((par, index) => {
                                const option = document.createElement("option");
                                option.value = par[0];
                                option.textContent = par[1];

                                if (values.length !== 0 && values.includes(par[0])) {
                                    option.selected = true;
                                }

                                selectElement.appendChild(option);
                            });

                            if (document.querySelector(`.js-example-basic-multiple`)) {
                                $('.js-example-basic-multiple').select2();
                            }
                        }
                    });
            } else {

                // if (document.querySelector('.js-example-basic-single')) {
                //     select2(select, table, hidden)
                // } else {
                selectDinamic(select, table, optionSelect, hidden, '')
                //}

            }
        });
}

function selectDinamic(select, table, optionSelect, hidden, id) {
    const selectElement = document.querySelector(`#${select}`);
    const url = `db_functions/${table}.php?action=all&id=${optionSelect}`;

    fetch(url)
        .then((res) => res.json())
        .then((data) => {
            if (data.status) {
                let datos = '';
                if (data.message == '') {
                    datos = data.data;
                } else {
                    datos = data.message;
                }

                datos.forEach((par) => {
                    let valores = Object.values(par);

                    const option = document.createElement("option");
                    option.value = valores[0];
                    option.textContent = valores[1];

                    if (optionSelect !== undefined && optionSelect == valores[0]) {
                        option.selected = true;
                    }

                    selectElement.appendChild(option);
                });

                // selectElement.appendChild(option);

                if (document.querySelector(`.js-example-basic-single`)) {
                    setTimeout(() => {
                        select2(select, table, undefined, undefined)
                    }, 200);

                }
            }
        });
}

function showAlert(title, text, confirmButtonText, id) {
    // sweert alert
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmButtonText,
        cancelButtonText: 'cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            desactivate(id);
        }
    })
}

function message(type, text_message) {
    // cerrar modal
    if (type) {
        $('#modal_master').modal('hide');
    }
    Swal.fire({
        position: 'top-end',
        icon: `${type ? 'success' : 'error'}`,
        title: text_message,
        showConfirmButton: false,
        timer: 1500
    })
}

function startLoad(btn) {

    let btnSubmit;

    if (btn == '') {
        btnSubmit = document.querySelector('#btnSubmit');
    } else {
        btnSubmit = document.querySelector(`#${btn}`);
    }

    btnSubmit.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></>`;
    btnSubmit.classList.add("opacity-75", "pe-none");
}

function endLoad(text, btn) {
    let btnSubmit;

    if (btn == '') {
        btnSubmit = document.querySelector('#btnSubmit');
    } else {
        btnSubmit = document.querySelector(`#${btn}`);
    }

    btnSubmit.innerHTML = `${text}`;
    btnSubmit.classList.remove("opacity-75", "pe-none");
}

function procesoLogout() {
    fetch('processLogout.php')
        .then((res) => res.json())
        .then((data) => {
            window.location.href = 'index.php';
        })
}

function select2(select, table, hidden, extra) {

    $(`#${select}`).select2({

        dropdownParent: $('#modal_master').hasClass('show') == true ? $('#modal_master .modal-body') : '',

        ajax: {
            url: `db_functions/${table}.php?action=allSelect2&tipo=${extra}`, // URL del archivo PHP que manejará la búsqueda
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    search: params.term,
                };
            },
            processResults: function (data) {

                return {
                    results: data,
                };
            },
            cache: true,
        },

        minimumInputLength: 1,
        dropdownParent: $('#modal_master').hasClass('show') == true ? $('#modal_master') : '',

        language: {
            inputTooShort: function () {
                return "Por favor, ingrese 1 o más caracteres";
            },
            // Otras traducciones...
        }
    });

}

function formWizard() {

    // Verificar si todas las clases necesarias están presentes
    if (!document.querySelector('.step') || !document.querySelector('.next-step') || !document.querySelector('.prev-step')) {
        console.error('Faltan clases necesarias en el documento. No se puede continuar.');
        return;
    }

    // Funcion para formulario de multipasos
    let currentStep = 1;

    // Ocultar todos los pasos excepto el primero
    let steps = document.querySelectorAll('.step');
    for (let i = 0; i < steps.length; i++) {
        if (steps[i].getAttribute('data-step') !== '1') {
            steps[i].setAttribute('style', 'display:none');
        }
    }

    // Avanzar al siguiente paso
    let nextButtons = document.querySelectorAll('.next-step');
    for (let i = 0; i < nextButtons.length; i++) {
        nextButtons[i].addEventListener('click', function () {
            let nextStep = currentStep + 1;
            document.querySelector('[data-step="' + currentStep + '"]').style.display = 'none';
            document.querySelector('[data-step="' + nextStep + '"]').style.display = 'block';
            currentStep = nextStep;
        });
    }

    // Retroceder al paso anterior
    let prevButtons = document.querySelectorAll('.prev-step');
    for (let i = 0; i < prevButtons.length; i++) {
        prevButtons[i].addEventListener('click', function () {
            let prevStep = currentStep - 1;
            document.querySelector('[data-step="' + currentStep + '"]').style.display = 'none';
            document.querySelector('[data-step="' + prevStep + '"]').style.display = 'block';
            currentStep = prevStep;
        });
    }
}
