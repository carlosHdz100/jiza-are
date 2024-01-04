<?php
$categoria = $_GET['category'];
// $id = $_GET['gar_id'];
?>
<div class="page-content mt-4">
    <div class="search-box bg-theme color-theme rounded-m shadow-l mx-2 mb-4">
        <i class="fa fa-search"></i>
        <input type="text" class="border-0" placeholder="Qué estás buscando?" data-search>
        <a href="#" class="clear-search disabled no-click mt-0"></a>
        <a href="#" data-menu="menu-filter" class="color-theme"><i class="fa fa-sliders me-n3"></i></a>
    </div>

    <?php if (!empty($categoria)) { ?>

        <div class="card card-style">
            <div class="content">
                <h1 class="text-center font-700 mb-1"><?= $categoria ?></h1>
            </div>
        </div>

    <?php } ?>





    <!-- <div class="search-results disabled-search-list mt-3">
        <div class="card card-style mx-2 px-2 mb-0 pt-2">

            <a href="#" class="d-flex py-2" data-filter-item data-filter-name="all apple watch 42 leather edition white">
                <div>
                    <img src="images/food/500x500/2.png" class="rounded-sm me-1" width="45" alt="img">
                </div>
                <div>
                    <span class="color-highlight font-400 d-block pt-0 mb-n2 font-11">Rentar</span>
                    <strong class="color-theme font-14 d-block mt-n2">Vestido de noche</strong>
                </div>
                <div class="ms-auto text-center align-self-center pe-2">
                    <h5 class="line-height-xs font-18 pt-3">$5.<sup class="font-14">50</sup></h5>
                </div>
            </a>
            <a href="#" class="d-flex py-2" data-filter-item data-filter-name="all apple watch lime edition 44 green">
                <div>
                    <img src="images/food/500x500/3.png" class="rounded-sm me-1" width="45" alt="img">
                </div>
                <div>
                    <span class="color-highlight font-400 d-block pt-0 mb-n2 font-11">Accesorio</span>
                    <strong class="color-theme font-14 d-block mt-n2">Aretes brillantes</strong>
                </div>
                <div class="ms-auto text-center align-self-center pe-2">
                    <h5 class="line-height-xs font-18 pt-3">$16.<sup class="font-14">50</sup></h5>
                </div>
            </a>
        </div>
    </div> -->


    <!-- <div class="search-no-results disabled mt-n3">
        <div class="content bg-red-dark p-3 rounded-m">
            <h1 class="color-white">Sin resultados</h1>
            <p class="color-white">
                No se encontraraon datos conforme a tu busqueda.
            </p>
        </div>
        <div class="divider divider-margins mt-4"></div>
    </div> -->


    <div class="row mb-0" id="setGarment">

    </div>



</div>

<script type="text/javascript" src="assets/scripts/custom.js"></script>
<script src="assets/scripts/src/garment.js"></script>
<script>
    getGarmentFiltroA(category,typeGarment,arrendador);
</script>