$(document).ready(async()=>{
    await montetableListUtilizador(1) 
    await loadListDepartamentoSLC("slcDepartamento")
})

let slcDepartamento = document.getElementById("slcDepartamento")
if(slcDepartamento){
    slcDepartamento.addEventListener("change",async ()=>{
        if(slcDepartamento.value != 0){
            await loadListCargoSLC("slcCargo",slcDepartamento.value)
            ///chamar para montar a tabela

        }
    })
}

let btnProcurar = document.getElementById("btnProcurar")
if(btnProcurar){
    btnProcurar.addEventListener("click", async()=>{
        await montetableListUtilizador(0)
    })
}

let btnNovo = document.getElementById("btnNovo")
if(btnNovo){
    btnNovo.addEventListener("click", async()=>{
        let modalEl = await openModal("modal-utilizador", "Adicionar novo utilizador")
    })
}

async function montetableListUtilizador(pagina) {
    try {
        let txtSearchUser = document.getElementById("txtSearchUser")
        let slcDepartamento = document.getElementById("slcDepartamento")
        let slcCargo = document.getElementById("slcCargo")
        let dados = {
            paginaSet : pagina,
            nomeUser : txtSearchUser ?.value || '',
            departamentoUser : slcDepartamento ?.value || '',
            cargoUser : slcCargo ?.value || ''
        }
    let result = await loadListUtilizador(JSON.stringify(dados))
    let tbodyList = document.getElementById("tbodyList")
    tbodyList.textContent = ''

    if(result && Array.isArray(result.obj) && result.obj.length > 0){
        result.obj.forEach(element => {
            let newTr = document.createElement("tr")
            newTr.classList.add("rowList")
            newTr.innerHTML = `<td data-id-user-sistema='${element.id}' data-id-login='${element.idLogin}'>${capitalizar(element.nome)}</td>
                                <td class='text-capitalize' data-id-classe='${element.idClasse}'>${element.nomeClasse}</td>
                                <td>${element.email}</td>
                                <td class='text-capitalize' data-id-departamento='${element.idDepartamento}'>${element.nomeDepartamento}</td>
                                <td class='text-capitalize' data-id-cargo='${element.idCargo}'>${element.nomeCargo}</td>
                                <td>${element.ativo == 1 ? 'Ativo' : 'Desativado'}</td>
                                <td>
                                    <i class='bi bi-pen btn btn-outline-warning' onclick='openModalUtilizador(${element.id},this)'></i>
                                    <i class='bi bi-trash btn btn-outline-danger ms-2' onclick='excluirRegistroUtilizador(${element.id},this)'></i>
                                </td>`
            tbodyList.append(newTr)
        })
    } else {
        let newTr = document.createElement("tr")
        newTr.innerHTML = `<p>Não foi encontrado nenhuma dados</p>`
        tbodyList.append(newTr)
    }

    let limite = result.obj.length > 0 ? result.obj[0]['limite'] : 0
    let totalRegisto = result.obj.length > 0 ? result.obj[0]['totalRegistro'] : 0
    pagination(totalRegisto, limite, pagina, 'paginador', 'passarPaginaUtilizador')

    } catch (error) {
        console.log(error)
    }
}

async function passarPaginaUtilizador(novaPagina) {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    await montetableListUtilizador(novaPagina)
}

