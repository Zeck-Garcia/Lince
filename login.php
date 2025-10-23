<style>
    #divLogin{
        width: 100%;
        height: 100vh;
        background: rgb(219, 2, 219);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    #divGroupLogin{
        width: 400px;
        box-shadow: 2px 2px 3px #ccc;
        border-radius: 3px;
    }

    #divGroupTitle{
        background: rgb(255,255,255);
        height: 110px;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items:center;
        justify-content: center;
        color: #000 !important;
        border-radius: 3px 3px 0 0;
 
    }

    #title{
        font-size: 2.5rem !important;
        color: rgb(219, 2, 219);
    }

    #subtitle{
        margin-top: 18px;
        font-size: 1.2rem !important;
        color: rgb(219, 2, 219);
    }

    #divSectionLogin{
        display: flex;
        flex-direction: column;
        padding: 25px;
        background: #fff;
        border-radius: 0 0 3px 3px;
    }

    #divSectionGroup{
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 0 45px;
    }

    .contentLogin{
        display: flex;
        flex-direction: column;
    }

    #divSubmit{
        width: 100%;
        margin-top: 10px;
    }

    #btnLogin{
        font-size: 1.2rem !important;
        background-color: rgb(255, 255, 255);
        border: solid 2px rgb(219, 2, 219);
        color: rgb(219, 2, 219);;
    }

    input{
        height: 45px !important;
    }
    @media (max-width: 600px) {
        #divGroupLogin{
            width: 100%;
        }

        #divSectionLogin, #divGroupTitle, #divGroupLogin{
            border-radius: 0;
        }
    }


</style>


<div id="divLogin">
    <div id="divGroupLogin">
        <div id="divGroupTitle">
            <h3 id="title"><strong>Lince</strong></h3>
            <h3 id="subtitle">Sistema para todos</h3>
        </div>
        
        <div id="divSectionLogin">
            <div id="divSectionGroup">
                <div class="contentLogin CampoGroup">
                    <input class="form-control" id="txtLogin" name="txtLogin" type="text" required>
                    <label class="modal-label" for="txtLogin">Nome</label>
                </div>
    
                <div class="contentLogin CampoGroup">
                    <input class="form-control" id="txtSenha" name="txtSenha" type="password" required>
                    <label class="modal-label" for="txtSenha">Senha</label>
                </div>
            </div>
    
            <div id="divSubmit">
                <button type="button" id="btnLogin" class="width100 btn btn-primary">Entrar</button>
            </div>
        </div>
        

    </div>
</div>

<script src="public/js/login.js"></script>
<!-- <script src="public/js/jquery-3.3.1.min.js"></script> -->