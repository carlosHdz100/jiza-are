<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h2>Categorías</h2>
                </div>

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
                            <button onclick="view('')" class="btn btn-info me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar arrendador</button>
                        </div>
                    </div>
                </div>


                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">



                        <table class="table align-items-center mb-0" id="tabla">


                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descripción</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Imagen</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                </tr>
                            </thead>


                            <tbody>

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <!-- <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div> -->
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Vestidos</h6>

                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Elegantes y con estilo</p>
                                    </td>

                                    <td>
                                        <img src="https://img.freepik.com/foto-gratis/mujer-joven-pie-boutique-ropa-moda-ia-generativa_188544-40697.jpg?size=626&ext=jpg&ga=GA1.1.1499912648.1700211044&semt=sph" width="100px" class="img-fluid ">
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
                                            <!-- <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div> -->
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Camisas</h6>

                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Cómodas y a la moda</p>
                                    </td>

                                    <td>
                                        <img src="https://img.freepik.com/foto-gratis/linea-sueteres-cuello-tortuga-varios-colores_157027-3257.jpg?size=626&ext=jpg&ga=GA1.1.1499912648.1700211044&semt=sph" width="100px" class="img-fluid">
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
                                            <!-- <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div> -->
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Bolsos</h6>

                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Accesorios a la moda</p>
                                    </td>

                                    <td>
                                        <img src="https://img.freepik.com/fotos-premium/bolso-dama-rosa-sobre-blanco_160204-1624.jpg?size=626&ext=jpg&ga=GA1.1.1499912648.1700211044&semt=sph" width="100px" class="img-fluid">
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
                                            <!-- <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div> -->
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Zapatos</h6>

                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Pisa con estilo</p>
                                    </td>

                                    <td>
                                        <img src="https://img.freepik.com/foto-gratis/cambio-armario-primavera-sobre-naturaleza-muerta_23-2150176678.jpg?size=626&ext=jpg&ga=GA1.1.1499912648.1700211044&semt=sph" width="100px" class="img-fluid">
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
                                            <!-- <div>
                                                <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                                            </div> -->
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Gafas de Sol</h6>

                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">Mantén el estilo  y protección</p>
                                    </td>

                                    <td>
                                        <img src="https://img.freepik.com/vector-premium/coleccion-gafas-sol-realistas_23-2147803921.jpg?size=626&ext=jpg&ga=GA1.1.1499912648.1700211044&semt=ais" width="100px" class="img-fluid">
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


<script src="assets/js/src/categories.js"></script>