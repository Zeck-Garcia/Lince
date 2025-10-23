<style>
    #btnSearchFormando{
        position: absolute;
        top:0px;
        right: 0px;
        cursor: pointer;
        z-index: 10;
        width: 45px;
        height: 45px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        font-size: 1.2rem !important;
        border-radius: 6px;
    }
</style>
<div class='modal show' tabindex='-1' style='display: block;' aria-modal='true' role='dialog'> 
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-fluid">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar novo formando</h5>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="">
                            <div class="row">

                                <div class="CampoGroup col-3 mt-3 w-100">
                                    <input type="text" id="txtCodFormando" class="form-control">
                                    <label>Cód</label>
                                    <span class="btn btn-success" id="btnSearchFormando"><i class="bi bi-search"></i></span>
                                </div>

                              	<div class="CampoGroup mt-3">
                                    <input type="text" id="txtNomeFormando" class="form-control">
                                    <label>Nome completo</label>
                                </div>

                                <div class="CampoGroup mt-3">
                                    <select class="select w-100 form-select" id="slcTipoFormacao">
                                    </select>
                                    <label>Formação</label>
                                </div>

                                <div class="row1">
                                    <div class="CampoGroup mt-3">
                                        <input type="date" id="txtDataFormacao" class="form-control">
                                    </div>
    
                                    <div class=" mt-3 row1">
                                        <div class="CampoGroup">
                                            <input type="text" id="txtHoraFormacao" class="form-control" onclick="onlyNumber(this)" maxlength="2">
                                            <label>Hora</label>
                                        </div>

                                        <div class="CampoGroup">
                                            <input type="text" id="txtMinutoFormacao" class="form-control" onclick="onlyNumber(this)" maxlength="2">
                                            <label>Minuto</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="CampoGroup mt-3 ">
                                    <select class="select w-100 form-select" id="slcLocalFormacao">
                                    </select>
                                    <label>Local</label>
                                </div>


                            </div>

                            <div class="modal-group-btn mt-3">
                                <input type="button" id="btnCloseModal" class="btnCloseModal btn btn-outline-secondary mr-3" data-dismiss="modal" value="Fechar">
                                <input type="button" id="btnActionSalvar" class="btn btn-success" value="Salvar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal-backdrop show'></div>

