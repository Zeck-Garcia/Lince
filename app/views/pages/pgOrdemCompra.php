<div class="container-fluid">
    <div class="d-md-flex justify-content-between align-items-center mb-2">
        <div>
            <h3 class="fw-bold m-0">Ordens de Compra</h3>
            <p class="text-muted small">Gestão de pedidos e orçamentos</p>
        </div>
        <button class="btn btn-success px-4 py-2 shadow-sm fw-bold" onclick="openModalOrder('')">
            <i class="bi bi-plus-lg me-2"></i> Nova Ordem
        </button>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px;">
        <div class="card-body p-3">
            <div class="row g-2">
                <div class="col-md-3">
                    <select id="slcPedido" class="form-select border-0 bg-light">
                        <option>Por aprovar</option>
                        <option>Aprovados</option>
                    </select>
                </div>
                <div class="col-md-9">
                    <div class="input-group">
                        <!-- <span class="input-group-text border-0 bg-light text-muted"><i class="bi bi-search"></i></span> -->
                        <input type="text" id="numberOrderCompra" class="form-control border-0 bg-light" placeholder="Pesquisar por autor, número ou empresa...">
                        <button class="btn btn-info"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 12px;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="py-3 px-4 border-0">Situação</th>
                        <th class="py-3 border-0">Status</th>
                        <th class="py-3 border-0">Nº Ordem</th>
                        <th class="py-3 border-0">Autor</th>
                        <th class="py-3 border-0">Departamento</th>
                        <th class="py-3 border-0">Data</th>
                        <th class="py-3 border-0">Email ao<br>fornecedor</th>
                        <th class="py-3 border-0 text-end px-4">Ação</th>
                    </tr>
                </thead>
                <tbody id="tbodyListOrder">
                </tbody>
            </table>

            <nav class="mb-4">
                <nav id='paginationHome'>
                    <ul class="pagination justify-content-center">
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

<script src="public/assets/js/pgOrderCompra.js?v=<?= VERSION ?>"></script>