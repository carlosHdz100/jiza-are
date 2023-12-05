<a href="?view=inicio" class="btn btn-outline-primary btn-sm mb-2"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-arrow-back-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M9 14l-4 -4l4 -4" />
        <path d="M5 10h11a4 4 0 1 1 0 8h-1" />
    </svg> Volver
</a>


<div class="col-md-12 mb-lg-0 mb-4">
    <div class="card mt-4">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="mb-0">Información de la renta<span id="infoLiq" class="fw-bold"><?= $liquidacionId ?></span></h5>
                </div>
                <!-- <div class="col-6 text-end">
                    <a class="btn bg-gradient-warning mb-0 editLiq" onclick="formEditarLiquidacion(<?= $liquidacionId ?>)" href="javascript:;"><i class="fas fa-pencil-alt" aria-hidden="true"></i>&nbsp;&nbsp;Editar</a>
                </div> -->
            </div>
        </div>
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-6 mb-md-0 mb-4">
                    <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre del artículo: </strong> &nbsp;<span class="fw-bold">Camisa</span> </li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Monto:</strong> &nbsp;<span id="" class="fw-bold">15€</span></li>
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Fecha Inico: </strong> &nbsp;<span class="fw-bold" id="">06/07/2023</span> </li>
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Fecha Entrega: </strong> &nbsp;<span class="fw-bold" id="">13/07/2023</span> </li>
                            <!-- <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Estatus:</strong> &nbsp; <div id="liq_status"></div> -->
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Cliente(s):</strong> &nbsp;<span class="fw-bold" id="">Antonio Arce Olivera</span> </li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Contacto del cliente:</strong> &nbsp;<span id="" class="fw-bold">9999999999</span></li>
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Arrendador: </strong> &nbsp;<span class="fw-bold">Joel Legaspi Valenzuela</span> </li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Contacto del arrendador:</strong> &nbsp;<span class="fw-bold" id="">9999999999</span> </li>
                            <!-- <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Estatus:</strong> &nbsp; <div id="liq_status"></div> -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>