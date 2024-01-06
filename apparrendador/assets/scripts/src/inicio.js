ingresoArrendador();
function ingresoArrendador() {
    const monto = document.getElementById('monto');

    const url = "db_functions/rent.php?action=ingresoArrendador";
    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status) {
                monto.textContent = data.total;
            } else {
                monto.textContent = 0;
            }
        })
        .catch(error => console.log(error));

}

function listarRentas(status) {
    const listRentasProceso = document.getElementById('listRentasProceso');
    listRentasProceso.innerHTML = ``;
    const url = `db_functions/rent.php?action=all&status=${status}`;
    console.log(url);
    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status) {
                data.data.forEach(item => {
                    listRentasProceso.innerHTML += `
                    <div class="card">
                    <div class="content mb-4">
                        <h3>ID: rent-${item.ren_id}</h3>
                        <div class="divider"></div>
                        <div class="d-flex">
                            <div class="w-35 border-right pe-3 border-red-dark">
                                <img src="assets/images/user.png" data-src="images/pictures/faces/4s.png" width="80" class="rounded-circle preload-img entered loaded" data-ll-status="loaded">
                                <h6 class="font-14 font-600 mt-2 text-center">${item.usu_nombre} ${item.usu_apellido}</h6>
                                <p class="color-red-dark mt-n1 font-9 font-400 text-center mb-0 pb-0">Cliente</p>
                            </div>
                                <div class="row mb-0">
                                    <div class="col-12">
                                        <p class="mb-0 pb-3 fw-bold fs-5"><i class="fa fa-coins color-green-dark me-2"></i>${item.ren_amount} €</p>
                                    </div>
                                    <div class="col-12">
                                        <p class="mb-0 pb-3"><i class="fa fa-calendar-alt me-2 color-yellow-dark"></i>${item.ren_create_at}</p>
                                    </div>
                                    <div class="col-12">
                                    <a href="#" onclick="viewRenta(${item.ren_id})" data-menu="menu-transaction-1" class="btn shadow-bg shadow-bg-m btn-m btn-full mb-3 rounded-s text-uppercase font-900 shadow-s bg-green-dark">Ver mas</a>                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <hr>
                `;
                });

                setTimeout(() => {
                    goModalesPWA();
                }, 200);
            } else {
                listRentasProceso.innerHTML = `
            <tr>
                <td colspan="6">No encontramos resultados</td>
            </tr>
            `;
            }
        })
        .catch(error => console.log(error));

}

function viewRenta(id) {

    const url = `db_functions/rent.php?action=viewRenta&id=${id}`;
    console.log(url);
    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status) {
                let renta = data.message[0];
                console.log(renta);
                const usu_name = document.getElementById('usu_name');
                const dateStart = document.getElementById('dateStart');
                const dateEnd = document.getElementById('dateEnd');
                const urlPrendas = document.getElementById('urlPrendas');
                const ren_amount = document.getElementById('ren_amount');
                const rent_id = document.getElementById('rent_id');
                const usu_telefono = document.getElementById('usu_telefono');
                const usu_telefono2 = document.getElementById('usu_telefono2');
                const usu_telefono3 = document.getElementById('usu_telefono3');
                const codigoEntrega = document.getElementById('codigoEntrega');

                usu_name.textContent = `${renta.usu_nombre} ${renta.usu_apellido}`;
                dateStart.textContent = renta.fechas_rentadas[0].gardat_date;
                dateEnd.textContent = `${renta.fechas_rentadas[renta.fechas_rentadas.length - 1].gardat_date}`;
                urlPrendas.setAttribute('href', `prendas.php?ver_renta=&prenda=${renta.gar_id}`);
                ren_amount.textContent = `${renta.ren_amount} €`;
                rent_id.textContent = `rent-${renta.ren_id}`;
                usu_telefono.setAttribute('href', `https://wa.me/${renta.usu_telefono}`);
                usu_telefono2.setAttribute('href', `tel:${renta.usu_telefono}`);
                usu_telefono3.textContent = renta.usu_telefono;

                if (renta.codigo_rentado == false && renta.ren_status == 0) {
                    codigoEntrega.innerHTML = codigoEntregaArrendador(renta.ren_id);

                    OTPInput();
                } else if (renta.codigo_rentado == true && renta.ren_status == 3) {

                    codigoEntrega.innerHTML = `<button class="btn btn-warning w-100" onclick="finalizarRenta(${renta.ren_id})"> Finalizar renta </button>`;
                } else {
                    codigoEntrega.innerHTML = '';
                }

                if (renta.ren_status == 1) {
                    usu_telefono2.classList.add('d-none');
                    usu_telefono3.classList.add('d-none');
                    usu_telefono.classList.add('d-none');
                }else{
                    usu_telefono2.classList.remove('d-none');
                    usu_telefono3.classList.remove('d-none');
                    usu_telefono.classList.remove('d-none');
                }

            } else {
                alert('No se pudo cargar la información');
            }
        })

}

