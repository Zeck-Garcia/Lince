<?php 
    require_once "app/views/pages/pgFilterLateral.php";
?>

<div class="bodyPage">
    <div class="groupBody">
    <!--  -->
        <div class="quadroAleatorioNoTitle row d-flex g-3">
            <div class="col-md-5 CampoGroup">
                <input type="text" class="form-control" id="txtBuscaFormando">
                <label>Buscar por:</label>
            </div>

            <div class="CampoGroup col-md-2">
                <select class="form-select" id="slcTipoSearch">
                    <option value=""></option>
                    <option value="1">Código</option>
                    <option value="2">Nome</option>
                    <option value="3">Local</option>
                    <option value="4">Formação</option>
                </select>
                <label>Tipo</label>
            </div>

            <div class="CampoGroup col-md-2 active">
                <input type="date" class="form-control" id="txtDeFormando">
                <label>De:</label>
            </div>
            
            <div class="CampoGroup col-md-2 active">
                <input type="date" class="form-control" id="txtAteFormando">
                <label>Até:</label>
            </div>
            
            <div class='col-md-1'>
                <button id="btnSearchFirstFormando" class="btn btn-success"><i class="bi bi-search"></i></button>
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
            <nav aria-label="Navegação de entregas" class="container-pagination">
                <ul class="pagination justify-content-center custom-pagination" id="paginador">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Anterior</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Próximo</a>
                    </li>
                </ul>
            </nav>
        </div>

        

        <div class="quadroAleatorioNoTitle row mt-3 d-flex g-2">
            <div class="col-md-4">
                <button id="btnAddCurso" class="btn btn-outline-info">Listar Cursos</button>
            </div>

            <div class="col-md-4">
                <button id="btnAddLocal" class="btn btn-outline-primary">Listar Local</button>
            </div>

            <div class="col-md-4">
                <button id="btnAddFuncionario" class="btn btn-outline-secondary">Listar funcionários</button>
            </div>
        </div>
    <!--  -->
    </div>
</div>

<script src="public/assets/js/pgRecursoHumano.js?v=<?= VERSION ?>"></script>