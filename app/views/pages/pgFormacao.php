<div class="container-fluid mt-3">
    <div class="d-md-flex justify-content-between align-items-center mb-2">
        <div>
            <h3 class="fw-bold m-0">Formação</h3>
            <p class="text-muted small">Gestão de Formação</p>
        </div>
        <div>
            <button id='btnAddPlanearFormando' class="btn btn-outline-secondary px-4 py-2 shadow-sm fw-bold" onclick="novaFormacao(this)">
                <i class="bi bi-person-lines-fill me-2"></i> Planear Formação
            </button>
            <button id='btnAddFormando' class="btn btn-success px-4 py-2 shadow-sm fw-bold" onclick="novaFormacao(this)">
                <i class="bi bi-plus-lg me-2"></i> Nova Formação
            </button>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        <div class="card-body p-3">
            <div class="row g-2">

                <div class="col-md-1">
                    <div class="form-floating">
                        <select id="slcSituacao" class="form-select">
                            <option value="1" selected>Concluido</option>
                            <option value="0">Não Concluido</option>
                        </select>
                        <label for="">Situação</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" id="txtBuscaFormando" class="form-control enterPress" placeholder="">
                        <label for="">Digite a sua pesquisa</label>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-floating">
                        <select id="slcTipoSearch" class="form-select">
                            <option value="">Selecione</option>
                            <option value="1">Código</option>
                            <option value="2">Nome</option>
                            <option value="3">Local</option>
                            <option value="4">Formação</option>
                            <option value="5">Loja</option>
                        </select>
                        <label for="">Tipo</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="date" id="txtDeFormando" class="form-control" placeholder="">
                            <label for="">De</label>
                        </div>
                        <div class="form-floating">
                            <input type="date" id="txtAteFormando" class="form-control" placeholder="">
                            <label for="">Ate</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-1">
                    <button id="btnSearchFirstFormando" class="btn btn-info" id="" onclick=""><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
        <div class="table-responsive">
            <table class="table table-sm table-hover align-middle mb-0 text-center">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 border-0">Cód.<br>func.</th>
                        <th class="py-3 border-0">Nome</th>
                        <th class="py-3 border-0">Loja</th>
                        <th class="py-3 border-0">Formação</th>
                        <th class="py-3 border-0">Data</th>
                        <th class="py-3 border-0">Tempo</th>
                        <th class="py-3 border-0">Local</th>
                        <th class="py-3 border-0">Situação</th>
                        <th class="py-3 border-0">Ação</th>
                    </tr>
                </thead>
                <tbody id="tbodyFormando" >
                </tbody>
            </table>

            <nav class="mb-4">
                <nav id='paginationHome'>
                    <ul class="pagination justify-content-center" id="paginador">
                        <li class="page-item disabled"><a class="page-link border-0 bg-transparent" href="#">Anterior</a></li>
                        <li class="page-item active"><a class="page-link rounded-circle mx-1" href="#" style="background: var(--bg-pink); border: none;">1</a></li>
                        <li class="page-item"><a class="page-link rounded-circle mx-1 border-0 text-dark" href="#">2</a></li>
                        <li class="page-item"><a class="page-link rounded-circle mx-1 border-0 text-dark" href="#">3</a></li>
                        <li class="page-item"><a class="page-link border-0 bg-transparent fw-bold" style="color: var(--text-pink)" href="#">Próximo</a></li>
                    </ul>
                </nav>
            </nav>

        </div>
    </div>

    <div class="card border-0 shadow-sm mt-4" style="border-radius: 12px;">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <button id="btnAddCurso" class="btn btn-outline-info btn-lg w-100">Listar Formação</button>
                </div>
        
                <div class="col-md-4">
                    <button id="btnAddLocal" class="btn btn-outline-primary btn-lg w-100">Listar Local</button>
                </div>
        
                <div class="col-md-4">
                    <button id="btnAddFuncionario" class="btn btn-outline-secondary btn-lg w-100">Listar funcionários</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->

<!-- <div class="bodyPage">
    <div class="groupBody">
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

                    <tbody id="tbodyFormando-">
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
    </div>
</div> -->

<script src="public/assets/js/pgFormacao.js?v=<?= VERSION ?>"></script>