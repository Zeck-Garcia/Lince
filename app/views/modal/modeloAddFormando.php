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
                                <div class="d-flex align-items-center">
                                    <div class="CampoGroup w-100">
                                    <input type="text" id="txtCodColaborador" class="form-control only-number">
                                    <label>Cód</label>
                                    </div>
                                    <button id="btnSearchFormando" class="btn btn-primary col-2 ms-2" onclick=""><i class="bi bi-search"></i></button>
                                    <button id="btnSaveFormando" class="btn btn-success col-2 ms-2">Salvar</button>
                                </div>

                              	<div class="CampoGroup mt-3">
                                    <input type="text" id="txtNomeColaborador" class="form-control">
                                    <label>Nome completo</label>
                                </div>

                                <div class="CampoGroup mt-3 active">
                                    <select class="select w-100 form-select" id="slcTipoCurso">
                                    </select>
                                    <label>Formação</label>
                                </div>

                                <div class="mt-3">
                                    <div class="d-flex g-2 row">
                                        <div class="CampoGroup col-md-4">
                                            <input type="date" id="txtDataFormacao" class="form-control">
                                        </div>
                                        
                                        <div class="CampoGroup col-md-4">
                                            <input type="number" id="txtHoraFormacao" class="form-control only-number" maxlength="2">
                                            <label>Hora</label>
                                        </div>
    
                                        <div class="CampoGroup col-md-4">
                                            <input type="number" id="txtMinutoFormacao" class="form-control only-number" maxlength="2">
                                            <label>Minuto</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="CampoGroup mt-3 active">
                                    <select class="select w-100 form-select" id="slcLocalCurso">
                                    </select>
                                    <label>Local</label>
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

