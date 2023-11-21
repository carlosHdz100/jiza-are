<form id="form">
    <input type="hidden" name="cat_id" class="form-control" id="cat_id" aria-describedby="emailHelp">

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nombre</label>
        <input type="text" name="cat_name" class="form-control" id="cat_name" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Descripción</label>
        <input type="text" name="cat_description" class="form-control" id="cat_description" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="formFile" class="form-label">Subir archivo</label>
        <input class="form-control" name="cat_image" type="file" id="cat_image" required>
    </div>

    <div class="d-flex justify-content-center mt-2"><button class="btn btn-success" id="btnSubmit"></button></div>
</form>