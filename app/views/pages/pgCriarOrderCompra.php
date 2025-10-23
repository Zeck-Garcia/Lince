<?php
// if($_SESSION["idUser"] == false){
//     header('Location: login');
// } else {
//     if($_SESSION["idUser"] != true or !in_array($_SESSION["classeAgente"], [1,2])){
//         header('Location: login');
//     }
// }
 include_once "app/controller/function/funcExpiraSessao.php";
?>

<style>

    .quadroAleatorioCorpo{
        display: flex;
        flex-direction: column;
        gap: 30px;
        padding: 25px 15px;
    }

    .groupBody{
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .groupBtn{
        width: 100%;
        display: flex;
        flex-direction: row;
        gap: 15px;
    }

    .divData{
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    #btnSearchEmpresa{
        position: absolute;
        top:0px;
        right: 0px;
        cursor: pointer;
        z-index: 10;
        width: 45px;
        height: 45px;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        font-size: 1.2rem !important;
        border-radius: 6px;
    }

    #containerInfoValue{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 10px;
    }

    #txtTextoItem, #txtTextoDescricao{
        font-size: 1.1rem !important;
    }
    /* tablet */
    @media (min-width: 751px ) and (max-width: 1100px){
        
    }
    
    /* mobile */
    @media (max-width: 750px) {
        #containerInfoValue{
            grid-template-columns: 1fr;
            gap: 5px;
        }

        #divNaoTemNada{
            margin: 15px 0 !important;
        }
    }
    
</style>

<div class="menuLateral">
    <?php require_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">
        <div class="divData">
            <div>
                <input type="text" class="form-control text-center" value="<?= date("d/m/Y");?>" readonly>
            </div>
            <form>

            <div class="CampoGroup">
                <select class="select" id="sltPrioridade">
                    <option value="">Prioridade</option>
                    <option value="1" selected>Baixa</option>
                    <option value="2">Média</option>
                    <option value="3">Alta</option>
                </select>
            </div>
        </div>


        <div class="quadroAleatorio">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-building"></i>
                <p>Dados do fornecedor</p>
                <div>
                    <span class="btn btn-outline-info btn-sm" id="btnListEmpresa"><i class="bi bi-building">Listar</i></span>
                    <span class="btn btn-outline-success btn-sm" id="btnAddEmpresa"><i class="bi bi-building-add">Add</i></span>
                </div>
            </div>

            <div class="quadroAleatorioCorpo">

                <div class="row1">
                    <div class="CampoGroup col-3">
                        <input type="text" id="txtCodEmpresa" class="form-control">
                        <label>Cód</label>
                        <span class="btn btn-success" id="btnSearchEmpresa"><i class="bi bi-search"></i></span>
                    </div>
    
                    <div class="CampoGroup w-100">
                        <input type="text" id="txtNomeEmpresa" class="form-control" readonly>
                        <label>Nome da empresa</label>
                    </div>
                </div>

                <div class="CampoGroup">
                    <input type="text" id="txtSiteEmpresa" class="form-control" readonly>
                    <label>Site da empresa</label>
                </div>
                
                <div class="CampoGroup">
                    <input type="text" id="txtEmailEmpresa" class="form-control" readonly>
                    <label>Email da empresa</label>
                </div>
                
                <div id="divEnviarEmail" class="checkButtom">
                    <input class="chkBox" id="chkEnviarEmail" type="checkbox">
                    <label for="chkEnviarEmail">Enviar email automático ao fornecedor após aprovado</label>
                </div>
            </div>
        </div>

        <div class="quadroAleatorio">
            <div class="quadroAleatorioTitle">
                <i class="bi bi-journal-check"></i>
                <p>Detalhes da nota</p>
                <span></span>
            </div>

            <div class="quadroAleatorioCorpo">
                <div id="containerInfoValue" class="">
                    <div class="CampoGroup">
                        <input type="text" id="txtValorNota" class="form-control">
                        <label>Valor da nota de compra</label>
                    </div>
    
                    <div class="CampoGroup" id="divNaoTemNada">
                        <input type="text" id="txtNumberOrcamento" class="form-control">
                        <label>Nº do orçamento</label>
                        <small>Caso tenha um número de orçamento.<small>
                    </div>

                    <div class="CampoGroup">
                        <input type="file" id="flOrcamento" name= "flOrcamento[]" class="form-control">
                        <small>Esse orçamento será enviado em anexo por email para o fornecedor.<small>
                    </div>
                </div>

                <div class="CampoGroup">
                    <textarea id="txtTextoItem" class="form-control" style="height: 70px"></textarea>
                    <label style="font-size: 1rem !important">Descrição do item a comprar</label>
                    <small>Minimo de 10 caracteres</small>
                </div>

                <div class="CampoGroup mt-3">
                    <textarea id="txtTextoDescricao" class="form-control" style="height: 100px"></textarea>
                    <label style="font-size: 1rem !important">Descrição do que será feito</label>
                    <small>Minimo de 20 caracteres</small><br>
                    <small>Caso tenha um link do produto, pode adicionar aqui junto com o texto para ajudar na validação.</small>
                </div>
            </div>
        </div>

        <div class="quadroAleatorioNoTitle">
            <input type="file" id="flAnexoOrder" name="flAnexoOrder[]" class="form-control" multiple>
            <small>Esse documento será usando internamente para validação</small>
        </div>

        </form>

        <div class="quadroAleatorioNoTitle groupBtn divEnviarOrder mt-3">
            <input type="button" id="btnEnviarOrder" class="btn btn-success" value="Enviar">
        </div>

    </div>

    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgCriarOrderCompra.js?v=<?= $versao;?>"></script>