async function openModalUtilizador(id,rowsList){
    try {
        let rowList = rowsList && rowsList.closest(".rowList") || ''
        let idLogin = rowList && rowList.cells[0].getAttribute("data-id-login")

        let titleModal = ''
        titleModal = id == '' ? 'Cadastrar novo Utilizador' : 'Editar Utilizador'
        let {modalEl} = await openModal("modal-utilizador", titleModal,1)

        let txtNomeColaborador = modalEl.querySelector("#txtNomeColaborador")
        let txtEmailColaborador = modalEl.querySelector("#txtEmailColaborador")
        let slcModalDepartamentoColaborador = modalEl.querySelector("#slcModalDepartamentoColaborador")
        let slcModalCargoColaborador = modalEl.querySelector("#slcModalCargoColaborador")
        let txtLoginUser = modalEl.querySelector("#txtLoginUser")
        let slcNivelUser = modalEl.querySelector("#slcNivelUser")
        let txtSenhaUser = modalEl.querySelector("#txtSenhaUser")
        let btnValidar = modalEl.querySelector("#btnValidar")
        
        await loadListNivelSLC("slcNivelUser")
        await loadListDepartamentoSLC("slcModalDepartamentoColaborador")

        if(slcModalDepartamentoColaborador){
            slcModalDepartamentoColaborador.addEventListener("change", async()=>{
                await loadListCargoSLC("slcModalCargoColaborador",slcModalDepartamentoColaborador.value)
            })
        }

        if(id != ''){
            await montarVerUtilizador(modalEl, id)
            if(txtNomeColaborador){
                txtNomeColaborador.setAttribute("data-id-login",idLogin)
            }
        } else {
            if(btnValidar){
                btnValidar.addEventListener("click",async()=>{
                    if(!checkVazioUtilizador(modalEl,1)){
                        if(!checkSenha(modalEl)){
                            
                            let dadosLogin = {
                                login : txtLoginUser.value
                            }

                            let resultLogin = await checkLoginExiste(JSON.stringify(dadosLogin))
                            console.log(resultLogin)
                            if(resultLogin && typeof resultLogin == 'object' && resultLogin.obj.sucesso){
                                let dados = {
                                    action : "salvar",
                                    nome : txtNomeColaborador.value,
                                    departamento : slcModalDepartamentoColaborador.value,
                                    cargo : slcModalCargoColaborador.value,
                                    classe : slcNivelUser.value,
                                    email : txtEmailColaborador.value,
                                    login : txtLoginUser.value,
                                    senha : txtSenhaUser.value,
                                }
                                //chamar o crud
                                let result = await CRUDUtillizador(JSON.stringify(dados))
    
                                if(result && typeof result == 'object' && result.obj.sucesso){
                                    btnValidar.classList.add("d-none")
                                }
                            } else {
                                txtLoginUser.classList.remove("border-0")
                                txtLoginUser.classList.add("border-danger")
                                txtLoginUser.focus()

                                msgAlert("alert-warning",resultLogin.obj.msg)
                            }
                        }
                    }
                })
            }                
        }
    } catch (error) {
        console.log(error)
    }
}

function checkSenha(modal){
    try {
        let txtSenhaUser = modal.querySelector("#txtSenhaUser")
        let txtConfirmarSenhaUser = modal.querySelector("#txtConfirmarSenhaUser")

        if(txtSenhaUser && txtSenhaUser.value != txtConfirmarSenhaUser.value && txtConfirmarSenhaUser){
            msgAlert("alert-danger", "A senha não confere, consulte se a senha e contra senha são iguais")
            return true
        }
        return false
    } catch (error) {
        console.log(error)
    }
}

