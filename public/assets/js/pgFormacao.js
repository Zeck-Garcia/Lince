$(document).ready(async()=>{
    await monteListFormando(0)
})
/**
 * 
 * @param {time} time conveter tempo em segundo
 * @returns 
 */
function timeToMs(time) {
    let [horas, minutos, segundos] = time.split(':').map(Number)
    return (horas * 3600 + minutos * 60 + segundos) * 1000
}

/**
 * 
 * @param {time} ms converter em milisegundos 
 * @returns 
 */
function convertMilliseconds(ms) {
    let horas = Math.floor(ms / 3600000)
    ms %= 3600000
    let minutos = Math.floor(ms / 60000)
    ms %= 60000
    let segundos = Math.floor(ms / 1000)
    return {
        horas: horas,
        minutos: minutos,
        segundos: segundos
    }
}

/**
 * 
 * @param {array} dadosGet lista de busca de formando
 * @returns list com os dodos 
 */
async function getLoadListFormando(dadosGet){
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)
        
        let response = await fetch("api/get-load-list-table-formando",{
            method : 'POST',
            body : dados
        })

        if(!response.ok) throw new Error("Error")

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {int} pagina numero da pagina
 * monta o html da lista de formando
 */
async function monteListFormando(pagina) {
    try {
        let txtBuscaFormando = document.getElementById("txtBuscaFormando")
        let slcTipoSearch = document.getElementById("slcTipoSearch")
        let txtDeFormando = document.getElementById("txtDeFormando")
        let txtAteFormando = document.getElementById("txtAteFormando")
        let slcSituacao = document.getElementById("slcSituacao")

        let dados = {
            paginaSet : pagina,
            action : slcTipoSearch ?.value || '',
            buscar : txtBuscaFormando ?.value || '',
            dataDe : txtDeFormando ?.value || '',
            dataAte : txtAteFormando ?.value || '',
            estado : slcSituacao ?.value || ''
        }

        let result = await getLoadListFormando(JSON.stringify(dados))
        console.log(result)
        let tempoTotal = 0
        let tbodyFormando = document.getElementById("tbodyFormando")
        tbodyFormando.textContent = ''
        if(result && Array.isArray(result.obj) && result.obj.length > 0){
            result.obj.forEach(item => {
                let timeFormacao = item.tempoFormacao ? item.tempoFormacao.split(":") : ("00:00:00").split(":")
                
                tempoTotal += timeToMs(item.tempoFormacao || "00:00:00")

                let horaFormacao = timeFormacao[0]
                let minutoFormacao = timeFormacao[1]

                let newTr = document.createElement("tr")
                newTr.innerHTML = `<td data-id-formando='${item.idFormacao}'>${item.codColaborador}</td>
                                <td>${item.nomeColaborador}</td>
                                <td>${item.nomeLoja || ''}</td>
                                <td class='${item.nomeFormacao || 'text-danger fw-bold'}' data-id-curso='${item.codNomeFormacao}'>${item.nomeFormacao || 'Curso não encontrado'}</td>
                                <td>${item.dataFormacao ? dataIso(item.dataFormacao) : ''}</td>
                                <td>${horaFormacao}:${minutoFormacao}</td>
                                <td data-id-local='${item.codLocalFormacao}'>${item.nomeLocal || ''}</td>
                                <td>${item.estado == 1 ? 'Concluído' : 'Por Concl.'}</td>
                                <td class='d-flex g-2'>
                                    <i class='bi bi-pen btn btn-outline-warning' onclick='editarRegistroFormando(this)'></i>
                                    <i class='bi bi-trash btn btn-outline-danger ms-2' onclick='excluirRegistroFormando(${item.idFormacao})'></i>
                                </td>`
                newTr.classList.add("rowList")
                tbodyFormando.append(newTr)
            })
        } else {
            let newTr = document.createElement("tr")
            msgAlert("alert-warning", "Não foi encontrado nenhum registro")
            newTr.innerHTML = 'Não Foi encontrado nenhum registro'
            tbodyFormando.append(newTr)
        }

        let convertMili = convertMilliseconds(tempoTotal)
        let horaFinal = convertMili.horas.toString().padStart(2,0)
        let minutoFinal = convertMili.minutos.toString().padStart(2,0)

        let rowTempoTotal = document.createElement("tr")
        rowTempoTotal.classList.add("rowTotalTime")
        rowTempoTotal.innerHTML = `<td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class='fw-bold'>${horaFinal}:${minutoFinal}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>`

        tbodyFormando.appendChild(rowTempoTotal)

        let limite = result.obj.length > 0 ? result.obj[0]['limite'] : 0
        let totalRegisto = result.obj.length > 0 ? result.obj[0]['totalRegistro'] : 0
        pagination(totalRegisto, limite, pagina, 'paginador', 'passarPagina')
            
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {int} novaPagina numero da pagina
 * pega a func e passa a pagina 
 */
function passarPagina(novaPagina) {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    monteListFormando(novaPagina)
}

/**
 * 
 * @param {event} event evento do botao
 */
async function editarRegistroFormando(event){
    try {
        loadAwaitAction("show")
        let {modalEl, container, nomeRoute} = await openModal("modal-add-formando", "Editar Formação...")

        modalEl.addEventListener("shown.bs.modal", async()=>{
            await loadListCursoSLC("slcTipoCurso")
            await loadListLojaSLC("slcLocalCurso")
            loadAwaitAction("")

            let rowList = event.closest(".rowList")
            let txtCodColaborador = document.getElementById("txtCodColaborador")
            let txtNomeColaborador = document.getElementById("txtNomeColaborador")
            let slcTipoCurso = document.getElementById("slcTipoCurso")
            let txtDataFormacao = document.getElementById("txtDataFormacao")
            let txtHoraFormacao = document.getElementById("txtHoraFormacao")
            let txtMinutoFormacao = document.getElementById("txtMinutoFormacao")
            let slcLocalCurso = document.getElementById("slcLocalCurso")
            let btnSaveFormando = document.getElementById("btnSaveFormando")
            let btnSearchFormando = document.getElementById("btnSearchFormando")

            let idFormacao = rowList.cells[0].getAttribute("data-id-formando")
    
            btnSearchFormando.setAttribute("disabled", true)
            txtCodColaborador.setAttribute("disabled", true)
            txtCodColaborador.setAttribute("onlyread", true)
            txtNomeColaborador.setAttribute("disabled", true)
            txtNomeColaborador.setAttribute("onlyread", true)
            btnSaveFormando.classList.add("btn-warning")
            btnSaveFormando.classList.remove("btn-success")

            txtCodColaborador.parentNode.classList.add("active")
            txtCodColaborador.value = rowList.cells[0].textContent

            txtNomeColaborador.parentNode.classList.add("active")
            txtNomeColaborador.value = rowList.cells[1].textContent

            slcTipoCurso.parentNode.classList.add("active")
            slcTipoCurso.value = rowList.cells[3].getAttribute("data-id-curso")

            txtDataFormacao.parentNode.classList.add("active")
            let [dia, mes, ano] = rowList.cells[4].textContent.split("/")
            txtDataFormacao.value = `${ano}-${mes}-${dia}`

            let [hora, minuto] = rowList.cells[5].textContent.split(":")

            txtHoraFormacao.parentNode.classList.add("active")
            txtHoraFormacao.value = hora
            
            txtMinutoFormacao.parentNode.classList.add("active")
            txtMinutoFormacao.value = minuto

            slcLocalCurso.parentNode.classList.add("active")
            slcLocalCurso.value = rowList.cells[6].getAttribute("data-id-local")

            if(btnSaveFormando){
                btnSaveFormando.addEventListener("click", async()=>{
                    let resultCheckVazio = checkVazioFormando(1)
                    if(!resultCheckVazio){
                        loadAwaitAction("show")
                        let dados = {
                            action : 'editar',
                            codColaborador : txtCodColaborador.value,
                            nome : txtNomeColaborador.value,
                            curso : slcTipoCurso.value,
                            data : txtDataFormacao.value,
                            hora : txtHoraFormacao.value,
                            minuto : txtMinutoFormacao.value,
                            loja : slcLocalCurso.value,
                            idFormando : idFormacao,
                            estado : 1
                        }

                        let resultCrud = await CRUDFormando(JSON.stringify(dados))

                        if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                            setTimeout(async()=>{
                                await monteListFormando(0)
                            },800)
                        }
                        loadAwaitAction("")
                    }
                })
            }
        })

    } catch (error) {
        loadAwaitAction("")
        console.log(error)
    }
}

/**
 * 
 * @param {array} dadosGet recebe os dados para o crud 
 * @returns return true ou false
 */
async function CRUDFormando(dadosGet) {
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)

        let response = await fetch("api/crud-formando", {
            method: 'POST',
            body  : dados
        })
        if(!response.ok) throw new Error("error")

        let result = await response.json()

        if(result && typeof result == 'object' && result.obj.sucesso){
            msgAlert('alert-success',result.obj.msg)
        } else {
            msgAlert('alert-warning',result.obj.msg)
        }

        return await result
    } catch (error) {
        console.log(error)
    }
}

