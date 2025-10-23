window.addEventListener("DOMContentLoaded",async function(){
    try {
        await loadDadosUser("", 0)
        //await loadDepartamento("slcDepartamento")
    } catch (error) {
        msgAlert("alert-danger", "Erro ao carregar página tente atualizar novamente." + error)
    }
})

async function loadDadosUser(userGet, paginaGet){
    return new Promise(async (resolve, reject) => {
        try {
            let tbodyList = document.getElementById("tbodyList")
            tbodyList.innerHTML = ""

            let dados = {
                searchUserSet : userGet,
                paginaSet : paginaGet,
            }

            let resultListUser = await $.post("././app/controller/function/funcListUser.php",dados)
            let jsonResultListUser = JSON.parse(resultListUser)

            if(jsonResultListUser && Array.isArray(jsonResultListUser.obj) && jsonResultListUser.obj.length > 0){
                jsonResultListUser.obj.forEach(element => {
                    let teste = document.createElement("tr")
                    teste.classList.add("rowList")
                    teste.innerHTML = `<td id='${element.idUser}'>${element.nomeUser}</td>
                                        <td>${capitalizar(element.nomeClasse)}</td>
                                        <td>` + (element.ativoUser == 1 ? "Sim" : "Não" ) + `</td>
                                        <td><i class='bi bi-person btn btn-outline-info btn-sm' onclick="loadListDadosuser(event)"></i></td>`
        
                    tbodyList.appendChild(teste)                    
                })

                //pagination inicio
                let x = 0
                let btnActive = 0

                let qtdRegistro = (jsonResultListUser.obj.length == 0 ? "" : jsonResultListUser.obj[0].totalRegistro )
                let qtdPagina = Math.ceil(qtdRegistro / jsonResultListUser.limite)
                let limite = jsonResultListUser.limite

                console.log(qtdRegistro)
                console.log(qtdPagina)
                console.log(limite)
                await pagination("paginationHome", qtdPagina, paginaGet, limite)

                document.querySelectorAll(".btnPgane").forEach(item => {
                    if(item){
                        item.addEventListener("click",async function(){
                            let txtSearchUser = document.getElementById("txtSearchUser") ?.value || ""
                            let pagina = item.getAttribute("data-pagina")

                            document.querySelectorAll(".btnPgane").forEach(active=>{
                                if(active.classList.contains("active")){
                                    btnActive = parseInt(active.getAttribute("data-pagina"))
                                }
                            })

                            if(pagina == "-"){
                                if(parseInt(btnActive) <= 1){
                                    x = parseInt(btnActive) - 1
                                } else {
                                    x = parseInt(btnActive) - 1
                                }
                            } else if (pagina == "+"){
                                if(parseInt(btnActive) < parseInt(qtdPagina)){
                                    x = parseInt(btnActive) + 1
                                } else {
                                    return
                                }
                            } else {
                                x = pagina
                            }
                            
                            await loadDadosUser(txtSearchUser,x)
                        })
                    }
                })
                //pagination fim

            }

            resolve()
        } catch (error) {
            msgAlert("alert-danger", "Houve um erro ao carregar lista com os usuários. tente atualizar a página." + error)
        }
    })
}

async function desBloquearInput(){
    //let slcDepartamento = document.getElementById("slcDepartamentox")
    //let txtDepartamento = document.getElementById("txtDepartamento")

    //let slcCargo = document.getElementById("slcCargox")
    //let txtCargo = document.getElementById("txtCargo")
    
    let slcLoja = document.getElementById("slcLojax")
    let txtLoja = document.getElementById("txtLoja")
    
    let slcAtivo = document.getElementById("slcAtivox")
    let txtAtivo = document.getElementById("txtAtivo")

    let txtNome = document.getElementById("txtNome")
    let txtSenha = document.getElementById("txtSenha")
    let txtEmail = document.getElementById("txtEmail")

    if(txtNome){
        txtNome.addEventListener("dblclick", ()=>{
            txtNome.removeAttribute("readonly")
        })

        txtNome.addEventListener("focusout", ()=>{
            txtNome.setAttribute("readonly", true)
        })
    }

    if(txtSenha){
        txtSenha.addEventListener("dblclick", ()=>{
            txtSenha.removeAttribute("readonly")
        })

        txtSenha.addEventListener("focusout", ()=>{
            txtSenha.setAttribute("readonly", true)
        })
    }

    if(txtEmail){
        txtEmail.addEventListener("dblclick", ()=>{
            txtEmail.removeAttribute("readonly")
        })

        txtEmail.addEventListener("focusout", ()=>{
            txtEmail.setAttribute("readonly", true)
        })
    }

    if(txtLoja){
        txtLoja.addEventListener("dblclick", ()=>{
            slcLoja.classList.remove("hidder")
            slcLoja.classList.add("form-select")

            txtLoja.classList.add("hidder")
            txtLoja.classList.remove("form-control")

            slcLoja.focus()

        })

        slcLoja.addEventListener("focusout", ()=>{
            txtLoja.classList.remove("hidder")
            txtLoja.classList.add("form-control")

            let x = slcLoja.options[slcLoja.selectedIndex]

            txtLoja.value = x.text

            slcLoja.classList.add("hidder")
            slcLoja.classList.remove("form-select")
        })
    }

    if(txtAtivo){
        txtAtivo.addEventListener("dblclick", ()=>{
            slcAtivo.classList.remove("hidder")
            slcAtivo.classList.add("form-select")

            txtAtivo.classList.add("hidder")
            txtAtivo.classList.remove("form-control")

            slcAtivo.focus()

        })

        slcAtivo.addEventListener("focusout", ()=>{
            txtAtivo.classList.remove("hidder")
            txtAtivo.classList.add("form-control")

            let x = slcAtivo.options[slcAtivo.selectedIndex]

            txtAtivo.value = x.text

            slcAtivo.classList.add("hidder")
            slcAtivo.classList.remove("form-select")
        })
    }
}

