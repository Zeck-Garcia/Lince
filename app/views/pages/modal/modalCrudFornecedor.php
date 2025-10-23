<style>

</style>


<div class='modal show' tabindex='-1' style='display: block;' aria-modal='true' role='dialog'> 
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-fluid">
                <div class="modal-header">
                    <h5 class="modal-title">Cadastrar empresa</h5>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="">
                            <div class="row d-flex gap-4 mt-4">
                              	<div class="CampoGroup">
                                    <input type="text" id="txtAddNomeEmpresa" class="form-control" value="" data-id-fornecedor="">
                                    <label>Nome da empresa</label>
                                </div>

                                <div class="CampoGroup">
                                    <input type="text" id="txtAddSiteEmpresa" class="form-control" value="">
                                    <label>Site da empresa</label>
                                </div>

                                <div class="CampoGroup">
                                    <input type="text" id="txtAddEmailEmpresa" class="form-control" value="" onclick="noSpace(this)">
                                    <label>Email da empresa</label>
                                </div>
                            </div>

                            <div class="modal-group-btn d-flex justify-content-end gap-3 mt-3">
                                <input type="button" id="btnCloseModal" class="btnCloseModal btn btn-outline-danger mr-3" data-dismiss="modal" value="Cancelar">
                                <input type="button" id="btnSalvarUsar" class="btn btn-outline-success" value="Salvar e usar">
                                <input type="button" id="btnSalvar" class="btn btn-success" value="Salvar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal-backdrop show'></div>

