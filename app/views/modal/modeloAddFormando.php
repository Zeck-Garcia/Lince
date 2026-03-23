<div id="" class='modal fade' tabindex='-1' style='z-index: 1100;' aria-modal='true' role='dialog'>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                <div class="input-group">
                                    <div class="form-floating">
                                        <input type="text" id="txtCodColaborador" class="form-control only-number" placeholder="">
                                        <label>Cód</label>
                                    </div>
                                    <button id="btnSearchFormando" class="btn btn-primary" onclick=""><i class="bi bi-search"></i></button>
                                    <button id="btnSaveFormando" class="btn btn-success">Salvar</button>
                                </div>

                                <div class="mt-3">
                                    <div class="form-floating">
                                      <input type="text" id="txtNomeColaborador" class="form-control" placeholder="">
                                      <label>Nome completo</label>
                                  </div>
                                </div>

                                <div class="mt-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="slcTipoCurso">
                                        </select>
                                        <label>Formação</label>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="d-flex g-2 row">
                                        <div class="form-floating col-md-4">
                                            <input type="date" id="txtDataFormacao" class="form-control" placeholder="">
                                            <label>Data</label>
                                        </div>
                                        
                                        <div class="form-floating col-md-4">
                                            <input type="number" id="txtHoraFormacao" class="form-control only-number" maxlength="2" placeholder="">
                                            <label>Hora</label>
                                        </div>
    
                                        <div class="form-floating col-md-4">
                                            <input type="number" id="txtMinutoFormacao" class="form-control only-number" maxlength="2" placeholder="">
                                            <label>Minuto</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <div class="form-floating mt-3">
                                        <select class="select w-100 form-select" id="slcLocalCurso">
                                        </select>
                                        <label>Local</label>
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
<div class='modal-backdrop show'></div>

