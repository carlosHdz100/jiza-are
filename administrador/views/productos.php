
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Prendas</h6>
              
            </div>


            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button class="btn btn-info me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#agregar-producto">Agregar nueva prenda</button>
</div>


            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
              
              
              
              <table class="table align-items-center mb-0">


                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Código caja</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Código pieza</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de productos</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Categoría</th>
                     
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>


                  <tbody>
                   
                  <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          

                        <!--
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                          </div>
-->


                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Producto A</h6>

                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">3472389479</p>
                    
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">9738382372283383</p>
                    
                      </td>


                      <td>
                        <p class="text-xs font-weight-bold mb-0">CAJA</p>
                      </td>

                      <td>
                        <p class="text-xs font-weight-bold mb-0">HIGIENE PERSONAL</p>
                      </td>


               

                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Activo</span>
                      </td>
                 
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#editar-producto">
                          Editar
                        </a>
                         | 
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#eliminar-producto">
                          Eliminar
                        </a>
                      </td>

                      

                    </tr>


                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          

                        <!--
                        <div>
                            <img src="https://cdn-icons-png.flaticon.com/512/6073/6073874.png" class="avatar avatar-sm me-3" alt="user1">
                          </div>
-->


                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Producto A</h6>

                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">3472389479</p>
                    
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">9738382372283383</p>
                    
                      </td>


                      <td>
                        <p class="text-xs font-weight-bold mb-0">CAJA</p>
                      </td>

                      <td>
                        <p class="text-xs font-weight-bold mb-0">HIGIENE PERSONAL</p>
                      </td>


               

                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Activo</span>
                      </td>
                 
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#editar-producto">
                          Editar
                        </a>
                         | 
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#eliminar-producto">
                          Eliminar
                        </a>
                      </td>

                      

                    </tr>





                   




                    




                  
                  
                  
                 




                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
     
     
     
     
    <!-- EMPIEZAN MODALES -->


    <!-- Modal crear usuario -->
<div class="modal fade" id="agregar-producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      


      <form action="" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Código caja</label>
    <input type="text" name="usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Código pieza</label>
    <input type="text" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Dirección</label>
    <input type="text" name="direccion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>



  <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
  <option selected>Tipo producto</option>
  <option value="1">Caja</option>
  <option value="2">Pieza</option>
</select>




<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
  <option selected>Categoria</option>
  <option value="1">Embutidos</option>
  <option value="2">Higiene personal</option>
  <option value="2">Dulcería</option>
</select>







(OCULTO)
  <input type="text" name="tipo_usuario" class="form-control" id="exampleInputEmail1" value="admin" aria-describedby="emailHelp" required>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Crear</button>
        </form>
      </div>
    </div>
  </div>
</div>





    <!-- Modal editar usuario -->
    <div class="modal fade" id="editar-producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      


      <form action="" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="Producto A" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Código caja</label>
    <input type="text" name="usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="3247398479824" required>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Código pieza</label>
    <input type="text" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="97382812728" required>
  </div>


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Dirección</label>
    <input type="text" name="direccion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="Av mexico #34" required>
  </div>



  <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
  <option selected>Caja</option>
  <option value="2">Pieza</option>
</select>




<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
  <option selected>Embutidos</option>
  <option value="2">Higiene personal</option>
  <option value="2">Dulcería</option>
</select>





(OCULTO)
  <input type="text" name="tipo_usuario" class="form-control" id="exampleInputEmail1" value="admin" aria-describedby="emailHelp" required>






      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Crear</button>
        </form>
      </div>
    </div>
  </div>
</div>






  <!-- Modal eliminar usuario -->
  <div class="modal fade" id="eliminar-producto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notificación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      


      <div class="text-center">
      <i class="fas fa-times text-danger" style="font-size:40px;"></i>
      <br>
      <h4>Estás seguro de eliminar el producto PRODUCTO A?</h4>
      </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary">Si</button>
   
      </div>
    </div>
  </div>
</div>







<!-- TERMINAN MODALES -->