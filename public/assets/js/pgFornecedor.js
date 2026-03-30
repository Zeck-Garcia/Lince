$(document).ready(async()=>{
    await montetableListFornecedor(1) 
})

let slcSituacao = document.getElementById("slcSituacao")
if(slcSituacao){
    slcSituacao.addEventListener("change",async()=>{
        await montetableListFornecedor(1)
    })
}

async function montetableListFornecedor(pagina) {
    try {

        let tbodyList = document.getElementById("tbodyList")
        let txtSearch = document.getElementById("txtSearch")
        let slcSituacao = document.getElementById("slcSituacao")
        tbodyList.textContent = ''
        if(tbodyList){
            let dados = {
                paginaSet : pagina,
                buscarPor : txtSearch ?.value || '',
                slcSituacao : slcSituacao ?.value || '',
            }
    
            let result = await loadListFornecedor(JSON.stringify(dados))
    
            if(result && Array.isArray(result.obj) && result.obj.length > 0){
                    result.obj.forEach(element=>{

                        let emailFornecedor = element.enviarEmailFornecedoOrder
                        let permitirEnviarEmail = element.enviarEmailOrder
                        let idPioridade = element.prioriOrder
                        let nomePioridade = element.nomePrioriOrder
                        let aprovaRejeitaOrder = element.aprovaRejeitaOrder
                        
                        let newTr = document.createElement("tr")
                        newTr.classList.add("rowList")
                        newTr.innerHTML = `
                                            <td class="px-4" data-id-fornecedor='${element.id}'>${element.id}</td>
                                            <td class="px-4 fw-bold">${element.nome}</td>
                                            <td class="">${element.email || ''}</td>
                                            <td class="fw-bold">${element.site || ''}</td>
                                            <td class='text-capitalize'>${element.morada || ''}</td>
                                            <td class='text-center text-capitalize'>${element.ativo == 1 ? 'Ativo' : 'Desativado'}</td>
                                            <td class="text-end px-4">
                                                <i class='bi bi-pen btn btn-outline-warning' onclick='openModalFornecedor(${element.id},this)'></i>
                                                <i class='bi bi-trash btn btn-outline-danger ms-2' onclick='excluirRegistroFornecedor(${element.id},this)'></i>
                                            </td>`
        
                        tbodyList.append(newTr)
                    })
            } else {
                let newTr = document.createElement("tr")
                newTr.innerHTML = `<td colspan='8'>Nenhum dados encontrado</td>`
                tbodyList.append(newTr)
                msgAlert("alert-warning","Nenhum resgisto encontrado com o filtro atual")
            }

            let limite = result.obj && result.obj.length > 0 ? result.obj[0]['limite'] : 0
            let totalRegisto = result.obj && result.obj.length > 0 ? result.obj[0]['totalRegistro'] : 0
            pagination(totalRegisto, limite, pagina, 'paginador', 'passarPaginaFornecedor')
        } else {
            msgAlert("alert-warning", "Elemento HTML não encontrado para montar a tabela")
        }
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {int} novaPagina numero da pagina
 */
async function passarPaginaFornecedor(novaPagina){
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    await montetableListFornecedor(novaPagina)
}

/**
 * ver se tem valor no campo de texto
 */
async function searchFornecedor() {
    try {
        let txtSearch = document.getElementById("txtSearch")
        if(txtSearch && txtSearch.value == ''){
            msgAlert("alert-warning", "O Campo de busca está vazio, primeiro escreva o que deseja buscar")
        } else {
            await montetableListFornecedor(1)
        }
    } catch (error) {
        console.log(error)
    }
}

async function openModalFornecedor(id){
    try {
        loadAwaitAction("show")
        let titleModal = ''
        titleModal = id == '' ? 'Cadastrar novo Fornecedor' : 'Analise de Fornecedor'
        let {modalEl} = await openModal("modal-add-fornecedor", titleModal,1)

        modalEl.addEventListener("shown.bs.modal", async()=>{
            let txtCodFornecedor = modalEl.querySelector("#txtCodFornecedor")
            let txtNome = modalEl.querySelector("#txtNome")
            let txtSite = modalEl.querySelector("#txtSite")
            let txtEmail = modalEl.querySelector("#txtEmail")
            let txtContacto = modalEl.querySelector("#txtContacto")
            let txtTelefone = modalEl.querySelector("#txtTelefone")
            let txtMorada = modalEl.querySelector("#txtMorada")
            let txtConcelho = modalEl.querySelector("#txtConcelho")
            let txtDistrito = modalEl.querySelector("#txtDistrito")
            let txtCodPostal = modalEl.querySelector("#txtCodPostal")
            let chkAtivo = modalEl.querySelector("#chkAtivo")
            let btnValidar = modalEl.querySelector("#btnValidar")

            if(id != ""){
                await montarVerFornecedor(modalEl, id)
            } else {
                //novo
                if(txtCodFornecedor){
                    txtCodFornecedor.parentNode.parentNode.parentNode.classList.add("d-none")
                    txtNome.parentNode.parentNode.parentNode.classList.remove("col-md-9")
                    txtNome.parentNode.parentNode.parentNode.classList.add("col-md-12")
                }
                
                if(btnValidar){
                    btnValidar.addEventListener("click", async()=>{
                        if(!checkVazioFornecedor(modalEl)){
                            btnValidar.setAttribute("disabled", true)
            
                            let dados = {
                                action : "salvar",
                                nome : txtNome.value,
                                site : txtSite.value,
                                email : txtEmail.value,
                                contacto : txtContacto.value,
                                telefone : txtTelefone.value,
                                morada : txtMorada.value,
                                concelho : txtConcelho.value,
                                distrito : txtDistrito.value,
                                codPostal : txtCodPostal.value,
                                ativo : chkAtivo.checked ? 1 : 0,
                            }
            
                            let result = await CRUDFornecedor(JSON.stringify(dados))
                            btnValidar.setAttribute("disabled", false)
            
                            if(result && typeof result == 'object' && result.obj.sucesso){
                                btnValidar.classList.add("d-none")
                                setTimeout(async()=>{
                                    await montetableListFornecedor(1) 
                                },800)
                            }
                        }
                    })
                }
            }
        })

        loadAwaitAction("")
        
    } catch (error) {
        console.log(error)
    }
}

async function CRUDFornecedor(dadosGet) {
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)

        let response = await fetch("api/crud-fornecedor",{
            method : 'POST',
            body : dados
        })

        if(!response.ok) throw new Error("erro")

        let result = await response.json()

        if(result && typeof result == 'object' && result.obj.sucesso){
            msgAlert("alert-success", result.obj.msg)
        } else {
            msgAlert("alert-warning", result.obj.msg)
        }
        return result
    } catch (error) {
        console.log(error)
    }
}

