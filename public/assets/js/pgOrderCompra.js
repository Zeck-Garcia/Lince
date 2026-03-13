$(document).ready(async()=>{
    await monteLoadListOrderCompra(0)
})

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

async function monteLoadListOrderCompra(pagina) {
    try {
        let tbodyListOrder = document.getElementById("tbodyListOrder")
        tbodyListOrder.textContent = ''
        if(tbodyListOrder){
            let dados = {
                paginaSet : pagina
            }
    
            let result = await loadListOrderCompra(JSON.stringify(dados))
    
            if(result && Array.isArray(result.obj) && result.obj.length > 0){
                result.obj.forEach(element => {

                    let emailFornecedor = element.enviarEmailFornecedoOrder
                    let pioridade = element.prioriOrder
                    let aprovaRejeitaOrder = element.aprovaRejeitaOrder

                    let newTr = document.createElement("tr")
                    newTr.innerHTML = `
                                        <td class="px-4 fw-bold"><span class='badge ${aprovaRejeitaOrder == null ? 'bg-warning' : aprovaRejeitaOrder == 1 ? 'bg-success' : 'bg-danger'}'>${aprovaRejeitaOrder == null ? 'Por aprovar' : aprovaRejeitaOrder == 1 ? 'Aprovada' : 'Rejeitada'}</span></td>
                                        <td class=""><span class="badge border ${(pioridade == 1 ? 'border-success text-success' : pioridade == 2 ? 'border-warning text-warning' : 'border-danger text-danger')} px-3">${pioridade == 1 ? 'Baixa' : pioridade == 2 ? 'Média' : 'Alta'}</span></td>
                                        <td class="fw-bold" data-id-order='${element.idOrder}'>${element.codOrder}</td>
                                        <td>${element.nomeUser}</td>
                                        <td>${element.nomeDepartamento || ''}</td>
                                        <td>${dataIso(element.dataOrder)}</td>
                                        <td class='text-center'><span class="badge ${emailFornecedor == 1 ? 'bg-success' : 'border border-danger text-danger'} px-3">${emailFornecedor == 1 ? 'Sim' : 'Não'}</span></td>
                                        <td class="text-end px-4">
                                            <button class="btn btn-sm btn-light border text-primary" title="Ver Detalhes" onclick='openModalOrder(${element.idOrder})'><i class="bi bi-eye"></i></button>
                                        </td>`
    
                    tbodyListOrder.append(newTr)
                })
            } else {
                let newTr = document.createElement("tr")
                newTr.innerHTML = 'Nenhum dados encontrado'
                tbodyListOrder.append(newTr)
            }
        } else {
            msgAlert("alert-warning", "Elemento HTML não encontrado para montar a tabela")
        }

    } catch (error) {
        console.log(error)
    }
}

async function openModalOrder(id) {
    try {

        let titleModal = ''
        titleModal = id == '' ? 'Cadastrar nova Ordem de compra' : 'Analise de Ordem de Compra'
        let {modalEl} = await openModal("modal-order-compra", titleModal)

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
            
            if(id != ''){
                await montarVerOrder(modalEl, id)
            } else { //novo

                //tira os collapse dos accordion
                modalEl.querySelectorAll(".accordion-collapse").forEach(item=>{
                    item.classList.remove("collapse")
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
                containerSendFile.classList.add("col-12")
                containerSendFile.innerHTML = `<div class="bg-light p-2 rounded">
                                            <input class="form-control form-control-sm" id="txtfileOrcamento" type="file" id="flOrcamento" name="flOrcamento[]" multiple>
                                            <small class="text-muted d-block mt-1 ms-1">Caso já tenha um orçamento faça o anexo. O orçamento será enviado em anexo para o fornecedor.</small>
                                        </div>`

                document.getElementById("containerValor").after(containerSendFile)
                let txtfileOrcamento = modalEl.querySelector("#txtfileOrcamento")

                let newButtonSearchFornecedor = document.createElement("button")
                newButtonSearchFornecedor.innerHTML = `<i class="bi bi-search"></i>`
                newButtonSearchFornecedor.classList.add("btn", "btn-info")
                newButtonSearchFornecedor.id = 'searchFornecedor'

                txtNomeEmpresa.parentNode.after(newButtonSearchFornecedor)

                await monteDadosFornecedor(modalEl)

                let btnSalvarOrder = modalEl.querySelector("#btnSalvarOrder")
                if(btnSalvarOrder){
                    btnSalvarOrder.addEventListener("click", async()=>{
                        let checkVazio = checkVazioOrderCompra(modalEl)
                        if(!checkVazio){
                            let marCheckEnviarEmail = chkEnviarEmailFornecedor.checked ? 1 : 0

                            let fileInput = modalEl.querySelector('#txtfileOrcamento')
                            console.log(fileInput)
                            let files = fileInput.files

                            // let grouArquivo = ''
                            // for (let i = 0; i < files.length; i++) {
                            //     let file = files[i]
                            //     let fileType = tipoArquivo(file.name)
                        

                            //     if (fileType === "pdf") {
                            //         // form_data.append('flOrcamento[]', file, file.name)
                            //         grouArquivo = file.name
                            //     } else if (fileType.startsWith("image/")) {
                            //         let compressedBlobArray = await compressImages([file], 1350, 1080, 1)
                            //         grouArquivo = compressedBlobArray
                            //             // form_data.append('flOrcamento[]', compressedBlobArray[0], file.name)
                            //     } else {
                            //         msgAlert("alert-danger", `Tipo de arquivo não suportado: ${file.name}`)
                            //     }
                            // }
                            let x = await processarArquivos(files)
                            console.log(x)
                            let dadosGet = {
                                action : "salvar",
                                pioridade : slcPrioridade.value,
                                idFornecedor : txtNomeEmpresa.getAttribute("data-id-fornecedor") ?? 0,
                                numeroOrcamento : txtNOrcamento.value,
                                valorNota : txtValorNota.value,
                                descricaoCurta : txtDescricaoCurta.value,
                                descricaoLonga : txtDescricaoLonga.value,
                                enviarEmail : marCheckEnviarEmail,
                                arquivos : x
                            }
            
                            let result = await CRUDOrderCompra(dadosGet)
                            console.log(result)
                        }
                    })
                }
            }
        })
        
    } catch (error) {
        console.log(error)
    }
}