async function loadListDadosuser(event){
    return new Promise(async (resolve, reject)=> {
        try {
            let userGet = event.target.closest(".rowList").cells[0].getAttribute("id")

            let containerUser = document.getElementById("containerUser")
            containerUser.innerHTML = ""

            let dados = {
                userSet : userGet,
            }

            let resultDadoUser = await $.post("././app/controller/function/funcLoadDadosUltilizador.php", dados)

            let teste = document.createElement("div")
            teste.id = ""
            teste.innerHTML = resultDadoUser

            containerUser.append(teste)

            campoInputLabelSuspenso()
            await desBloquearInput()

            let btnExcluirUltilizador = document.getElementById("btnExcluirUltilizador")
            if(btnExcluirUltilizador){
                btnExcluirUltilizador.addEventListener("click",async function(){
                    
                    await openConfirmar("Excluir ultizador","Deseja realmente excluir o ultizador selecionado")
                    let btnConfirmar = document.getElementById("btnConfirmar")
                    if(btnConfirmar){
                        btnConfirmar.addEventListener("click",async function(){
                            let idUser = document.getElementById("txtNome").getAttribute("data-id")
                            let result = await crudUltilizador("excluir",idUser)

                            if(result == "excluida"){
                                document.getElementById("containerUser").innerHTML = ""
                                document.getElementById("tbodyList").querySelectorAll(".rowList").forEach(item=>{
                                    if(item.cells[0].getAttribute("id") == idUser){
                                        item.remove()
                                    }
                                })
                                msgAlert("alert-success", "Utilizador excluido com sucesso")
                            } else if(result == "naoExclui"){
                                msgAlert("alert-danger","O utilizador não pode ser excluir porque já existe ordem de compra criada pelo mesmo, você pode apenas desativa-lo.")
                            } else {
                                msgAlert("alert-danger","Houve um erro ao excluir o utilizador, consulte a lista para saber se a ação foi finalizada.")
                            }
                            $("#divModalConfirmar").remove()
                        })
                    }
                })
            }

            let btnAlterarUltilizador = document.getElementById("btnAlterarUltilizador")
            if(btnAlterarUltilizador){
                btnAlterarUltilizador.addEventListener("click",async function(){
                    
                    await openConfirmar("Excluir ultizador","Deseja realmente alterar o ultizador selecionado")
                    let btnConfirmar = document.getElementById("btnConfirmar")
                    if(btnConfirmar){
                        btnConfirmar.addEventListener("click",async function(){
                            let idUser = document.getElementById("txtNome").getAttribute("data-id")
                            let result = await crudUltilizador("editar",idUser)

                            if(result == "alterada"){
                                msgAlert("alert-success", "Utilizador alterado com sucesso")

                                document.getElementById("tbodyList").querySelectorAll(".rowList").forEach(item=>{
                                    if(item.cells[0].getAttribute("id") == idUser){
                                        item.cells[0].textContent = document.getElementById("txtNome").value
                                        item.cells[1].textContent = document.getElementById("txtLoja").value
                                        item.cells[2].textContent = document.getElementById("txtAtivo").value
                                    }
                                })

                            } else {
                                msgAlert("alert-danger","Houve um erro ao alterar o utilizador, consulte a lista para saber se a ação foi finalizada.")
                            }
                            $("#divModalConfirmar").remove()
                        })
                    }
                })
            }
            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

let btnProcurar = document.getElementById("btnProcurar")
if(btnProcurar){
    btnProcurar.addEventListener("click",async function(){
        let user = document.getElementById("txtSearchUser")
        await loadDadosUser(user.value, "")
        document.getElementById("containerUser").textContent = ""
    })
}

// let slcDepartamento = document.getElementById("slcDepartamento")
// if(slcDepartamento){
//     slcDepartamento.addEventListener("change",async function(){
//         let slcCargo = document.getElementById("slcCargo")

//         let idDP = document.getElementById("slcDepartamento")
//         let txtSearchUser = document.getElementById("txtSearchUser")

//         await loadCargo("slcCargo", idDP.value)
        
//         let teste = document.createElement("option")
//         teste.innerHTML = "Todos"
//         teste.value = 0
        
//         if(slcDepartamento.value == 0){
//             slcCargo.append(teste)
//         }

//         await loadDadosUser(txtSearchUser.value, this.value, slcCargo.value,"")
//     })
// }

// let slcCargo = document.getElementById("slcCargo")
// if(slcCargo){
//     slcCargo.addEventListener("change",async function(){
//         let idDP = document.getElementById("slcDepartamento")
//         let txtSearchUser = document.getElementById("txtSearchUser")

//         await loadDadosUser(txtSearchUser.value, idDP.value, this.value,"")
//     })
// }
