<div class="page-content mt-4">

    <div class="card card-style">
        <div class="content mb-0">
            <h1 class="mb-n2">Mis paquetes</h1>

            <div class="tab-controls tabs-small rounded my-4" data-highlight="bg-highlight-dark">
                <a href="#" class="bg-highlight-dark no-click" data-bs-toggle="collapse" onclick="getallPackage(1)" data-bs-target="#tab-2" class="collapsed" aria-expanded="false">Publicadas</a>
                <a href="#" data-bs-toggle="collapse" onclick="getallPackage(0)" data-bs-target="#tab-3" class="collapsed" aria-expanded="false">Ocultas</a>
            </div>

            <div class="row mb-0" id="setGarment"></div>
            <a href="#" class="btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-highlight">Ver mas</a>
        </div>
    </div>
</div>

<script src="assets/scripts/src/garment.js"></script>
<script>
    getallPackage(1);
</script>