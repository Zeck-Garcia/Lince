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
    #btnAddArtigo{
        position: absolute;
        top:0px;
        right: 0px;
        cursor: pointer;
        z-index: 10;
        height: 45px;
        padding: 0 10px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        font-size: 1.2rem !important;
        border-radius: 6px;
    }

    #txtSearchUser{
        width: 350px;
    }

    #tableAddItem{
        min-width: 170px;
    }
</style>
<div class="menuLateral">
    <?php include_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">

    <div class="quadroAleatorioNoTitle">
        <span>fsdfsfs</span>
    </div>
        <div class="quadroAleatorioNoTitle mt-3">
            <div class="row1">
                <div class="row1 mb-3 w-100">
                    <div class="CampoGroup w-100">
                        <input type="text" id="txtSearchUser" class="form-control">
                        <label>Buscar transferência ou encomenda</label>
                    </div>
        
                    <button id="btnProcurar" class="btn btn-success"><i class="bi bi-search"></i></button>
                </div>

                <div class="CampoGroup active col-4">
                    <select id="slcFeito" class="form-control form-select">
                        <option value="3">Todos</option>
                        <option value="1">Feita</option>
                        <option value="0" selected>Por fazer</option>
                    </select>
                    <label>Feito</label>
                </div>
            </div>
        </div>

        <div class="quadroAleatorio mt-3">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-0-circle"></i>
                <p>Minhas transferência</p>
                <span></span>
            </div>

            <div class="quadroAleatorioCorpo">
                <table class="table table-striped table-hover text-center table-bordered ">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Tipo</th>
                            <th>Data</th>
                            <th>Transferência</th>
                            <th>Nº encomenda</th>
                            <th>Artigo</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyListTrasnf">
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
                <button id="btnNovaTranfe" class="w-100 btn btn-success">Criar nova transferência</button>
            </div>
        </div>

        <div id="containerNovaTransf" class="quadroAleatorio mt-3" style="display: block;">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-0-circle"></i>
                <p>Criar nova transferência</p>
                <span><i id="btnCancelNovo" class="btn btn-outline-danger">Cancelar</i></span>
            </div>

            <div class="quadroAleatorioCorpo">

                <div class="row1 w-100">
                    <div class="col1 w-100">
                        <div class="col1">
                            <div class="CampoGroup mt-3 w-100">
                                <select type="text" id="slcTipoTransf" class="form-control form-select">
                                    <option value=""></option>
                                    <option value="1">Pendente de aceitar por insuficiência de stock</option>
                                    <option value="2">Cancelada por falta de stock</option>
                                </select>
                                <label>Tipo de transferência</label>
                            </div>
                            <div class="row1 ">
                            <div class="CampoGroup mt-3 w-100">
                                <input type="text" id="txtNumberTransf" class="form-control">
                                <label>Nº Transferência</label>
                            </div>

                            <div class="CampoGroup mt-3 w-100">
                                <input type="text" id="txtNumberOrder" class="form-control">
                                <label>Nº encomenda</label>
                            </div>
                        </div>
                        </div>
                        

                        <div class="CampoGroup mt-3">
                            <input type="text" id="txtNumberItem" class="form-control">
                            <label>Artigo</label>
                            <span class="btn btn-success" id="btnAddArtigo">Adicionar artigo</span>
                            <small>Informe o código do produto e adicione. Você pode adicionar quantos itens forem necessário.</small>
                        </div>
                    </div>

                    <div class="col-3">
                        <table id="tableAddItem" class="table table-striped table-hover text-center table-bordered table-sm mt-3">
                            <tr>
                                <td>Artigo</td>
                                <td>Excluir</td>
                            </tr>
                            <tbody id="tbodyItem">
                            </tdody>
                        </table>
                    </div>

                </div>
                

                <div class="row1 mt-3">
                    <button id="btnAddListEnvio" class="w-100 btn btn-success">Adicionar a lista de envio</button>
                </div>
            </div>
        </div>

        <div id="containerTableList" class="quadroAleatorioNoTitle col1 mt-3" style="display: none;">
            <table class="table table-striped table-hover text-center table-bordered ">
                <thead>
                    <tr>
                        <th>Nº transferência</th>
                        <th>Nº encomenda</th>
                        <th>Artigo</th>
                        <th>Excluir</th>
                    </tr>
                </thead>

                <tbody id="tbodyenviarTransf">
                </tbody>
            </table>

            <div class="row1 w-100">
                <button id="btnEnviarAnulacao" class="w-100 btn btn-success">Enviar transferência</button>
            </div>
        </div>

    </div>
    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgTransfePendentePorAceitar.js"></script>