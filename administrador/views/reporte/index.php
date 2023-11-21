<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h2>Resumen de rentas</h2>
                </div>


                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4>Filtro de búsqueda</h4>
                                <button onclick="resetForm('form')" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-reload" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M19.933 13.041a8 8 0 1 1 -9.925 -8.788c3.899 -1 7.935 1.007 9.425 4.747"></path>
                                        <path d="M20 4v5h-5"></path>
                                    </svg></button>
                            </div>

                            <form id="form" class="row" onsubmit="createFilterTable(); return false;">
                                <div class="col-md-6">
                                    Desde
                                    <input class="form-control form-control-lg" type="date" id="rangoFechasInicio" name="rangoFechasInicio" placeholder=".form-control-lg" aria-label=".form-control-lg example">
                                </div>
                                <div class="mb-3 col-md-6">
                                    Hasta
                                    <input class="form-control form-control-lg" type="date" id="rangoFechasFin" name="rangoFechasFin" placeholder=".form-control-lg" aria-label=".form-control-lg example">
                                </div>
                                <button type="submit" id="btnSubmit" class="btn btn-dark" style="width:100%;">Consultar</button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Usuario</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha de creación</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Monto</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha de inicio</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha final</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                </tr>
                            </thead>


                            <tbody>

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Javier</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">05/07/2023</span>
                                    </td>

                                    <td class="align-middle">
                                        <span class="text-xs font-weight-bold">5000€</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">06/07/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">13/07/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Finalizado</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <a type="button" class="btn btn-success" href="?view=ver_reporte"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Francisco</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">08/04/2023</span>
                                    </td>

                                    <td class="align-middle">
                                        <span class="text-xs font-weight-bold">1000€</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">09/04/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">20/04/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-danger">Cancelado</span>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <a type="button" class="btn btn-success" href="?view=ver_reporte"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Paola</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">20/08/2023</span>
                                    </td>

                                    <td class="align-middle">
                                        <span class="text-xs font-weight-bold">45000€</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">23/08/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">27/07/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-secondary">En proceso</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <a type="button" class="btn btn-success" href="?view=ver_reporte"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Karla</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">15/02/2023</span>
                                    </td>

                                    <td class="align-middle">
                                        <span class="text-xs font-weight-bold">20000€</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">17/02/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">25/07/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-primary">Entregado</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <a type="button" class="btn btn-success" href="?view=ver_reporte"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Luis</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">09/11/2023</span>
                                    </td>

                                    <td class="align-middle">
                                        <span class="text-xs font-weight-bold">7000€</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">28/11/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">30/11/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-warning">No entregado</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <a type="button" class="btn btn-success" href="?view=ver_reporte"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Martín</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">05/07/2023</span>
                                    </td>

                                    <td class="align-middle">
                                        <span class="text-xs font-weight-bold">5000€</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">06/07/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">13/07/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Finalizado</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <a type="button" class="btn btn-success" href="?view=ver_reporte"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Ana</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">08/04/2023</span>
                                    </td>

                                    <td class="align-middle">
                                        <span class="text-xs font-weight-bold">1000€</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">09/04/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">20/04/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-danger">Cancelado</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <a type="button" class="btn btn-success" href="?view=ver_reporte"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Rosa</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">20/08/2023</span>
                                    </td>

                                    <td class="align-middle">
                                        <span class="text-xs font-weight-bold">45000€</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">23/08/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">27/07/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-secondary">En proceso</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <a type="button" class="btn btn-success" href="?view=ver_reporte"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Raúl</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">15/02/2023</span>
                                    </td>

                                    <td class="align-middle">
                                        <span class="text-xs font-weight-bold">20000€</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">17/02/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">25/07/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-primary">Entregado</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <a type="button" class="btn btn-success" href="?view=ver_reporte"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Ángel</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">09/11/2023</span>
                                    </td>

                                    <td class="align-middle">
                                        <span class="text-xs font-weight-bold">7000€</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">28/11/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold">30/11/2023</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-warning">No entregado</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <a type="button" class="btn btn-success" href="?view=ver_reporte"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>