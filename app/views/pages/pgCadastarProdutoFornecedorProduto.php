<style>
    #btnCancelarAmostra, #btnSalvarAmostra{
        height: 60px !important;
    }
</style>

<div class="menuLateral">
    <?php include_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">
    <!--  -->
        <div class="">
            <div class="quadroAleatorioNoTitle row1">
                <div class="CampoGroup w-100">
                    <select class="form-select" id="slcDepartamentoProduto">
                        <option value=""></option>
                    </select>
                    <label>Departamento</label>
                </div>

                <div class="CampoGroup w-100">
                    <select class="form-select" id="slcNomeAbrevProduto">
                        <option value=""></option>
                    </select>
                    <label>Produto</label>
                </div>
            </div>

            <div class="hidder" id="containerForm">
                <div class="quadroAleatorio mt-3">
                    <div class="quadroAleatorioTitle">
                        <i class="bi bi-inbox"></i>
                        <p>Enviar nova amostra de produto</p>
                        <span></span>
                    </div>
    
                    <div class="quadroAleatorioCorpo">
                        <div id="containerViewQuestion">
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidder" id="containerButton">
                <div class="quadroAleatorioNoTitle mt-3">
                    <div class="dp-grid grid-2">
                        <input type="button" id="btnCancelarAmostra" class="btn btn-outline-danger" value="Cancelar">
                        <input type="button" id="btnSalvarAmostra" class="btn btn-success" value="Salvar">
                    </div>
                </div>
            </div>
        </div>
    
    <!--  -->
    </div>

    <!-- <footer class="footerPage">
        <p>Roda pe</p>
    </footer> -->
</div>

<script src="public/js/pgCadastarProdutoFornecedorProduto.js?v=<?= $versao;?>"></script>