async function excluirRegistroFornecedor(id, rowsList) {
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
            
                    let result = await CRUDFornecedor(JSON.stringify(dados))
                    
                    if(result && typeof result == 'object' && result.obj.sucesso){
                        msgAlert("alert-success", result.obj.msg)
                        modal.remove()
                        setTimeout(async()=>{
                            await montetableListFornecedor(1) 
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

/**
 * 
 * @param {object} modal recebe o modal
 * @param {*} id id da ordem
 */
async function montarVerFornecedor(modal, id){
    try {
        let txtCodFornecedor = modal.querySelector("#txtCodFornecedor")
        let txtNome = modal.querySelector("#txtNome")
        let txtSite = modal.querySelector("#txtSite")
        let txtEmail = modal.querySelector("#txtEmail")
        let txtContacto = modal.querySelector("#txtContacto")
        let txtTelefone = modal.querySelector("#txtTelefone")
        let txtMorada = modal.querySelector("#txtMorada")
        let txtConcelho = modal.querySelector("#txtConcelho")
        let txtDistrito = modal.querySelector("#txtDistrito")
        let txtCodPostal = modal.querySelector("#txtCodPostal")
        let btnValidar = modal.querySelector("#btnValidar")
        let chkAtivo= modal.querySelector("#chkAtivo")

        let dadosGet = {
            paginaSet : 0,
            buscarPor : id
        }

        let result = await loadListFornecedor(JSON.stringify(dadosGet))
        loadAwaitAction("")

        modal.querySelectorAll(".btnCloseModal").forEach(btnCloseModal=>{
            if(btnCloseModal){
                if(btnCloseModal.getAttribute("data-bs-dismiss")){
                    btnCloseModal.removeAttribute("data-bs-dismiss")
                }

                btnCloseModal.addEventListener("click", async (e)=>{
                    e.preventDefault()
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
            result.obj.forEach(async (item) =>{

                txtCodFornecedor.value = item.id
                txtNome.value = item.nome || ''
                txtSite.value = item.site || ''
                txtEmail.value = item.email || ''
                txtContacto.value = item.contacto || ''
                txtTelefone.value = item.telefone || ''
                txtMorada.value = item.morada || ''
                txtConcelho.value = item.concelho || ''
                txtDistrito.value = item.distrito || ''
                txtCodPostal.value = item.codPostal || ''
                chkAtivo.checked = item.ativo == 1 ? chkAtivo.checked : ''
                let permi = [1,6]
            })

            if(btnValidar){
                btnValidar.addEventListener("click", async()=>{
                    let dados = {
                        action : "editar",
                        id: id,
                        nome : txtNome.value,
                        site : txtSite.value,
                        email : txtEmail.value,
                        contacto : txtContacto.value,
                        telefone : txtTelefone.value,
                        morada : txtMorada.value,
                        concelho : txtConcelho.value,
                        distrito : txtDistrito.value,
                        codPostal : txtCodPostal.value,
                        ativo : chkAtivo.checked ? 1 : 0,
                    }
    
                    let result = await CRUDFornecedor(JSON.stringify(dados))
    
                    if(result && typeof result == 'object' && result.obj.sucesso){
                        txtCodFornecedor.setAttribute("readonly",true)
                        txtNome.setAttribute("readonly",true)
                        txtSite.setAttribute("readonly",true)
                        txtEmail.setAttribute("readonly",true)
                        txtContacto.setAttribute("readonly",true)
                        txtTelefone.setAttribute("readonly",true)
                        txtMorada.setAttribute("readonly",true)
                        txtConcelho.setAttribute("readonly",true)
                        txtDistrito.setAttribute("readonly",true)
                        txtCodPostal.setAttribute("readonly",true)
                        chkAtivo.setAttribute("disabled",true)
                        btnValidar.classList.add("d-none")
                        setTimeout(async()=>{
                            await montetableListFornecedor(1) 
                        },800)
                    }

                })
            }

            
        } else {
            //nao sei o que fazer aqui qual sera a saida
        }

        async function verAlteracao(result){
            try {

                console.log(result[0].morada)
                console.log(txtMorada.value)
                if(result[0].nome != txtNome.value
                    || result[0].site != txtSite.value
                    || result[0].email != txtEmail.value
                    || result[0].contacto != txtContacto.value
                    || result[0].telefone != txtTelefone.value
                    || result[0].morada != txtMorada.value
                    || result[0].concelho != txtConcelho.value
                    || result[0].distrito != txtDistrito.value
                    || result[0].codPostal != txtCodPostal.value
                    || result[0].ativo != chkAtivo.checked ? 1 : 0

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
                            if(!checkVazioFornecedor(modal,0)){
                                let dados = {
                                    action : "editar",
                                    id: id,
                                    nome : txtNome.value,
                                    site : txtSite.value,
                                    email : txtEmail.value,
                                    contacto : txtContacto.value,
                                    telefone : txtTelefone.value,
                                    morada : txtMorada.value,
                                    concelho : txtConcelho.value,
                                    distrito : txtDistrito.value,
                                    codPostal : txtCodPostal.value,
                                    ativo : chkAtivo.checked ? 1 : 0,
                                }

                                let resultCrud = await CRUDFornecedor(JSON.stringify(dados))
            
                                if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                                    txtCodFornecedor.setAttribute("readonly",true)
                                    txtNome.setAttribute("readonly",true)
                                    txtSite.setAttribute("readonly",true)
                                    txtEmail.setAttribute("readonly",true)
                                    txtContacto.setAttribute("disabled",true)
                                    txtTelefone.setAttribute("disabled",true)
                                    txtMorada.setAttribute("readonly",true)
                                    txtConcelho.setAttribute("readonly",true)
                                    txtDistrito.setAttribute("readonly",true)
                                    txtCodPostal.setAttribute("readonly",true)
                                    chkAtivo.setAttribute("disabled",true)
                                    btnValidar.classList.add("d-none")
                                    setTimeout(async()=>{
                                        await montetableListFornecedor(1)
                                    },800)
                                }
                                    //chamar o crud
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

function checkVazioFornecedor(modal){
    try {
        let txtCodFornecedor = modal.querySelector("#txtCodFornecedor")
        let txtNome = modal.querySelector("#txtNome")
        let txtSite = modal.querySelector("#txtSite")
        let txtEmail = modal.querySelector("#txtEmail")
        let txtContacto = modal.querySelector("#txtContacto")
        let txtTelefone = modal.querySelector("#txtTelefone")
        let txtMorada = modal.querySelector("#txtMorada")
        let txtConcelho = modal.querySelector("#txtConcelho")
        let txtDistrito = modal.querySelector("#txtDistrito")
        let txtCodPostal = modal.querySelector("#txtCodPostal")
        let btnValidar = modal.querySelector("#btnValidar")
        let chkAtivo= modal.querySelector("#chkAtivo")

        if(txtNome.value == ''){
            txtNome.classList.add("border-danger")
            txtNome.focus()
            msgAlert("alert-warning", "Informe o nome do fornecedor")
            return true 
        } else {
            txtNome.classList.remove("border-danger")
        }

        return false
    } catch (error) {
        console.log(error)
    }
}