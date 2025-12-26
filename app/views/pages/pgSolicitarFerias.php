<?php
// if($_SESSION["loginUser"] == false){
//     header('Location: login');
// } else {
//     if($_SESSION["loginUser"] != true or $_SESSION["classeAgente"] != "3"){
//         header('Location: login');
//     }
// }

?>
<style>
    #containerPedirFerias{
        display: flex;
        flex-direction: row;
        gap: 10px;
        align-items: center;
    }
</style>
<div class="menuLateral">
    <?php include_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">
    <!--  -->
        
        <div class="quadroAleatorio">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-0-circle"></i>
                <p>Férias marcadas</p>
                <span></span>
            </div>

            <div class="quadroAleatorioCorpo">
                <table class="table table-striped table-hover text-center table-bordered ">
                    <thead>
                        <tr>
                            <th>Colaborador</th>
                            <th>Periodo</th>
                            <th>Situação</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Henrique</td>
                            <td>20/20/2025 a 20/20/2025</td>
                            <td>Aprovado</td>
                            <td><i class="bi bi-check-lg btn btn-success"></i></td>
                        </tr>
                        <tr>
                            <td>Henrique</td>
                            <td>20/20/2025 a 20/20/2025</td>
                            <td>Aprovado</td>
                            <td><i class="bi bi-check-lg btn btn-success"></i></i></td>
                        </tr>
                        <tr>
                            <td>Henrique</td>
                            <td>20/20/2025 a 20/20/2025</td>
                            <td>Por aprovar</td>
                            <td><i class="bi bi-trash btn btn-outline-info"></i></td>
                        </tr>
                        <tr>
                            <td>Henrique</td>
                            <td>20/20/2025 a 20/20/2025</td>
                            <td>Aprovado</td>
                            <td><i class="bi bi-check-lg btn btn-success"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
        <div class="quadroAleatorioNoTitle mt-3">
            <button id="btnNovaFerias" class="w-100 btn btn-success">Marcar novas férias</button>
        </div>

        <div id="containerNovaFerias" class="hidder">
            <div class="quadroAleatorio mt-3 ">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-0-circle"></i>
                    <p>Novas ferias</p>
                    <span><i class="btn btn-sm btn-outline-danger">Fechar</i></span>
                </div>
    
                <div  class="quadroAleatorioCorpo">
                    <div class="CampoGroup">
                        <select id="slcFeriasFuncionario" class="form-control form-select">
                            <option value=""></option>
                            <option value="1">funcionario 1</option>
                            <option value="2">funcionario 2</option>
                        </select>
                        <label>Colaborador</label>
                        <small></small>
                    </div>
    
                    <div id="containerPedirFerias" class="row1 mt-3">
                        <div class="row1">
                            <div class="groupSizeSmallInfo">
                                <div class="groupSizeSmallInfoIcon"></div>
                                <div class="groupSizeSmallInfoItem">
                                    <div class="groupSizeSmallInfoItemTitle">De:</div>
                                    <div class="groupSizeSmallInfoText row1 mt-3">
                                        <div class="CampoGroup col-4">
                                            <select id="slcDeAno" class="form-select">
                                                <option value=""></option>
                                            </select>
                                            <label>Ano</label>
                                        </div>
    
                                        <div class="CampoGroup col-4">
                                            <select id="slcDeMes" class="form-select">
                                                <option value=""></option>
                                            </select>
                                            <label>Mês</label>
                                        </div>
    
                                        <div class="CampoGroup col-3">
                                            <select id="slcDeDia" class="form-select">
                                                <option value=""></option>
                                            </select>
                                            <label>Dia</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="row1">
                            <div class="groupSizeSmallInfo">
                                <div class="groupSizeSmallInfoIcon"></div>
                                <div class="groupSizeSmallInfoItem">
                                    <div class="groupSizeSmallInfoItemTitle">Ate:</div>
                                    <div class="groupSizeSmallInfoText row1 mt-3">
                                        <div class="CampoGroup col-4">
                                            <select id="slcAteAno" class="form-select">
                                                <option value=""></option>
                                            </select>
                                            <label>Ano</label>
                                        </div>
    
                                        <div class="CampoGroup col-4">
                                            <select id="slcAteMes" class="form-select">
                                                <option value=""></option>
                                            </select>
                                            <label>Mês</label>
                                        </div>
    
                                        <div class="CampoGroup col-3">
                                            <select id="slcAteDia" class="form-select">
                                                <option value=""></option>
                                            </select>
                                            <label>Dia</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div id="containerTempoFerias" class="hidder" >
                            <span style="font-size: 2rem !important;" id="contarDias">15 dias</span>
                        </div>
                    </div>
    
                    <div class="row1">
                        <button id="btnAddFeriasAlista" class="w-100 btn btn-success mt-3">Adicionar a lista</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="containerSendFerias" class="hidder">
            <div  class="quadroAleatorio mt-3">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-0-circle"></i>
                    <p>Marcação de férias em curso</p>
                    <span></span>
                </div>
    
                <div  class="quadroAleatorioCorpo">
                <table class="table table-striped table-hover text-center table-bordered ">
                        <thead>
                            <tr>
                                <th>Situação</th>
                                <th>Colaborador</th>
                                <th>De</th>
                                <th>Ate</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
    
                        <tbody id="tbodyListSendFerias">
                            <!-- <tr>
                                <td>Eviado</td>
                                <td>Henrique</td>
                                <td>20/20/2025</td>
                                <td>20/20/2025</td>
                                <td><i class="bi bi-trash btn btn-outline-info"></i></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Henrique</td>
                                <td>20/20/2025</td>
                                <td>20/20/2025</td>
                                <td><i class="bi bi-trash btn btn-outline-info"></i></i></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Henrique</td>
                                <td>20/20/2025</td>
                                <td>20/20/2025</td>
                                <td><i class="bi bi-trash btn btn-outline-info"></i></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Henrique</td>
                                <td>20/20/2025</td>
                                <td>20/20/2025</td>
                                <td><i class="bi bi-trash btn btn-outline-info"></i></td>
                            </tr> -->
                        </tbody>
                    </table>
                    <div class="row1">
                        <button id="btnCancelarEnvioFerias" class="w-100 btn btn-outline-danger mt-3">Cancelar o envio</button>
                        <button id="btnEnviarEnvioFerias" class="w-100 btn btn-success mt-3">Enviar lista de férias</button>
    
                    </div>
                </div>
    
            </div>
        </div>
    <!--  -->
    </div>

    <footer class="footerPage">
        <p>Roda pe</p>
    </footer>
</div>

<script src="public/js/pgSolicitarFerias.js"></script>