function codigoEntregaArrendador(ren_id) {
    let html = `<div class="d-flex align-items-center justify-content-center h-100">
        <div class="log-in-box">
            <div class="log-in-title">
                <h3 class="text-title">Porfavor ingresa el PIN que te proporcinara el cliente para confirmar la entrega de la prenda</h3>
            </div>

            <div id="otp" class="inputs d-flex flex-row justify-content-center">
                <input class="text-center form-control rounded" type="text" id="first" maxlength="1" placeholder="0">
                <input class="text-center form-control rounded" type="text" id="second" maxlength="1" placeholder="0">
                <input class="text-center form-control rounded" type="text" id="third" maxlength="1" placeholder="0">
                <input class="text-center form-control rounded" type="text" id="fourth" maxlength="1" placeholder="0">
                <input class="text-center form-control rounded" type="text" id="fifth" maxlength="1" placeholder="0">
                <input class="text-center form-control rounded" type="text" id="sixth" maxlength="1" placeholder="0">
            </div>

            <!--<div class="send-box pt-4">
                <h5>Didn't get the code? <a href="javascript:void(0)" class="theme-color fw-bold">Resend
                        It</a></h5>
            </div>-->	

            <button onclick="entregarPrenda(${ren_id})" class="btn btn-info w-100 mt-3" type="button">Validar y entregar</button>
        </div>
    </div>`;

    return html;

}

function entregarPrenda(ren_id) {
    let codigo = '';
    const inputs = document.querySelectorAll("#otp > *[id]");
    for (let i = 0; i < inputs.length; i++) {
        codigo += inputs[i].value;
    }

    const url = `db_functions/rent.php?action=entregarPrenda`;
    let datos = new FormData();
    datos.append('ren_id', ren_id);
    datos.append('codigo', codigo);
    fetch(url, {
        method: 'POST',
        body: datos
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.status) {
                alert('Prenda entregada');
                location.reload();
            } else {
                alert(data.message);
            }
        })
}

function finalizarRenta(ren_id) {

    // preguntar con sweetAlert si esta seguro de finalizar la renta
    Swal.fire({
        title: '¿Estas seguro?',
        text: "Una vez finalizada la renta no se podra revertir",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, finalizar'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = `db_functions/rent.php?action=finalizarRenta`;
            let datos = new FormData();
            datos.append('ren_id', ren_id);
            fetch(url, {
                method: 'POST',
                body: datos
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status) {
                        alert('Renta finalizada');
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
        }
    })

}

function OTPInput() {
    const inputs = document.querySelectorAll("#otp > *[id]");
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener("keydown", function (event) {
            if (event.key === "Backspace") {
                inputs[i].value = "";
                if (i !== 0) inputs[i - 1].focus();
            } else {
                if (i === inputs.length - 1 && inputs[i].value !== "") {
                    return true;
                } else if (event.keyCode > 47 && event.keyCode < 58) {
                    inputs[i].value = event.key;
                    if (i !== inputs.length - 1) inputs[i + 1].focus();
                    event.preventDefault();
                } else if (event.keyCode > 64 && event.keyCode < 91) {
                    inputs[i].value = String.fromCharCode(event.keyCode);
                    if (i !== inputs.length - 1) inputs[i + 1].focus();
                    event.preventDefault();
                }
            }
        });
    }
}