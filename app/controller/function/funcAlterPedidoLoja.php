<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

?>
<div class='quadroAleatorioNoTitle row1 mt-3'>
    <div class="CampoGroup">
        <label>Estado</label>
        <select class="select" id="sltFeito">
            <option value="" selected>Todos</option>
            <option value="1">Feito</option>
            <option value="0">Não feito</option>
        </select>
    </div>

    <div class="row1">
        <div class="CampoGroup">
            <label>Buscar</label>
            <input type="text" id="txtProcurar" class="form-control">
        </div>

        <div><button id="btnBuscarProduto" class="btn btn-success"><i class='bi bi-search'></i></button></div>
    </div>
</div>


<div class='quadroAleatorioNoTitle column1 mt-3'>
    <table class='table table-striped table-hover text-center table-bordered'>
        <thead>
            <tr>
                <th>Estado</th>
                <th>Data</th>
                <th>Cod</th>
                <th>Produto</th>
                <th>QTD</th>
                <th>Excluir</th>
            </tr>
        </thead>

        <tbody id="tbodyPedido">

        <?php

            //$cama = buscarProdutoLoja("","");

            // var_dump($cama);

            // if(mysqli_num_rows($qryListPedidoLoja) > 0){
            //     while($dadosList = $operation->listar($qryListPedidoLoja)){
            //         $feito = $dadosList['feitoPedido'];
            //         $class = ($feito == 0 ? "" : "rowSuccess");
            //         $data = ($dadosList['dataFeitoPedido'] == "" ? "" : (new DateTime($dadosList['dataFeitoPedido']))->format("d/m/Y") );
            //         $idRow = $dadosList['idPedido'];
            //         echo "<tr class='rowList {$class}' data-id-row='{$idRow}'>
            //             <td>" . ($feito == 0 ? "" : "Já solicitado") . "</td>
            //             <td>{$data}</td>
            //             <td>{$dadosList['codProdutoPedido']}</td>
            //             <td>{$dadosList['nomeProduto']}</td>
            //             <td>{$dadosList['qtdPedido']}</td>
            //             <td>" . ($feito == 0 ? "<i class='bi bi-trash' onclick='excluirProdutoFeito(event)'></i>" : "") . "</td>
            //         </tr>";
            //     }
            // }
        ?>
        </tbody>
    </table>
</div>