<?php
// if($_SESSION["idUser"] == false){
//     header('Location: login');
// } else {
//     if($_SESSION["idUser"] != true or !in_array($_SESSION["classeAgente"], [1,2])){
//         header('Location: login');
//     }
// }
// include_once "app/controller/function/funcExpiraSessao.php";
?>
<style>
    .groupBody{
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .quadroAleatorio{
        margin-bottom: 10px;
    }

    .groupBtn{
        width: 100%;
        display: flex;
        flex-direction: row;
        gap: 15px;
    }

    .groupBtn > input{
        height: 60px;
        width: 100%;
    }

    .quadroAleatorioNoTitle{
        padding: 10px !important;
    }

    .borderDash{
        border: dashed 1px #ccc;
        padding: 5px;
        border-radius: 6px;
    }

    h3{
        font-size: 1.3rem !important;
        font-weight: 500 !important;
    }

    .borderDash > span{
        color: #949494;
    }

    .anexoGroup{
        padding: 10px;
        border-radius: 6px;
        box-shadow: 2px 2px 3px #ccc;
        border: solid 1px #ccc;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: center;
        cursor: pointer;
    }

    .anexoGroup > span > i{
        font-size: 1.5rem !important;
    }

    #btnProcurarOrderCompra{
        width: 150px;
    }

    .aprovado > td{
        /* background-color: var(--bs-success-bg-subtle); */
        color: green;
    }

    .rejeitado > td{
        color: red;
        /* background-color: var(--bs-danger-bg-subtle); */
    }

    .actionFinal{
        height: 50px;
        text-align: center;
        padding-top:15px;
        border-radius: 4px;
        box-shadow: 1px 2px 1px #ccc;
        color: #fff;
    }

    #divArquivo{
        width: 48px;
        height: 48px;
        border-radius: 4px;
        box-shadow: 1px 2px 1px #ccc;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: rgba(223, 230, 233,0.8);
    }
    
    #divArquivo > span{
        font-size: 0.7rem !important;
    }

    #divArquivo:hover{
        cursor: pointer;
    }
/* tablet */
@media (min-width: 751px ) and (max-width: 1100px){

}
    
    
/* mobile */
@media (max-width: 750px) {

}

</style>

<div class="menuLateral">
    <?php include_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">
        <div class="quadroAleatorioNoTitle">

            <div class="row1 mb-3">
                <div class="row1  w-100">
                    <div class="CampoGroup w-100">
                        <input type="text" id="numberOrderCompra" class="form-control">
                        <label>Buscar</label>
                    </div>
        
                    <button id="btnProcurarOrderCompra" class="btn btn-success"><i class="bi bi-search"></i></button>
                </div>

                <?php

                    if(in_array($_SESSION["classeAgente"],[1])){
                        echo "<div class='row1 col-3'>
                            <div class='CampoGroup w-100 active'>
                                <select id='slcFeito' class='form-control form-select'>
                                    <option value='0'>Todos</option>
                                </select>
                                <label>Feito</label>
                            </div>
                        </div>";
                    }
                ?>


                <div class="row1 col-3">
                    <div class="CampoGroup w-100 active">
                        <select id="slcPedido" class="form-control form-select">
                            <option value="3" selected>Por aprovar</option>
                            <option value="1">Aprovados</option>
                            <option value="0">Rejeitado</option>
                            <option value="2">Todos</option>
                        </select>
                        <label>Pedidos</label>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover text-center table-bordered ">
                <thead>
                    <tr>
                        <th>Nº da ordem</th>
                        <th>Autor</th>
                        <th>Criação</th>
                        <th>Email enviado<br>ao fornecedor</th>
                        <th>Ver</th>
                    </tr>
                </thead>
    
                <tbody id="tbodyListOrder">
                </tbody>
            </table>

            <div  class="quadroAleatorioNoTitle paginationAqui">
                <nav id='paginationHome'>
                </nav>
            </div>
        </div>

        <div id="infoOrdemCompra">
            <!-- <div class="quadroAleatorio">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-person"></i>
                    <p>Dados do solicitante</p>
                    <span></span>
                </div>

                <div class="quadroAleatorioCorpo">
                    <div class="borderDash mt-3">
                        <span>Nome</span>
                        <h3>1</h3>
                    </div>
                    
                    <div class="row1">
                        <div class="borderDash mt-3 w-100">
                            <span>Data</span>
                            <h3>Empresa 1</h3>
                        </div>
                        
                        <div class="borderDash mt-3">
                            <span>Prioridade</span>
                            <h3>1</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quadroAleatorio">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-building"></i>
                    <p>Dados da empresa</p>
                    <span></span>
                </div>

                <div class="quadroAleatorioCorpo">
                    <div class="row1">
                        <div class="borderDash mt-3">
                            <span>Nº</span>
                            <h3>1</h3>
                        </div>
                        
                        <div class="borderDash mt-3 w-100">
                            <span>Nome</span>
                            <h3>Empresa 1</h3>
                        </div>
                    </div>
                    
                    <div class="borderDash mt-3">
                        <span>Site</span>
                        <h3>www.www.www</h3>
                    </div>
                </div>
            </div>

            <div class="quadroAleatorio">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-journal-check"></i>
                    <p>Dados da nota</p>
                    <span></span>
                </div>

                <div class="quadroAleatorioCorpo">
                    <div class="borderDash mt-3">
                        <span>Valor</span>
                        <h3>22.22</h3>
                    </div>
                    
                    <div class="borderDash mt-3">
                        <span>Detalhe do item</span>
                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae veritatis enim, beatae adipisci distinctio quis aspernatur dolor delectus ratione cumque quod itaque consequatur, et sint rerum officia, fugiat atque laborum.</h3>
                    </div>
                    
                    <div class="borderDash mt-3">
                        <span>Descrição da compra</span>
                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti magnam nobis voluptates porro debitis illum quia eius suscipit, sint pariatur quaerat adipisci ad molestias dolore harum, sed perferendis voluptatem nostrum.</h3>
                    </div>
                </div>
            </div>

            <div class="quadroAleatorio">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-file-earmark-zip"></i>
                    <p>Anexo</p>
                    <span></span>
                </div>

                <div class="quadroAleatorioCorpo">
                    <div class="borderDash d-flex gap-3">
                        <div class="anexoGroup">
                            <span><i class="bi bi-file-image"></i></span>
                            <h5 class="titleFile">sdsfffs.jpg</h5>
                        </div>

                        <div class="anexoGroup">
                            <span><i class="bi bi-file-word"></i></span>
                            <h5 class="titleFile">sdsfffs.doc</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quadroAleatorioNoTitle groupBtn ">
                <input type="buton" class="btn btn-outline-danger w-100" value="Rejeitar">
                <input type="buton" class="btn btn-success w-100" value="Aprovar">
            </div> -->
        </div>

    </div>

    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgListOrderCompra.js?v=<?= $versao;?>"></script>
