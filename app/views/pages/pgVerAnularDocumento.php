<?php
// if($_SESSION["loginUser"] == false){
//     header('Location: login');
// } else {
//     if($_SESSION["loginUser"] != true or $_SESSION["classeAgente"] != "3"){
//         header('Location: login');
//     }
// }

?>
<style>

#btnProcurar{
    width: 50px !important;
}

#groupFilter{
    align-items: center !important;
}

</style>

<div class="menuLateral">
    <?php include_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">

        <div class="quadroAleatorioNoTitle">
            <div class="row1" id="groupFilter">
                <div id="groupFilterItem" class="row1 w-100">
                    <div class="CampoGroup w-100">
                        <input type="text" id="txtSearchUser" class="form-control">
                        <label>Buscar encomeda</label>
                    </div>
        
                    <button id="btnProcurar" class="btn btn-success"><i class="bi bi-search"></i></button>
                </div>

                <div class="row1 w-100">
                    <div class="CampoGroup mt-3 active w-100">
                        <select id="slcLoja" class="form-control form-select">
                            <option value="0" selected>Todos</option>
                        </select>
                        <label>Loja</label>
                    </div>
    
                    <div class="CampoGroup mt-3 active w-100">
                        <select id="slcFeito" class="form-control form-select">
                            <option value="3">Todos</option>
                            <option value="0" selected>Por fazer</option>
                            <option value="1">Feito</option>
                        </select>
                        <label>Estado</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="quadroAleatorio col1 mt-3">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-0-circle"></i>
                <p>Anulações</p>
                <span></span>
            </div>

            <div class="quadroAleatorioCorpo">
                <table class="table table-striped table-hover text-center table-bordered ">
                    <thead>
                        <tr>
                            <th><input id="chkAll" type="checkbox"></th>
                            <th>Loja</th>
                            <th>Encomenda</th>
                            <th>Data</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyViewAnulacao">
                    </tbody>
                </table>

                <div  class="quadroAleatorioNoTitle paginationAqui">
                    <nav id='paginationHome'>
                    </nav>
                </div>

                <div class="groupBtn row1 w-100 mt-3">
                    <input type="button" id="btnAddListAnulacao" class="btn btn-success" value="Adicionar a lista">
                </div>
            </div>

        </div>


        <div id="containerFinalizarAnulacao" class="quadroAleatorio mt-3" style="display: none;">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-0-circle"></i>
                <p>Anulações a serem finalizdas</p>
                <span><i id="tbnFecharEnvio" class="btn btn-outline-danger">Cancelar</i></span>
            </div>

            <div class="quadroAleatorioCorpo">
                <table id="tableAnularFinal" class="table table-striped table-hover text-center table-bordered ">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Loja</th>
                                <th>Encomenda</th>
                                <th>Data</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>

                        <tbody id="tbodyEnviarListAnulacao">
                        </tbody>
                    </table>

                    <div class="groupBtn row1 w-100">
                        <input type="button" id="btnFinalizarEnviarList" class="btn btn-success" value="Finalizar lista">
                    </div>
            </div>
        </div>

    </div>


    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgVerAnularDocumento.js"></script>