async function montarVerUtilizador(modal, id){
    try {
        let txtNomeColaborador = modal.querySelector("#txtNomeColaborador")
        let txtEmailColaborador = modal.querySelector("#txtEmailColaborador")
        let slcModalDepartamentoColaborador = modal.querySelector("#slcModalDepartamentoColaborador")
        let slcModalCargoColaborador = modal.querySelector("#slcModalCargoColaborador")
        let txtLoginUser = modal.querySelector("#txtLoginUser")
        let slcNivelUser = modal.querySelector("#slcNivelUser")
        let txtSenhaUser = modal.querySelector("#txtSenhaUser")
        let txtConfirmarSenhaUser = modal.querySelector("#txtConfirmarSenhaUser")
        let btnValidar = modal.querySelector("#btnValidar")
        let containerDadosLogin = modal.querySelector("#containerDadosLogin")

        let newAtivo = document.createElement("div")
        newAtivo.classList.add("col-12","mt-2")
        newAtivo.innerHTML = `<div class="form-check form-switch">
                                        <input class="form-check-input custom-switch" type="checkbox" id="chkAtivo" checked>
                                        <label class="form-check-label fw-semibold" for="chkAtivo">Utilizador ativo, desmarque para desativa-lo</label>
                                    </div>`

        containerDadosLogin.append(newAtivo)
        let chkAtivo = modal.querySelector("#chkAtivo")

        let dados = {
            paginaSet : 0,
            id : id,
        }

        let result = await loadListUtilizador(JSON.stringify(dados))
        
        modal.querySelectorAll(".btnCloseModalUtilizador").forEach(btnCloseModalUtilizador=>{
            if(btnCloseModalUtilizador){
                if(btnCloseModalUtilizador.getAttribute("data-bs-dismiss")){
                    btnCloseModalUtilizador.removeAttribute("data-bs-dismiss")
                }

                btnCloseModalUtilizador.addEventListener("click", async (e)=>{
                    e.preventDefault()
                    console.log(btnValidar.getAttribute("data-valide"))
                    if(!btnValidar.getAttribute("data-valide")){
                        await verAlteracao(result.obj)
                    } else {
                        modal.remove()
                        $(".modal-backdrop").remove()
                    }
                })
            }
        })

        if(result && Array.isArray(result.obj) && result.obj.length > 0){
            result.obj.forEach(async (item)=>{
                await loadListCargoSLC("slcModalCargoColaborador",item.idDepartamento)

                txtNomeColaborador.value = item.nome
                txtEmailColaborador.value = item.email
                slcModalDepartamentoColaborador.value = item.idDepartamento
                slcModalCargoColaborador.value = item.idCargo
                txtLoginUser.value = item.login
                slcNivelUser.value = item.idClasse
                chkAtivo.checked = item.ativo == 1 ? true : false  
                txtSenhaUser.value = ''
                txtConfirmarSenhaUser.value = ''
            })

            txtLoginUser.setAttribute("disabled", true)

        } else {
            //ver se coloca a mensagem de user nao encontrado
        }

        if(btnValidar){
            btnValidar.textContent = 'Salvar Alteração'
            btnValidar.classList.remove("btn-success")
            btnValidar.classList.add("btn-warning")
            btnValidar.addEventListener("click", async()=>{
                if(!checkVazioUtilizador(modal,0)){
                    if(!checkSenha(modal)){
                        let dados = {
                            action : "editar",
                            id : id,
                            idLogin : txtNomeColaborador.getAttribute("data-id-login"),
                            nome : txtNomeColaborador.value,
                            departamento : slcModalDepartamentoColaborador.value,
                            cargo : slcModalCargoColaborador.value,
                            classe : slcNivelUser.value,
                            email : txtEmailColaborador.value,
                            login : txtLoginUser.value,
                            senha : txtSenhaUser.value,
                            ativo : chkAtivo.checked ? 1 : 0
                        }

                        let resultCrud = await CRUDUtillizador(JSON.stringify(dados))
    
                        if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                            txtNomeColaborador.setAttribute("readonly",true)
                            txtEmailColaborador.setAttribute("readonly",true)
                            slcModalDepartamentoColaborador.setAttribute("disabled",true)
                            slcModalCargoColaborador.setAttribute("disabled",true)
                            txtLoginUser.setAttribute("readonly",true)
                            slcNivelUser.setAttribute("readonly",true)
                            txtSenhaUser.setAttribute("readonly",true)
                            txtConfirmarSenhaUser.setAttribute("readonly",true)
                            btnValidar.classList.add("d-none")
                            btnValidar.setAttribute("data-valide", true)
                            setTimeout(async()=>{
                                await montetableListUtilizador(0)
                            },800)
                        }
                        //crud editar
                    }
                }
            })
        }

        async function verAlteracao(result){
            try {

                if(result[0].nome != txtNomeColaborador.value
                    || result[0].email != txtEmailColaborador.value
                    || result[0].idDepartamento != slcModalDepartamentoColaborador.value
                    || result[0].idCargo != slcModalCargoColaborador.value
                    || result[0].idClasse != slcNivelUser.value
                    || txtSenhaUser.value != ''
                    || txtConfirmarSenhaUser.value != ''

                ){
                    //chamar mensagem
                    let modalConfirme = await openSubModal("modal-confirme", "Confirmar", "Deseja sair sem salvar os dados alterados?")

                    let btnCloseSubModal =  modalConfirme.querySelector(".modal-footer").querySelector(".btnCloseSubModal")
                    if(btnCloseSubModal){
                        btnCloseSubModal.addEventListener("click",()=>{
                            modal.remove()
                            modalConfirme.remove()
                            $(".modal-backdrop").remove()
                        })
                    }

                    let btnSubModalValida = modalConfirme.querySelector("#btnSubModalValida")
                    if(btnSubModalValida){
                        btnSubModalValida.textContent = 'Salvar'
                        btnSubModalValida.addEventListener("click", async()=>{
                            if(!checkVazioUtilizador(modal,0)){
                                if(!checkSenha(modal)){
                                    let dados = {
                                        action : "editar",
                                        id : id,
                                        idLogin : txtNomeColaborador.getAttribute("data-id-login"),
                                        nome : txtNomeColaborador.value,
                                        departamento : slcModalDepartamentoColaborador.value,
                                        cargo : slcModalCargoColaborador.value,
                                        classe : slcNivelUser.value,
                                        email : txtEmailColaborador.value,
                                        login : txtLoginUser.value,
                                        senha : txtSenhaUser.value,
                                        ativo : chkAtivo.checked ? 1 : 0
                                    }

                                    let resultCrud = await CRUDUtillizador(JSON.stringify(dados))
                
                                    if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                                        txtNomeColaborador.setAttribute("readonly",true)
                                        txtEmailColaborador.setAttribute("readonly",true)
                                        slcModalDepartamentoColaborador.setAttribute("disabled",true)
                                        slcModalCargoColaborador.setAttribute("disabled",true)
                                        txtLoginUser.setAttribute("readonly",true)
                                        slcNivelUser.setAttribute("readonly",true)
                                        txtSenhaUser.setAttribute("readonly",true)
                                        txtConfirmarSenhaUser.setAttribute("readonly",true)
                                        btnValidar.classList.add("d-none")
                                        btnValidar.setAttribute("data-valide", true)
                                        setTimeout(async()=>{
                                            await montetableListUtilizador(0)
                                        },800)

                                    }
                                    //chamar o crud
                                }
                            } 
                        })
                    }
                } else {
                    //pode fechar
                    modal.remove()
                    $(".modal-backdrop").remove()
                }
            } catch (error) {
                console.log(error)
            }
        }
    } catch (error) {
        console.log(error)
    }
}