/**
 * 
 * @param {int} id id do registro a ser excluido 
 */
async function excluirRegistroFormando(id) {
    try {
        let result = await openSubModal("modal-confirme", 'Confirmar', 'Deseja realmente exluir o registro?')
        result.addEventListener("shown.bs.modal", ()=>{
            let btnSubModalValida = result.querySelector("#btnSubModalValida")
            if(btnSubModalValida){
                btnSubModalValida.addEventListener("click", async()=>{
                    let dados = {
                        action : "excluir",
                        id : id,
                    }
                    let resultCrud = await CRUDFormando(JSON.stringify(dados))
                    if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                        setTimeout(async()=>{
                            await monteListFormando(0)
                        },800)
                        result.remove()
                        document.getElementById("modalSub-container").textContent = ''
                    }
                })
            }
        })
    } catch (error) {
        console.log(error)
    }
}

let slcSituacao = document.getElementById("slcSituacao")
if(slcSituacao){
    slcSituacao.addEventListener("change",async()=>{
        await monteListFormando(1)
    })
}

//btnSearchFirstFormando
let btnSearchFirstFormando = document.getElementById("btnSearchFirstFormando")
if(btnSearchFirstFormando){
    btnSearchFirstFormando.addEventListener("click",async ()=>{
        let txtBuscaFormando = document.getElementById("txtBuscaFormando")
        let slcTipoSearch = document.getElementById("slcTipoSearch")
        let txtDeFormando = document.getElementById("txtDeFormando")
        let txtAteFormando = document.getElementById("txtAteFormando")

        if(txtDeFormando.value != '' || txtAteFormando.value != ''){
            await monteListFormando(1)
        } else {
            if(txtBuscaFormando.value == ''){
                return msgAlert("alert-warning", "O campo de busca está vazio. Se quiser buscar por algo, informe o texto")
            } else {
                if(slcTipoSearch.value == ''){
                    return msgAlert("alert-warning", "Escolha um tipo de busca")
                } else {
                    await monteListFormando(1)
                }
            }
        }
    })
}

