<?php
// if($_SESSION["idUser"] == false){
//     header('Location: login');
// } else {
//     if($_SESSION["idUser"] != true or !in_array($_SESSION["classeAgente"], [1])){
//         header('Location: login');
//     }
// }
// include_once "app/controller/function/funcExpiraSessao.php";
?>
<style>

/* tablet */
@media (min-width: 751px ) and (max-width: 1100px){

}
    
/* mobile */
@media (max-width: 750px) {
    
}

</style>

<div class="menuLateral">
    <?php include_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">
        <div class="quadroAleatorioNoTitle">

            <div class="">
                <div class="row1 mb-3">
                    <div class="CampoGroup w-100">
                        <input type="text" id="txtSearchUser" class="form-control">
                        <label>Buscar User</label>
                    </div>
        
                    <button id="btnProcurar" class="btn btn-success"><i class="bi bi-search"></i></button>
                </div>

                <!-- <div class="row1 borderDashed p-1">
                    <div class="CampoGroup w-100 active">
                        <select class="form-control form-select" id="slcDepartamento">
                            <option value="0">Todos</option>
                        </select>
                        <label>Departamento</label>
                    </div>

                    <div class="CampoGroup  w-100 active">
                        <select class="form-control form-select" id="slcCargo">
                            <option value="0">Todos</option>
                        </select>
                        <label>Cargo</label>
                    </div>
                </div> -->

            </div>

            <table class="table table-striped table-hover text-center table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Nome completo</th>
                        <th>Categoria</th>
                        <th>Ativo</th>
                        <th>Ver</th>
                    </tr>
                </thead>
    
                <tbody id="tbodyList">
                </tbody>
            </table>

            <div class="quadroAleatorioNoTitle paginationAqui">
                <nav id='paginationHome'>
                    <!-- <ul class=''>
                        <li class=''><button class='btn btn-outline-info btnPgane' data-pagina='1'><i class="bi bi-chevron-double-left"></i></buton></li>
        
                        <li class='page-item'><button id='btnPagina1' class='btn btn-outline-info btnPgane active' data-pagina='1'>1</buton></li>
                        <li class='page-item'><button id='btnPagina2' class='btn btn-outline-info btnPgane' data-pagina='1'>1</buton></li>
                    
                        <li class=''><button class='btn btn-outline-info btnPgane' data-pagina='$paginaTotal'><i class="bi bi-chevron-double-right"></i></buton></li>
                    </ul> -->
                </nav>
            </div>
        </div>

        <div id="containerUser" class="quadroAleatorio mt-3">
        </div>
    </div>

    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgListarUltilizadores.js?v=<?= $versao;?>"></script>