window.addEventListener("DOMContentLoaded",async function(){
    try {
        await loadPageFormando(0)
    } catch (error) {
        //fazer erro
    }
})

async function listLoadPageFormando(paginaGet) {
    try {

        let txtBuscaFormando = document.getElementById("txtBuscaFormando")
        let slcTipoSearch = document.getElementById("slcTipoSearch")
        let txtDeFormando = document.getElementById("txtDeFormando")
        let txtAteFormando = document.getElementById("txtAteFormando")

        let dados = {
            txtBuscaSet : txtBuscaFormando.value,
            tipoBuscaSet : slcTipoSearch.value,
            txtDeSet : txtDeFormando.value,
            txtAteSet : txtAteFormando.value,
            paginaSet : paginaGet,
        }

        let result = await $.post("././app/controller/function/funcListLoadPageFormando.php", dados)
        return result
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao carregar lista de formação")
    }
}

function timeToMs(time) {
    let [horas, minutos, segundos] = time.split(':').map(Number)
    return (horas * 3600 + minutos * 60 + segundos) * 1000
}

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

async function loadPageFormando(paginaGet){
    try {
        let tbodyFormando = document.getElementById("tbodyFormando")

        tbodyFormando.innerHTML = "Aguarde carregando página..."

        let resultLoad = await listLoadPageFormando(paginaGet)
        let jsonResultLoad = JSON.parse(resultLoad)
        tbodyFormando.innerHTML = ""

        let tempoTotal = 0

        if(jsonResultLoad && Array.isArray(jsonResultLoad.obj) && jsonResultLoad.obj.length > 0){
            jsonResultLoad.obj.forEach(item=>{

                let timeFormacao = item.tempoFormacao.split(":")
                
                tempoTotal += timeToMs(item.tempoFormacao)

                let horaFormacao = timeFormacao[0]
                let minutoFormacao = timeFormacao[1]
                let tr = document.createElement("tr")
                tr.classList.add("rowList")
                tr.innerHTML = `<td data-id-registro-formando='${item.idFormacao}'>${item.codFuncionarioFormacao}</td>
                                <td>${item.nomeFuncionario}</td>
                                <td>${item.nomeFormacaoNome}</td>
                                <td>${dataIso(item.dataFormacao)}</td>
                                <td>${horaFormacao}:${minutoFormacao}</td>
                                <td>${item.nomeLoja}</td>
                                <td><i class='bi bi-trash btn btn-outline-danger' onclick='excluirRegistroFormacao(this)'></i></td>`

                tbodyFormando.appendChild(tr)
            })
        } else {
            msgAlert("alert-warning", "Nenhum registro encontrado")
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
                                    <td>${horaFinal}:${minutoFinal}</td>
                                    <td></td>
                                    <td></td>`

        tbodyFormando.appendChild(rowTempoTotal)

        //pagination inicio
        let x = 0
        let btnActive = 0

        let qtdRegistro = (jsonResultLoad.obj.length == 0 ? "" : jsonResultLoad.obj[0].totalRegistro )
        let qtdPagina = Math.ceil(qtdRegistro / jsonResultLoad.limite)
        let limite = jsonResultLoad.limite

        await pagination("paginationHome", qtdPagina, paginaGet, limite)
        document.querySelectorAll(".btnPgane").forEach(item => {
            if(item){
                item.addEventListener("click",async function(){

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

                    await loadPageFormando(x)
                })
            }
        })
        //pagination fim
    } catch (error) {
        
    }
}

async function excluirRegistroFormacao(event) {
    try {
        let idFormado = event.parentNode.parentNode.cells[0].getAttribute("data-id-registro-formando")

        await openConfirmar("Excluir", "Deseja realmente exluir o registro atual?")

        let btnConfirmar = document.getElementById("btnConfirmar")

        if(btnConfirmar){
            btnConfirmar.addEventListener("click", async()=>{
                let result = await CRUDFormando("excluir", idFormado, "", "", "", "", "", "", "")
                
                if(result == 2){
                    msgAlert("alert-success", "Formação excluida com sucesso.")

                    let rowTotalTime = document.querySelector(".rowTotalTime")

                    let novaSoma = rowTotalTime.cells[4].textContent.split(":")
                        
                    let xHora = parseFloat(novaSoma[0])
                    let xMinuto = parseFloat(novaSoma[1])

                    let tempoExluir = event.parentNode.parentNode.cells[4].textContent.split(":")

                    document.querySelector(".rowTotalTime").cells[4].textContent = `${(xHora - parseFloat(tempoExluir[0])).toString().padStart(2, 0)}:${(xMinuto - parseFloat(tempoExluir[1])).toString().padStart(2, 0)}`

                    event.parentNode.parentNode.remove()
                } else if (result == "sessionExpira"){
                    window.location.href = "login"
                } else {
                    msgAlert("alert-danger", "Houve um erro ao excluir registro, atualize a página e tente novamente.")
                }
                document.getElementById("divModalConfirmar").remove()
            })
        }

    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao excluir registro, atualize a página e tente novamente.")
    }
}

async function openModalAddFormando() {
    try {
        let result = await $.post("././app/views/pages/modal/modeloAddFormando.php")

        let teste = document.createElement("div")
        teste.id = "divModal"
        teste.innerHTML = result

        document.body.appendChild(teste)
        
        campoInputLabelSuspenso()
        await listAllFormacaoNome("slcTipoFormacao")
        // await listAllFormacaoLocal("slcLocalFormacao")
        await loadListLoja("slcLocalFormacao",1)

        let txtCodFormando = document.getElementById("txtCodFormando")
        let txtNomeFormando = document.getElementById("txtNomeFormando")
        
        let slcTipoFormacao = document.getElementById("slcTipoFormacao")

        let txtDataFormacao = document.getElementById("txtDataFormacao")
        let txtHoraFormacao = document.getElementById("txtHoraFormacao")
        let txtMinutoFormacao = document.getElementById("txtMinutoFormacao")

        let btnActionSalvar = document.getElementById("btnActionSalvar")

        let tbodyFormando = document.getElementById("tbodyFormando")

        let slcLocalFormacao = document.getElementById("slcLocalFormacao")


        let action = "criar"

        let btnSearchFormando = document.getElementById("btnSearchFormando")
        if(btnSearchFormando){
            btnSearchFormando.addEventListener("click", async  ()=>{
                let resultFomando = await searchFuncionario(txtCodFormando.value)

                let jsonResultFormando = JSON.parse(resultFomando)

                if(jsonResultFormando && Array.isArray(jsonResultFormando.obj) && jsonResultFormando.obj.length){
                      
                    jsonResultFormando.obj.forEach(element=>{
                        txtNomeFormando.value = element.nomeFuncionario
                        txtNomeFormando.parentNode.classList.add("active")

                    })
                } else {
                    msgAlert("alert-warning", "Nenhum funcionário encontrado com esse código.")
                    txtNomeFormando.value = ""
                    txtNomeFormando.parentNode.classList.remove("active")
                }
            })  
        }

        if(btnActionSalvar){
            btnActionSalvar.addEventListener("click", async(event)=>{
                event.preventDefault()
                let obrig = await checkVazioCampoFormando()

                if(obrig != 0){
                    let resultCrud = await CRUDFormando(action, "", txtCodFormando.value, txtNomeFormando.value, slcTipoFormacao.value, txtDataFormacao.value, txtHoraFormacao.value, txtMinutoFormacao.value, slcLocalFormacao.value)
    
                    let slcTipoFormacaonomeOption = slcTipoFormacao.children[slcTipoFormacao.selectedIndex]
                    let slcLocalFormacaoOptoin = slcLocalFormacao.options[slcLocalFormacao.selectedIndex]
    
                    if(resultCrud == 1){
                        let rowTotalTime = document.querySelector(".rowTotalTime")

                        msgAlert("alert-success", "Formação salvo com sucesso.")
    
                        let testeRow = document.createElement("tr") //txtMinutoFormacao.value
                        testeRow.classList.add("rowList")
                        testeRow.innerHTML = `<td>${txtCodFormando.value}</td>
                                                <td>${txtNomeFormando.value}</td>
                                                <td>${slcTipoFormacaonomeOption.textContent}</td>
                                                <td>${dataIso(txtDataFormacao.value)}</td>
                                                <td>${txtHoraFormacao.value.toString().padStart(2,0) + ":" + txtMinutoFormacao.value.toString().padStart(2,0)}</td>
                                                <td>${slcLocalFormacaoOptoin.text}</td>
                                                <td>Criado</td>`
    
                        rowTotalTime.parentElement.insertBefore(testeRow, rowTotalTime)
                        
                        let novaSoma = rowTotalTime.cells[4].textContent.split(":")
                        
                        let xHora = parseFloat(novaSoma[0])
                        let xMinuto = parseFloat(novaSoma[1])

                        document.querySelector(".rowTotalTime").cells[4].textContent = `${(xHora + parseFloat(txtHoraFormacao.value)).toString().padStart(2, 0)}:${(xMinuto + parseFloat(txtMinutoFormacao.value)).toString().padStart(2, 0)}`

                        if(tbodyFormando.querySelectorAll(".rowList").length > 7){
                            tbodyFormando.querySelectorAll(".rowList")[0].remove()
                        }
                            
                        document.getElementById("divModal").remove()
    
                    } else if(resultCrud == "sessionExpira") {
                        window.location.href = "login"
                    } else {
                        msgAlert("alert-danger", "Houve um erro ao salvar formação, tente novamente.")
                    }
                }
            })
        }


        closeModal()
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao abrir janela, atualize a página.")
    }
}

async function checkVazioCampoFormando() {
    try {
        let txtCodFormando = document.getElementById("txtCodFormando")
        let txtNomeFormando = document.getElementById("txtNomeFormando")
        let slcTipoFormacao = document.getElementById("slcTipoFormacao")
        let txtDataFormacao = document.getElementById("txtDataFormacao")
        let txtHoraFormacao = document.getElementById("txtHoraFormacao")
        let txtMinutoFormacao = document.getElementById("txtMinutoFormacao")
        let slcLocalFormacao = document.getElementById("slcLocalFormacao")

        if(txtCodFormando && txtCodFormando.value == ""){
            msgAlert("alert-danger", "Primeiro informe o codigo do funcionário.")
            txtCodFormando.classList.add("textObrigatorio")
            return 0
        } else {
            txtCodFormando.classList.remove("textObrigatorio")
        }

        if(txtNomeFormando && txtNomeFormando.value == ""){
            msgAlert("alert-danger", "Primeiro informe o codigo do funcionário.")
            txtNomeFormando.classList.add("textObrigatorio")
            return 0
        } else {
            txtNomeFormando.classList.remove("textObrigatorio")
        }

        if(slcTipoFormacao && slcTipoFormacao.value == ""){
            msgAlert("alert-danger", "Primeiro informe o codigo do funcionário.")
            slcTipoFormacao.classList.add("textObrigatorio")
            return 0
        } else {
            slcTipoFormacao.classList.remove("textObrigatorio")
        }

        if(txtDataFormacao && txtDataFormacao.value == ""){
            msgAlert("alert-danger", "Primeiro informe o codigo do funcionário.")
            txtDataFormacao.classList.add("textObrigatorio")
            return 0
        } else {
            txtDataFormacao.classList.remove("textObrigatorio")
        }

        if(txtHoraFormacao && txtHoraFormacao.value == ""){
            msgAlert("alert-danger", "Primeiro informe o codigo do funcionário.")
            txtHoraFormacao.classList.add("textObrigatorio")
            return 0
        } else {
            txtHoraFormacao.classList.remove("textObrigatorio")
        }

        if(txtMinutoFormacao && txtMinutoFormacao.value == ""){
            msgAlert("alert-danger", "Primeiro informe o codigo do funcionário.")
            txtMinutoFormacao.classList.add("textObrigatorio")
            return 0
        } else {
            txtMinutoFormacao.classList.remove("textObrigatorio")
        }

        if(slcLocalFormacao && slcLocalFormacao.value == ""){
            msgAlert("alert-danger", "Primeiro informe o codigo do funcionário.")
            slcLocalFormacao.classList.add("textObrigatorio")
            return 0
        } else {
            slcLocalFormacao.classList.remove("textObrigatorio")
        }
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao verificar os campos")
    }
}

async function CRUDFormando(action, idFormacao, codFunc, nomeFunc, tipoForm, dataForm, horaForm, minutoForm, localForm) {
    try {
        let dados = {
            actionSet : action,
            idFormacaoSet : idFormacao,
            codFuncSet : codFunc,
            nomeFuncSet : nomeFunc,
            tipoFormSet : tipoForm,
            dataFormSet : dataForm,
            horaFormSet : horaForm,
            minutoFormSet : minutoForm,
            localFormSet : localForm,
        }

        let result = await $.post("././app/controller/function/funcCRUDFormando.php", dados)
        return result
    } catch (error) {
        msgAlert("alert-danger", "houve um erro ao salvar formação, verifique se foi salvao e volte a tentar." + error)
    }
}
//
async function searchFuncionario(idFormando) {
    try {
        let dados = {
            idFormandoSet : idFormando,
        }
        let result = await $.post("././app/controller/function/funcSearchFuncionario.php", dados)

        // let jsonResult = JSON.parse(result)

        // if(jsonResult && Array.isArray(jsonResult.obj) && Array.isArray(jsonResult.obj).lenght > 0){
            return result
        // } else {
        //     return msgAlert("alert-warning", "Nenhum funcionário encontrado com esse código.")
        // }

    } catch (error) {
        msgAlert("alert-danger", "Erro ao consultar funcionário, tente nomamente ou atualize a página.")
    }
}

//formacao
async function openModalAddFormacao() {
    try {
        let result = await $.post("././app/views/pages/modal/modeloAddFormacaoNome.php")

        let teste = document.createElement("div")
        teste.innerHTML = result
        teste.id = "divModal"

        document.body.appendChild(teste)

        closeModal()
        campoInputLabelSuspenso()

        let btnSaveFormacao = document.getElementById("btnSaveFormacao")
        let txtNomeFormacao = document.getElementById("txtNomeFormacao")
        let tbodyFormacao = document.getElementById("tbodyFormacao")

        await loadListFormacaoNome(0)

        if(btnSaveFormacao){
            btnSaveFormacao.addEventListener("click",async ()=>{
                if(txtNomeFormacao.value == ""){
                    msgAlert("alert-danger", "Primeiro escreva alguma coisa para salvar")
                } else {
                    let btnAction = ""
                    let idFormacao = ""

                    if(btnSaveFormacao.classList.contains("btn-warning")){
                        btnAction = "editar"
                        idFormacao = txtNomeFormacao.getAttribute("data-id-formacao")
                    } else {
                        btnAction = "criar"
                    }

                    let result = await crudFormacao(btnAction, txtNomeFormacao.value, idFormacao)
                    
                    if(result == 1){
                        msgAlert("alert-success", "Titulo de formação salvo com sucesso.")
                        let testeRow = document.createElement("tr")
                        testeRow.classList.add("rowList")
                        testeRow.innerHTML = `<td>${txtNomeFormacao.value}</td>
                                            <td>Criado</td>`
    
                        tbodyFormacao.appendChild(testeRow)
    
                        if(tbodyFormacao.querySelectorAll(".rowList").length >= 6){
                            tbodyFormacao.querySelectorAll(".rowList")[0].remove()
                        }
    
                        txtNomeFormacao.value = ""
                        txtNomeFormacao.parentNode.classList.remove("active")
    
                    } else if (result == "sessionExpira"){
                        window.location.href = "login"
                    } else if (result == 4) {
                        msgAlert("alert-warning", "Titulo de formação já existe.")
                    } else if (result == 5) {
                        msgAlert("alert-success", "Registro alterado com sucesso")

                        tbodyFormacao.querySelectorAll(".rowList").forEach(item=>{
                            if(item.cells[0].getAttribute("data-id-formacao-nome") == idFormacao){
                                item.cells[0].textContent = txtNomeFormacao.value
                            }
                        })

                    } else {
                        msgAlert("alert-danger", "Houve um erro ao salvar, tente novamente, ou atualize a página.")
                    }
                }
            })
        }
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao abrir modal atualize a página." + error)
    }
}

async function loadListFormacaoNome(paginaGet){
    try {
        let tbodyFormacao = document.getElementById("tbodyFormacao")
        tbodyFormacao.innerHTML = "Aguarde carregar a página..."
        let resultFormacaoNome = await listTableFormacaoNome(paginaGet)
        
        let JSONresultFormacaoNome = JSON.parse(resultFormacaoNome)

        
        tbodyFormacao.innerHTML = ""
    
        if(JSONresultFormacaoNome && Array.isArray(JSONresultFormacaoNome.obj) && JSONresultFormacaoNome.obj.length > 0){
            JSONresultFormacaoNome.obj.forEach(element => {
                let testeCriarRow = document.createElement("tr")
                testeCriarRow.classList.add("rowList")
                testeCriarRow.innerHTML = `<td data-id-formacao-nome='${element.idFormacaoNome}'>${element.nomeFormacaoNome}</td>
                                            <td><i class='bi bi-pencil btn btn-outline-warning btnEditarFormacaoNome'></i>
                                            <i class='bi bi-trash btn btn-outline-danger btnexcluirFormacaoNome'></i></td>`
    
                tbodyFormacao.appendChild(testeCriarRow)
            })
        }

        document.querySelectorAll(".btnexcluirFormacaoNome").forEach(item=>{
            item.addEventListener("click", async ()=>{
                await openConfirmar("Excluir", "Deseja realmente exluir o registro atual?", "divModal")

                let btnConfirmar = document.getElementById("btnConfirmar")

                if(btnConfirmar){
                    btnConfirmar.addEventListener("click", async()=>{
                        let id = item.parentNode.parentNode.cells[0].getAttribute("data-id-formacao-nome")
                        let resultExcluir = await crudFormacao("excluir", "", id)
                        if(resultExcluir == 2){
                            msgAlert("alert-success", "Item excluido com sucesso.")
                            item.parentNode.parentNode.remove()
                        } else if (resultExcluir = "sessionExpira") {
                            window.location.href = "login"
                        } else if(resultExcluir == 3){
                            msgAlert("alert-warning", "Não pode ser excluido porque já tem registro com esse código")
                        } else {
                            msgAlert("alert-danger", "Erro ao excluir item, atualize a página e volte a tentar novamente.")
                        }
                        document.getElementById("divModalConfirmar").remove()
                    })

                }
            })
        })

        document.querySelectorAll(".btnEditarFormacaoNome").forEach(item=>{
            item.addEventListener("click", async ()=>{
                let txtNomeFormacao = document.getElementById("txtNomeFormacao")
                let nomeFormacao = item.parentNode.parentNode.cells[0].textContent
                let idFormacao = item.parentNode.parentNode.cells[0].getAttribute("data-id-formacao-nome")
                
                txtNomeFormacao.value = nomeFormacao

                txtNomeFormacao.setAttribute("data-id-formacao", idFormacao)
                txtNomeFormacao.parentNode.classList.add("active")

                document.getElementById("btnSaveFormacao").classList.remove("btn-success")
                document.getElementById("btnSaveFormacao").classList.add("btn-warning")
            })
        })

        //pagination inicio
        let x = 0
        let btnActive = 0

        let qtdRegistro = (JSONresultFormacaoNome.obj.length == 0 ? "" : JSONresultFormacaoNome.obj[0].totalRegistro )
        let qtdPagina = Math.ceil(qtdRegistro / JSONresultFormacaoNome.limite)
        let limite = JSONresultFormacaoNome.limite

        await pagination("paginationHomeModal", qtdPagina, paginaGet, limite)
        document.querySelectorAll(".btnPgane").forEach(item => {
            if(item){
                item.addEventListener("click",async function(){

                    let pagina = item.getAttribute("data-pagina")

                    document.querySelectorAll(".btnPgane").forEach(active=>{
                        if(active.classList.contains("active")){
                            btnActive = parseInt(active.getAttribute("data-pagina"))
                        }
                    })

                    if(pagina == "-"){
                        x = parseInt(btnActive) - 1
                    } else if (pagina == "+"){
                        if(parseInt(btnActive) < parseInt(qtdPagina)){
                            x = parseInt(btnActive) + 1
                        } else {
                            return
                        }
                    } else {
                        x = pagina
                    }

                    await loadListFormacaoNome(x)
                })
            }
        })
        //pagination fim

    } catch (error) {
        msgAlert("alert-danger","erro aqui" + error)        
    }
}

async function listTableFormacaoNome(paginaGet) {
    try {
        let dados = {
            paginaSet : paginaGet,
        }

        let result = await $.post("././app/controller/function/funcListTableFormacaoNome.php", dados)
        return result
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao carregar lista de formação, tente atualizar a página.")
    }
}

async function listAllFormacaoNome(select) {
    try {
        let slc = document.getElementById(select)
        
        let result = await $.post("././app/controller/function/funcListAllFormacaoNome.php")
        
        let jsonResult = JSON.parse(result)
        let testeOptionVazio = document.createElement("option")
        testeOptionVazio.innerHTML = ""
        testeOptionVazio.value = ""

        slc.appendChild(testeOptionVazio)
        
        if(jsonResult && Array.isArray(jsonResult.obj) && jsonResult.obj.length){
            jsonResult.obj.forEach(element =>{
                let teste = document.createElement("option")
                teste.innerHTML = element.nomeFormacaoNome
                teste.value = element.idFormacaoNome
                teste.setAttribute("data-id-formacao-nome", element.idFormacaoNome)

                slc.appendChild(teste)
            })
        }

        slc.addEventListener("change", ()=>{
            if(slc.value != ""){
                slc.parentNode.classList.add("active")
            } else {
                slc.parentNode.classList.remove("active")
            }
        })

    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao carregar lista de formação, tente atualizar a página.")
    }
}

async function listAllFormacaoLocal(select) {
    try {
        let slc = document.getElementById(select)
        
        let result = await $.post("././app/controller/function/funcListAllFormacaoLocal.php")
        let jsonResult = JSON.parse(result)
        let testeOptionVazio = document.createElement("option")
        testeOptionVazio.innerHTML = ""
        testeOptionVazio.value = ""

        slc.appendChild(testeOptionVazio)
        
        if(jsonResult && Array.isArray(jsonResult.obj) && jsonResult.obj.length){
            jsonResult.obj.forEach(element =>{
                let teste = document.createElement("option")
                teste.innerHTML = element.nomeFormacaoLocal
                teste.value = element.idFormacaoLocal
                teste.setAttribute("data-id-formacao-local", element.idFormacaoLocal)

                slc.appendChild(teste)
            })
        }

        slc.addEventListener("change", ()=>{
            if(slc.value != ""){
                slc.parentNode.classList.add("active")
            } else {
                slc.parentNode.classList.remove("active")
            }
        })

    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao carregar lista de formação, tente atualizar a página.")
    }
}

async function crudFormacao(action, formacao, idFormacao) {
    try {
        let dados = {
            actionSet : action,
            formacaoSet : formacao,
            idFormacaoSet : idFormacao || "",
        }

        let result = await $.post("././app/controller/function/funcCRUDFormacao.php", dados)
        return result
    } catch (error) {
        msgAlert("alert-danger", "houve um erro ao salvar a formação atualize a página.")
    }
}

//local de formação
async function openModalAddLocal() {
    try {
        let result = await $.post("././app/views/pages/modal/modeloAddLocalNome.php")

        let teste = document.createElement("div")
        teste.innerHTML = result
        teste.id = "divModal"

        document.body.appendChild(teste)

        closeModal()
        campoInputLabelSuspenso()

        let btnSaveLocal = document.getElementById("btnSaveLocal")
        let txtNomeLocal = document.getElementById("txtNomeLocal")
        let tbodyLocal = document.getElementById("tbodyLocal")

        await loadListLocalNome(0)

        if(btnSaveLocal){
            btnSaveLocal.addEventListener("click",async ()=>{
                if(txtNomeLocal.value == ""){
                    msgAlert("alert-danger", "Primeiro escreva alguma coisa para salvar")
                } else {
                    let btnAction = ""
                    let idLocalAqui = ""

                    if(btnSaveLocal.classList.contains("btn-warning")){
                        btnAction = "editar"
                        idLocalAqui = txtNomeLocal.getAttribute("data-id-local")
                    } else {
                        btnAction = "criar"
                    }

                    let result = await crudLocal(btnAction, txtNomeLocal.value, idLocalAqui)
                    
                    if(result == 1){
                        msgAlert("alert-success", "Titulo de formação salvo com sucesso.")
                        let testeRow = document.createElement("tr")
                        testeRow.classList.add("rowList")
                        testeRow.innerHTML = `<td>${txtNomeLocal.value}</td>
                                            <td>Criado</td>`
    
                        tbodyLocal.appendChild(testeRow)
    
                        if(tbodyLocal.querySelectorAll(".rowList").length >= 7){
                            tbodyLocal.querySelectorAll(".rowList")[0].remove()
                        }
    
                        txtNomeLocal.value = ""
                        txtNomeLocal.parentNode.classList.remove("active")
    
                    } else if (result == "sessionExpira"){
                        window.location.href = "login"
                    } else if (result == 4) {
                        msgAlert("alert-warning", "Titulo de formação já existe.")
                    
                    } else if (result == 5) {
                        msgAlert("alert-success", "Registro alterado com sucesso")

                        tbodyLocal.querySelectorAll(".rowList").forEach(item=>{
                            if(item.cells[0].getAttribute("data-id-local-nome") == txtNomeLocal.getAttribute("data-id-local")){
                                item.cells[0].textContent = txtNomeLocal.value
                            }
                        })
                    } else {
                        msgAlert("alert-danger", "Houve um erro ao salvar, tente novamente, ou atualize a página.")
                    }
                }
            })
        }

    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao abrir modal atualize a página.")
    }
}

async function loadListLocalNome(paginaGet){
    try {
        let tbodyLocal = document.getElementById("tbodyLocal")
        tbodyLocal.innerHTML = "Aguarde carregar a página..."

        let resultLocalNome = await listLocalNome(paginaGet)
    
        let JSONresultLocalNome = JSON.parse(resultLocalNome)
        tbodyLocal.innerHTML = ""
    
        if(resultLocalNome && Array.isArray(JSONresultLocalNome.obj) && JSONresultLocalNome.obj.length > 0){
            JSONresultLocalNome.obj.forEach(element => {
                let testeCriarRow = document.createElement("tr")
                testeCriarRow.classList.add("rowList")
                testeCriarRow.innerHTML = `<td data-id-Local-nome='${element.idLoja}'>${element.nomeLoja}</td>
                                            <td><i class='bi bi-pencil btn btn-outline-warning btnEditarLocalNome'></i>
                                            <i class='bi bi-trash btn btn-outline-danger btnexcluirLocalNome'></i></td>`
    
                tbodyLocal.appendChild(testeCriarRow)
            })
        }

        document.querySelectorAll(".btnexcluirLocalNome").forEach(item=>{
            item.addEventListener("click", async ()=>{
                await openConfirmar("Excluir", "Deseja realmente exluir o registro atual?", "divModal")

                let btnConfirmar = document.getElementById("btnConfirmar")

                if(btnConfirmar){
                    btnConfirmar.addEventListener("click", async()=>{
                        let id = item.parentNode.parentNode.cells[0].getAttribute("data-id-Local-nome")
                        let resultExcluir = await crudLocal("excluir", "", id)
                        if(resultExcluir == 2){
                            msgAlert("alert-success", "Item excluido com sucesso.")
                            item.parentNode.parentNode.remove()
                        } else if(resultExcluir == 3){
                            msgAlert("alert-warning", "Não pode ser excluido porque já tem registro com esse código")
                        } else if (resultExcluir = "sessionExpira") {
                            window.location.href = "login"
                        } else {
                            msgAlert("alert-danger", "Erro ao excluir item, atualize a página e volte a tentar novamente.")
                        }
                        document.getElementById("divModalConfirmar").remove()
                    })

                }
            })
        })

        document.querySelectorAll(".btnEditarLocalNome").forEach(item=>{
            item.addEventListener("click", async ()=>{
                let txtNomeLocal = document.getElementById("txtNomeLocal")
                let nomeLocalValue = item.parentNode.parentNode.cells[0].textContent
                let idLocalValue = item.parentNode.parentNode.cells[0].getAttribute("data-id-local-nome")
                
                txtNomeLocal.value = nomeLocalValue

                txtNomeLocal.setAttribute("data-id-local", idLocalValue)
                txtNomeLocal.parentNode.classList.add("active")

                document.getElementById("btnSaveLocal").classList.remove("btn-success")
                document.getElementById("btnSaveLocal").classList.add("btn-warning")
            })
        })

        //pagination inicio
        let x = 0
        let btnActive = 0
        let qtdRegistro = (JSONresultLocalNome.obj.length == 0 ? "" : JSONresultLocalNome.obj[0].totalRegistro)
        let qtdPagina = Math.ceil(qtdRegistro / JSONresultLocalNome.limite)
        let limite = JSONresultLocalNome.limite

        await pagination("paginationHomeModal", qtdPagina, paginaGet, limite)
        document.querySelectorAll(".btnPgane").forEach(item => {
            if(item){
                item.addEventListener("click",async function(){

                    let pagina = item.getAttribute("data-pagina")

                    document.querySelectorAll(".btnPgane").forEach(active=>{
                        if(active.classList.contains("active")){
                            btnActive = parseInt(active.getAttribute("data-pagina"))
                        }
                    })

                    if(pagina == "-"){
                        x = parseInt(btnActive) - 1
                    } else if (pagina == "+"){
                        if(parseInt(btnActive) < parseInt(qtdPagina)){
                            x = parseInt(btnActive) + 1
                        } else {
                            return
                        }
                    } else {
                        x = pagina
                    }

                    await loadListLocalNome(x)
                })
            }
        })
        //pagination fim

    } catch (error) {
        msgAlert("alert-danger","erro aqui" + error)        
    }
}

async function listLocalNome(paginaGet) {
    try {
        let dados = {
            paginaSet : paginaGet,
        }

        let result = await $.post("././app/controller/function/funcListLocalNome.php", dados)
        return result
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao carregar lista de formação, tente atualizar a página.")
    }
}

async function crudLocal(action, formacao, idFormacao) {
    try {
        let dados = {
            actionSet : action,
            formacaoSet : formacao,
            idFormacaoSet : idFormacao || "",
        }

        let result = await $.post("././app/controller/function/funcCRUDLocal.php", dados)
        return result
    } catch (error) {
        msgAlert("alert-danger", "houve um erro ao salvar a formação atualize a página.")
    }
}

//listar funcionario
async function openModalAddFuncionario() {
    try {
        let result = await $.post("././app/views/pages/modal/modeloAddFuncionario.php")

        let teste = document.createElement("div")
        teste.innerHTML = result
        teste.id = "divModal"

        document.body.appendChild(teste)

        closeModal()
        campoInputLabelSuspenso()

        await loadListLoja("slcLocalTrabalho",1)

        //tbodyListFuncionario

        let btnActionSalvar = document.getElementById("btnActionSalvar")

        // let btnSaveLocal = document.getElementById("btnSaveLocal")
        // let txtNomeLocal = document.getElementById("txtNomeLocal")
        // let tbodyLocal = document.getElementById("tbodyLocal")

        await loadListFuncionario(0)

        let txtCodFuncionario = document.getElementById("txtCodFuncionario")
        let txtNomeFuncionario = document.getElementById("txtNomeFuncionario")
        let slcLocalTrabalho = document.getElementById("slcLocalTrabalho")

        let btnSearchFuncionario = document.getElementById("btnSearchFuncionario")
        if(btnSearchFuncionario){
            btnSearchFuncionario.addEventListener("click",async ()=>{
                //fazer o botao de busca
                let resultFuncionario = await searchFuncionario(txtCodFuncionario.value)

                let jsonResultFuncionario = JSON.parse(resultFuncionario)

                if(jsonResultFuncionario && Array.isArray(jsonResultFuncionario.obj) && jsonResultFuncionario.obj.length){
                      
                    jsonResultFuncionario.obj.forEach(element=>{
                        txtNomeFuncionario.value = element.nomeFuncionario
                        txtNomeFuncionario.parentNode.classList.add("active")

                        if(element.lojaFuncionario != null){
                            slcLocalTrabalho.value = element.lojaFuncionario 
                            (element.lojaFuncionario == null ? slcLocalTrabalho.parentNode.classList.remove("active") : slcLocalTrabalho.parentNode.classList.add("active"))
                        }
                        
                        document.getElementById("btnActionSalvar").value = "Editar"
                        document.getElementById("btnActionSalvar").classList.remove("btn-success")
                        document.getElementById("btnActionSalvar").classList.add("btn-warning")

                    })
                } else {
                    msgAlert("alert-warning", "Nenhum funcionário encontrado com esse código.")
                    txtNomeFuncionario.value = ""
                    txtNomeFuncionario.parentNode.classList.remove("active")

                    slcLocalTrabalho.parentNode.classList.remove("active")

                    document.getElementById("btnActionSalvar").value = "Salvar"
                    document.getElementById("btnActionSalvar").classList.remove("btn-warning")
                    document.getElementById("btnActionSalvar").classList.add("btn-success")
                }
            })
        }

        if(btnActionSalvar){
            btnActionSalvar.addEventListener("click", async ()=>{
                if(txtCodFuncionario.value == ""){
                    msgAlert("alert-danger", "Primeiro informe os dados do funcinário.")
                } else {
                    let btnNomeAction = btnActionSalvar.value

                    txtCodFuncionario.removeAttribute("disabled")
    
                    let resultCRUD = await crudFuncionario(btnNomeAction, txtCodFuncionario.value, txtNomeFuncionario.value, slcLocalTrabalho.value)
    
                    if(resultCRUD == 1){
                        msgAlert("alert-success", "Registro salvo com sucesso")
                    } else if (resultCRUD == "sessionExpira"){
                        window.location.href = "login"
                    } else if (resultCRUD == 3){
                        msgAlert("alert-success", "Registro alterado com sucesso")
                    } else {
                        msgAlert("alert-danger", "Erro ao salvar registro, consulte a lista para saber se ação foi finalizada")
                    }
                
                    document.getElementById("tbodyListFuncionario").querySelectorAll(".rowList").forEach(item=>{
                        if(txtCodFuncionario.value == item.cells[0].textContent){
                            let x = slcLocalTrabalho.options[slcLocalTrabalho.selectedIndex]

                            item.cells[1].textContent = txtNomeFuncionario.value
                            item.cells[2].textContent = x.textContent
                            item.cells[2].setAttribute("data-local-trabalho", x.value)
                        }
                    })

                    txtCodFuncionario.value = ""
                    txtNomeFuncionario.value = ""
                    slcLocalTrabalho.value = ""
    
                    txtCodFuncionario.parentNode.classList.remove("active")
                    txtNomeFuncionario.parentNode.classList.remove("active")
                    slcLocalTrabalho.parentNode.classList.remove("active")
    
                    document.getElementById("btnActionSalvar").value = "Salvar"
                    document.getElementById("btnActionSalvar").classList.remove("btn-warning")
                    document.getElementById("btnActionSalvar").classList.add("btn-success")

                    
                }
            })
        }

        // if(btnSaveLocal){
        //     btnSaveLocal.addEventListener("click",async ()=>{
        //         if(txtNomeLocal.value == ""){
        //             msgAlert("alert-danger", "Primeiro escreva alguma coisa para salvar")
        //         } else {
        //             let result = await crudLocal("criar", txtNomeLocal.value)
                    
        //             if(result == 1){
        //                 msgAlert("alert-success", "Titulo de formação salvo com sucesso.")
        //                 let testeRow = document.createElement("tr")
        //                 testeRow.classList.add("rowList")
        //                 testeRow.innerHTML = `<td>${txtNomeLocal.value}</td>
        //                                     <td>Criado</td>`
    
        //                 tbodyLocal.appendChild(testeRow)
    
        //                 if(tbodyLocal.querySelectorAll(".rowList").length >= 6){
        //                     tbodyLocal.querySelectorAll(".rowList")[0].remove()
        //                 }
    
        //                 txtNomeLocal.value = ""
        //                 txtNomeLocal.parentNode.classList.remove("active")
    
        //             } else if (result == 10){
        //                 window.location.href = "login"
        //             } else if (result == 4) {
        //                 msgAlert("alert-warning", "Titulo de formação já existe.")
        //             } else {
        //                 msgAlert("alert-danger", "Houve um erro ao salvar, tente novamente, ou atualize a página.")
        //             }
        //         }
        //     })
        // }

    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao abrir modal atualize a página.")
    }
}

function actionModalFuncionario(event){
    try {
        let btn = event

        let txtCodFuncionario = document.getElementById("txtCodFuncionario")
        let txtNomeFuncionario = document.getElementById("txtNomeFuncionario")
        let slcLocalTrabalho = document.getElementById("slcLocalTrabalho")

        txtCodFuncionario.setAttribute("disabled", true)
        txtCodFuncionario.value = btn.parentNode.parentNode.cells[0].textContent
        txtCodFuncionario.setAttribute("data-cod-funcionario", btn.parentNode.parentNode.cells[0].getAttribute("data-cod-funcionario"))
        txtNomeFuncionario.value = btn.parentNode.parentNode.cells[1].textContent
        
        slcLocalTrabalho.value = btn.parentNode.parentNode.cells[2].getAttribute("data-local-trabalho")

        txtCodFuncionario.parentNode.classList.add("active") || ""
        txtNomeFuncionario.parentNode.classList.add("active") || ""

        btn.parentNode.parentNode.cells[2].getAttribute("data-local-trabalho") != "" ? slcLocalTrabalho.parentNode.classList.add("active") : slcLocalTrabalho.parentNode.classList.remove("active")

        document.getElementById("btnActionSalvar").value = "Editar"
        document.getElementById("btnActionSalvar").classList.remove("btn-success")
        document.getElementById("btnActionSalvar").classList.add("btn-warning")

    } catch (error) {
        msgAlert("alert-danger", "Erro ao carregar botão, atualize a página")
    }
}

async function excluirRegistro(event, idRegistro) {
    try {
        await openConfirmar("Excluir", "Deseja realmente exluir o registro atual?")

        let btnConfirmar = document.getElementById("btnConfirmar")

        if(btnConfirmar){
            btnConfirmar.addEventListener("click", async()=>{

                let result = await crudFuncionario("excluir", idRegistro, "", "")
                if(result == 2){
                    msgAlert("alert-success", "Registro excluida com sucesso.")

                    event.parentNode.parentNode.remove()
                } else if (result == "sessionExpira"){
                    window.location.href = "login"
                } else if(result == 3){
                    msgAlert("alert-warning", "Registro não pode ser excluido porque já tem historico.")
                } else {
                    msgAlert("alert-danger", "Houve um erro ao excluir registro, atualize a página e tente novamente.")
                }
                document.getElementById("divModalConfirmar").remove()
            })
        }

    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao excluir registro, atualize a página e tente novamente.")
    }
}

async function loadListFuncionario(paginaGet){
    try {
        let tbodyListFuncionario = document.getElementById("tbodyListFuncionario")
        tbodyListFuncionario.innerHTML = "Aguarde carregar a página..."
        let resultFuncionario = await listFuncionario(paginaGet)
    
        let JSONresultFuncionario = JSON.parse(resultFuncionario)
        
        tbodyListFuncionario.innerHTML = ""
    
        if(resultFuncionario && Array.isArray(JSONresultFuncionario.obj) && JSONresultFuncionario.obj.length > 0){
            JSONresultFuncionario.obj.forEach(element => {
                let testeCriarRow = document.createElement("tr")
                testeCriarRow.classList.add("rowList")
                testeCriarRow.innerHTML = `<td data-cod-funcionario='${element.idFuncionario}'>${element.codFuncionarioFuncionario}</td>
                                            <td>${element.nomeFuncionario}</td>
                                            <td data-local-trabalho='${element.idLoja || ''}'>${capitalizar(element.nomeLoja || "")}</td>
                                            <td>
                                              <i class='bi bi-pencil btn btn-outline-warning btn-sm' onclick='actionModalFuncionario(this)'></i> 
                                              <i class='bi bi-trash btn btn-outline-danger btn-sm' onclick='excluirRegistro(this, ${element.idFuncionario})' ></i>
                                            </td>`
    
                tbodyListFuncionario.appendChild(testeCriarRow)
            })
        }

        document.querySelectorAll(".btnexcluirLocalNome").forEach(item=>{
            item.addEventListener("click", async ()=>{
                await openConfirmar("Excluir", "Deseja realmente exluir o registro atual?", "divModal")

                let btnConfirmar = document.getElementById("btnConfirmar")

                if(btnConfirmar){
                    btnConfirmar.addEventListener("click", async()=>{
                        let id = item.parentNode.parentNode.cells[0].getAttribute("data-id-Local-nome")
                        let resultExcluir = await crudLocal("excluir", "", id)
                        if(resultExcluir == 2){
                            msgAlert("alert-success", "Item excluido com sucesso.")
                            item.parentNode.parentNode.remove()
                        } else if(resultExcluir == 3){
                            msgAlert("alert-warning", "Não pode ser excluido porque já tem registro com esse código")
                        } else {
                            msgAlert("alert-danger", "Erro ao excluir item, atualize a página e volte a tentar novamente.")
                        }
                        document.getElementById("divModalConfirmar").remove()
                    })

                }
            })
        })

        //pagination inicio
        let x = 0
        let btnActive = 0
        let qtdRegistro = (JSONresultFuncionario.obj.length == 0 ? "" : JSONresultFuncionario.obj[0].totalRegistro)
        let qtdPagina = Math.ceil(qtdRegistro / JSONresultFuncionario.limite)
        let limite = JSONresultFuncionario.limite

        await pagination("paginationHomeModal", qtdPagina, paginaGet, limite)
        document.querySelectorAll(".btnPgane").forEach(item => {
            if(item){
                item.addEventListener("click",async function(){

                    let pagina = item.getAttribute("data-pagina")

                    document.querySelectorAll(".btnPgane").forEach(active=>{
                        if(active.classList.contains("active")){
                            btnActive = parseInt(active.getAttribute("data-pagina"))
                        }
                    })

                    if(pagina == "-"){
                        x = parseInt(btnActive) - 1
                    } else if (pagina == "+"){
                        if(parseInt(btnActive) < parseInt(qtdPagina)){
                            x = parseInt(btnActive) + 1
                        } else {
                            return
                        }
                    } else {
                        x = pagina
                    }

                    await loadListFuncionario(x)
                })
            }
        })
        //pagination fim

    } catch (error) {
        msgAlert("alert-danger","erro aqui" + error)        
    }
}

async function listFuncionario(paginaGet) {
    try {
        let dados = {
            paginaSet : paginaGet,
        }

        let result = await $.post("././app/controller/function/funcListFuncionario.php", dados)
        return result
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao carregar lista de formação, tente atualizar a página.")
    }
}

async function crudFuncionario(action, cod, nome, localTrabalho) {
    try {
        let dados = {
            actionSet : action,
            codSet : cod || "",
            nomeSet : nome || "",
            localTrabalhoSet : localTrabalho || "",
        }

        let result = await $.post("././app/controller/function/funcCRUDFuncionario.php", dados)
        return result
    } catch (error) {
        msgAlert("alert-danger", "houve um erro ao salvar a formação atualize a página.")
    }
}

let btnProcurarOrderCompra = document.getElementById("btnProcurarOrderCompra")
if(btnProcurarOrderCompra){
    btnProcurarOrderCompra.addEventListener("click", async ()=>{
        let txtBuscaFormando = document.getElementById("txtBuscaFormando")
        let slcTipoSearch = document.getElementById("slcTipoSearch")
        let txtDeFormando = document.getElementById("txtDeFormando")
        let txtAteFormando = document.getElementById("txtAteFormando")

        if(txtBuscaFormando.value != "" && slcTipoSearch.value == ""){
            return msgAlert("alert-danger", "Primeiro selecione um tipo de busca")
        }

        if(txtDeFormando.value != "" && txtAteFormando.value == ""){
            return msgAlert("alert-danger", "Primeiro informe uma data valida")
        }

        await loadPageFormando(0)
    })
}

let btnAddFormando = document.getElementById("btnAddFormando")
if(btnAddFormando){
    btnAddFormando.addEventListener("click",async ()=>{
        openModalAddFormando()
        
    })
}

let btnAddFormacao = document.getElementById("btnAddFormacao")
if(btnAddFormacao){
    btnAddFormacao.addEventListener("click", async ()=>{
        openModalAddFormacao()
    })
}

let btnAddLocal = document.getElementById("btnAddLocal")
if(btnAddLocal){
    btnAddLocal.addEventListener("click", async ()=>{
        openModalAddLocal()
    })
}

let btnAddFuncionario = document.getElementById("btnAddFuncionario")
if(btnAddFuncionario){
    btnAddFuncionario.addEventListener("click", async ()=>{
        openModalAddFuncionario()
    })
}

let slcTipoSearch= document.getElementById("slcTipoSearch")
if(slcTipoSearch){
    slcTipoSearch.addEventListener("click", ()=>{
        if(slcTipoSearch.value != ""){
            slcTipoSearch.parentNode.classList.add("active")
        } else {
            slcTipoSearch.parentNode.classList.remove("active")
        }
    })
}