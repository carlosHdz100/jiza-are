<form id="form">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nombre</label>
        <input type="text" name="usu_nombre" class="form-control" id="usu_nombre" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Apellidos</label>
        <input type="text" name="usu_apellido" class="form-control" id="usu_apellido" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Correo</label>
        <input type="text" name="use_correo" class="form-control" id="use_correo" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Contraseña</label>
        <input type="text" name="use_password" class="form-control" id="use_password" aria-describedby="emailHelp">
    </div>

    <!-- <select class="form-select" name="use_fkrol" id="use_fkrol" aria-label="Default select example">
        <option selected>Selecciona un rol</option>
    </select> -->
    
    <input type="hidden" name="use_id" class="form-control" id="use_id" aria-describedby="emailHelp">

    <!-- (OCULTO) -->
    <!-- <input type="text" name="tipo_usuario" class="form-control" id="exampleInputEmail1" value="admin" aria-describedby="emailHelp" required> -->

    <div class="d-flex justify-content-center mt-2"><button class="btn btn-success" id="btnSubmit"></button></div>
</form>