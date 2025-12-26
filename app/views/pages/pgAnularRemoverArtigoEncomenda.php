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
                <table  class="table table-striped table-hover text-center table-bordered ">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Encomenda</th>
                            <th>Artigo</th>
                            <th>Data</th>
                            <th>Motivo</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyViewAnulacao">
                    </tbody>
                </table>

                <div  class="quadroAleatorioNoTitle paginationAqui">
                    <nav id='paginationHome'>
                    </nav>
                </div>
            </div>

        </div>

        <div class="quadroAleatorioNoTitle mt-3">
            <div class="row1 w-100">
                <button id="btnNovaRemocao" class="w-100 btn btn-success">Criar nova remoção de item</button>
            </div>
        </div>

        <div id="containerNovaAnulacao" class="quadroAleatorio mt-3" style="display: none;">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-0-circle"></i>
                <p>Criar nova remoção de item</p>
                <span><i id="btnCancelRemocao" class="btn btn-outline-danger">Cancelar</i></span>
            </div>

            <div class="quadroAleatorioCorpo">

            <div class="row1 w-100">
                <div class="col1 w-100">
                    <div class="CampoGroup mt-3">
                        <input type="text" id="txtNumberOrder" class="form-control">
                        <label>Nº encomenda</label>
                    </div>

                    <div class="CampoGroup mt-3">
                        <textarea id="txtMoreInfo" class="form-control" style="height: 130px"></textarea>
                        <label>Motivo da remoção</label>
                        <small></small>
                    </div>
                </div>

                <div class="col1">
                    <div class="CampoGroup mt-3">
                        <input type="text" id="txtNumberItem" class="form-control">
                        <label>Artigo</label>
                    </div>

                    <button id="btnAddItemRemocao" class="btn btn-outline-success mt-3">Adicionar artigo</button>
                    <small>Você pode adicionar quantos itens forem necessário</small>
                    <table id="tableAddItemRemocao" class="table table-striped table-hover text-center table-bordered table-sm mt-3">
                        <tbody id="tbodyItemRemocao">
                        </tdody>
                    </table>
                </div>

            </div>
                

                <div class="row1 mt-3">
                    <button id="btnEnviarRemoverArtigo" class="w-100 btn btn-success">Enviar remoção de artigo</button>
                </div>
            </div>
        </div>

    </div>

    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgAnularRemoverArtigoEncomenda.js"></script>