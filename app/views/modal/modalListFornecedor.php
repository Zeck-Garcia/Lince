<div id="" class='modal fade' tabindex='-1' style='z-index: 1100;' aria-modal='true' role='dialog'>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 10px;">
            <div class="modal-fluid">
                <div class="modal-header text-white" style="background: var(--bg-pink);">
                    <h2 class="modal-title h5 mb-0 fw-bold">
                        <i class="bi bi-person-badge me-2"></i>
                    </h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="">
                            <div class="row">

                                <div class="col">
                                    <div class="input-group">
                                        <div class="form-floating">
                                            <input type="text" id="txtBuscarFornecedor" class="form-control border-0 bg-light" placeholder="">
                                            <label>Fornecedor</label>
                                        </div>
                                        <button class="btn btn-info" id="btnBuscarFornecedor"><i class="bi bi-search"></i></button>
                                    </div>
                                </div>

                                <table class="table table-sm table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Cód<br>Fornecedor</th>
                                            <th class="text-center">Nome</th>
                                            <th class="text-center">Email</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tbodyListFornecedor">
                                    </tbody>
                                </table>

                                <div  class="quadroAleatorioNoTitle paginationAqui mt-3">
                                    <nav aria-label="Navegação de entregas" class="container-pagination">
                                        <ul class="pagination justify-content-center custom-pagination" id="paginador-for">
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
                            </div>

                            <div class="modal-group-btn mt-3">
                                <input type="button" id="btnCloseModal" class="btnCloseModal btn btn-outline-secondary mr-3" value="Fechar" data-bs-dismiss="modal">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

