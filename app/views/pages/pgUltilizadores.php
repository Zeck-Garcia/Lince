<div class="container-fluid mt-3">
    <div class="d-md-flex justify-content-between align-items-center mb-2">
        <div>
            <h3 class="fw-bold m-0">Utilizadores</h3>
            <p class="text-muted small">Gestão de Utilizadores</p>
        </div>
        <button class="btn btn-success px-4 py-2 shadow-sm fw-bold" onclick="openModalUtilizador('','')">
            <i class="bi bi-plus-lg me-2"></i> Nova Utilizador
        </button>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        <div class="card-body p-3">
            <div class="row g-2">
                <div class="col-md-3">
                    <div class="form-floating">
                        <select id="slcDepartamento" class="form-select border-0 bg-light" placeholder="">
                            <option value="0">Todas</option>
                        </select>
                        <label for="slcDepartamento">Departamento</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <select id="slcCargo" class="form-select border-0 bg-light">
                            <option value="0">Todas</option>
                        </select>
                        <label for="slcCargo">Cargo</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" id="txtSearchUser" class="form-control border-0 bg-light enterPress" placeholder=" ">
                            <label for="txtSearchUser">Pesquisar por utilizador, departamento, email, ativo ou cargo...</label>
                        </div>
                        <button class="btn btn-info" id="searchOrderCompra" onclick="searchOrderCompra()">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
        <div class="table-responsive">
            <table class="table table-sm table-striped table-hover text-center table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Nome Utilizador</th>
                        <th>Classe</th>
                        <th>Email</th>
                        <th>Departamento</th>
                        <th>Cargo</th>
                        <th>Ativo</th>
                        <th>Ação</th>
                    </tr>
                </thead>
    
                <tbody id="tbodyList">
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
</div>

<script src="public/assets/js/pgUltilizadores.js?v=<?= VERSION ?>"></script>