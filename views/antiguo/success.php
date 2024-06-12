<div class="page-content">

    <div class="container-fluid d-flex flex-column  align-items-center justify-content-center" style="min-height: 400px;background-color: #00a650">
        <h1 class="color-white">Felicidades <?= $usuario->usu_nombre ?></h1>
        <h2 class="color-white">Tu renta se ha realizado con éxito</h2>
        <!-- <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-discount-check" width="76" height="76" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1" />
            <path d="M9 12l2 2l4 -4" />
        </svg> -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="76" height="76" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
            <path d="M9 12l2 2l4 -4" />
        </svg>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <a href="?view=renta_detalle&rent_id=1" type="button" class="btn btn-outline-primary me-5 p-3 ">Ver mi renta</a>

        <a href="?view=" type="button" class="btn btn-outline-primary p-3">Ir al inicio</a>
    </div>

</div>