function checkVazioUtilizador(modal, action){
    try {
        let txtNomeColaborador = modal.querySelector("#txtNomeColaborador")
        let txtEmailColaborador = modal.querySelector("#txtEmailColaborador")
        let slcModalDepartamentoColaborador = modal.querySelector("#slcModalDepartamentoColaborador")
        let slcModalCargoColaborador = modal.querySelector("#slcModalCargoColaborador")
        let txtLoginUser = modal.querySelector("#txtLoginUser")
        let slcNivelUser = modal.querySelector("#slcNivelUser")
        let txtSenhaUser = modal.querySelector("#txtSenhaUser")
        let txtConfirmarSenhaUser = modal.querySelector("#txtConfirmarSenhaUser")

        if(txtNomeColaborador.value == ''){
            txtNomeColaborador.classList.remove("border-0")
            txtNomeColaborador.classList.add("border", "border-danger")
            txtNomeColaborador.focus()
            msgAlert("alert-warning", "Informe o nome do Utilizador do sistema")
            return true 
        } else {
            txtNomeColaborador.classList.add("border-0")
            txtNomeColaborador.classList.remove("border", "border-danger")
        }

        if(txtEmailColaborador.value == ''){
            txtEmailColaborador.classList.remove("border-0")
            txtEmailColaborador.classList.add("border", "border-danger")
            txtEmailColaborador.focus()
            msgAlert("alert-warning", "Qual o email o utilizador")
            return true 
        } else {
            txtEmailColaborador.classList.add("border-0")
            txtEmailColaborador.classList.remove("border", "border-danger")
        }

        if(slcModalDepartamentoColaborador.value == 0){
            slcModalDepartamentoColaborador.classList.remove("border-0")
            slcModalDepartamentoColaborador.classList.add("border", "border-danger")
            slcModalDepartamentoColaborador.focus()
            msgAlert("alert-warning", "Escolha um departamento")
            return true 
        } else {
            slcModalDepartamentoColaborador.classList.add("border-0")
            slcModalDepartamentoColaborador.classList.remove("border", "border-danger")
        }

        if(slcModalCargoColaborador.value == 0){
            slcModalCargoColaborador.classList.remove("border-0")
            slcModalCargoColaborador.classList.add("border", "border-danger")
            slcModalCargoColaborador.focus()
            msgAlert("alert-warning", "Agora escolha um cargo")
            return true 
        } else {
            slcModalCargoColaborador.classList.add("border-0")
            slcModalCargoColaborador.classList.remove("border", "border-danger")
        }

        if(txtLoginUser.value == ''){
            txtLoginUser.classList.remove("border-0")
            txtLoginUser.classList.add("border", "border-danger")
            txtLoginUser.focus()
            msgAlert("alert-warning", "Informe qual é o login do utilizador")
            return true 
        } else {
            txtLoginUser.classList.add("border-0")
            txtLoginUser.classList.remove("border", "border-danger")
        }

        if(slcNivelUser.value == ''){
            slcNivelUser.classList.remove("border-0")
            slcNivelUser.classList.add("border", "border-danger")
            slcNivelUser.focus()
            msgAlert("alert-warning", "Qual o nível de acesso a esse utilizador")
            return true 
        } else {
            slcNivelUser.classList.add("border-0")
            slcNivelUser.classList.remove("border", "border-danger")
        }

        if(action == 1){
            if(txtSenhaUser.value == ''){
                txtSenhaUser.classList.remove("border-0")
                txtSenhaUser.classList.add("border", "border-danger")
                txtSenhaUser.focus()
                msgAlert("alert-warning", "Escreva ao menos uma senha")
                return true 
            } else {
                txtSenhaUser.classList.add("border-0")
                txtSenhaUser.classList.remove("border", "border-danger")
            }
    
            if(txtConfirmarSenhaUser.value == ''){
                txtConfirmarSenhaUser.classList.remove("border-0")
                txtConfirmarSenhaUser.classList.add("border", "border-danger")
                txtConfirmarSenhaUser.focus()
                msgAlert("alert-warning", "Informe a contra senha")
                return true 
            } else {
                txtConfirmarSenhaUser.classList.add("border-0")
                txtConfirmarSenhaUser.classList.remove("border", "border-danger")
            }
        }

        return false
    } catch (error) {
        console.log(error)
    }
}

