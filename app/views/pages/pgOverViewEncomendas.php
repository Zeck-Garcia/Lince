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
            <div class="row1 w-100"> 
                <div class="row1 col-4">
                    <div class="CampoGroup w-100">
                        <input type="text" id="txtSearchUser" class="form-control">
                        <label>Buscar encomenda</label>
                    </div>
        
                    <button id="btnProcurar" class="btn btn-success"><i class="bi bi-search"></i></button>
                </div>

                <div class="CampoGroup active">
                    <select id="slcFeito" class="form-control form-select">
                        <option value="3">Todos</option>
                        <option value="1">Feita</option>
                        <option value="0" selected>Por fazer</option>
                    </select>
                    <label>Feito</label>
                </div>

                <div class="CampoGroup active">
                    <select id="slcLoja" class="form-control form-select">
                        <option value="3" selected>Todos</option>
                        <option value="1">Feita</option>
                        <option value="0">Por fazer</option>
                    </select>
                    <label>Loja</label>
                </div>

                <div class="CampoGroup active">
                    <select id="slcAssuntoDepartamento" class="form-control form-select">
                        <option value="3" selected>Todos</option>
                    </select>
                    <label>Departamento</label>
                </div>

                <div class="CampoGroup active">
                    <select id="slcAssunto" class="form-control form-select">
                        <option value="3" selected>Todos</option>
                    </select>
                    <label>Assunto</label>
                </div>
            </div>
        </div>


        <div class="quadroAleatorio mt-3">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-0-circle"></i>
                <p>Serviço</p>
                <span></span>
            </div>

            <div class="quadroAleatorioCorpo">
                <table class="table table-striped table-hover text-center table-bordered ">
                    <thead>
                        <tr>
                            <th>Loja</th>
                            <th>Assunto</th>
                            <th>Encomenda</th>
                            <th>Detalhes</th>
                            <th>Marcar</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyOverView">
                        <tr>
                            <td>nome</td>
                            <td>nome</td>
                            <td>nome</td>
                            <td><i class='bi bi-ticket-detailed btn btn-outline-info'></td>
                            <td><i class='bi bi-check-lg btn btn-outline-info'></td>
                        </tr>
                        <tr>
                            <td>nome</td>
                            <td>nome</td>
                            <td>nome</td>
                            <td><i class='bi bi-ticket-detailed btn btn-outline-info'></td>
                            <td><i class='bi bi-check-lg btn btn-outline-info'></td>
                        </tr>
                        <tr>
                            <td>nome</td>
                            <td>nome</td>
                            <td>nome</td>
                            <td><i class='bi bi-ticket-detailed btn btn-outline-info'></td>
                            <td><i class='bi bi-check-lg btn btn-outline-info'></td>
                        </tr>
                        <tr>
                            <td>nome</td>
                            <td>nome</td>
                            <td>nome</td>
                            <td><i class='bi bi-ticket-detailed btn btn-outline-info'></td>
                            <td><i class='bi bi-check-lg btn btn-outline-info'></td>
                        </tr>
                    </tbody>
                </table>

                <div  class="quadroAleatorioNoTitle paginationAqui">
                    <nav id='paginationHome'>
                    </nav>
                </div>
            </div>
        </div>

        <div class="quadroAleatorioNoTitle mt-3">
            <div class="">

            </div>
        </div>


    </div>

    <footer class="footerPage">
        <p>Roda pe</p>
    </footer>
</div>

<script src="public/js/pgOverViewEncomendas.js"></script>