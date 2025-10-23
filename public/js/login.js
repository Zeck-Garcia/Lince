window.addEventListener("DOMContentLoaded",async function(){
    try {
    
        await campoInputLabelSuspenso()
    } catch (error) {
        //fazer erro
    }
})

function getParameter(theParameter) {
    var params = "https://www.google.com.br?cama=01&casa=02"
    // var params = window.location.search.substr(1).split('/')

    for (var i = 0; i < params.length; i++) {
        var p = params[i].split('/')
        if (p[0] == theParameter) {
            return decodeURIComponent(p[1])
        }
    }
    return false
}

var valorHidSelProduto = getParameter('login')

document.addEventListener("keypress", function(e){
    if(e.key === "Enter"){
        var btnLogin = document.querySelector("#btnLogin")
        btnLogin.click()
    }
})

//BTNLOGIN CHAMA FUNC PARA VER LOGIN
const btnLogin = document.querySelector("#btnLogin")
btnLogin.addEventListener("click", function(){
    
    const txtLogin = document.querySelector("#txtLogin").value
    const txtSenha = document.querySelector("#txtSenha").value
    
    if(txtLogin != "" && txtSenha != ""){
        validarLogin(txtLogin, txtSenha)
    }
})

//FUNC VALIDAR LOGIN
function validarLogin(x,y){
    dados = {
        txtLogin : x,
        txtSenha : y,
    }

    $.post("./././app/models/session.php", dados)
        .done(function(resultLogin){
            switchLogin(resultLogin)
        })

        .fail(function(jqXHR, textStatus, errorThrown){
            msgAlert("alert-danger","Login invalido, tente novamente")
        })
}

//FUNC LOGIN
function switchLogin(x){

    console.log(x)
    const dados = {
        valorX : x,
    }

    $.post("./././app/controller/function/loginRedireciona.php",dados)
        .done(function(resultX){
            console.log(resultX)
            window.location.href = resultX
        })

        .fail(function(jqXHR,textStatus, errorThrown){
            msgAlert("alert-danger","Erro ao abrir a página do usuário, tente novamente.")
        })
}