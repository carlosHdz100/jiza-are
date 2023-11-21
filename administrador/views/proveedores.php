
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Proveedores</h6>
              
            </div>


            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button class="btn btn-info me-md-2" type="button" data-bs-toggle="modal" data-bs-target="#agregar-proveedor">Agregar nuevo proveedor</button>
</div>


            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
              
              
              
              <table class="table align-items-center mb-0">


                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
             
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dirección</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teléfono</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Logo</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Correo</th>
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
                            <h6 class="mb-0 text-sm">Tienda A</h6>

                          </div>
                        </div>
                      </td>
                 


                      <td>
                        <p class="text-xs font-weight-bold mb-0">Av Mexico #23</p>
                      </td>

                      <td>
                        <p class="text-xs font-weight-bold mb-0">+5294949393</p>
                      </td>


                      <td>
                        <img src="https://abaratalo.com/wp-content/uploads/2021/10/Logo-copia.png" width="80px" class="img-fluid rounded-circle">
                      </td>


                      <td>
                        <p class="text-xs font-weight-bold mb-0">proveedor@g.com</p>
                      </td>
                     

                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Activo</span>
                      </td>
                 
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#editar-proveedor">
                          Editar
                        </a>
                         | 
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#eliminar-proveedor">
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
                            <h6 class="mb-0 text-sm">Tienda A</h6>

                          </div>
                        </div>
                      </td>
                   


                      <td>
                        <p class="text-xs font-weight-bold mb-0">Av Mexico #23</p>
                      </td>

                      <td>
                        <p class="text-xs font-weight-bold mb-0">+5294949393</p>
                      </td>


                      <td>
                        <img src="https://abaratalo.com/wp-content/uploads/2021/10/Logo-copia.png" width="80px" class="img-fluid rounded-circle">
                      </td>


                      <td>
                        <p class="text-xs font-weight-bold mb-0">proveedor@g.com</p>
                      </td>
                     

                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Activo</span>
                      </td>
                 
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#editar-proveedor">
                          Editar
                        </a>
                         | 
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-bs-toggle="modal" data-bs-target="#eliminar-proveedor">
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
<div class="modal fade" id="agregar-proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo proveedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      


      <form action="" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>



  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Dirección</label>
    <input type="text" name="direccion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Teléfono</label>
    <input type="tel" name="telefono" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>



  <div class="mb-3">
  <label for="formFile" class="form-label">Subir archivo</label>
  <input class="form-control" name="logo" type="file" id="formFile" required>
</div>



<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Correo</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
  </div>



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
    <div class="modal fade" id="editar-proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar proveedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      


      <form action="" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre</label>
    <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="Tienda A" required>
  </div>

  


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Dirección</label>
    <input type="text" name="direccion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="Ac mexico 33" required>
  </div>


  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Teléfono</label>
    <input type="tel" name="telefono" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="87978" required>
  </div>



  <div class="mb-3">
    Logo actual
    <img src="https://i.pinimg.com/originals/a3/2b/19/a32b19c33d4a36e69069493a0353e531.png" class="img-fluid" width="50px">
    <br>
  <label for="formFile" class="form-label">Subir archivo</label>
  <input class="form-control" name="logo" type="file" id="formFile" required>
</div>


<div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Correo</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="87978" required>
  </div>





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
  <div class="modal fade" id="eliminar-proveedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <h4>Estás seguro de eliminar el proveedor PROVEEDOR A?</h4>
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