window.addEventListener("DOMContentLoaded",async function(){
    try {
        //await loadDepartamento("slcDepartamento")
        //await loadListLoja("slcLoja")
        await loadListClasse("slcLojax")
    } catch (error) {
        
    }
})

function camposFormUltilizador(){
    return {
        // slcDepartamento : document.querySelector("#slcDepartamento"),
        // slcCargo : document.querySelector("#slcCargo"),
        slcClasse : document.querySelector("#slcLojax"),
        txtNome : document.querySelector("#txtNome"),
        txtLogin : document.querySelector("#txtLogin"),
        txtSenha : document.querySelector("#txtSenha"),
        //slcLoja : document.querySelector("#slcLoja"),
        txtEmail : document.querySelector("#txtEmail"),
    }
}

async function valideCampos(){
    let campos = camposFormUltilizador()

    // if(campos.slcDepartamento.value == ""){
    //     campos.slcDepartamento.parentNode.classList.add("textObrigatorio")
    //     msgAlert("alert-danger","Selecione o departamento")
    //     return 0
    // } else {
    //     campos.slcDepartamento.parentNode.classList.remove("textObrigatorio")
    // }

    // if(campos.slcCargo.value == ""){
    //     campos.slcCargo.parentNode.classList.add("textObrigatorio")
    //     msgAlert("alert-danger","Selecione um cargo")
    //     return 0
    // } else {
    //     campos.slcCargo.parentNode.classList.remove("textObrigatorio")
    // }

    if(campos.slcClasse.value == ""){
        campos.slcClasse.parentNode.classList.add("textObrigatorio")
        msgAlert("alert-danger","Escolha uma classe")
        return 0
    } else {
        campos.slcClasse.parentNode.classList.remove("textObrigatorio")
    }

    if(campos.txtNome.value.length < 5){
        campos.txtNome.parentNode.classList.add("textObrigatorio")
        msgAlert("alert-danger","Escreva um nome maior que 5 letras")
        return 0
    } else {
        campos.txtNome.parentNode.classList.remove("textObrigatorio")
    }

    if(campos.txtLogin.value == ""){
        campos.txtLogin.parentNode.classList.add("textObrigatorio")
        msgAlert("alert-danger","Escolha um login com mais de 5 letras")
        return 0
    } else {
        campos.txtLogin.parentNode.classList.remove("textObrigatorio")
    }

    if(campos.txtSenha.value == ""){
        campos.txtSenha.parentNode.classList.add("textObrigatorio")
        msgAlert("alert-danger","A senha deve ter ao menos 6 caracteres")
        return 0
    } else {
        campos.txtSenha.parentNode.classList.remove("textObrigatorio")
    }

    // if(campos.slcLoja.value == ""){
    //     campos.slcLoja.parentNode.classList.add("textObrigatorio")
    //     msgAlert("alert-danger","Selecione a loja a que pertence essa pessoa")
    //     return 0
    // } else {
    //     campos.slcLoja.parentNode.classList.remove("textObrigatorio")
    // }
}
async function checkLogin(loginGet){
    try {
        let dados = {
            loginSet : loginGet,
        }

        let result = await $.post("././app/controller/function/funcVerLoginExiste.php", dados)
        return result

    } catch(error){
        msgAlert("alert-danger", "Houve um erro ao consultar login existente, atualize a página novamente e volte a tentar.")
    }
}

let btnSalvarUltilizador = document.querySelector("#btnSalvarUltilizador")
if(btnSalvarUltilizador){
    btnSalvarUltilizador.addEventListener("click",async function(){
        //chama func salvar 

        let valide = await valideCampos()

        if(valide != 0){
            let txtLogin = document.getElementById("txtLogin")

            let checkLoginValue = await checkLogin(txtLogin.value)
            if(checkLoginValue == 1){
                msgAlert("alert-danger", "O login já existe tente outro.")
                txtLogin.focus()
            } else {
                let restul = await crudUltilizador("criar","")
                
                if(restul == "criar"){
                     let campos = camposFormUltilizador()
                     campos.txtEmail.value = ""
                     campos.txtNome.value = ""
                     campos.txtLogin.value = ""
                     campos.txtSenha.value = ""
                     campos.slcClasse.value = ""
    
                    campos.txtEmail.parentNode.classList.remove("active")
                     campos.txtNome.parentNode.classList.remove("active")
                     campos.txtLogin.parentNode.classList.remove("active")
                     campos.txtSenha.parentNode.classList.remove("active")
                     campos.slcClasse.parentNode.classList.remove("active")
                    msgAlert("alert-success","Utilizador salvo com sucesso")
                } else {
                    msgAlert("alert-danger","Houve um erro ao salvar o utilizador, consulte a lista para saber se a ação foi finalizada")
                }
            }
        }
    })
}

// let slcDepartamento = document.getElementById("slcDepartamento")
// if(slcDepartamento){
//     slcDepartamento.addEventListener("change",async function(){
//         document.getElementById("slcCargo").parentNode.classList.add("active")
//         await loadCargo("slcCargo", this.value)
//     })
// }