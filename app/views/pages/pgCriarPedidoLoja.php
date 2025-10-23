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
        <div class='quadroAleatorioNoTitle column1 mt-3'>
            <div class='row1'>
        
                <input type='text' id="txtProcurarProduto" class='form-control' placeholder='Buscar'>
                <button id="btnBuscarProduto" class='btn btn-success'>Procurar<i class='bi bi-search'></i></button>
            </div>
        
            <div id="containerProduto" class='row1 mt-3' style="display: block">
                <!-- <div class='imgGroupProduto'>
                    <img class='imgProduto' src='./././public/assets/no_imagen.jpg' id=''>
                </div>
        
                <div class='column1'>
                    <h2 class='titleProduto'>Nome do produto será aqui</h2>
        
                    <div class=''>
                        <div class='groupSizeSmallInfo borderDashed'>
                            <div class='groupSizeSmallInfoIcon'><i class='bi bi-info-circle'></i></div>
                            <div class='groupSizeSmallInfoItem'>
                                <div class='groupSizeSmallInfoItemTitle'>Artigo</div>
                                <div class='groupSizeSmallInfoText'>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi molestiae ipsam praesentium labore non animi dolores aut dolor officia omnis eligendi inventore sunt eaque, iure repellat molestias excepturi nostrum aperiam.</div>
                            </div>
                        </div>
        
                        <div class='mt-3 labelGroup'>
                            <label>Quantidade</label>
                            <input type='text' class='form-control' placeholder='Informe a quantidade'>
                        </div>
        
                        <div class='mt-3'>
                            <button class='btn btn-success'>Adicionar<i class='bi bi-card-checklist'></i></button>
                        </div>
                    </div>
                </div> -->
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
    </div>

    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>



<script src="public/js/pgCriarPedidoLoja.js"></script>
