<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h2>Usuarios</h2>

                </div>


                <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button onclick="view('')" class="btn btn-info me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar nuevo</button>
                </div> -->

                <div class="row container">
                    <div class="col-lg-6">
                        <select class="form-select" id="select_filtro" onchange="filtro()">
                            <option value="1">Activos</option>
                            <option value="0">Inactivos</option>
                            <option value="2">Todos</option>
                        </select>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-end">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end col-lg-6">
                            <button onclick="view('')" class="btn btn-info me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar usuario</button>
                        </div>
                    </div>
                </div>


                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">



                        <table class="table align-items-center mb-0" id="tabla">


                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Correo</th>
                                    <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rol</th> -->
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
                                                <h6 class="mb-0 text-sm">Alejandro</h6>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">admin@admin.com</p>
                                    </td>
                                    
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Activo</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger"><i class="fa fa-chevron-down"></i></button>
                                        </div>
                                    </td>

                                    <!-- <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#editar_usuario">
                                            Editar
                                        </a>
                                        |
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#pre_eliminar">
                                            Eliminar
                                        </a>
                                    </td> -->
                                </tr>


                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Carlos</h6>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">admin@admin.com</p>
                                    </td>
                                    
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-danger">No activo</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger"><i class="fa fa-chevron-down"></i></button>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Felipe</h6>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">admin@admin.com</p>
                                    </td>
                            
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Activo</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger"><i class="fa fa-chevron-down"></i></button>
                                        </div>
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
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">admin@admin.com</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-danger">No activo</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger"><i class="fa fa-chevron-down"></i></button>
                                        </div>
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
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">admin@admin.com</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">Activo</span>
                                    </td>

                                    <td class="align-middle text-center text-sm">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                            <button type="button" class="btn btn-danger"><i class="fa fa-chevron-down"></i></button>
                                        </div>
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


<script src="assets/js/src/usuarios.js"></script>