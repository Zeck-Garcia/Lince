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
        <div class="quadroAleatorioNoTitle">
            <div class="CampoGroup mt-3 active">
                <select id="slcLoja" class="form-control form-select">
                    <option value="0" selected>Todos</option>
                </select>
                <label>Loja</label>
            </div>

            <div class="quadroAleatorioNoTitle column1 mt-3">
                <table class='table table-striped table-hover text-center table-bordered'>
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="chkAll"></th>
                            <th>Loja</th>
                            <th>Data pedido</th>
                            <th>Cod</th>
                            <th>QTD</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyPedido">
                    </tbody>
                </table>

                <div class="groupBtn row1 mb-3 w-100">
                    <input type="button" id="btnBaixarEncomendas" class="btn btn-success" value="Baixar pedidos">
                </div>
            </div>
        </div>
    </div>

    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgListEncomendasLojas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>