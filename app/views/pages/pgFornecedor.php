<div class="container-fluid mt-3">
    <div class="d-md-flex justify-content-between align-items-center mb-2">
        <div>
            <h3 class="fw-bold m-0">Fornecedor</h3>
            <p class="text-muted small">Gestão de Fornecedores</p>
        </div>
        <button class="btn btn-success px-4 py-2 shadow-sm fw-bold" onclick="openModalFornecedor('')">
            <i class="bi bi-plus-lg me-2"></i> Novo Forncedor
        </button>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        <div class="card-body p-3">
            <div class="row g-2">
                <div class="col-md-3">
                    <div class="form-floating">
                        <select id="slcSituacao" class="form-select border-0 bg-light">
                            <option value="2" selected>Todas</option>
                            <option value="1">Ativo</option>
                            <option value="0">Desativado</option>
                        </select>
                        <label for="">Situação</label>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="form-floating">
                            <input type="text" id="txtSearch" class="form-control border-0 bg-light enterPress" placeholder="Pesquisar por autor, status, data, número ou ...">
                            <label for="">Pesquisar por nome, email, site, morada</label>
                        </div>
                            <button class="btn btn-info" id="search" onclick="searchFornecedor()"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
        <div class="table-responsive">
            <table class="table table-sm table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 px-4 border-0">Cód</th>
                        <th class="py-3 border-0">Fornecedor</th>
                        <th class="py-3 border-0 text-center">Email</th>
                        <th class="py-3 border-0">Site</th>
                        <th class="py-3 border-0 text-center">Morada</th>
                        <th class="py-3 border-0 text-center">Ativo</th>
                        <th class="py-3 border-0 text-end px-4">Ação</th>
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

<script src="public/assets/js/pgFornecedor.js?v=<?= VERSION ?>"></script>