async function CRUDUtillizador(dadosGet){
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)

        let response = await fetch("api/crud-utilizador",{
            method : 'POST',
            body : dados
        })

        if(!response.ok) throw new Error("Error")

        let result = await response.json()

        if(result && typeof result.obj == 'object' && result.obj.sucesso){
            msgAlert("alert-success", result.obj.msg)
        } else {
            msgAlert("alert-warning", result.obj.msg)
        }

        return result
    } catch (error) {
        console.log(error)
    }
}

async function excluirRegistroUtilizador(id, rowsList) {
    try {
        let rowList = rowsList.closest(".rowList")
        let idlogin = rowList.cells[0].getAttribute("data-id-login")
        let modal = await openSubModal("modal-confirme", "Excluir", "Deseja realmente excluir o registro atual.")

        modal.addEventListener("shown.bs.modal",async()=>{

            let btnSubModalValida = modal.querySelector("#btnSubModalValida")
            if(btnSubModalValida){
                btnSubModalValida.addEventListener("click",async()=>{
                    let dados = {
                        action : "excluir",
                        id : id,
                        idLogin : idlogin,
                    }
            
                    let result = await CRUDUtillizador(JSON.stringify(dados))
                    
                    if(result && typeof result == 'object' && result.obj.sucesso){
                        msgAlert("alert-success", result.obj.msg)
                        modal.remove()
                        setTimeout(async()=>{
                            await montetableListUtilizador(0) 
                        },800)
                    } else {
                        msgAlert("alert-warning", result.obj.msg)
                    }
                })
            }
        })
    } catch (error) {
        console.log(error)
    }
}