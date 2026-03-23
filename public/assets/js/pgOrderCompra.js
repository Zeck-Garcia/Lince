$(document).ready(async()=>{
    await monteLoadListOrderCompra(0)
})

/**
 * 
 * @param {array} dadosGet dados para consulta a lista de ordem
 * @returns 
 */
async function loadListOrderCompra(dadosGet){
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)

        let response = await fetch("api/load-list-order-comrpa",{
            method : "POST",
            body : dados
        })

        if(!response.ok) throw new Error("Erro")

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {int} pagina numero da pagina 
 */
async function monteLoadListOrderCompra(pagina) {
    try {
        let tbodyListOrder = document.getElementById("tbodyListOrder")
        let txtSearchOrderCompra = document.getElementById("txtSearchOrderCompra")
        let slcPedido = document.getElementById("slcPedido")
        tbodyListOrder.textContent = ''
        if(tbodyListOrder){
            let dados = {
                paginaSet : pagina,
                searchOrderCompra : txtSearchOrderCompra ?.value || '',
                slcPedido : slcPedido ?.value || '',
            }
    
            let result = await loadListOrderCompra(JSON.stringify(dados))
    
            if(result && Array.isArray(result.obj) && result.obj.length > 0){
                result.obj.forEach(element => {

                    let emailFornecedor = element.enviarEmailFornecedoOrder
                    let permitirEnviarEmail = element.enviarEmailOrder
                    let idPioridade = element.prioriOrder
                    let nomePioridade = element.nomePrioriOrder
                    let aprovaRejeitaOrder = element.aprovaRejeitaOrder

                    let btnNewEnviar = `<button class='btn btn-sm p-1 fs-7 fw-bold ${emailFornecedor == 1 ? 'btn-success' : 'btn-outline-danger'}' ${emailFornecedor == 0 ? `onclick="btnEnviarEmailFornecedor(this)"` : ''}>Não, enviar ${emailFornecedor == 0 ? "<i class='bi bi-send'></i>" : ''}</button>`

                    let newTr = document.createElement("tr")
                    newTr.classList.add("rowList")
                    newTr.innerHTML = `
                                        <td class="px-4 fw-bold"><span class='badge text-capitalize ${aprovaRejeitaOrder == null ? 'bg-warning' : aprovaRejeitaOrder == 1 ? 'bg-success' : 'bg-danger'}'>${aprovaRejeitaOrder == null ? 'por aprovar' : aprovaRejeitaOrder == 1 ? 'aprovada' : 'rejeitada'}</span></td>
                                        <td class=""><span class="badge border text-capitalize ${(idPioridade == 1 ? 'border-success text-success' : idPioridade == 2 ? 'border-warning text-warning ' : 'border-danger text-danger')} px-3">${nomePioridade}</span></td>
                                        <td class="fw-bold" data-id-order='${element.idOrder}'>${element.codOrder}</td>
                                        <td class='text-capitalize'>${element.nomeUser}</td>
                                        <td class='text-center text-capitalize'>${element.nomeDepartamento || ''}</td>
                                        <td>${dataIso(element.dataOrder)}</td>
                                        <td class='text-center'>
                                            ${permitirEnviarEmail == 1 ? (aprovaRejeitaOrder == 1 ? (emailFornecedor == 1 ? "<span class='badge text bg-success'>Enviado</span>" : btnNewEnviar) : aprovaRejeitaOrder == 0 ? '' : "<small class='text-secondary text-capitalize'>esperando aprovação</small>") : '<small>O utilizador não quer enviar o email</small>'}
                                        </td>
                                        <td class="text-end px-4">
                                            <button class="btn btn-sm btn-light border text-primary" title="Ver Detalhes" onclick='openModalOrder(${element.codOrder})'><i class="bi bi-file-earmark-medical"></i></button>
                                        </td>`
    
                    tbodyListOrder.append(newTr)
                })
            } else {
                let newTr = document.createElement("tr")
                newTr.innerHTML = `<td colspan='8'>Nenhum dados encontrado</td>`
                tbodyListOrder.append(newTr)
                msgAlert("alert-warning","Nenhum resgisto encontrado com o filtro atual")
            }

            let limite = result.obj && result.obj.length > 0 ? result.obj[0]['limite'] : 0
            let totalRegisto = result.obj && result.obj.length > 0 ? result.obj[0]['totalRegistro'] : 0
            pagination(totalRegisto, limite, pagina, 'paginador', 'passarPaginaOrderCompra')
        } else {
            msgAlert("alert-warning", "Elemento HTML não encontrado para montar a tabela")
        }

    } catch (error) {
        console.log(error)
    }
}

/**
 * ver se tem valor no campo de texto
 */
async function searchOrderCompra() {
    try {
        let txtSearchOrderCompra = document.getElementById("txtSearchOrderCompra")
        if(txtSearchOrderCompra && txtSearchOrderCompra.value == ''){
            msgAlert("alert-warning", "O Campo de busca está vazio, primeiro escreva o que deseja buscar")
        } else {
            await monteLoadListOrderCompra(0)
        }
    } catch (error) {
        console.log(error)
    }
}

let slcPedido = document.getElementById("slcPedido")
if(slcPedido){
    slcPedido.addEventListener("change",async()=>{
        await monteLoadListOrderCompra(0)
    })
}

/**
 * 
 * @param {int} novaPagina numero da pagina
 */
async function passarPaginaOrderCompra(novaPagina){
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    await monteLoadListOrderCompra(novaPagina)
}

/**
 * 
 * @param {int} id id da ordem para abrir no modal
 */