function checkVazioOrderCompra(mdoal){
    try {
        let txtNomeEmpresa = mdoal.querySelector("#txtNomeEmpresa")
        let txtNOrcamento = mdoal.querySelector("#txtNOrcamento")
        let txtValorNota = mdoal.querySelector("#txtValorNota")
        let txtDescricaoCurta = mdoal.querySelector("#txtDescricaoCurta")
        let txtDescricaoLonga = mdoal.querySelector("#txtDescricaoLonga")
        
        if(txtNomeEmpresa.value == ''){
            txtNomeEmpresa.classList.remove("border-0")
            txtNomeEmpresa.classList.add("border", "border-danger")
            txtNomeEmpresa.focus()
            msgAlert("alert-warning", "Informe o fornecedor desta Ordem de Compra")
            return true
        } else {
            txtNomeEmpresa.classList.add("border-0")
            txtNomeEmpresa.classList.remove("border", "border-danger")
        }

        if(txtValorNota.value == ''){
            txtValorNota.classList.remove("border-0")
            txtValorNota.classList.add("border", "border-danger")
            txtValorNota.focus()
            msgAlert("alert-warning", "Informe o valor da nota de compra")
            return true
        } else {
            txtValorNota.classList.add("border-0")
            txtValorNota.classList.remove("border", "border-danger")
        }

        if(txtDescricaoCurta.value == ''){
            txtDescricaoCurta.classList.remove("border-0")
            txtDescricaoCurta.classList.add("border", "border-danger")
            txtDescricaoCurta.focus()
            msgAlert("alert-warning", "Descreva qual será o item comprado")
            return true
        } else {
            txtDescricaoCurta.classList.add("border-0")
            txtDescricaoCurta.classList.remove("border", "border-danger")
        }

        if(txtDescricaoLonga.value == ''){
            txtDescricaoLonga.classList.remove("border-0")
            txtDescricaoLonga.classList.add("border", "border-danger")
            txtDescricaoLonga.focus()
            msgAlert("alert-warning", "Faça uma pequena historia de como será usado o item")
            return true
        } else {
            txtDescricaoLonga.classList.add("border-0")
            txtDescricaoLonga.classList.remove("border", "border-danger")
        }

        return false
    } catch (error) {
        console.log(error)
    }
}

