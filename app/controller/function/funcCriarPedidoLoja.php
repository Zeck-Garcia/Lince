<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $codPodutoSet = str_replace(" ", "", trim(filter_input(INPUT_POST, "codPodutoSet")));

?>

    <!-- <div class="borderDashed p-3">
        <div class="row1">
            <div class="sltGroup">
                <label >Familia</label>
                <select class="select">
                    <option>Todos</option>
                    <option>Descanso</option>
                    <option>Sofás</option>
                </select>
            </div>

            <div class="sltGroup">
                <label >Produto</label>
                <select class="select">
                    <option>Todos</option>
                    <option>Decoração</option>
                    <option>Sofá</option>
                </select>
            </div>
        </div>


        <div class="mt-3" style="display:block;">
            <table class="table table-striped table-hover text-center table-bordered ">
                <thead>
                    <tr>
                        <th>nome</th>
                        <th>nome</th>
                        <th>nome</th>
                        <th>nome</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>nome</td>
                        <td>nome</td>
                        <td>nome</td>
                        <td>nome</td>
                    </tr>
                    <tr>
                        <td>nome</td>
                        <td>nome</td>
                        <td>nome</td>
                        <td>nome</td>
                    </tr>
                    <tr>
                        <td>nome</td>
                        <td>nome</td>
                        <td>nome</td>
                        <td>nome</td>
                    </tr>
                    <tr>
                        <td>nome</td>
                        <td>nome</td>
                        <td>nome</td>
                        <td>nome</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> -->


    <div class='quadroAleatorioNoTitle column1 mt-3'>
        <div class='row1'>

            <input type='text' id="txtProcurarProduto" class='form-control' placeholder='Buscar'>
            <button id="btnBuscarProduto" class='btn btn-success'>Procurar<i class='bi bi-search'></i></button>
        </div>

        <div id="containerProduto" class='row1 mt-3' style="display: block">

        </div>
    </div>

    <div class='quadroAleatorio mt-3'>
        <div class='quadroAleatorioTitle'>
            <i class='bi bi-list-ul'></i>
            <p>Itens da lista de pedidos</p>
            <span class="btn btn-danger" id="btnLimparLista"><i class="bi bi-fire"></i></span>
        </div>

        <div class='quadroAleatorioCorpo'>
            <table class='table table-striped table-hover text-center table-bordered'>
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Cod</th>
                        <th>Produto</th>
                        <th>QTD</th>
                        <th>Excluir</th>
                    </tr>
                </thead>

                <tbody id="tbodyPedido">
                </tbody>
            </table>
            <div class='row1 mb-3'>
                <button id="btnEnviarLista" class='btn btn-success'>Enviar lista de pedidos<i class='bi bi-send'></i></button>
            </div>
        </div>
    </div>