async function novaFormacao(btn){
    try {
        loadAwaitAction("show")
        let btnAction = btn
        let idBtn = btnAction.id
        console.log(idBtn)
        let titleModal = "Adicionar nova Formação"
        let estado = 1
        
        if(idBtn == "btnAddPlanearFormando") titleModal = "Planear Nova Formação"
        if(idBtn == "btnAddPlanearFormando") estado = 0

        let {modalEl, container, nomeRoute} = await openModal("modal-add-formando", titleModal)
        
        modalEl.addEventListener("shown.bs.modal", async()=>{
            await loadListCursoSLC("slcTipoCurso")
            await loadListLojaSLC("slcLocalCurso")
            
            let btnSaveFormando = document.getElementById("btnSaveFormando")
            let btnSearchFormando = document.getElementById("btnSearchFormando")

            let txtCodColaborador = document.getElementById("txtCodColaborador")
            let txtNomeColaborador = document.getElementById("txtNomeColaborador")
            let slcTipoCurso = document.getElementById("slcTipoCurso")
            let txtDataFormacao = document.getElementById("txtDataFormacao")
            let txtHoraFormacao = document.getElementById("txtHoraFormacao")
            let txtMinutoFormacao = document.getElementById("txtMinutoFormacao")
            let slcLocalCurso = document.getElementById("slcLocalCurso")
            
            if(idBtn == "btnAddPlanearFormando"){
                txtHoraFormacao.parentNode.classList.add("d-none")
                txtMinutoFormacao.parentNode.classList.add("d-none")
            }

            loadAwaitAction("")

            if(btnSearchFormando){
                btnSearchFormando.addEventListener("click", async ()=>{
                    if(txtCodColaborador.value == ''){
                        msgAlert("alert-warning", "Primeiro informe o código do funcionario")
                    } else {
                        let dados = {
                            action : '',
                            paginaSet : 0,
                            codColaborador : txtCodColaborador.value,
                            nomeColaborador : ''
                        }

                        let resultSearch = await searchDadosFuncionario(JSON.stringify(dados))

                        if(resultSearch && typeof resultSearch == 'object' && resultSearch.obj.length > 0){
                            resultSearch.obj.forEach(item=>{
                                txtNomeColaborador.parentNode.classList.add("active")
                                txtNomeColaborador.value = item.nomeColaborador
                            })
                        } else {
                            txtNomeColaborador.value = ''
                            txtNomeColaborador.parentNode.classList.remove("active")
                            msgAlert("alert-warning", "Nenhum colaborador foi encontrado com esse código.")
                        }
                    }
                })
            }

            if(btnSaveFormando){
                btnSaveFormando.addEventListener("click", async()=>{
                    let resultCheckVazio = checkVazioFormando(estado)
                    if(!resultCheckVazio){
                        let dados = {
                            action : 'salvar',
                            codColaborador : txtCodColaborador.value,
                            nomeColaborador : txtNomeColaborador.value,
                            curso : slcTipoCurso.value,
                            data : txtDataFormacao.value,
                            hora : txtHoraFormacao.value.padStart(2,0),
                            minuto : txtMinutoFormacao.value.padStart(2,0),
                            loja : slcLocalCurso.value,
                            estado : estado,
                        }

                        let resultCrud = await CRUDFormando(JSON.stringify(dados))

                        setTimeout(async()=>{
                            await monteListFormando(0)
                        },800)

                        if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                            txtCodColaborador.value = ''
                            txtCodColaborador.parentNode.classList.remove("active")
                            txtNomeColaborador.value = ''
                            txtNomeColaborador.parentNode.classList.remove("active")
                            slcTipoCurso.value = '0'
                            txtDataFormacao.value = ''
                            txtDataFormacao.parentNode.classList.remove("active")
                            txtHoraFormacao.value = ''
                            txtHoraFormacao.parentNode.classList.remove("active")
                            txtMinutoFormacao.value = ''
                            txtMinutoFormacao.parentNode.classList.remove("active")
                            slcLocalCurso.value = '0'
                        }
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
 * @returns false se estiver tudo ok
 */
function checkVazioFormando(estado){
    try {
        let txtCodColaborador = document.getElementById("txtCodColaborador")
        let txtNomeColaborador = document.getElementById("txtNomeColaborador")
        let slcTipoCurso = document.getElementById("slcTipoCurso")
        let txtDataFormacao = document.getElementById("txtDataFormacao")
        let txtHoraFormacao = document.getElementById("txtHoraFormacao")
        let txtMinutoFormacao = document.getElementById("txtMinutoFormacao")
        let slcLocalCurso = document.getElementById("slcLocalCurso")

        if(txtCodColaborador.value == ''){
            txtCodColaborador.classList.add("border-danger")
            txtCodColaborador.focus()
            msgAlert("alert-warning", "O campo código do colaborador está vazio")
            return true
        } else {
            txtCodColaborador.classList.remove("border-danger")
        }

        if(txtNomeColaborador.value == ''){
            txtNomeColaborador.classList.add("border-danger")
            txtNomeColaborador.focus()
            msgAlert("alert-warning", "O campo nome do colaborador está vazio, Use o botão para localizar o colaboradoro ou informe o nome do colaborador")
            return true
        } else {
            txtNomeColaborador.classList.remove("border-danger")
        }
        
        if(estado == 1){
            if(slcTipoCurso.value == 0){
                slcTipoCurso.classList.add("border-danger")
                slcTipoCurso.focus()
                msgAlert("alert-warning", "O campo formação do colaborador está vazio")
                return true
            } else {
                slcTipoCurso.classList.remove("border-danger")
            }

            if(txtDataFormacao.value == ''){
                txtDataFormacao.classList.add("border-danger")
                txtDataFormacao.focus()
                msgAlert("alert-warning", "Informe a data que ocorreu a formação")
                return true
            } else {
                txtDataFormacao.classList.remove("border-danger")
            }

            if(txtHoraFormacao.value == ''){
                txtHoraFormacao.classList.add("border-danger")
                txtHoraFormacao.focus()
                msgAlert("alert-warning", "Quantas horas durou a formaçao")
                return true
            } else {
                txtHoraFormacao.classList.remove("border-danger")
            }
    
            if(txtMinutoFormacao.value == ''){
                txtMinutoFormacao.classList.add("border-danger")
                txtMinutoFormacao.focus()
                msgAlert("alert-warning", "Irfome o minuto que durou a formação, use 0 para informar que não houve minuto a mais")
                return true
            } else {
                txtMinutoFormacao.classList.remove("border-danger")
            }
       
            if(slcLocalCurso.value == 0){
                slcLocalCurso.classList.add("border-danger")
                slcLocalCurso.focus()
                msgAlert("alert-warning", "Qual foi o local de formação")
                return true
            } else {
                slcLocalCurso.classList.remove("border-danger")
            }
        }

        return false

    } catch (error) {
        console.log(error)
    }
}

////curso
//1
let btnAddCurso = document.getElementById("btnAddCurso")
if(btnAddCurso){
    try {
        btnAddCurso.addEventListener("click", async()=>{
            loadAwaitAction("show")
            let {modalEl, container, nomeRoute} = await openModal('modal-add-curso', 'Lista De Cursos')
    
            modalEl.addEventListener("shown.bs.modal", async()=>{
                await monteLoadListTableCurso(0)
                loadAwaitAction("")
    
                let btnSaveCurso = document.getElementById("btnSaveCurso")
                if(btnSaveCurso){
                    btnSaveCurso.addEventListener("click", async()=>{
                        let txtNomeCurso = modalEl.querySelector("#txtNomeCurso")
                        let slcAtivo = modalEl.querySelector("#slcAtivo")
                        if(txtNomeCurso.value == ''){
                            msgAlert("alert-warning", "O campo nome está vazio")
                        } else {
                            //chamar o crud
                            let actionNome = btnSaveCurso.textContent == 'Salvar Alteração' ? 'editar' : 'salvar'
                            let dados = {
                                action : actionNome,
                                id : txtNomeCurso.getAttribute("data-id-curso") || '',
                                nome : txtNomeCurso.value,
                                ativo : slcAtivo.value == 99 ? 1 : slcAtivo.value,
                            }
                            loadAwaitAction("show")
                            let resultCrud = await CRUDCurso(JSON.stringify(dados))
                            loadAwaitAction("")
                            if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                                txtNomeCurso.value = ''
                                txtNomeCurso.parentNode.classList.remove("active")
                                slcAtivo.value = 1
                                btnSaveCurso.innerHTML = '<i class="bi bi-plus-circle"></i>'
                                btnSaveCurso.classList.remove("btn-warning")
                                btnSaveCurso.classList.add("btn-success")
                                setTimeout(async()=>{
                                    await monteLoadListTableCurso(0)
                                },800)
                            }
                        }
                    })
                }
            })
        })
    } catch (error) {
        console.log(error)
    }
}

//2
/**
 * 
 * @param {int} novaPagina numero da pagina
 * eh o passador para mover a pagina 
 */
function passarBuscaCurso(novaPagina) {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    monteLoadListTableCurso(novaPagina)
}

//3
/**
 * 
 * @param {array} dadosGet dados para a busca 
 * @returns 
 */
async function searchDadosCurso(dadosGet) {
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)

        let response = await fetch("api/search-dados-curso", {
            method : 'POST',
            body : dados
        })
        if(!response.ok) throw new Error("erro")

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

//4
/**
 * 
 * @param {array} dadosGet dados para a busca 
 * @returns 
 */
async function loadListtableCurso(dadosGet) {
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)
        let response = await fetch("api/get-load-list-table-curso",{
            method : 'POST',
            body : dados
        })

        if(!response.ok) throw new Error("error")

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

//5
async function monteLoadListTableCurso(pagina){
    try {
        let txtNomeCurso = document.getElementById("txtNomeCurso")
         let dados = {
                paginaSet : pagina,
                nomeCurso : txtNomeCurso ?.value || ''
            }
            
            let resultListTabel = await loadListtableCurso(JSON.stringify(dados))
            let tbodyCurso = document.querySelector("#tbodyCurso")
            tbodyCurso.textContent = ''

            if(resultListTabel && Array.isArray(resultListTabel.obj) && resultListTabel.obj.length > 0){
                resultListTabel.obj.forEach(item=>{
                    let newTr = document.createElement("tr")
                    newTr.classList.add("rowList")
                    newTr.innerHTML = `<td data-id-curso='${item.id}'>${item.nome}</td>
                                        <td>${(item.ativo == 1 ? 'Ativo' : 'Desativado')}</td>
                                        <td>
                                            <i class='bi bi-pen btn btn-outline-warning' onclick='editarCurso(this)'></i>
                                            <i class='bi bi-trash btn btn-outline-danger' onclick='excluirCurso(${item.id})'></i>
                                        </td>`

                    tbodyCurso.append(newTr)
                })

            } else {
                let newTr = document.createElement("tr")
                newTr.innerHTML = `Nao foi encontrado nenhum resigstro`
                tbodyCurso.append(newTr)
            }

            let limite = resultListTabel.obj.length > 0 ? resultListTabel.obj[0]['limite'] : 0
            let totalRegisto = resultListTabel.obj.length > 0 ? resultListTabel.obj[0]['totalRegistro'] : 0
            pagination(totalRegisto, limite, pagina, 'paginador-submodal', 'passarCurso')
    } catch (error) {
        console.log(error)
    }
}

//6
async function passarCurso(novaPagina) {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    await monteLoadListTableCurso(novaPagina)
}

//7
async function editarCurso(btn) {
    try {
        let rowList = btn.closest(".rowList")
        let txtNomeCurso = document.getElementById("txtNomeCurso")
        let slcAtivo = document.getElementById("slcAtivo")
        let btnSaveCurso = document.getElementById("btnSaveCurso")

        btnSaveCurso.classList.remove('btn-sucesso')
        btnSaveCurso.classList.add('btn-warning')
        btnSaveCurso.textContent = 'Salvar Alteração'
        let idCurso = rowList.cells[0].getAttribute("data-id-curso")
        let nomeCurso = rowList.cells[0].textContent
        let ativoCurso = rowList.cells[1].textContent

        txtNomeCurso.setAttribute("data-id-curso", idCurso)
        txtNomeCurso.parentNode.classList.add("active")
        txtNomeCurso.value = nomeCurso
        slcAtivo.value = ativoCurso == 'Ativo' ? 1 : 0
    } catch (error) {
        console.log(error)
    }
}

//8
async function excluirCurso(id){
    try {
        let result = await openSubModal("modal-confirme", 'Confirmar', 'Deseja realmente exluir o registro?')
        result.addEventListener("shown.bs.modal", ()=>{
            let btnSubModalValida = result.querySelector("#btnSubModalValida")
            if(btnSubModalValida){
                btnSubModalValida.addEventListener("click", async()=>{
                    let dados = {
                        action : "excluir",
                        id : id,
                    }
                    let resultCrud = await CRUDCurso(JSON.stringify(dados))
                    if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                        setTimeout(async()=>{
                            await monteLoadListTableCurso(0)
                        },800)
                        result.remove()
                        document.getElementById("modalSub-container").textContent = ''
                    }
                })
            }
        })
    } catch (error) {
        console.log(error)
    }
}

//9
async function CRUDCurso(dadosGet){
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)

        let response = await fetch("api/crud-curso",{
            method : 'POST',
            body : dados
        })

        if(!response.ok) throw new Error("error")

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

//local
//1
let btnAddLocal = document.getElementById("btnAddLocal")
if(btnAddLocal){
    try {
        btnAddLocal.addEventListener("click", async()=>{
            loadAwaitAction("show")
            let {modalEl, container, nomeRoute} = await openModal('modal-add-local', 'Lista De Local')
    
            modalEl.addEventListener("shown.bs.modal", async()=>{
                await monteLoadListTableLocal(0)
                loadAwaitAction("")
                let btnSaveLocal = document.getElementById("btnSaveLocal")
                if(btnSaveLocal){
                    btnSaveLocal.addEventListener("click", async()=>{
                        let txtNomeLocal = modalEl.querySelector("#txtNomeLocal")
                        let slcAtivo = modalEl.querySelector("#slcAtivo")
                        if(txtNomeLocal.value == ''){
                            msgAlert("alert-warning", "O campo nome está vazio")
                        } else {
                            //chamar o crud
                            let actionNome = btnSaveLocal.textContent == 'Salvar Alteração' ? 'editar' : 'salvar'
                            let dados = {
                                action : actionNome,
                                id : txtNomeLocal.getAttribute("data-id-Local") || '',
                                nome : txtNomeLocal.value,
                                ativo : slcAtivo.value == 99 ? 1 : slcAtivo.value,
                            }
                            loadAwaitAction("show")
                            let resultCrud = await CRUDLocal(JSON.stringify(dados))
                            loadAwaitAction("")
                            if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                                txtNomeLocal.value = ''
                                txtNomeLocal.parentNode.classList.remove("active")
                                slcAtivo.value = 1
                                btnSaveLocal.innerHTML = '<i class="bi bi-plus-circle"></i>'
                                btnSaveLocal.classList.remove("btn-warning")
                                btnSaveLocal.classList.add("btn-success")
                                setTimeout(async()=>{
                                    await monteLoadListTableLocal(0)
                                },800)
                            }
                        }
                    })
                }
            })
        })
    } catch (error) {
        loadAwaitAction("")
        console.log(error)
    }
}

//2
async function passarBuscaLocal(novaPagina) {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    await monteLoadListTableLocal(novaPagina)
}

//3
async function searchDadosLocal(dadosGet) {
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)

        let response = await fetch("api/search-dados-local", {
            method : 'POST',
            body : dados
        })
        if(!response.ok) throw new Error("erro")

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

//4
async function loadListtableLocal(dadosGet) {
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)
        let response = await fetch("api/get-load-list-table-local",{
            method : 'POST',
            body : dados
        })

        if(!response.ok) throw new Error("error")

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

//5
async function monteLoadListTableLocal(pagina){
    try {
            let nomeLoja = document.getElementById("txtNomeLocal")
         let dados = {
                paginaSet : pagina,
                nomeLoja : nomeLoja ?.value || ''
            }
            
            let resultListTabel = await loadListtableLocal(JSON.stringify(dados))
            let tbodyLocal = document.querySelector("#tbodyLocal")
            tbodyLocal.textContent = ''

            if(resultListTabel && Array.isArray(resultListTabel.obj) && resultListTabel.obj.length > 0){
                resultListTabel.obj.forEach(item=>{
                    let newTr = document.createElement("tr")
                    newTr.classList.add("rowList")
                    newTr.innerHTML = `<td data-id-local='${item.id}'>${item.nome}</td>
                                        <td>${(item.ativo == 1 ? 'Ativo' : 'Desativado')}</td>
                                        <td>
                                            <i class='bi bi-pen btn btn-outline-warning' onclick='editarLocal(this)'></i>
                                            <i class='bi bi-trash btn btn-outline-danger' onclick='excluirLocal(${item.id})'></i>
                                        </td>`

                    tbodyLocal.append(newTr)
                })
            } else {
                let newTr = document.createElement("tr")
                newTr.innerHTML = `Nao foi encontrado nenhum resigstro`
                tbodyLocal.append(newTr)
            }

            let limite = resultListTabel.obj.length > 0 ? resultListTabel.obj[0]['limite'] : 0
            let totalRegisto = resultListTabel.obj.length > 0 ? resultListTabel.obj[0]['totalRegistro'] : 0
            pagination(totalRegisto, limite, pagina, 'paginador-submodal', 'passarLocal')
    } catch (error) {
        console.log(error)
    }
}

//6
async function passarLocal(novaPagina) {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    await monteLoadListTableLocal(novaPagina)
}

//7
async function editarLocal(btn) {
    try {
        let rowList = btn.closest(".rowList")
        let txtNomeLocal = document.getElementById("txtNomeLocal")
        let slcAtivo = document.getElementById("slcAtivo")
        let btnSaveLocal = document.getElementById("btnSaveLocal")

        btnSaveLocal.classList.remove('btn-sucesso')
        btnSaveLocal.classList.add('btn-warning')
        btnSaveLocal.textContent = 'Salvar Alteração'
        let idLocal = rowList.cells[0].getAttribute("data-id-local")
        let nomeLocal = rowList.cells[0].textContent
        let ativoLocal = rowList.cells[1].textContent

        txtNomeLocal.setAttribute("data-id-local", idLocal)
        txtNomeLocal.parentNode.classList.add("active")
        txtNomeLocal.value = nomeLocal
        slcAtivo.value = ativoLocal == 'Ativo' ? 1 : 0
    } catch (error) {
        console.log(error)
    }
}

//8
async function excluirLocal(id){
    try {
        let result = await openSubModal("modal-confirme", 'Confirmar', 'Deseja realmente exluir o registro?')
        result.addEventListener("shown.bs.modal", ()=>{
            let btnSubModalValida = result.querySelector("#btnSubModalValida")
            if(btnSubModalValida){
                btnSubModalValida.addEventListener("click", async()=>{
                    let dados = {
                        action : "excluir",
                        id : id,
                    }
                    let resultCrud = await CRUDLocal(JSON.stringify(dados))
                    if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                        setTimeout(async()=>{
                            await monteLoadListTableLocal(0)
                        },800)
                        result.remove()
                        document.getElementById("modalSub-container").textContent = ''
                    }
                })
            }
        })
    } catch (error) {
        console.log(error)
    }
}

//9
async function CRUDLocal(dadosGet){
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)

        let response = await fetch("api/crud-local",{
            method : 'POST',
            body : dados
        })

        if(!response.ok) throw new Error("error")

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

//funcionario
//1
let btnAddFuncionario = document.getElementById("btnAddFuncionario")
if(btnAddFuncionario){
    try {
        btnAddFuncionario.addEventListener("click", async()=>{
            loadAwaitAction("show")
            let {modalEl, container, nomeRoute} = await openModal('modal-add-funcionario', 'Lista De Funcionario')
    
            modalEl.addEventListener("shown.bs.modal", async()=>{
                await monteLoadListTableFuncionario(0)
                await loadListLojaSLC("slcLoja")
                loadAwaitAction("")
    
                let btnSaveFuncionario = document.getElementById("btnSaveFuncionario")
                if(btnSaveFuncionario){
                    btnSaveFuncionario.addEventListener("click", async()=>{
                        let txtCodFuncionario = modalEl.querySelector("#txtCodFuncionario")
                        let txtNomeFuncionario = modalEl.querySelector("#txtNomeFuncionario")
                        let slcLoja = modalEl.querySelector("#slcLoja")
                        let slcAtivo = modalEl.querySelector("#slcAtivo")
                        if(txtCodFuncionario.value == '' || txtNomeFuncionario.value == ''){
                            msgAlert("alert-warning", "O campo cod ou nome estão vazio")
                        } else {
                            //chamar o crud
                            let actionNome = btnSaveFuncionario.textContent == 'Salvar' ? 'editar' : 'salvar'
                            let dados = {
                                action : actionNome,
                                id : txtCodFuncionario.getAttribute("data-id-funcionario") || '',
                                codColaborador : txtCodFuncionario.value,
                                nomeColaborador : txtNomeFuncionario.value,
                                loja : slcLoja.value == 99 ? '' : slcLoja.value,
                                ativo : slcAtivo.value == 99 ? 1 : slcAtivo.value,
                            }
                            loadAwaitAction("show")
                            let resultCrud = await CRUDFuncionario(JSON.stringify(dados))
                            loadAwaitAction("")
                            if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                                txtCodFuncionario.value = ''
                                txtCodFuncionario.parentNode.classList.remove("active")
                                txtNomeFuncionario.value = ''
                                txtNomeFuncionario.parentNode.classList.remove("active")
                                slcAtivo.value = 1
                                btnSaveFuncionario.innerHTML = '<i class="bi bi-plus-circle"></i>'
                                btnSaveFuncionario.classList.remove("btn-warning")
                                btnSaveFuncionario.classList.add("btn-success")
                                setTimeout(async()=>{
                                    await monteLoadListTableFuncionario(0)
                                },800)
                            }
    
                            txtCodFuncionario.removeAttribute("disabled")
                            txtCodFuncionario.removeAttribute("onlyread")
                        }
                    })
                }
            })
        })
    } catch (error) {
        loadAwaitAction("")
    }
}

//2
async function passarBuscaFuncionario(novaPagina) {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    await monteLoadListTableFuncionario(novaPagina)
}

//3
async function searchDadosFuncionario(dadosGet) {
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)

        let response = await fetch("api/search-dados-funcionario", {
            method : 'POST',
            body : dados
        })
        if(!response.ok) throw new Error("erro")

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

//4
async function loadListtableFuncionario(dadosGet) {
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)
        let response = await fetch("api/get-load-list-table-funcionario",{
            method : 'POST',
            body : dados
        })

        if(!response.ok) throw new Error("error")

        return await response.json()
    } catch (error) {
        console.log(error)
    }
}

