<div id="" class='modal fade' tabindex='-1' style='z-index: 1100;' aria-modal='true' role='dialog'>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 10px;">
            <div class="modal-fluid">
                <div class="modal-header text-white" style="background: var(--bg-color-pink);">
                    <h2 class="modal-title h5 mb-0 fw-bold">
                        <i class="bi bi-person-badge me-2"></i>
                    </h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="">
                            <div class="row">

                            <div class="d-flex align-items-center" id="containerNome">
                                <div class="col-2 CampoGroup me-3">
                                  <input type="text" id="txtCodFuncionario" class="form-control only-number">
                                  <label>Cod</label>
                                </div>
                                <div class="CampoGroup w-100">
                                  <input type="text" id="txtNomeFuncionario" class="form-control">
                                  <label>Nome do Funcionário</label>
                                </div>
                                <button id="btnSearchFuncionario" class="btn btn-primary col-1 ms-2" onclick="monteLoadListTableFuncionario(0)"><i class="bi bi-search"></i></button>
                                <button id="btnSaveFuncionario" class="btn btn-success col-1 ms-2"><i class="bi bi-plus-circle"></i></button>
                            </div>

                            <div class="col-md-6 mt-3" id='containerLoja'>
                                <div class="CampoGroup active">
                                    <select class="select w-100" id="slcLoja">
                                        <option value="99" selected disabled>Selecione</option>
                                    </select>
                                    <label for='slcAtivo'>Loja</label>
                                </div>
                            </div>

                            <div class="col-md-6 mt-3" id='containerAtivo'>
                                <div class="CampoGroup active">
                                    <select class="select w-100" id="slcAtivo">
                                        <option value="99" selected disabled>Selecione</option>
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                    <label for='slcAtivo'>Ativo</label>
                                </div>
                            </div>

                                <div class="mt-3">
                                    <table class="table table-striped table-hover text-center table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Cod</th>
                                                <th>Nome</th>
                                                <th>Loja</th>
                                                <th>Ativo</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tbodyFuncionario">
                                        </tbody>
                                    </table>
                                </div>

                                <div  class="quadroAleatorioNoTitle paginationAqui mt-3">
                                    <nav aria-label="Navegação de entregas" class="container-pagination">
                                        <ul class="pagination justify-content-center custom-pagination" id="paginador-submodal">
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