async function monteDadosFornecedor(modal){
    try {
        let searchFornecedor = modal.querySelector("#searchFornecedor")

        if(searchFornecedor){
            searchFornecedor.addEventListener("click", async()=>{

                if(txtNomeEmpresa.value != ''){
                    let resultSearchFornecedor = await loadSearchFornecedor(txtNomeEmpresa.value)

                    if(resultSearchFornecedor && Array.isArray(resultSearchFornecedor.obj) && resultSearchFornecedor.obj.length > 0){
                        resultSearchFornecedor.obj.forEach(item=>{
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
                    }
                } else {
                    msgAlert("alert-warning", "Informe o código ou nome do fornecedor")
                    txtNomeEmpresa.removeAttribute("data-id-fornecedor")
                    txtNomeEmpresa.value = ''
                    txtSiteEmpresa.value = ''
                    txtEmailEmpresa.value = ''
                }
            })
        }
    } catch (error) {
        console.log(error)
    }
}

async function montarVerOrder(modal, id){
    try {
         let containerFile = document.createElement("div")
        containerFile.id = 'containerFile'
        containerFile.innerHTML = `<div class="d-flex flex-wrap gap-2 mb-2" id="containerFile">
                                <div class="anexo-item d-inline-flex align-items-center p-2 rounded border border-light-subtle shadow-sm bg-white" 
                                    style="cursor: pointer; transition: all 0.2s ease-in-out;"
                                    onclick="window.open('caminho/do/teu/arquivo.pdf', '_blank')">
                                    
                                    <div class="icon-anexo me-2 d-flex align-items-center justify-content-center bg-light rounded" style="width: 35px; height: 35px;">
                                        <i class="bi bi-paperclip text-primary fs-5"></i>
                                    </div>
                                    
                                    <div class="me-3">
                                        <p class="mb-0 fw-semibold text-dark" style="font-size: 0.85rem;">orcamento_v01.pdf</p>
                                        <small class="text-muted" style="font-size: 0.75rem;">Clique para abrir</small>
                                    </div>

                                    <a href="caminho/do/teu/arquivo.pdf" download class="btn btn-sm btn-outline-secondary border-0 p-1">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>`
        modal.querySelector("#containerValor").after(containerFile)

        let containerDadosUser = modal.querySelector("#containerDadosUser")
        containerDadosUser.classList.remove("d-none")

        let txtfileOrcamento = modal.querySelector("#containerFile")

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

                // console.log(searchUrlClickFim)

                txtNumberOrder.value = item.codOrder
                txtNumberOrder.setAttribute('data-id-order',item.idOrder)
                slcPrioridade.value = item.prioriOrder
                txtColaborador.value = item.nomeUser
                txtDepartamento.value = item.nomeDepartamento
                txtCargo.value = item.nomeCargo
                txtNomeEmpresa.value = item.nomeFornecedor
                txtSiteEmpresa.value = item.siteFornecedor
                txtEmailEmpresa.value = item.emailFornecedor
                chkEnviarEmailFornecedor.value = item.enviarEmailFornecedoOrder
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
                                                <input class='form-control border-0 bg-light' value='${item.userSistema}'>
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
                                                        <textarea class='form-control border-0 bg-light' id='txtAprovacaoRejeicao' style='min-height: 120px' ${statusOrder == null ? '' : 'disabled'}>${item.textoAprovadorOrder || ''}</textarea>
                                                        <label>Texto da Validação</label>
                                                        <small class='text-muted'>Descreva o motivo do porque está aprovando ou rejeitando essa ordem de compra</small>
                                                    </div>
                                                </div>
                                            </div>`

                    containerAprovação.append(newContainerAprovacao)
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

            })
        } else {

        }
    } catch (error) {
        console.log(error)
    }
}

async function btnAprovarRejeitar(modal){
    try {
        let txtAprovacaoRejeicao = modal.querySelector("#txtAprovacaoRejeicao")
        let txtNumberOrder = modal.querySelector("#txtNumberOrder")
        let orderNumber = txtNumberOrder.getAttribute("data-id-order")
        let containerAprovação = modal.querySelector("#containerAprovação")

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
                                containerAprovação.querySelector(".card").setAttribute("style", `border-radius: 10px; border-left: 4px solid ${fazer == 1 ? '#198754' : '#dc3545'} !important;`)
                                await monteLoadListOrderCompra(0)
                            }, 800)
                        }
                    })
                })
                
            })
        }
    } catch (error) {
        console.log(error)
    }
}

async function loadSearchFornecedor(id){
    try {
        let dados = new FormData()
        dados.append("dados", id)

        let response = await fetch("api/get-search-dados-fornecedor",{
            method : 'POST',
            body : dados
        })

        if(!response.ok) throw new Error("Error")

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

async function CRUDOrderCompra(dadosGet){
    try {
        console.log(dadosGet)
        let dados = new FormData()
        let dadosTexto = { ...dadosGet }
        
        let arquivosParaEnviar = dadosTexto.arquivos
        delete dadosTexto.arquivos

        dados.append("dados", JSON.stringify(dadosTexto))

        console.log(arquivosParaEnviar)
        console.log(arquivosParaEnviar.length)
        if (arquivosParaEnviar && arquivosParaEnviar.length > 0) {
            arquivosParaEnviar.forEach((item) => {
                dados.append("arquivos[]", item.file, item.nome)
            })
        } else {
            console.log("deu rui ze ruela")
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