//5
async function monteLoadListTableFuncionario(pagina){
    try {
        let txtCodFuncionario = document.getElementById("txtCodFuncionario")
        let txtNomeFuncionario = document.getElementById("txtNomeFuncionario")

         let dados = {
                paginaSet : pagina,
                codColaborador : txtCodFuncionario ?.value || '',
                nomeColaborador : txtNomeFuncionario ?.value || '',
            }
            
            let resultListTabel = await loadListtableFuncionario(JSON.stringify(dados))
            let tbodyFuncionario = document.querySelector("#tbodyFuncionario")
            tbodyFuncionario.textContent = ''

            if(resultListTabel && Array.isArray(resultListTabel.obj) && resultListTabel.obj.length > 0){
                resultListTabel.obj.forEach(item=>{
                    let newTr = document.createElement("tr")
                    newTr.classList.add("rowList")
                    newTr.innerHTML = `<td data-id-funcionario='${item.id}'>${item.codColaborador}</td>
                                        <td>${item.nome}</td>
                                        <td>${item.nomeLoja || ''}</td>
                                        <td>${(item.ativo == 1 ? 'Ativo' : 'Desativado')}</td>
                                        <td>
                                            <i class='bi bi-pen btn btn-outline-warning' onclick='editarFuncionario(this)'></i>
                                            <i class='bi bi-trash btn btn-outline-danger' onclick='excluirFuncionario(${item.codColaborador})'></i>
                                        </td>`

                    tbodyFuncionario.append(newTr)
                })

            } else {
                let newTr = document.createElement("tr")
                newTr.innerHTML = `Nao foi encontrado nenhum resigstro`
                tbodyFuncionario.append(newTr)
            }

            let limite = resultListTabel.obj.length > 0 ? resultListTabel.obj[0]['limite'] : 0
            let totalRegisto = resultListTabel.obj.length > 0 ? resultListTabel.obj[0]['totalRegistro'] : 0
            pagination(totalRegisto, limite, pagina, 'paginador-submodal', 'passarFuncionario')
    } catch (error) {
        console.log(error)
    }
}

