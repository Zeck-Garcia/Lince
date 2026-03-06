    <?php include_once "app/views/pages/pgFilterLateral.php";?>

<div class="bodyPage">
    <div class="groupBody">
        <div class="quadroAleatorioNoTitle">

            <div class="">
                <div class="d-flex justify-content-between mb-3">
                    <div class="CampoGroup col-1">
                        <input type="text" id="txtCodColaborador" class="form-control">
                        <label for="txtCodColaborador">Cod</label>
                    </div>

                    <div class="CampoGroup w-100 ms-3">
                        <input type="text" id="txtSearchUser" class="form-control">
                        <label>Buscar User</label>
                    </div>
                    <button id="btnProcurar" class="btn btn-outline-success col-1 ms-3"><i class="bi bi-search"></i></button>
                    <button id="btnNovo" class="btn btn-info col-1 ms-3"><i class="bi bi-person-plus"></i></button>
                </div>

                <div class="borderDashed p-2 d-flex justify-content-between">
                    <div class="CampoGroup col-6 active">
                        <select class="form-select" id="slcDepartamento">
                            <option value="0">Selecione</option>
                        </select>
                        <label>Departamento</label>
                    </div>

                    <div class="CampoGroup active col-6 ms-3">
                        <select class="form-select" id="slcCargo">
                            <option value="0">Selecione</option>
                        </select>
                        <label>Cargo</label>
                    </div>
                </div>

            </div>

            <table class="table table-striped table-hover text-center table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Nome Utilizador</th>
                        <th>Email</th>
                        <th>Departamento</th>
                        <th>Cargo</th>
                        <th>Ativo</th>
                        <th>Ação</th>
                    </tr>
                </thead>
    
                <tbody id="tbodyList">
                </tbody>
            </table>

            <div  class="quadroAleatorioNoTitle paginationAqui">
                <nav aria-label="Navegação de entregas" class="container-pagination">
                    <ul class="pagination justify-content-center custom-pagination" id="paginador">
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

        <div id="containerUser" class="quadroAleatorio mt-3">
        </div>
    </div>
</div>

<script src="public/assets/js/pgUltilizadores.js?v=<?= VERSION ?>"></script>