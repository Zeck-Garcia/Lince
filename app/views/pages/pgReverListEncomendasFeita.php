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
            <div class="row1">
                <div class="CampoGroup mt-3 active">
                    <select id="slcLoja" class="form-control form-select">
                        <option value="0" selected>Todos</option>
                    </select>
                    <label>Loja</label>
                </div>
            </div>

            <div class="quadroAleatorioNoTitle column1 mt-3">
                <table class='table table-striped table-hover text-center table-bordered'>
                    <thead>
                        <tr>
                            <th>Feito por</th>
                            <th>Data feito</th>
                            <th>Loja</th>
                            <th>Data pedido</th>
                            <th>Cod</th>
                            <th>QTD</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyPedido">
                    </tbody>
                </table>
            </div>
            
            <div  class="quadroAleatorioNoTitle paginationAqui mt-3">
                <nav id='paginationHome'>
                </nav>
            </div>

        </div>

    </div>

    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgReverListEncomendasFeita.js"></script>
