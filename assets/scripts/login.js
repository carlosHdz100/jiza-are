function login() {

    const formLogin = document.querySelector('#form');
    const btnLogin = document.querySelector('#btnLogin');

    btnLogin.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...`;
    btnLogin.classList.add("opacity-75", "pe-none");

    const url = `processLogin.php`;
    let datos = new FormData(formLogin);

    fetch(url, {
        method: 'POST',
        body: datos
    })
        .then((res) => res.json())
        .then((data) => {
            if (data[0] == 1) {
                msgExito(data[1]);
                window.location.href = `index.php?view=`;
            } else {
                msgError(data[1]);

                btnLogin.innerHTML = `Ingresar`;
                btnLogin.classList.remove("opacity-75", "pe-none");
            }
        })


}

function register() {

    const formRegister = document.querySelector('#formRegister');
    const btnRegister = document.querySelector('#btnRegister');

    btnRegister.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...`;
    btnRegister.classList.add("opacity-75", "pe-none");

    const url = `db_functions/usuario.php?action=create`;
    let datos = new FormData(formRegister);

    fetch(url, {
        method: 'POST',
        body: datos
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.status) {
                msgExito(data.message);
                setTimeout(() => {
                    window.reload();
                }, 3000);
            } else {
                msgError(data.message);

                btnRegister.innerHTML = `Registrarse`;
                btnRegister.classList.remove("opacity-75", "pe-none");
            }
        })

}

function msgExito(mensaje) {
    const snackbar2 = document.getElementById('snackbar-1');
    var toastData = snackbar2.getAttribute('data-toast')
    var notificationToast = document.getElementById(toastData);
    var notificationToast = new bootstrap.Toast(notificationToast);
    notificationToast.show();
    snackbar2.innerHTML = mensaje;
    // Swal.fire({
    //     icon: "success",
    //     title: `${mensaje}`,
    // })
}

function msgError(mensaje) {
    const snackbar2 = document.getElementById('snackbar-2');
    var toastData = snackbar2.getAttribute('data-toast')
    var notificationToast = document.getElementById(toastData);
    var notificationToast = new bootstrap.Toast(notificationToast);
    notificationToast.show();
    snackbar2.innerHTML = mensaje;

    //console.log(mensaje);
    // Swal.fire({
    //     icon: "error",
    //     title: `${mensaje}`,
    // })
}