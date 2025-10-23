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
    .containerDetailsMore{
        margin-top: 10px !important;
    }
</style>

<div class="menuLateral">
    <?php include_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage" id="containerBodyPage">
    <div class="groupBody">
    <!--  -->
        <div class="quadroAleatorio">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-people"></i>
                <p>Colaboradores</p>
                <span></span>
            </div>

            <div class="quadroAleatorioCorpo">
                <table class="table table-striped table-hover text-center table-bordered ">
                    <thead>
                        <tr>
                            <th>Cód colaborador</th>
                            <th>Cargo</th>
                            <th>Nome</th>
                            <th>Data de adminissão</th>
                            <th>Detalhes</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyListColaborador">
                        <tr>
                            <td>344</td>
                            <td>Gerente</td>
                            <td>Henrique</td>
                            <td>20/20/2025</td>
                            <td><i class="bi bi-info btn btn-outline-info"></i></td>
                        </tr>
                        <tr>
                            <td>435</td>
                            <td>Gerente</td>
                            <td>Henrique</td>
                            <td>20/20/2025</td>
                            <td><i class="bi bi-info btn btn-outline-info"></i></td>
                        </tr>
                        <tr>
                            <td>3242</td>
                            <td>Gerente</td>
                            <td>noHenriqueme</td>
                            <td>20/20/2025</td>
                            <td><i class="bi bi-info btn btn-outline-info"></i></td>
                        </tr>
                        <tr>
                            <td>876</td>
                            <td>Gerente</td>
                            <td>Henrique</td>
                            <td>20/20/2025</td>
                            <td><i class="bi bi-info btn btn-outline-info"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
            <!-- mais detalhes -->
        <div class="">
            <div id="containerMoreDetailsColaborador" class="quadroAleatorio mt-3 ">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-person-lines-fill"></i>
                    <p>Detalhes do colaborador</p>
                    <span><i class="btn btn-outline-danger">Fechar</i></span>
                </div>
    
                <div class="quadroAleatorioCorpo">
                    <div class="containerDetailsMore">
                        <div class="dp-grid grid-2">
                            <div class="groupSizeSmallInfo">
                                <div class="groupSizeSmallInfoItem">
                                    <div class="groupSizeSmallInfoItemTitle">Nome</div>
                                    <div class="groupSizeSmallInfoText">44545d4545f</div>
                                </div>
                            </div>
            
                            <div class="groupSizeSmallInfo">
                                <div class="groupSizeSmallInfoItem">
                                    <div class="groupSizeSmallInfoItemTitle">Data de nascimento</div>
                                    <div class="groupSizeSmallInfoText">44545d4545f</div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="containerDetailsMore dp-grid grid-4">
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">contacto 1</div>
                                <div class="groupSizeSmallInfoText">44545d4545f</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">contacto 2</div>
                                <div class="groupSizeSmallInfoText">44545d4545f</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Email</div>
                                <div class="groupSizeSmallInfoText">email@emial.com</div>
                            </div>
                        </div>
                    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">contacto de emergência</div>
                                <div class="groupSizeSmallInfoText">78645365464</div>
                            </div>
                        </div>
                    </div>
    
                    <div class="mt-2 dp-grid grid-4">
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Nº doc identificação</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Validade</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">contribuinte</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">NISS</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
                    </div>
    
                    <div class="mt-2 dp-grid grid-4">
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Nacionalidade</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Naturalidade</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Concelho</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Freguesia</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
                    </div>
    
                    <div class="row1 w-100 containerDetailsMore">
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Morada</div>
                                <div class="groupSizeSmallInfoText">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi molestiae ipsam praesentium labore non animi dolores aut dolor officia omnis eligendi inventore sunt eaque, iure repellat molestias excepturi nostrum aperiam.</div>
                            </div>
                        </div>
                    </div>
    
                    <div class="mt-2 dp-grid grid-4">
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Nº dependente</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Parentesco</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Nome</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Data nascimento</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
                    </div>
    
                    <div class="mt-2 dp-grid grid-2">
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Estado civil</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
    
                        <div class="groupSizeSmallInfo">
                            <div class="groupSizeSmallInfoItem">
                                <div class="groupSizeSmallInfoItemTitle">Nome do cônjuge</div>
                                <div class="groupSizeSmallInfoText">99999999999</div>
                            </div>
                        </div>
                    </div>
    
                    <!-- <div class="quadroAleatorio mt-3">
                        <div class="quadroAleatorioTitle">
                            <i class="bi bi-0-circle"></i>
                            <p>Lista de uniforme</p>
                            <span></span>
                        </div>
    
                        <div class="quadroAleatorioCorpo">
                            <table class="table table-striped table-hover text-center table-bordered ">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Qtd</th>
                                        <th>Ano</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    <tr>
                                        <td>Camisola</td>
                                        <td>2</td>
                                        <td>2025</td>
                                    </tr>
                                    <tr>
                                        <td>Tshirt</td>
                                        <td>3</td>
                                        <td>2025</td>
                                    </tr>
                                    <tr>
                                        <td>Camisola</td>
                                        <td>2</td>
                                        <td>2024</td>
                                    </tr>
                                    <tr>
                                        <td>Calça</td>
                                        <td>0</td>
                                        <td>2024</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> -->
    
                    <div class="quadroInfoDados mt-2 w-100">
                        <div class="quadroInfoDadosTitle">Anexar documento pendente</div>
                        
                        <div class="quadroInfoDadosText dp-grid grid-2">
                                <div class="mt-2">
                                    <input type="file"><br>
                                    <label class="mt-2"><strong>IBAN</strong></label><br>
                                </div>
    
                                <div class="mt-2">
                                    <input type="file"><br>
                                    <label class="mt-2"><strong>IBAN</strong></label><br>
                                </div>
    
                                <div class="mt-2">
                                    <input type="file"><br>
                                    <label class="mt-2"><strong>IBAN</strong></label><br>
                                </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>

        <div class="quadroAleatorioNoTitle mt-3">
            <button id="btnNewColaborador" class="w-100 btn btn-success">Criar novo colaborador</button>
        </div>
    
        <div id="containerGoupNewCadastro" class="hidder">
            <div  class="quadroAleatorio mt-3">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-person-plus"></i>
                    <p>Dados pessoais</p>
                    <span></span>
                </div>
    
                <!-- cadastro -->
                <div class="quadroAleatorioCorpo">
                    <!-- inicio dos dados pessoas -->
                     <p>Após o envio do formulário, você não poderá mais alterar os dados. Então antes de enviar confira se os dados estão corretos.</p>
                    <div class="row1 w-100">
                        <div class="CampoGroup mt-3 w-100">
                            <input type="text" id="txtNomeCompleto" class="form-control">
                            <label>Nome completo</label>
                        </div>
    
                        <div class="CampoGroup mt-3">
                            <input type="text" id="txtDataNascimento" class="form-control">
                            <label>Data nascimento</label>
                        </div>
                    </div>
    
                    <!-- contacto -->
                    <div class="col1 w-100">
                        <div class="row1">
                            <div class="CampoGroup mt-3 w-100">
                                <input type="text" id="txtContacto1" class="form-control">
                                <label>Contacto 1</label>
                            </div>
        
                            <div class="CampoGroup mt-3 w-100">
                                <input type="text" id="txtContacto2" class="form-control">
                                <label>Contacto 1</label>
                            </div>
                            
                            <div class="CampoGroup mt-3 w-100">
                                <input type="text" id="txtContactoEmergencia" class="form-control">
                                <label>Contacto de emergência</label>
                            </div>
                        </div>
    
                        <div class="CampoGroup mt-3 w-100">
                            <input type="text" id="txtEmail" class="form-control">
                            <label>E-mail</label>
                        </div>
                    </div>
    
                    <!-- contribuinte -->
                    <div class="row1 w-100">
                        <div class="CampoGroup mt-3 w-100">
                            <input type="text" id="txtNumeroIdentificacao" class="form-control">
                            <label>Nº doc identificação</label>
                        </div>
    
                        <div class="CampoGroup mt-3 w-100">
                            <input type="text" id="txtNumeroIdentificacaoValidade" class="form-control">
                            <label>Validade</label>
                        </div>
    
                        <div class="CampoGroup mt-3 w-100">
                            <input type="text" id="txtNIF" class="form-control">
                            <label>NIF</label>
                        </div>
    
                        <div class="CampoGroup mt-3 w-100">
                            <input type="text" id="txtNISS" class="form-control">
                            <label>NISS</label>
                        </div>
                    </div>
    
                    <!-- morada -->
                    <div class="row1">
                        <div class="CampoGroup mt-3">
                            <input type="text" id="txtMorada" class="form-control">
                            <label>Morada</label>
                        </div>
    
                        <div class="CampoGroup mt-3">
                            <input type="text" id="txtPorta" class="form-control">
                            <label>Porta</label>
                        </div>
    
                        <div class="CampoGroup mt-3">
                            <input type="text" id="txtAndar" class="form-control">
                            <label>Andar</label>
                        </div>
    
                        <div class="CampoGroup mt-3">
                            <input type="text" id="txtCodPostal" class="form-control">
                            <label>Código postal</label>
                        </div>
                    </div>
                    
                    <div class="row1">
                        <div class="CampoGroup mt-3">
                            <input type="text" id="txtLocalidade" class="form-control" disabled>
                            <label>Localidade</label>
                        </div>
                        
                        <div class="CampoGroup mt-3">
                            <input type="text" id="txtConcelho" class="form-control" disabled>
                            <label>Concelho</label>
                        </div>
    
                        <div class="CampoGroup mt-3">
                            <input type="text" id="txtDistrito" class="form-control" disabled>
                            <label>Distrito</label>
                        </div>
                    </div>
                    
                    <!-- nacionalidade -->
                    <div class="row1">
                        <div class="CampoGroup mt-3 w-100">
                            <select id="slcNacionalidade" class="form-select">
                                <option value=""></option>
                                <option value="Portugal">Portugal</option>
                                <hr>
                            </select>
                            <label>Nacionalidade</label>
                        </div>
    
                        <!-- caso seja portugues nao exibe isso -->
                        <div class="CampoGroup mt-3 w-100">
                            <select id="slcNaturalidade" class="form-select">
                                <option value=""></option>
                                <option value="Portugal">Portugal</option>
                                <hr>
                            </select>
                            <label>Naturalidade</label>
                        </div>
    
                        <div class="CampoGroup mt-3 w-100">
                            <input type="text" id="txtConcelhoNaturalidade" class="form-control">
                            <label>Concelho</label>
                        </div>
    
                        <div class="CampoGroup mt-3 w-100">
                            <input type="text" id="txtFreguesiaNaturalidade" class="form-control">
                            <label>Freguesia</label>
                        </div>
                    </div>
                    <!-- fim dos dados pessoas -->
    
                    <hr>
                    <!-- habilitacao literaria -->
                    <div class="row1 mt-3">
                        <div class="CampoGroup w-100">
                            <select id="slcHabilitacaoLiteraria" class="form-select">
                                <option value=""></option>
                                <option value="1" data-habilitacao="0">1º ciclo do Ensino Básico</option>
                                <option value="1" data-habilitacao="0">2º ciclo do Ensino Básico</option>
                                <option value="1" data-habilitacao="0">3º ciclo do Ensino Básico</option>
                                <option value="2" data-habilitacao="1">Ensino secundário</option>
                                <option value="3" data-habilitacao="1">Licenciatura (3 anos)</option>
                                <option value="3" data-habilitacao="1">Licenciatura (5 anos)</option>
                                <option value="4" data-habilitacao="1">Mestrado</option>
                                <option value="5" data-habilitacao="1">Doutoramento</option>
                            </select>
                            <label>Habilitação literária</label>
                        </div>
    
                        <!-- caso tenha secundario / licenciatura / mestrado / doutoramento -->
                        <div class="CampoGroup w-100 hidder" id="containerHabilitacaoLiteraria">
                            <input type="text" id="txtQualCurso" class="form-control">
                            <label>Qual curso?</label>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- n de dependentes -->
            <div class="quadroAleatorio mt-3">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-person-heart"></i>
                    <p>Dependentes</p>
                    <span></span>
                </div>
    
                <div class="quadroAleatorioCorpo">
                    <div id="containerDependente" class="col1 mt-3">
                        <div class="row1">
                            <div class="CampoGroup w-100">
                                <select id="slcNumeroDependentes" class="form-select">
                                    <option value=""></option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                                <label>Nº de dependentes</label>
                            </div>
        
                            <div class="CampoGroup  w-100">
                                <select id="slcNumeroTitularRendimento" class="form-select">
                                    <option value=""></option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                                <label>Nº de titulares do rendimento</label>
                            </div>
                        </div>
    
                        <!-- ira repetir para a qtd de dependentes que tem -->
                        <!-- <div class="row1 mt-3">
                            <div class="CampoGroup">
                                <select id="slcParentesco" class="form-select">
                                    <option value=""></option>
                                    <option value="">Mãe / Pai</option>
                                    <option value="">Filha / Filho</option>
                                    <option value="">Avó / Avô</option>
                                    <option value="">Irmã / Irmão</option>
                                    <option value="">Enteada / Enteado</option>
                                    <option value="">Tia / Tio</option>
                                    <option value="">Bisavó / Bisavô</option>
                                    <option value="">Mãe / Pai do cônjuge</option>
                                    <option value="">Irmã / irmão do cônjuge</option>
                                    <option value="">Prima / Primo</option>
                                    <option value="">Outros</option>
                                </select>
                                <label>Parentesco</label>
                            </div>
    
                            <div class="CampoGroup col-2">
                                <input type="text" id="txtQualParentesco" class="form-control">
                                <label>Qual?</label>
                            </div>
    
                            <div class="CampoGroup w-100">
                                <input type="text" id="txtNomeParentesco" class="form-control">
                                <label>Nome</label>
                            </div>
    
                            <div class="CampoGroup col-2">
                                <input type="text" id="txtDataNascimentoParentesco" class="form-control">
                                <label>Data nascimento</label>
                            </div>
    
                            <div class="CampoGroup col-2">
                                <input type="text" id="txtNIFParentesco" class="form-control">
                                <label>NIF</label>
                            </div>
                        </div> -->
                    </div>
    
                    <hr>
                    <!-- casado ? -->
                    <div class="row1 mt-3">
                        <div class="CampoGroup">
                            <select id="slcEstadoCivil" class="form-select">
                                <option value=""></option>
                                <option value="1">Solteiro (a)</option>
                                <option value="2">Casado</option>
                                <option value="3">Divorciado</option>
                            </select>
                            <label>Estado civil</label>
                        </div>
    
                        <!-- caso casado aparece essa opção -->
                         <div class="hidder" id="containerConjuge">
                             <div class="row1 w-100">
                                 <div class="CampoGroup w-100">
                                     <input type="text" id="txtNomeConjuge" class="form-control">
                                     <label>Nome do cônjuge</label>
                                 </div>
                             </div>
         
                             <div class="row1 w-100">
                                 <div class="CampoGroup w-100">
                                     <input type="text" id="txtNumeroIdentificacaoConjuge" class="form-control">
                                     <label>Nº de identificação do cônjuge</label>
                                 </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
    
            <!-- uniforme -->
            <div class="quadroAleatorio mt-3">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-person-arms-up"></i>
                    <p>Uniforme</p>
                    <span></span>
                </div>
    
                <div class="quadroAleatorioCorpo">
                    <div class="col1 mt-3">
                        <div class="row1">
                            <div class="CampoGroup w-100">
                                <select id="sltUniforme" class="form-select">
                                    <option value=""></option>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
                                <label>Necessário uniforme?</label>
                            </div>
                        </div>
    
    
                        <div class="mt-3 W-100 hidder" id="containerUniforme">
                            <div class="row1">
                                <div class="col1 w-100">
                                    <div class="row1 w-100">
                                        <div class="CampoGroup w-100">
                                            <select id="slcTipoUniforme" class="form-control form-select">
                                                <option value=""></option>
                                                <option value="1" data-calcado="0">Calça</option>
                                                <option value="2" data-calcado="0">Tshirt</option>
                                                <option value="3" data-calcado="0">Camisola</option>
                                                <option value="4" data-calcado="0">Bermuda</option>
                                                <option value="5" data-calcado="0">Colete</option>
                                                <option value="6" data-calcado="1">Sapatilha</option>
                                            </select>
                                            <label>Uniforme</label>
                                        </div>
            
                                        <div class="CampoGroup w-100">
                                            <select id="slcTamanhoUniforme" class="form-select">
                                                <option value=""></option>
                                            </select>
                                            <label>Tamanho</label>
                                        </div>
                                    </div>
        
                                    <div class="mt-3">
                                        <button id="btnAddUniforme" class="w-100 btn btn-success">Adicionar uniforme</button>
                                    </div>
                                </div>
        
                                <div class="row1 w-100">
                                    <table class="table table-striped table-hover text-center table-bordered ">
                                        <!-- <thead> -->
                                            <tr>
                                                <th>Uniforme</th>
                                                <th>Tamanho</th>
                                                <th></th>
                                            </tr>
                                        <!-- </thead> -->
        
                                        <tbody id="tbodyUniforme">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- dos termos -->
            <div class="quadroAleatorio mt-3">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-briefcase"></i>
                    <p>Dos termos</p>
                    <span></span>
                </div>
    
                <div class="quadroAleatorioCorpo">
                    <div class="col1 w-100 borderDashed pd-1 mgt-2">
                        <div class="row1">
                            <p>Encontra-se a receber alguma prestação de doença por parte da Seguranºa Social?</p>
                        </div>
                        <div class="">
                            <input type="radio" name="rdDoenca" class=""><label>Sim</label>
                            <input type="radio" name="rdDoenca" class=""><label>Não</label>
                        </div>
                    </div>
    
                    <div class="col1 w-100 borderDashed pd-1 mgt-2">
                        <div class="row1">
                            <p>Autorizo que me contactem quando necessário, ao desenvolvimento da relação contratual, mesmo que fora do horário normal de trabalho, para os números de contactos pessoais a indicar para essa finalidade aos Recursos Humanos.</p>
                        </div>
                        <div class="">
                            <input type="radio" name="rdAutorizoContacte" class=""><label>Sim</label>
                            <input type="radio" name="rdAutorizoContacte" class=""><label>Não</label>
                        </div>
                    </div>
    
                    <div class="col1 w-100 borderDashed pd-1 mgt-2" style="border: dashed red 1px !important;">
                        <div class="col1 w-100">
                            <p><strong>Lebre-se que deverá fazer-se acompanhar dos seguintes documentos:</strong></p>
                        </div>
    
                        <div class="row1">
                            <p>IBAN</p>
                            <div>
                                <input type="radio" name="rdIBAN" class=""><label>Sim</label>
                                <input type="radio" name="rdIBAN" class=""><label>Não</label>
                            </div>
                        </div>

                        <div class="hidder" id="containerConfirmaEnvioCertificadoLiterario">
                            <div class="row1">
                                <p>Certificado de Habilitação literária</p>
                                <div>
                                    <input type="radio" name="rdCertificadoHabilitacao" class=""><label>Sim</label>
                                    <input type="radio" name="rdCertificadoHabilitacao" class=""><label>Não</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- declaracao fiscal -->
            <div class="quadroAleatorio mt-3">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-0-circle"></i>
                    <p>Declaração fiscal - Titularidade dos rendimentos</p>
                    <span></span>
                </div>
    
                <div class="quadroAleatorioCorpo">
                    <div>
                        <small><strong>Sendo casado e não separado judicialmente de pessoas e bens</strong></small>
                        <div class="row1 borderDashed mt-2 pd-1">
                            <div>
                                <p>O declarante é único titular do rendimento</p>
                                <small>um titular</small>
                            </div>
    
                            <div class="CampoGroup col-2">
                                <select id="slcDeclaranteUnico" class="form-select">
                                    <option value=""></option>
                                    <option value="">Sim</option>
                                    <option value="">Não</option>
                                </select>
                                <label>Selecione</label>
                            </div>
                        </div>
    
                        <div class="row1 borderDashed mt-2 pd-1">
                            <div>
                                <p>Ambos os cônjuges são titulares de rendimentos mas um deles aufere 95% ou mais do rendimento englobado</p>
                                <small>um titular</small>
                            </div>
    
                            <div class="CampoGroup col-2">
                                <select id="slcRendimentoMais" class="form-select">
                                    <option value=""></option>
                                    <option value="">Sim</option>
                                    <option value="">Não</option>
                                </select>
                                <label>Selecione</label>
                            </div>
                        </div>
    
                        <div class="row1 borderDashed mt-2 pd-1 row1">
                            <div>
                                <p>Ambos os cônjuges são tituares de rendimentos e nenhum aufere 95% ou mais do rendimento englobado</p>
                                <small>dois titulares</small>
                            </div>
    
                            <div class="CampoGroup col-2">
                                <select id="slcRendimentoMenos" class="form-select">
                                    <option value=""></option>
                                    <option value="">Sim</option>
                                    <option value="">Não</option>
                                </select>
                                <label>Selecone</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- declaracao fiscal -->
            <div class="quadroAleatorio mt-3">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-0-circle"></i>
                    <p>Declaração fiscal - Opções do declarante</p>
                    <span></span>
                </div>
    
                <div class="quadroAleatorioCorpo">
                    <div>
                        <div class="borderDashed mt-3 pd-1 row1">
                            <p>O declarante, estando em condições legais, opta pela retenção como "Casado único titular"</p>
                            <div class="CampoGroup col-2">
                                <select id="slcCasadoUnico" class="form-select">
                                    <option value=""></option>
                                    <option value="1">Sim</option>
                                    <option value="2">Não</option>
                                </select>
                                <label>Selecione</label>
                            </div>
                        </div>
    
                        <div class="row1 borderDashed mt-3 pd-1">
                            <p>O declarente opta pela taxa de retenção mensal?</p>
                            <div class="CampoGroup col-2">
                                <select id="slcRetencaoMensal" class="form-select">
                                    <option value=""></option>
                                    <option value="1">Sim</option>
                                    <option value="2">Não</option>
                                </select>
                                <label>Selecione</label>
                            </div>
    
                            <div class="CampoGroup">
                                <input type="text" id="txtRetencaoMensal" class="form-control">
                                <label>na % de:</label>
                            </div>
    
                        </div>
    
                        <div class="borderDashed mt-3 pd-1">
                            <p>Para efeitos de retenção mensal sobre complemento de pensao, declara-se que recebe pensão mensal?</p>
                            <div class="row1">
                                <div class="CampoGroup col-2">
                                    <select id="slcRecebePensao" class="form-select">
                                        <option value=""></option>
                                        <option value="1">Sim</option>
                                        <option value="2">Não</option>
                                    </select>
                                    <label>Selecione</label>
                                </div>
    
                                <div class="CampoGroup">
                                    <input type="text" id="txtNomePensao" class="form-control">
                                    <label>Informe o nome aqui</label>
                                </div>
    
                                <div class="CampoGroup">
                                    <input type="text" id="txtValorPensao" class="form-control">
                                    <label>no valor de</label>
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
    
            <div class="quadroAleatorioNoTitle mt-3 row1">
                <button id="btnCancelarColaborador" class="w-100 btn btn-outline-danger">Cancelar cadastro</button>
                <button id="btnSalvarColaborador" class="w-100 btn btn-success">Adicionar colaborador</button>
            </div>
        </div>

        <div id="containerAnexoDoc" class="hidder" >
            <div class="quadroAleatorio mt-3">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-paperclip"></i>
                    <p>Anexe os documentos</p>
                    <span></span>
                </div>
    
                <div class="quadroAleatorioCorpo">
                    <p>Agora faça o envio dos anexos</p>
                    <p>Antes de anexar os arquivos, solicite para o novo colaborador assinar os dois documentos impresso</p>
    
                    <div class="dp-grid grid-2">
                        <div class="borderDashed pd-1 col1">
                                <input type="file" id="flFichaColaborador">
                                <label class="mt-2"><strong>Ficha do colaborador</strong></label><br>
                                <small>Arquivo enviado</small><i class="bi bi-check-lg"></i>
                        </div>
    
                        <div class="borderDashed pd-1 col1">
                            <input type="file" id="flIBAN"><br>
                            <label class="mt-2"><strong>IBAN</strong></label><br>
                        </div>
    
                        <div class="borderDashed pd-1 col1">
                            <input type="file" id="flDeclaracaoFiscal"><br>
                            <label class="mt-2"><strong>Declaração Fiscal</strong></label><br>
                        </div>
    
                        <div class="borderDashed pd-1 col1">
                            <input type="file" id="flCertificadoHabilitacao">
                            <label class="mt-2"><strong>Certificado de Habilitação</strong></label><br>
                            <small>Arquivo enviado</small><i class="bi bi-check-lg"></i>
                        </div>
                    </div>
    
                    <div class="mt-2 col1">
                        <small>Os anexos poderão ser imagem ou PDF.</small><br>
                        <small>Anexe um arquivo por campo.</small><br>
                        <small>Os anexos que ficarem pendente poderão ser enviado depois, no link que foi enviado para o email do novo colaborador ou é só voltar nesta página, clicar em mais detalhes para ver a ficha do colaborador, e anexar os documentos pendentes</small>
                    </div>
                    <button id="btnAnexarDocumentoNewCadastro" class="w-100 btn btn-success mt-3">Enviar anexo</button>
    
                </div>
            </div>
        </div>



    <!--  -->
    </div>

    <footer class="footerPage">
        <p>Roda pe</p>
    </footer>
</div>

<script src="public/js/pgColaborador.js"></script>