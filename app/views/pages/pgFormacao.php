<?php
 include_once "app/controller/function/funcExpiraSessao.php";
?>

<div class="menuLateral">
    <?php require_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">
    <!--  -->
        <div class="quadroAleatorioNoTitle row1">
            <div class="CampoGroup">
                <input type="text" class="form-control" id="txtBuscaFormando">
                <label>Buscar por:</label>
            </div>

            <div class="CampoGroup">
                <select class="select" id="slcTipoSearch">
                    <option value=""></option>
                    <option value="1">Código</option>
                    <option value="2">Nome</option>
                    <option value="3">Local</option>
                    <option value="4">Formação</option>
                </select>
                <label>Tipo</label>
            </div>

            <div class="CampoGroup">
                <input type="text" class="form-control" id="txtDeFormando">
                <label>De:</label>
            </div>
            
            <div class="CampoGroup">
                <input type="text" class="form-control" id="txtAteFormando">
                <label>Até:</label>
            </div>
            
            <div>
                <button id="btnProcurarOrderCompra" class="btn btn-success"><i class="bi bi-search"></i></button>
            </div>
        </div>

        <div class="quadroAleatorio mt-3">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-newspaper"></i>
                <p>Lista</p>
                <div>
                    <span class="btn btn-outline-success btn-sm" id="btnAddFormando"><i class="bi bi-building-add">Add</i></span>
                </div>
            </div>

            <div class="quadroAleatorioCorpo">
                <table class="table table-striped table-hover text-center table-bordered">
                    <thead>
                        <tr>
                            <th>Cód. func.</th>
                            <th>Nome</th>
                            <th>Formação</th>
                            <th>Data</th>
                            <th>Tempo</th>
                            <th>Local</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyFormando">
                    </tbody>
                </table>
            </div>
        </div>

        <div  class="quadroAleatorioNoTitle paginationAqui mt-3">
            <nav id='paginationHome'>
            </nav>
        </div>

        <div class="quadroAleatorioNoTitle row1 mt-3">
            <div class="w-100">
                <button id="btnAddFormacao" class="btn btn-outline-info">Listar Formação</button>
            </div>

            <div class="w-100">
                <button id="btnAddLocal" class="btn btn-outline-primary">Listar Local</button>
            </div>

            <div class="w-100">
                <button id="btnAddFuncionario" class="btn btn-outline-secondary">Listar funcionários</button>
            </div>
        </div>
    <!--  -->
    </div>

    <footer class="footerPage">
        <p>Roda pe</p>
    </footer>
</div>

<script src="public/js/pgRecursoHumano.js?v=<?= $versao;?>"></script>