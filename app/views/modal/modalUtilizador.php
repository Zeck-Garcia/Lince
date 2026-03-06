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
                                    <input type="text" id="txtCodColaboradorModal" class="form-control only-number">
                                    <label>Cod</label>
                                    </div>
                                    <div class="CampoGroup w-100">
                                    <input type="text" id="txtNomeColaboradorModal" class="form-control">
                                    <label>Nome do Funcionário</label>
                                    </div>
                                    <button id="btnSearchColaboradorModal" class="btn btn-primary col-1 ms-3"><i class="bi bi-search"></i></button>
                                    <button id="btnSaveColaboradorModal" class="btn btn-success col-1 ms-3"><i class="bi bi-plus-circle"></i></button>
                                </div>

                                <div class="d-flex align-items-center mt-3">
                                    <div class="CampoGroup w-100">
                                        <input type="text" id="txtemailModal" class="form-control">
                                        <label>Email</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mt-3" id='containerLoja'>
                                    <div class="CampoGroup active">
                                        <select class="select w-100" id="slcDepartamentoModal">
                                            <option value="99" selected disabled>Selecione</option>
                                        </select>
                                        <label for='slcAtivo'>Departamento</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3" id='containerAtivo'>
                                    <div class="CampoGroup active">
                                        <select class="select w-100" id="slcCargoModal">
                                            <option value="99" selected disabled>Selecione</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                        <label for='slcAtivo'>Cargo</label>
                                    </div>
                                </div>

                                <div class="col-md-7 mt-3" id='containerLoja'>
                                    <div class="CampoGroup active">
                                        <select class="select w-100" id="slcLojaModal">
                                            <option value="99" selected disabled>Selecione</option>
                                        </select>
                                        <label for='slcAtivo'>Loja</label>
                                    </div>
                                </div>

                                <div class="col-md-5 mt-3" id='containerAtivo'>
                                    <div class="CampoGroup active">
                                        <select class="select w-100" id="slcAtivoModal">
                                            <option value="99" selected disabled>Selecione</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                        <label for='slcAtivo'>Ativo</label>
                                    </div>
                                </div>

                                <div>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" id="chkAtivoColaboradorModal" name="ativo" checked>
                                        <label class="form-check-label fw-bold" for="chkAtivoColaboradorModal">Colaborador ativo?</label>
                                    </div>
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

