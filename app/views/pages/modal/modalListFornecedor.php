<style>
    #campoEmpresa{
        position: relative;
    }

    #btnSearchListEmpresa{
        position: absolute;
        top: 0;
        right: 10px;
        height: 45px;
        z-index: 9;
        cursor: pointer;
    }

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
                            <div class="row d-flex gap-4 mt-3">
                              	<div class="CampoGroup" id="campoEmpresa">
                                    <input type="text" id="txtListCodEmpresa" class="form-control">
                                    <label>Buscar empresa</label>
                                    <span class="input-group-text" id="btnSearchListEmpresa"><i class="bi bi-search"></i></span>
                                </div>

                                <div class="">
                                    <table class="table table-striped table-hover text-center table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Usar</th>
                                                <th>Cod</th>
                                                <th>Empresa</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tbodyListEmpresa">
                                        </tbody>
                                    </table>
                                
                                </div>
                            </div>

                            <div class="modal-group-btn d-flex justify-content-end gap-3 mt-3">
                                <input type="button" id="btnCloseModal" class="btnCloseModal btn btn-outline-danger mr-3" data-dismiss="modal" value="Sair">
                                <input type="button" id="btnListUsar" class="btn btn-success" value="Usar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal-backdrop show'></div>