//6
async function passarFuncionario(novaPagina) {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    await monteLoadListTableFuncionario(novaPagina)
}

//7
async function editarFuncionario(btn) {
    try {
        let rowList = btn.closest(".rowList")
        let txtNomeFuncionario = document.getElementById("txtNomeFuncionario")
        let txtCodFuncionario = document.getElementById("txtCodFuncionario")
        let slcAtivo = document.getElementById("slcAtivo")
        let btnSaveFuncionario = document.getElementById("btnSaveFuncionario")

        btnSaveFuncionario.classList.remove('btn-sucesso')
        btnSaveFuncionario.classList.add('btn-warning')
        btnSaveFuncionario.textContent = 'Salvar'
        let idFuncionario = rowList.cells[0].getAttribute("data-id-funcionario")
        let nomeFuncionario = rowList.cells[1].textContent
        let codFuncionario = rowList.cells[0].textContent
        let ativoFuncionario = rowList.cells[3].textContent
        console.log(idFuncionario)
        
        txtNomeFuncionario.setAttribute("data-id-funcionario", idFuncionario)
        txtNomeFuncionario.parentNode.classList.add("active")
        txtNomeFuncionario.value = nomeFuncionario
        slcAtivo.value = ativoFuncionario == 'Ativo' ? 1 : 0
        
        txtCodFuncionario.setAttribute('disabled', true)
        txtCodFuncionario.setAttribute('onlyread', true)
        txtCodFuncionario.value = codFuncionario
        txtCodFuncionario.parentNode.classList.add("active")
    } catch (error) {
        console.log(error)
    }
}

//8
async function excluirFuncionario(id){
    try {
        let result = await openSubModal("modal-confirme", 'Confirmar', 'Deseja realmente exluir o registro?')
        result.addEventListener("shown.bs.modal", ()=>{
            let btnSubModalValida = result.querySelector("#btnSubModalValida")
            if(btnSubModalValida){
                btnSubModalValida.addEventListener("click", async()=>{
                    let dados = {
                        action : "excluir",
                        id : id,
                    }
                    let resultCrud = await CRUDFuncionario(JSON.stringify(dados))
                    if(resultCrud && typeof resultCrud == 'object' && resultCrud.obj.sucesso){
                        setTimeout(async()=>{
                            await monteLoadListTableFuncionario(0)
                        },800)
                        result.remove()
                        document.getElementById("modalSub-container").textContent = ''
                    }
                })
            }
        })
    } catch (error) {
        console.log(error)
    }
}

//9
async function CRUDFuncionario(dadosGet){
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)

        let response = await fetch("api/crud-funcionario",{
            method : 'POST',
            body : dados
        })

        if(!response.ok) throw new Error("error")

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