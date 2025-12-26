<?php
// if($_SESSION["idUser"] == false){
//     header('Location: login');
// } else {
//     if($_SESSION["idUser"] != true or !in_array($_SESSION["classeAgente"], [1])){
//         header('Location: login');
//     }
// }
// include_once "app/controller/function/funcExpiraSessao.php";
?>
<style>

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
        <div id="">
            <div class="quadroAleatorio">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-person"></i>
                    <p>Criar novo utilizador</p>
                    <span></span>
                </div>

                <div class="quadroAleatorioCorpo">
                    <!-- <div class="CampoGroup mt-3">
                        <select id="slcDepartamento" class="form-control form-select">
                            <option value=""></option>

                        </select>
                        <label>Departamento</label>
                    </div> -->

                    <!-- <div class="CampoGroup mt-3">
                        <select id="slcCargo" class="form-control form-select">
                            <option value=""></option>
                        </select>
                        <label>Cargo</label>
                    </div> -->

                    <div class="CampoGroup mt-3">
                        <select id="slcLojax" class="form-control form-select">
                            <option value=""></option>
                        </select>
                        <label>Categoria</label>
                    </div>

                    <div class="CampoGroup mt-3">
                        <input type="text" id="txtNome" class="form-control">
                        <label>Nome completo</label>
                    </div>

                    <div class="CampoGroup mt-3">
                        <input type="text" id="txtLogin" class="form-control" onclick="noSpace(this)">
                        <label>Login</label>
                    </div>

                    <div class="CampoGroup mt-3">
                        <input type="text" id="txtSenha" class="form-control" onclick="noSpace(this)">
                        <label>Senha</label>
                    </div>

                    <!-- <div class="CampoGroup mt-3">
                        <select id="slcLoja" class="form-control form-select">
                            <option value=""></option>
                        </select>
                        <label>Loja</label>
                    </div> -->

                    <div class="CampoGroup mt-3">
                        <input type="text" id="txtEmail" class="form-control">
                        <label>Email</label>
                    </div>
                </div>
            </div>

            <div class="quadroAleatorioCorpo groupBtn mt-3">
                    <input type="button" id="btnSalvarUltilizador" class="btn btn-success w-100" value="Salvar">
            </div>
        </div>
    </div>

    <footer class="footerPage">
        <?php include_once "app/views/pages/rodape.php"; ?>
    </footer>
</div>

<script src="public/js/pgCriarUltilizadores.js?v=<?= $versao;?>"></script>