async function openModalOrder(id) {
    try {

        let titleModal = ''
        titleModal = id == '' ? 'Cadastrar nova Ordem de compra' : 'Analise de Ordem de Compra'
        let {modalEl} = await openModal("modal-order-compra", titleModal,1)

        modalEl.addEventListener("shown.bs.modal", async()=>{
            let txtNumberOrder = modalEl.querySelector("#txtNumberOrder")
            let slcPrioridade = modalEl.querySelector("#slcPrioridade")
            let txtColaborador = modalEl.querySelector("#txtColaborador")
            let txtDepartamento = modalEl.querySelector("#txtDepartamento")
            let txtCargo = modalEl.querySelector("#txtCargo")
            let txtNomeEmpresa = modalEl.querySelector("#txtNomeEmpresa")
            let txtSiteEmpresa = modalEl.querySelector("#txtSiteEmpresa")
            let txtEmailEmpresa = modalEl.querySelector("#txtEmailEmpresa")
            let txtContactoEmpresa = modalEl.querySelector("#txtContactoEmpresa")
            let txtTelefoneEmpresa = modalEl.querySelector("#txtTelefoneEmpresa")
            let chkEnviarEmailFornecedor = modalEl.querySelector("#chkEnviarEmailFornecedor")
            let txtNOrcamento = modalEl.querySelector("#txtNOrcamento")
            let txtValorNota = modalEl.querySelector("#txtValorNota")
            let txtDescricaoCurta = modalEl.querySelector("#txtDescricaoCurta")
            let txtDescricaoLonga = modalEl.querySelector("#txtDescricaoLonga")

            let containerButton = modalEl.querySelector("#containerButton")
            
            if(slcPrioridade){
                slcPrioridade.addEventListener("change",()=>{
                    console.log(slcPrioridade.value)
                    switch(Number(slcPrioridade.value)){
                        case 1:
                            slcPrioridade.classList.remove("border-warning")
                            slcPrioridade.classList.remove("border-danger")
                            slcPrioridade.classList.add("border-success")
                            break
                        case 2:
                            slcPrioridade.classList.remove("border-success")
                            slcPrioridade.classList.remove("border-danger")
                            slcPrioridade.classList.add("border-warning")
                            break
                        case 3:
                            slcPrioridade.classList.remove("border-success")
                            slcPrioridade.classList.remove("border-warning")
                            slcPrioridade.classList.add("border-danger")
                            break
                        default:
                            break
                    }
                })
            }

            if(id != ''){
                await montarVerOrder(modalEl, id)
            } else { //novo

                //tira os collapse dos accordion
                modalEl.querySelectorAll(".accordion-collapse").forEach(item=>{
                    item.classList.remove("collapse")
                    modalEl.querySelector(`#${item.id}`).classList.add("show")
                })

                //ao clicar em algum campo do fornecedor sem informar qual é o fornecedor ele ira mostra um aviso que deve buscar o fornecedor primeiro
                if(txtSiteEmpresa){
                    txtSiteEmpresa.setAttribute("readonly", true)
                    txtSiteEmpresa.addEventListener("click", ()=>{
                        if(!txtNomeEmpresa.getAttribute("data-id-fornecedor") && txtNomeEmpresa.getAttribute("data-id-fornecedor") == null){
                            msgAlert("alert-warning", "Informe o codigo do fornecedor e clique em buscar para localizar um fornecedor")
                        }
                    })
                }

                //ao clicar em algum campo do fornecedor sem informar qual é o fornecedor ele ira mostra um aviso que deve buscar o fornecedor primeiro
                if(txtEmailEmpresa){
                    txtEmailEmpresa.setAttribute("readonly", true)
                    txtEmailEmpresa.addEventListener("click", ()=>{
                        if(!txtNomeEmpresa.getAttribute("data-id-fornecedor") && txtNomeEmpresa.getAttribute("data-id-fornecedor") == null){
                            msgAlert("alert-warning", "Informe o codigo do fornecedor e clique em buscar para localizar um fornecedor")
                        }
                    })
                }

                //ao clicar em algum campo do fornecedor sem informar qual é o fornecedor ele ira mostra um aviso que deve buscar o fornecedor primeiro
                if(txtContactoEmpresa){
                    txtContactoEmpresa.setAttribute("readonly", true)
                    txtContactoEmpresa.addEventListener("click", ()=>{
                        if(!txtNomeEmpresa.getAttribute("data-id-fornecedor") && txtNomeEmpresa.getAttribute("data-id-fornecedor") == null){
                            msgAlert("alert-warning", "Informe o codigo do fornecedor e clique em buscar para localizar um fornecedor")
                        }
                    })
                }

                //ao clicar em algum campo do fornecedor sem informar qual é o fornecedor ele ira mostra um aviso que deve buscar o fornecedor primeiro
                if(txtTelefoneEmpresa){
                    txtTelefoneEmpresa.setAttribute("readonly", true)
                    txtTelefoneEmpresa.addEventListener("click", ()=>{
                        if(!txtNomeEmpresa.getAttribute("data-id-fornecedor") && txtNomeEmpresa.getAttribute("data-id-fornecedor") == null){
                            msgAlert("alert-warning", "Informe o codigo do fornecedor e clique em buscar para localizar um fornecedor")
                        }
                    })
                }

                //container user
                let containerDadosUser = modalEl.querySelector("#containerDadosUser")
                if(containerDadosUser){
                    containerDadosUser.classList.add("d-none")
                }

                //tira o botao de aprovar
                let btnValidar = modalEl.querySelector("#btnValidar")
                if(btnValidar){
                    btnValidar.classList.add("d-none")
                }

                //botao de salvar order
                let btnNewSalvarOrder = document.createElement("button")
                btnNewSalvarOrder.classList.add("btn", "btn-success")
                btnNewSalvarOrder.id = "btnSalvarOrder"
                btnNewSalvarOrder.textContent = 'Salvar Ordem de Compra'
                containerButton.append(btnNewSalvarOrder)

                //criar o container de arquivos dos anexo
                let containerSendFile = document.createElement("div")
                containerSendFile.id = 'containerSendFile'
                containerSendFile.classList.add("row", "mt-3", "g-3")
                containerSendFile.innerHTML = `<div class='col-md-6'><div class="bg-light p-2 rounded">
                                            <input class="form-control form-control-sm" id="txtfileOrcamento" type="file" id="flOrcamento" name="flOrcamento[]" multiple>
                                            <small class="text-muted d-block mt-1 ms-1"><span class='fw-bold'>Orçamento</span> Caso já tenha um orçamento do fornecedor faça o anexo. O orçamento será enviado em anexo para o fornecedor quando Aprovado caso a opção de envio esteja habilitada.</small>
                                        </div></div>

                                        <div class='col-md-6'><div class="bg-light p-2 rounded">
                                            <input class="form-control form-control-sm" id="txtfileArquivoInterno" type="file" id="txtfileArquivoInterno" name="txtfileArquivoInterno[]" multiple>
                                            <small class="text-muted d-block mt-1 ms-1"><span class='fw-bold'>Aquivo Interno</span> Caso tenho uma arquivo que ajude na aprovação pode anexar aqui. Esse arquivo será usado internamento</small>
                                        </div></div>
                                        `

                document.getElementById("containerValor").after(containerSendFile)
                let txtfileOrcamento = modalEl.querySelector("#txtfileOrcamento")

                let newButtonSearchFornecedor = document.createElement("button")
                newButtonSearchFornecedor.innerHTML = `<i class="bi bi-search"></i>`
                newButtonSearchFornecedor.classList.add("btn", "btn-info")
                newButtonSearchFornecedor.id = 'searchFornecedor'

                txtNomeEmpresa.parentNode.after(newButtonSearchFornecedor)

                let newlistOpenFornecedor = document.createElement("button")
                newlistOpenFornecedor.innerHTML = `<i class="bi bi-card-checklist"></i>`
                newlistOpenFornecedor.classList.add("btn", "bg-primary-subtle")
                newlistOpenFornecedor.id = 'listFornecedor'

                txtNomeEmpresa.parentNode.after(newlistOpenFornecedor)

                let listFornecedor = modalEl.querySelector("#listFornecedor")
                if(listFornecedor){
                    listFornecedor.addEventListener("click", async()=>{
                        await monteModalFornecedor(0)
                    })
                }

                await monteDadosFornecedor(modalEl)

                let btnSalvarOrder = modalEl.querySelector("#btnSalvarOrder")
                if(btnSalvarOrder){
                    btnSalvarOrder.addEventListener("click", async()=>{
                        let checkVazio = checkVazioOrderCompra(modalEl)
                        if(!checkVazio){
                            let marCheckEnviarEmail = chkEnviarEmailFornecedor.checked ? 1 : 0

                            let fileInput = modalEl.querySelector('#txtfileOrcamento')
                            let files = fileInput.files
                        
                            if(files.length == 0){
                                //chamar modal para perguntar se quer salvar sem anexo
                                let modal = await openSubModal("modal-confirme", "Sem anexo", "Deseja mesmo salvar essa Ordem de Compra sem anexar o Orçamento?")

                                modal.addEventListener("shown.bs.modal", async ()=>{
                                    //salvar
                                    let modalFooter = modal.querySelector(".modal-footer")
                                    if(modalFooter) modalFooter.querySelector(".btnCloseSubModal").textContent = 'Não, voltar'

                                    let btnSubModalValida = modal.querySelector("#btnSubModalValida")
                                    if(btnSubModalValida){
                                        btnSubModalValida.addEventListener("click",async ()=>{
                                            await sendSaveOrder(modalEl)
                                            setTimeout(async()=>{
                                                await monteLoadListOrderCompra(0)
                                            },800)
                                            modal.remove()
                                        })
                                    }
                                })
                            } else {
                                await sendSaveOrder(modalEl)
                                
                                setTimeout(async()=>{
                                    await monteLoadListOrderCompra(0)
                                },800)
                            }
                        }
                    })
                }
            }
        })
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {int} pagina numero da pagina
 */
async function monteModalFornecedor(pagina) {
    try {
        let txtBuscarFornecedor = document.getElementById("txtBuscarFornecedor")
        let dados = {
            paginaSet : pagina,
            buscarPor : txtBuscarFornecedor ?.value || ''
        }

        let resultListFornecedor = await getLoadListFornecedor(dados)
        
        if(resultListFornecedor && Array.isArray(resultListFornecedor.obj) && resultListFornecedor.obj.length){
            let {resultOpenModal, container, rota} = await openModal("modal-list-fornecedor", "Lista de Fornecedores", 2) 
            
            let tbodyListFornecedor = container.querySelector("#tbodyListFornecedor")
            
            resultListFornecedor.obj.forEach(item=>{
                let newTr = document.createElement("tr")
                newTr.classList.add("rowList")
                newTr.innerHTML = `<td class='text-center'>${item.id}</td>
                        <td>${item.nome}</td>
                        <td data-site-fornecedor='${item.site}'>${item.email}</td>
                        <td><button class='btn btn-outline-info btn-sm btnUsarFornecedor' title='Usar esse fornecedor'><i class='bi bi-box-arrow-up-right'></i></button></td>
                `
                tbodyListFornecedor.append(newTr)
            })

            let btnBuscarFornecedor = container.querySelector("#btnBuscarFornecedor")

            if(btnBuscarFornecedor){
                btnBuscarFornecedor.addEventListener("click", async()=>{
                    await monteModalFornecedor(0)
                })
            }

            container.querySelectorAll(".btnUsarFornecedor").forEach(item=>{
                item.addEventListener("click", ()=>{
                    let rowList = item.closest(".rowList")
                    let idFornecedorRow = rowList.cells[0].textContent
                    let nomeFornecedorRow = rowList.cells[1].textContent
                    let emailFornecedorRow = rowList.cells[2].textContent
                    let siteFornecedorRow = rowList.cells[2].getAttribute("data-site-fornecedor")

                    txtNomeEmpresa.setAttribute("data-id-fornecedor", idFornecedorRow)
                    txtNomeEmpresa.value = nomeFornecedorRow
                    txtSiteEmpresa.value = siteFornecedorRow
                    txtEmailEmpresa.value = emailFornecedorRow
                    container.textContent = ''

                    if(document.querySelector("#txtCodEmpresa")){
                        document.querySelector("#txtCodEmpresa").parentNode.parentNode.remove()
                    }
                    
                    let newCodForn = document.createElement("div")
                    newCodForn.classList.add("col-2", "me-3")
                    newCodForn.innerHTML = `<div class='form-floating'><input type="text" id="txtCodEmpresa" class="form-control bg-light" placeholder="" value='${idFornecedorRow}' readonly="true">
                    <label>Cód.</label></div>`

                    txtNomeEmpresa.parentNode.parentNode.insertBefore(newCodForn, txtNomeEmpresa.parentNode)
                })
            })

            let limite = resultListFornecedor.obj.length > 0 ? resultListFornecedor.obj[0]['limite'] : 0
            let totalRegisto = resultListFornecedor.obj.length > 0 ? resultListFornecedor.obj[0]['totalRegistro'] : 0
            pagination(totalRegisto, limite, pagina, 'paginador-for', 'passarPaginaModalFornecedor')

        } else {
            let tbodyListFornecedor = document.querySelector("#tbodyListFornecedor")
            tbodyListFornecedor.textContent = ''
            let newTr = document.createElement("tr")
                newTr.classList.add("rowList")
                newTr.innerHTML = `<td colspan='4'>Nenhum registo localizado</td>`
                tbodyListFornecedor.append(newTr)
            msgAlert("alert-warning","Nenhum fornecedor localizado com a busca")
        }
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {int} novaPagina numero da pagina
 */
async function passarPaginaModalFornecedor(novaPagina){
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    await monteModalFornecedor(novaPagina)
}

/**
 * 
 * @param {object} modalEl recebe o modal
 * @returns o result da crud
 */
async function sendSaveOrder(modalEl) {
    try {
        loadAwaitAction("show")
        let slcPrioridade = modalEl.querySelector("#slcPrioridade")
        let txtNomeEmpresa = modalEl.querySelector("#txtNomeEmpresa")
        let txtNOrcamento = modalEl.querySelector("#txtNOrcamento")
        let txtValorNota = modalEl.querySelector("#txtValorNota")
        let txtDescricaoCurta = modalEl.querySelector("#txtDescricaoCurta")
        let txtDescricaoLonga = modalEl.querySelector("#txtDescricaoLonga")
        let chkEnviarEmailFornecedor = modalEl.querySelector("#chkEnviarEmailFornecedor")
        let fileInput = modalEl.querySelector('#txtfileOrcamento')
        let files = fileInput.files

        let txtfileArquivoInterno = modalEl.querySelector("#txtfileArquivoInterno")
        let filesInterno = txtfileArquivoInterno.files

        let btnSalvarOrder = modalEl.querySelector("#btnSalvarOrder")
        let listFornecedor = modalEl.querySelector("#listFornecedor")
        let searchFornecedor = modalEl.querySelector("#searchFornecedor")

        let arquivos = await processarArquivos(files)
        let arquivosInterno = await processarArquivos(filesInterno)
        let formData = new FormData()
        let dadosGet = {
            action : "salvar",
            pioridade : slcPrioridade.value,
            idFornecedor : txtNomeEmpresa.getAttribute("data-id-fornecedor") ?? 0,
            numeroOrcamento : txtNOrcamento.value,
            valorNota : txtValorNota.value,
            descricaoCurta : txtDescricaoCurta.value,
            descricaoLonga : txtDescricaoLonga.value,
            enviarEmail : chkEnviarEmailFornecedor.checked ? 1 : 0,
            arquivos : arquivos,
            arquivosInterno : arquivosInterno
        }

        let result = await CRUDOrderCompra(dadosGet)
        loadAwaitAction("")

        slcPrioridade.setAttribute("disabled", true)
        txtNomeEmpresa.setAttribute("readonly", true)
        txtNOrcamento.setAttribute("readonly", true)
        txtValorNota.setAttribute("readonly", true)
        txtDescricaoCurta.setAttribute("readonly", true)
        txtDescricaoLonga.setAttribute("readonly", true)
        chkEnviarEmailFornecedor.setAttribute("disabled", true)
        fileInput.setAttribute("disabled", true)
        txtfileArquivoInterno.setAttribute("disabled", true)
        listFornecedor.setAttribute("disabled", true)
        searchFornecedor.setAttribute("disabled", true)

        if(result && typeof result == 'object' && result.obj.sucesso){
            if(txtNumberOrder) txtNumberOrder.value = result.obj.result
            if(btnSalvarOrder) btnSalvarOrder.classList.add("d-none")
        }

        return result
    } catch (error) {
        loadAwaitAction("")
        console.log(error)
    }
}

/**
 * 
 * @param {*object} mdoal recebe o modal
 * @returns 
 */
function checkVazioOrderCompra(mdoal){
    try {
        let txtNomeEmpresa = mdoal.querySelector("#txtNomeEmpresa")
        let txtNOrcamento = mdoal.querySelector("#txtNOrcamento")
        let txtValorNota = mdoal.querySelector("#txtValorNota")
        let txtDescricaoCurta = mdoal.querySelector("#txtDescricaoCurta")
        let txtDescricaoLonga = mdoal.querySelector("#txtDescricaoLonga")
        
        if(txtNomeEmpresa.value == ''){
            txtNomeEmpresa.classList.add("border-danger")
            txtNomeEmpresa.focus()
            msgAlert("alert-warning", "Informe o fornecedor desta Ordem de Compra")
            return true
        } else {
            txtNomeEmpresa.classList.remove("border-danger")
        }

        if(txtValorNota.value == ''){
            txtValorNota.classList.add("border-danger")
            txtValorNota.focus()
            msgAlert("alert-warning", "Informe o valor da nota de compra")
            return true
        } else {
            txtValorNota.classList.remove("border-danger")
        }

        if(txtDescricaoCurta.value == ''){
            txtDescricaoCurta.classList.add("border-danger")
            txtDescricaoCurta.focus()
            msgAlert("alert-warning", "Descreva qual será o item comprado")
            return true
        } else {
            txtDescricaoCurta.classList.remove("border-danger")
        }

        if(txtDescricaoLonga.value == ''){
            txtDescricaoLonga.classList.add("border-danger")
            txtDescricaoLonga.focus()
            msgAlert("alert-warning", "Faça uma pequena historia de como será usado o item")
            return true
        } else {
            txtDescricaoLonga.classList.remove("border-danger")
        }

        return false
    } catch (error) {
        console.log(error)
    }
}

/**
 * @param {object} modal recebe o modal
 */
async function monteDadosFornecedor(modal){
    try {
        let searchFornecedor = modal.querySelector("#searchFornecedor")
        let txtNomeEmpresa = modal.querySelector("#txtNomeEmpresa")

        if(searchFornecedor){
            searchFornecedor.addEventListener("click", async()=>{

                if(txtNomeEmpresa.value != ''){
                    let resultSearchFornecedor = await loadDadosSearchFornecedor(txtNomeEmpresa.value)

                    if(resultSearchFornecedor && Array.isArray(resultSearchFornecedor.obj) && resultSearchFornecedor.obj.length > 0){
                        msgAlert("alert-success","Fornecedor localizadado")

                        txtNomeEmpresa.classList.remove("border-danger")

                        resultSearchFornecedor.obj.forEach(item=>{
                            if(modal.querySelector("#txtCodEmpresa")){
                                modal.querySelector("#txtCodEmpresa").parentNode.parentNode.remove()
                            }

                            let newCodForn = document.createElement("div")
                            newCodForn.classList.add("col-2", "me-3")
                            newCodForn.innerHTML = `<div class='form-floating'><input type="text" id="txtCodEmpresa" class="form-control bg-light" placeholder="" value='${item.idFornecedor}' readonly="true">
                            <label>Cód.</label></div>`

                            txtNomeEmpresa.parentNode.parentNode.insertBefore(newCodForn, txtNomeEmpresa.parentNode)

                            txtNomeEmpresa.setAttribute("data-id-fornecedor", item.idFornecedor)
                            txtNomeEmpresa.value = item.nomeFornecedor
                            txtSiteEmpresa.value = item.siteFornecedor
                            txtEmailEmpresa.value = item.emailFornecedor
                        })
                    } else {
                        msgAlert("alert-warning", "Nenhum fornecedor encontrado")
                        txtNomeEmpresa.removeAttribute("data-id-fornecedor")
                        txtNomeEmpresa.value = ''
                        txtSiteEmpresa.value = ''
                        txtEmailEmpresa.value = ''
                        if(modal.querySelector("#txtCodEmpresa")){
                            modal.querySelector("#txtCodEmpresa").parentNode.parentNode.remove()
                        }
                    }
                } else {
                    msgAlert("alert-warning", "Informe o código ou nome do fornecedor")
                    txtNomeEmpresa.removeAttribute("data-id-fornecedor")
                    txtNomeEmpresa.value = ''
                    txtSiteEmpresa.value = ''
                    txtEmailEmpresa.value = ''
                    if(modal.querySelector("#txtCodEmpresa")){
                        modal.querySelector("#txtCodEmpresa").parentNode.parentNode.remove()
                    }
                }
            })
        }
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {object} modal recebe o modal
 * @param {*} id id da ordem
 */
async function montarVerOrder(modal, id){
    try {
        let txtNumberOrder = modal.querySelector("#txtNumberOrder")
        let slcPrioridade = modal.querySelector("#slcPrioridade")
        let txtColaborador = modal.querySelector("#txtColaborador")
        let txtDepartamento = modal.querySelector("#txtDepartamento")
        let txtCargo = modal.querySelector("#txtCargo")
        let txtNomeEmpresa = modal.querySelector("#txtNomeEmpresa")
        let txtSiteEmpresa = modal.querySelector("#txtSiteEmpresa")
        let txtEmailEmpresa = modal.querySelector("#txtEmailEmpresa")
        let chkEnviarEmailFornecedor = modal.querySelector("#chkEnviarEmailFornecedor")
        let txtNOrcamento = modal.querySelector("#txtNOrcamento")
        let txtValorNota = modal.querySelector("#txtValorNota")
        let txtDescricaoCurta = modal.querySelector("#txtDescricaoCurta")
        let txtDescricaoLonga = modal.querySelector("#txtDescricaoLonga")

        let containerDadosUser = modal.querySelector("#containerDadosUser")
        containerDadosUser.classList.remove("d-none")

        let dadosGet = {
            paginaSet : 0,
            idOrder : id
        }

        let result = await loadListOrderCompra(JSON.stringify(dadosGet))

        if(result && Array.isArray(result.obj) && result.obj.length > 0){
            result.obj.forEach(item=>{

                let regexUrl = /(https?:\/\/[^\s]+)/g

                let urlClick = item.descricaoOrder
                let searchUrlClick = urlClick.match(regexUrl)
                let searchUrlClickFim = searchUrlClick ? searchUrlClick[0] : ''
                let classeSolicitante = item.classeSolicitanteOrder
                let idSolicitante = item.idSolicitanteOrder
                let statusOrder = item.aprovaRejeitaOrder

                txtNumberOrder.value = item.codOrder
                txtNumberOrder.setAttribute('data-id-order',item.codOrder)
                slcPrioridade.value = item.prioriOrder
                txtColaborador.value = item.nomeUser
                txtDepartamento.value = item.nomeDepartamento
                txtCargo.value = item.nomeCargo
                txtNomeEmpresa.value = item.nomeFornecedor
                txtSiteEmpresa.value = item.siteFornecedor
                txtEmailEmpresa.value = item.emailFornecedor
                item.enviarEmailOrder == 1 ? chkEnviarEmailFornecedor.checked = true : chkEnviarEmailFornecedor.checked = false 
                txtNOrcamento.value = item.numeroOrcamentoOrder
                txtValorNota.value = item.valorNotaOrder
                txtDescricaoCurta.value = item.descricaoItemOrder
                txtDescricaoLonga.value = item.descricaoOrder

                slcPrioridade.setAttribute("disabled", true)
                txtColaborador.setAttribute("disabled", true)
                txtDepartamento.setAttribute("disabled", true)
                txtCargo.setAttribute("disabled", true)
                
                if(statusOrder != null){
                    chkEnviarEmailFornecedor.setAttribute("disabled", true)
                }

                txtNOrcamento.setAttribute("disabled", true)
                txtValorNota.setAttribute("disabled", true)
                txtDescricaoCurta.setAttribute("disabled", true)
                txtDescricaoLonga.setAttribute("disabled", true)
                txtNomeEmpresa.setAttribute("disabled", true)
                txtSiteEmpresa.setAttribute("disabled", true)
                txtEmailEmpresa.setAttribute("disabled", true)
                txtContactoEmpresa.setAttribute("disabled", true)
                txtTelefoneEmpresa.setAttribute("disabled", true)

                let containerAprovação = modal.querySelector("#containerAprovação")

                let newContainerAprovacao = document.createElement("div")
                if(newContainerAprovacao){
                    let inputValidador = ''
                    if(statusOrder != null){
                        inputValidador = `<div class='form-floating mb-3'>
                                                <input class='form-control bg-light text-capitalize' value='${item.userSistema}' readonly>
                                                <label>Validador</label>
                                            </div>`
                    }

                    newContainerAprovacao.classList.add("card", "border-0", "shadow-sm", "p-3")
                    newContainerAprovacao.setAttribute("style", `border-radius: 10px; border-left: 4px solid ${statusOrder == null ? '#ffc107' : statusOrder == 1 ? '#198754' : '#ff1707'} !important;`)
                    newContainerAprovacao.innerHTML = `<div class='fw-bold text-uppercase small text-muted mb-3'>
                                                <i class='bi bi-shield-lock me-1'></i> Validação
                                            </div>
                                            <div class='row g-3'>
                                                <div class='col-12 mt-3'>
                                                    ${inputValidador}
                                                    <div class='form-floating'>
                                                        <textarea class='form-control bg-light' id='txtAprovacaoRejeicao' style='min-height: 120px' ${statusOrder == null ? '' : 'disabled'}  placeholder=''>${item.textoAprovadorOrder || ''}</textarea>
                                                        <label>Texto da Validação</label>
                                                        <small class='text-muted'>Descreva o motivo do porque está a aprovar ou rejeitar essa Ordem de Compra</small>
                                                    </div>
                                                </div>
                                            </div>`

                    if(containerAprovação){
                        containerAprovação.append(newContainerAprovacao)
                    }
                }

                let newStatus = document.createElement("div")
                    newStatus.classList.add("col-md-4", "mb-3")
                    newStatus.innerHTML = `<div class="CampoGroup shadow-sm">
                                <input type="text" id="txtstatus" class="form-control fw-bold text-center" placeholder="" value="${statusOrder == null ? 'Por Aprovar' : statusOrder == 1 ? 'Aprovado' : 'Rejeitado'}" disabled readonly style="${statusOrder == null ? 'background: #ffc107;' : statusOrder == 1 ? 'background: #198754; color: white;' : 'background: #dc3545; color: white;'}">
                            </div>`

                txtNumberOrder.parentNode.parentNode.parentNode.insertBefore(newStatus, txtNumberOrder.parentNode.parentNode)

                let btnValidar = modal.querySelector("#btnValidar")
                if(btnValidar){
                    btnValidar.addEventListener("click", async()=>{
                        await btnAprovarRejeitar(modal)
                    })
                }

                let btnExcluir = modal.querySelector("#btnExcluir")
                if(btnExcluir){
                    let btnidSolicitante = btnExcluir.getAttribute("data-id-agente")
                    let btnClasseSolicitante = btnExcluir.getAttribute("data-class-agente")
                    
                    if(Number(idSolicitante) == Number(btnidSolicitante) 
                        && Number(classeSolicitante) == Number(btnClasseSolicitante) 
                        && statusOrder == null)
                    {
                        btnExcluir.classList.remove("d-none")
                        btnExcluir.setAttribute("onclick", `excluirOrder(${item.idOrder})`)
                    }
                }

                if(statusOrder == 1 || statusOrder == 0){
                    if(btnValidar) btnValidar.classList.add("d-none")
                }

                if(item.arquivos.length > 0){

                    let contar = {
                        arquivo : [],
                        interno : []
                    }

                    item.arquivos.forEach(element=>{
                        if(element.tipo == 1){
                            contar.arquivo.push(element)
                        } else if (element.tipo == 2){
                            contar.interno.push(element)
                        }
                    })

                    let containerFile = document.createElement("div")
                        containerFile.id = 'containerFile'
                        containerFile.classList.add("d-flex", "gap-2", "flex-wrap", "justify-content-evenly")

                        let containerPrincipal = document.createElement("div") //div principal
                        containerPrincipal.classList.add("col","card","border-0","shadow-sm","rounded-","p-4","bg-light")
                        containerPrincipal.innerHTML = ''

                        if(contar.arquivo.length > 0){
                            let newTituloContainerFileOrcamento = document.createElement("h6") //titulo do quadro
                            newTituloContainerFileOrcamento.classList.add("text-uppercase","text-muted","fw-bold","small","mb-3","d-flex","align-items-center")
                            newTituloContainerFileOrcamento.innerHTML = '<i class="bi bi-cash-stack me-2 text-warning"></i> Ficheiros de Orçamento'
    
                            containerPrincipal.append(newTituloContainerFileOrcamento) //injeta o quadro na div principal
    
                            let newContainerGroupOrcamento = document.createElement("div") //criar a div group de file
                            newContainerGroupOrcamento.classList.add("d-flex","gap-3","flex-wrap")
    
                            item.arquivos.forEach(elementImg=>{
                                if(elementImg.tipo == 1){
                                    let newItemFileOrcamento = document.createElement("div") // cria os files
                                    newItemFileOrcamento.classList.add("anexo-item","d-inline-flex","align-items-center","p-2","rounded-3","border","bg-white","shadow-sm","hover-shadow")
                                    newItemFileOrcamento.setAttribute("style", "width: 200px; cursor: pointer; border-left: 4px solid #ffc107 !important;")
        
                                    newItemFileOrcamento.innerHTML = `
                                    <div class='d-inline-flex align-items-center' onclick="window.open('public/assets/uploads/orders/${elementImg.nomeHash}', '_blank')">
                                                    <div class="icon-anexo me-2 d-flex align-items-center justify-content-center bg-warning-subtle rounded" style="width: 40px; height: 40px;" onclick="window.open('public/assets/uploads/orders/${elementImg.nomeHash}', '_blank')">
                                                        <i class="bi bi-file-earmark-pdf text-warning fs-5"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-0 fw-bold text-dark" style="font-size: 0.8rem;">${elementImg.numeroOrder}</p>
                                                        <small class="text-muted" style="font-size: 0.7rem;">Orçamento Externo</small>
                                                    </div>
                                                </div>
                                                <div>
                                                    <a href="public/assets/uploads/orders/${elementImg.nomeHash}" download class="btn btn-sm btn-outline-secondary p-1">
                                                    <i class="bi bi-download"></i>
                                                    </a>
                                                </div>`
        
                                    newContainerGroupOrcamento.append(newItemFileOrcamento)
                                }
                            })
    
                            containerPrincipal.append(newTituloContainerFileOrcamento)
                            containerPrincipal.append(newContainerGroupOrcamento)
                        }

                        if(contar.arquivo.length > 0 && contar.interno.length > 0){
                            let newLine = document.createElement("hr")
                            newLine.classList.add("my-3","opacity-25")
                            containerPrincipal.append(newLine)
                        }

                        if(contar.interno.length > 0){
                            let newTituloContainerFileInterno = document.createElement("h6") //titulo do quadro
                            newTituloContainerFileInterno.classList.add("text-uppercase","text-muted","fw-bold","small","mb-3","d-flex","align-items-center")
    
                            newTituloContainerFileInterno.innerHTML = '<i class="bi bi-shield-lock me-2 text-primary"></i> Documentos Internos'
    
                            containerPrincipal.append(newTituloContainerFileInterno) //injeta o quadro na div principal
    
                            let newContainerGroupInterno = document.createElement("div") //criar a div group de file
                            newContainerGroupInterno.classList.add("d-flex","gap-3","flex-wrap")
    
                            item.arquivos.forEach(elementImg=>{
                                if(elementImg.tipo == 2){
                                    let newItemFileInterno = document.createElement("div") // cria os files
                                    newItemFileInterno.classList.add("anexo-item","d-inline-flex","align-items-center","justify-content-between","p-2","rounded-3","border","bg-white","shadow-sm","hover-shadow")
                                    newItemFileInterno.setAttribute("style", "width: 200px; cursor: pointer; border-left: 4px solid var(--bg-pink)!important;")
        
                                    newItemFileInterno.innerHTML = `
                                                <div class='d-inline-flex align-items-center' onclick="window.open('public/assets/uploads/arquivo_interno/${elementImg.nomeHash}', '_blank')">
                                                    <div class="icon-anexo me-2 d-flex align-items-center justify-content-center bg-primary-subtle rounded" style="width: 40px; height: 40px;">
                                                        <i class="bi bi-file-earmark-pdf text-primary fs-5"></i>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <p class="mb-0 fw-bold text-dark" style="font-size: 0.8rem;">${elementImg.numeroOrder}</p>
                                                        <small class="text-muted" style="font-size: 0.7rem;">Doc. Interno</small>
                                                    </div>
                                                </div>
                                                
                                                <div>
                                                    <a href="public/assets/uploads/arquivo_interno/${elementImg.nomeHash}" download class="btn btn-sm btn-outline-secondary p-1">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                </div>`
        
                                    newContainerGroupInterno.append(newItemFileInterno)
                                }
                            })
    
                            containerPrincipal.append(newTituloContainerFileInterno)
                            containerPrincipal.append(newContainerGroupInterno)
    
                        }

                        containerFile.append(containerPrincipal)

                        modal.querySelector("#containerValor").after(containerFile)
                }

            })
        } else {

        }
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {int} id ir da oredm para excluir 
 */
async function excluirOrder(id) {
    try {
        let btnExcluir = document.getElementById("btnExcluir")
        let btnValidar = document.getElementById("btnValidar")
        let txtstatus = document.getElementById("txtstatus")
        let txtAprovacaoRejeicao = document.getElementById("txtAprovacaoRejeicao")

        let modal = await openSubModal("modal-confirme", "Excluir Order", "Deseja realmente excluir essa Ordem de Compra?")

        modal.addEventListener("shown.bs.modal",async()=>{
            let btnSubModalValida = modal.querySelector("#btnSubModalValida")
            if(btnSubModalValida){
                btnSubModalValida.addEventListener("click",async()=>{
                    let dados = {
                        action : "excluir",
                        idOrder : id,
                    }

                    let result = await CRUDOrderCompra(dados)
                    if(result && typeof result == 'object' && result.obj.sucesso){
                        modal.remove()
                        if(btnExcluir) btnExcluir.remove()
                        if(btnValidar) btnValidar.remove()
                        if(txtstatus) txtstatus.value = 'Excluido'
                        if(txtAprovacaoRejeicao) txtAprovacaoRejeicao.setAttribute("disabled", true)

                        setTimeout(async ()=>{
                            if(txtstatus) txtstatus.setAttribute("style", "background: red;")
                            await monteLoadListOrderCompra(0)
                        },800)
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
 */
async function btnAprovarRejeitar(modal){
    try {
        let txtAprovacaoRejeicao = modal.querySelector("#txtAprovacaoRejeicao")
        let txtNumberOrder = modal.querySelector("#txtNumberOrder")
        let orderNumber = txtNumberOrder.getAttribute("data-id-order")
        let containerAprovação = modal.querySelector("#containerAprovação")
        let txtstatus = modal.querySelector("#txtstatus")
        let chkEnviarEmailFornecedor = modal.querySelector("#chkEnviarEmailFornecedor")

        let btnExcluir = modal.querySelector("#btnExcluir")
        let btnValidar = modal.querySelector("#btnValidar")

        if(txtAprovacaoRejeicao && txtAprovacaoRejeicao.value == ''){
            txtAprovacaoRejeicao.classList.remove("border-0")
            txtAprovacaoRejeicao.classList.add("border-danger","border")
            txtAprovacaoRejeicao.focus()
            msgAlert("alert-warning", `Escreva o motivo o porque está a validar essa Ordem de compra`)
        } else if(txtAprovacaoRejeicao){
            txtAprovacaoRejeicao.classList.remove("border-danger", "border")
            txtAprovacaoRejeicao.classList.add("border-0")
            let modalConfirme = await openSubModal("modal-confirme", "Aprovar / Rejeitar", 
                                                `
                                                <div>
                                                    <p class='mb-0 fw-medium'>Deseja aprovar ou rejeitar essa Ordem de Compra?</p>
                                                </div>
                                                <div bis_skin_checked='1' class='d-flex justify-content-around'>
                                                    <input type='button' class='btn btn-outline-danger btnAprovaRejeita' value='Rejeitar'>
                                                    <input type='button'class='btn btn-success btnAprovaRejeita' value='Aprovar'>
                                                </div>
                                                `
                                            )

            modalConfirme.addEventListener("shown.bs.modal", async()=>{
                let btnSubModalValida = modalConfirme.querySelector("#btnSubModalValida")
                if(btnSubModalValida) btnSubModalValida.classList.add("d-none")
                modalConfirme.querySelectorAll(".btnAprovaRejeita").forEach(async item =>{
                    let clickFoiEm = item.value == 'Aprovar' ? 1 : 0
                    item.addEventListener("click",async ()=>{
                        item.setAttribute("disabled" , true)
                        let dados = {
                            action : "aprovar/reprovar",
                            idOrder : orderNumber,
                            fazer : clickFoiEm,
                            textAprovacao : txtAprovacaoRejeicao ?.value || ''
                        }
    
                        let resultCrud = await CRUDOrderCompra(dados)
    
                        if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                            setTimeout(async() => {
                                modalConfirme.remove()
                                txtAprovacaoRejeicao.setAttribute("disabled", true)
                                btnExcluir.classList.add("d-none")
                                btnValidar.classList.add("d-none")
                                containerAprovação.querySelector(".card").removeAttribute("style", true)
                                containerAprovação.querySelector(".card").setAttribute("style", `border-radius: 10px; border-left: 4px solid ${clickFoiEm == 1 ? '#198754' : '#dc3545'} !important;`)
                                txtstatus.value = clickFoiEm == 1 ? 'Aprovado' : 'Rejeitado'
                                txtstatus.setAttribute("style",`background: ${clickFoiEm == 1 ? '#198754' : '#dc3545'}`)
                                await monteLoadListOrderCompra(0)
                            }, 800)

                            if(clickFoiEm == 1 && chkEnviarEmailFornecedor.checked){
                                await enviarEmailFornecedor(orderNumber)
                            }
                        }
                        item.setAttribute("disabled" , false)
                    })
                })
            })
        }
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {object} rowsList recebe a linha ta tabela
 */
async function btnEnviarEmailFornecedor(rowsList){
    try {
        let rowList = rowsList.closest(".rowList")
        if(rowList){
            let idOrder = rowList.cells[2].textContent
            let btn = rowsList

            btn.innerHTML = 'A Enviar... <i class="bi bi-arrow-repeat"></i>'
            btn.classList.remove("btn-outline-danger")
            btn.classList.add("btn-secondary")

            let modal = await openSubModal("modal-confirme", "Enviar Email", "Deseja enviar o email para o fornecedor?")

            let btnSubModalValida = modal.querySelector("#btnSubModalValida")
            if(btnSubModalValida){
                btnSubModalValida.addEventListener("click", async()=>{
                    await enviarEmailFornecedor(idOrder)
                })
            }

            modal.addEventListener("hidden.bs.modal",async()=>{
                await monteLoadListOrderCompra(0)
            })
        }
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {int} idOrder numero da ordem
 */
async function enviarEmailFornecedor(idOrder){
    try {
        let dados = {
            action : "interno",
            destino : "emailFornecedor",
            orderCompra : idOrder,
        }
        await enviarEmail(JSON.stringify(dados))

        setTimeout(async()=>{
            await monteLoadListOrderCompra(0)
        },800)
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {array} dadosGet dados para o crud
 * @returns result o crud
 */
async function CRUDOrderCompra(dadosGet){
    try {
        let dados = new FormData()
        let dadosTexto = { ...dadosGet }
        
        let arquivosParaEnviar = dadosTexto.arquivos || []
        let arquivosParaEnviarInterno = dadosTexto.arquivosInterno || []
        
        delete dadosTexto.arquivos
        delete dadosTexto.arquivosInterno

        dados.append("dados", JSON.stringify(dadosTexto))

        if (arquivosParaEnviar && arquivosParaEnviar.length > 0) {
            arquivosParaEnviar.forEach((item) => {
                dados.append("arquivos[]", item.file, item.nome)
            })
        }

        if (arquivosParaEnviarInterno && arquivosParaEnviarInterno.length > 0) {
            arquivosParaEnviarInterno.forEach((item) => {
                dados.append("arquivosInterno[]", item.file, item.nome)
            })
        }

        let response = await fetch("api/crud-order-compra",{
            method : 'POST',
            body : dados
        })

        if(!response.ok) throw new Error("Error")

        result = await response.json()

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

/**
 * 
 * @param {file} files arquivos
 * @returns lista dos arquivos tratado
 */
async function processarArquivos(files) {
    try {
        let listaDeArquivosParaEnvio = []
        for (let file of files) {
            let arquivoFinal = file
    
            if (file.type.startsWith('image/')) {
                let resultArray = await compressImages([file], 1350, 1080, 1)
                arquivoFinal = resultArray[0]
            }
    
            listaDeArquivosParaEnvio.push({
                file: arquivoFinal,
                nome: file.name,
            })
        }

        return listaDeArquivosParaEnvio
    } catch (error) {
        console.log(error)
    }
}

