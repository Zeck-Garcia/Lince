<style>
  #btnSearchFuncionario{
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-fluid">
                <div class="modal-header">
                    <h5 class="modal-title">Gerir Funcionario</h5>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="">
                            <div class="row">

                                <div class="CampoGroup col-3 mt-3 w-100">
                                    <input type="text" id="txtCodFuncionario" class="form-control">
                                    <label>Cód</label>
                                    <span class="btn btn-success" id="btnSearchFuncionario"><i class="bi bi-search"></i></span>
                                </div>

                              	<div class="CampoGroup mt-3">
                                    <input type="text" id="txtNomeFuncionario" class="form-control">
                                    <label>Nome completo</label>
                                </div>

                                <div class="CampoGroup mt-3 ">
                                    <select class="select w-100 form-select" id="slcLocalTrabalho">
                                    </select>
                                    <label>Local de trabalho</label>
                                </div>


                                <div class="mt-3">
                                    <table class="table table-striped table-hover text-center table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                                <th>Local trabalho</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tbodyListFuncionario">
                                        </tbody>
                                    </table>
                                </div>

                                <div  class="quadroAleatorioNoTitle paginationAqui mt-3">
                                    <nav id='paginationHomeModal'>
                                    </nav>
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

