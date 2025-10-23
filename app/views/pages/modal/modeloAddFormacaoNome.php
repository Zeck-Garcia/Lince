<style>
    #btnSaveFormacao{
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
                    <h5 class="modal-title">Adicionar nova formação</h5>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="">
                            <div class="row">

                              	<div class="CampoGroup mt-3">
                                    <input type="text" id="txtNomeFormacao" class="form-control">
                                    <label>Titulo da formação</label>
                                    <button id="btnSaveFormacao" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                                </div>

                                <div class="mt-3">
                                    <table class="table table-striped table-hover text-center table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Formação</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tbodyFormacao">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal-backdrop show'></div>

