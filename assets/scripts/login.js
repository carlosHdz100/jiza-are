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

function msgExito(mensaje) {
    console.log(mensaje);
    // Swal.fire({
    //     icon: "success",
    //     title: `${mensaje}`,
    // })
}

function msgError(mensaje) {
    console.log(mensaje);
    // Swal.fire({
    //     icon: "error",
    //     title: `${mensaje}`,
    // })
}