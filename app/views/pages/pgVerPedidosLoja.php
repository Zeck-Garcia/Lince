<?php
// if($_SESSION["loginUser"] == false){
//     header('Location: login');
// } else {
//     if($_SESSION["loginUser"] != true or $_SESSION["classeAgente"] != "3"){
//         header('Location: login');
//     }
// }

?>
<div class="menuLateral">
    <?php include_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">
       
    <div class='quadroAleatorioNoTitle row1 mt-3'>
        <div class="CampoGroup active">
            <select class="form-control form-select" id="sltFeito">
                <option value="3" selected>Todos</option>
                <option value="1">Feito</option>
                <option value="0">Não feito</option>
            </select>
            <label>Estado</label>
        </div>

        <div class="row1">
            <div class="CampoGroup">
                <input type="text" id="txtProcurar" class="form-control">
                <label>Buscar</label>
            </div>

            <div><button id="btnBuscarProduto" class="btn btn-success"><i class='bi bi-search'></i></button></div>
        </div>
    </div>
        
    <div class='quadroAleatorioNoTitle column1 mt-3'>
        <table class='table table-striped table-hover text-center table-bordered'>
            <thead>
                <tr>
                    <th>Estado</th>
                    <th>Data solicita</th>
                    <th>Data pedido</th>
                    <th>Cod</th>
                    <th>Produto</th>
                    <th>QTD</th>
                    <th>Excluir</th>
                </tr>
            </thead>

            <tbody id="tbodyPedido">
            </tbody>
        </table>

        <div  class="quadroAleatorioNoTitle paginationAqui">
            <nav id='paginationHome'>
            </nav>
        </div>
    </div>
       
    </div>

    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgVerPedidoLoja.js"></script>
