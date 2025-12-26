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

    .borderDashed > h3{
        font-size: 1.1rem !important;
        font-weight: 600 !important;
    }


</style>

<div class="menuLateral">
    <?php include_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">


        <div class="quadroAleatorio">
            <div class="row1"> 
                <div class="row1 mb-3 w-100">
                    <div class="CampoGroup w-100">
                        <input type="text" id="txtSearchUser" class="form-control">
                        <label>Buscar encomenda</label>
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

            <!-- minhas anulações -->
            <div class="quadroAleatorioTitle">
                <i class="bi bi-0-circle"></i>
                <p>Minhas anulações</p>
                <span></span>
            </div>

            <div class="quadroAleatorioCorpo">
                    <table class="table table-striped table-hover text-center table-bordered ">
                    <thead>
                        <tr>
                            <th>Estado</th>
                            <th>Data</th>
                            <th>Nº encomenda</th>
                            <th>Guia remessa / Fatura</th>
                            <th>Ver detalhes</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyAnularDoc">
                    </tbody>
                </table>

                <div  class="quadroAleatorioNoTitle paginationAqui">
                    <nav id='paginationHome'>
                    </nav>
                </div>

            </div>

        </div>

        <!-- detalhe da anulacao -->
        <div id="containerDetailsEncomendas" class="row1 mt-2 w-100" style="display: none !important;">
            <div class='quadroAleatorio w-100'>
                <div class='quadroAleatorioTitle'>
                    <i class='bi bi-building'></i>
                    <p>Dados da anulação</p>
                    <span><i class="btn btn-outline-danger btn-sm" id="btnCloseDetailsAnulacao">Fechar</i></span>
                </div>
    
                <div class='quadroAleatorioCorpo w-100'>

                    <div class="row1">
                        <div class='borderDashed mt-3 w-100'>
                            <span>Solicitado do fonecedor</span>
                            <h3 id="fornecedor"></h3>
                        </div>

                        <div class='borderDashed mt-3 w-100'>
                            <span>Emitido guia de remessa ou fatura</span>
                            <h3 id="emetidoGuia"></h3>
                        </div>
                    </div>

                    <div class="row1">
                        <div class='borderDashed mt-3 w-100'>
                            <span>Motivo da anulação</span>
                            <h3 id="MeuMotivo"></h3>
                        </div>
                    </div>


                    <div class='borderDashed mt-3 w-100'>
                        <span>Observação do anulador</span>
                        <h3 id="ObsDoAnulador"></h3>
                    </div>

                </div>
            </div>
        </div>

        <!-- btn criar nova anucao -->
        <div class="quadroAleatorioNoTitle mt-3">
            <div class="row1 w-100">
                <button id="btnNovaAnulacao" class="w-100 btn btn-success">Criar nova anulação</button>
            </div>
        </div>

        <!-- criar nova anulacao -->
        <div id="containerNovaAnulacao" class="quadroAleatorio mt-3" style="display: none;">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-0-circle"></i>
                <p>Criar nova anulação de documento</p>
                <span><i id="btnCancelEnvio" class="btn btn-outline-danger">Cancelar</i></span>
            </div>

            <div class="quadroAleatorioCorpo">
                <div class="mt-3">
                    <div class="CampoGroup">
                        <select id="slcTipoAnulacao" class="form-control form-select">
                            <option value=""></option>
                            <option value="1">Anulão de encomenda - Indicado para as lojas</option>
                            <option value="2">Anulação de documento</option>
                        </select>
                        <label>Tipo de anulação</label>
                        <small>Anulação de documentos, caso já tenha emitido fatura ou guia de remessa.</small>
                        <br><small>Anulação de documentos, indicado para o setor de logistica.</small>
                    </div>
                </div>

                <div class="row1">
                    <div class="CampoGroup mt-3">
                        <input type="text" id="txtNumberOrder" class="form-control">
                        <label>Nº encomenda</label>
                    </div>

                    <div class="CampoGroup mt-3 hidder" id="divNumberGuia">
                        <input type="text" id="txtNumberGuia" class="form-control">
                        <label>Guia remessa / Fatura</label>
                    </div>
                </div>
                
                <div class="col1 w-100 mt-3">
                    <div class="CampoGroup">
                        <textarea id="txtMoreInfo" class="form-control" style="height: 90px"></textarea>
                        <label>Motivo da anulação</label>
                        <small></small>
                    </div>
                </div>

                <div class="row1 mt-3">
                    <button id="btnAdicionarAnulacao" class="w-100 btn btn-success">Adicionar</button>
                </div>
            </div>
        </div>

        <!-- listagem da anulacao em andamento -->
        <div id="containerTableListAnulacao" class="quadroAleatorioNoTitle col1 mt-3" style="display: none;">
            <table class="table table-striped table-hover text-center table-bordered ">
                <thead>
                    <tr>
                        <th>Tipo de anulação</th>
                        <th>Nº encomenda</th>
                        <th>Guia remessa / Fatura</th>
                        <th>Observação</th>
                        <th>Ver detalhes</th>
                    </tr>
                </thead>

                <tbody id="tbodyNovaAnulacao">
                </tbody>
            </table>

            <div class="row1 w-100">
                <button id="btnEnviarAnulacao" class="w-100 btn btn-success">Enviar anulação</button>
            </div>
        </div>
    </div>

    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgAnularDocumentoLoja.js"></script>

