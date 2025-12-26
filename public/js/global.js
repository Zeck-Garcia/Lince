window.onload = async function(){
    try {
        if (window.innerWidth < 750) {
            await controlBarra()
        }
        await afterLoad()
        await campoInputLabelSuspenso()
    } catch (error) {
        
    }
}

// window.addEventListener('load', function() {
//     var preloader = document.getElementById('preloader')
//     preloader.style.display = 'none'

//     var conteudo = document.getElementById('containerContent')
//     conteudo.style.display = 'block'
// })

//pega a url atual
function atualizarURLComParametros(parametros) {
    const urlAtual = window.location.pathname
    
    const novaURL = `${urlAtual}?${new URLSearchParams(parametros).toString()}`
    
    history.pushState(null, "", novaURL)

    window.location.href = novaURL
}

//click no meu lateral
async function afterLoad(){
    document.querySelectorAll(".menuItem").forEach((menuItem) => {
        menuItem.addEventListener("click", function(event){
            if(menuItem.getAttribute("data-colapsse") != undefined && menuItem.getAttribute("data-colapsse") != ""){
                if(menuItem){

                    document.querySelectorAll(".subMenu").forEach(item => {
                        item.classList.remove("show")
                    })

                    document.getElementById(this.getAttribute("data-colapsse")).classList.toggle("show")

                    if(document.querySelector("#groupInfoUser").classList.contains("showMenuSimples")){
                        controlBarra()
                    }
                }
            }

        }) 
    })
}

//exibe os aviso
function msgAlert(title, msg, time){
    const teste = document.createElement("div")
    teste.classList.add("textMsgBox")
    teste.classList.add("alert")
    teste.classList.add(title)
    teste.setAttribute("role", "alert")
    
    teste.innerHTML = msg + `<div class='btnCloseMsgBox'>x</div>`
    
    document.querySelector("#divBoxMsgBox").style.display = "block"
    document.querySelector("#divBoxMsgBox").classList.add("show")
    document.querySelector("#divBoxMsgBox").append(teste)

    const btnClose = teste.querySelector(".btnCloseMsgBox")
    btnClose.addEventListener("click", function(){
        
        teste.remove()

        if(document.querySelector("#divBoxMsgBox").children.length === 0){
            document.querySelector("#divBoxMsgBox").classList.remove("show")
            document.querySelector("#divBoxMsgBox").style.display = "none"
        }
    })

    let timee = (time === undefined ? 10000 : time)
    
    setTimeout(function(){
        if(teste.parentElement){
            teste.remove()
    
            if(document.querySelector("#divBoxMsgBox").children.length === 0){
                document.querySelector("#divBoxMsgBox").classList.remove("show")
                document.querySelector("#divBoxMsgBox").style.display = "none"
            }
        }
    }, timee)
}

//modal de confirmacao
async function openConfirmar(titleGet, msgGet, local){
    try {
        let dados = {
            titleSet : titleGet,
            msgSet : msgGet,
        }

        let resultModalConfirme = await $.post("././app/views/pages/modal/modalConfirme.php", dados)

        let teste = document.createElement("div")
        teste.id = "divModalConfirmar"
        teste.innerHTML = resultModalConfirme
        
        if(local == "" || local == undefined){
            document.body.append(teste)
        } else {
            document.getElementById(local).append(teste)
        }
        

        let btnCloseModal = document.querySelector("#btnCloseModalConfirmar")
        if(btnCloseModal){
            btnCloseModal.addEventListener("click", function(){
                $("#divModalConfirmar").remove()
            })
        }


    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao abrir janela, volte a tentar novamente." + error)
    }
}

//list empresa / fornecedor
function listEmpresa(codEmpresaGet){
    return new Promise(async (resolve, reject) => {
        try {

            let dados = {
                EmpresaSet : codEmpresaGet,
            }

            let resultListEmpresa = await $.post("././app/controller/function/funcListEmpresa.php", dados)

            let jsonResultListEmpresa = JSON.parse(resultListEmpresa)

            let tbodyListEmpresa = document.querySelector("#tbodyListEmpresa")
            tbodyListEmpresa.innerHTML = ""

            if(jsonResultListEmpresa && Array.isArray(jsonResultListEmpresa.obj) && jsonResultListEmpresa.obj.length > 0){
                jsonResultListEmpresa.obj[0].forEach(Element => {
                    let row = document.createElement("tr")
                    row.classList.add("rowListEmpresa")

                    row.innerHTML = `<td><input type='radio' id='' name='empresa' class='inputRadio' data-id='${Element.idFornecedor}' data-email='${Element.emailFornecedor}' data-site='${Element.siteFornecedor}'></td>
                                        <td>${Element.idFornecedor}</td>
                                        <td>${Element.nomeFornecedor}</td>
                                        <td>
                                        <i class='bi bi-pencil-square btn btn-outline-warning btn-sm' onclick='editarFonecedor(event)'></i>
                                        <i class='bi bi-trash btn btn-outline-danger btn-sm' onclick='excluirFornecedor(event)'></i>
                                        </td>
                                    `
                    tbodyListEmpresa.append(row)
                })
            }

            resolve()
        } catch (error) {
            msgAlert("alert-danger","Houve um erro ao consultar lista de empresas, atualize a página." + error)
        }
    })
}

async function editarFonecedor(event) {
    try {
        let id = event.target.parentNode.parentNode.cells[1].textContent
        $("#divModal").remove()

        let resultModal = await openModalAddEmpresa()

        let teste = document.createElement("div")
        teste.innerHTML = resultModal
        teste.id = "divModalEdit"

        document.body.append(teste)

        let dados = {
            EmpresaSet : id,
        }

        let resultListEmpresa = await $.post("././app/controller/function/funcListEmpresa.php", dados)

        let jsonResultListEmpresa = JSON.parse(resultListEmpresa)
        
        if(jsonResultListEmpresa && Array.isArray(jsonResultListEmpresa.obj) && jsonResultListEmpresa.obj.length > 0){

            document.getElementById("txtAddNomeEmpresa").setAttribute("data-id-fornecedor", jsonResultListEmpresa.obj[0][0].idFornecedor)
    
            document.getElementById("txtAddNomeEmpresa").parentNode.classList.add("active")
            document.getElementById("txtAddSiteEmpresa").parentNode.classList.add("active")
            document.getElementById("txtAddEmailEmpresa").parentNode.classList.add("active")

            document.getElementById("txtAddNomeEmpresa").value = jsonResultListEmpresa.obj[0][0].nomeFornecedor
            document.getElementById("txtAddSiteEmpresa").value = jsonResultListEmpresa.obj[0][0].siteFornecedor
            document.getElementById("txtAddEmailEmpresa").value = jsonResultListEmpresa.obj[0][0].emailFornecedor

            document.getElementById("btnSalvarUsar").style.display = "none"
            document.getElementById("btnSalvar").value = "Editar"
            document.getElementById("btnSalvar").classList.remove("btn-success")
            document.getElementById("btnSalvar").classList.add("btn-warning")
        }

    } catch (error) {
        msgAlert("alert-danger","Erro de alguma coisa" + error)
    }
}

async function CrudEmpresa(idFornecedorGet, nomeEmpresaGet, siteEmpresaGet, emailEmpresaGet,actionGet){
    try {
        let dados = {
            codEmpresaSet : idFornecedorGet,
            nomeEmpresaSet : nomeEmpresaGet,
            siteEmpresaSet : siteEmpresaGet,
            emailEmpresa : emailEmpresaGet,
            actionSet : actionGet,
        }

        let resultCrud = await $.post("././app/controller/function/funcCrudEmpresa.php", dados)

        if(resultCrud == "criar"){
            msgAlert("alert-success", "Fornecedor adicionada com sucesso.")
        } else if (resultCrud == "criarUsar"){ 
            msgAlert("alert-success", "Fornecedor adicionada com sucesso.")
            
            await searchEmpresa("", nomeEmpresaGet)
        }else if(resultCrud == "alterado" || resultCrud == "excluido"){
            msgAlert("alert-success", `Fornecedor ${resultCrud} com sucesso.`)
        }else if(resultCrud == "naoExclui") {
            msgAlert("alert-danger", "O fornecedor não pode ser excluido porque já existe ordem de compra emitida.")
        } else {
            msgAlert("alert-danger",`Houve um erro ao ${resultCrud} a empresa, consulte a lista de empresa para ver se a ação foi finalizada.`)
        }

        if(document.getElementById("preload")){
            loadStepAction("none", "", "")
        }
        
        $("#divModal").remove()

    } catch (error) {
        //fazer mensagem de erro
        if(document.getElementById("preload")){
            loadStepAction("none", "", "")
        }
        msgAlert("alert-danger", "Houve um erro ao criar a empresa, verifique se a mesma coisa criada em <strong>'Listar'</strong>." + error)
    }
}

async function excluirFornecedor(event) {
    try {
        let id = event.target.parentNode.parentNode.cells[1].textContent

        await openConfirmar("Excluir", "Deseja mesmo excluir esse fornecedor? <br><br> Caso exista ordem de compra emitida para esse fornecedor não poderá ser excluido. <br><br> Deseja continuar?")

        let btnConfirmar = document.getElementById("btnConfirmar")
        if(btnConfirmar){
            btnConfirmar.addEventListener("click",async ()=>{
                document.getElementById("divModalConfirmar").remove()

                loadStepAction("block", "Aguarde", "Aguarde enquanto verificamos a exclusão do fornecedor")
                await CrudEmpresa(id, "", "", "","excluir")
                
                $("#divModalConfirmar").remove()

            })
        }
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao finalizar exclusão da empresa." + error)
    }
}

//compara data retorno de numero de dias entre datas
async function compareDate(dataPrimaria, dataSecundaria){

    let [dia,mes,ano] = dataPrimaria.split("/")
    let valorDataPrimaria = new Date(ano,mes - 1, dia).getTime()

    let [diaSec,mesSec,anoSec] = dataSecundaria.split("/")
    let valorDataSecundario = new Date(anoSec,mesSec - 1, diaSec).getTime()

    result = valorDataPrimaria - valorDataSecundario
    
    return result
}

//menu lateral
//fora de uso
function menuItem(){
    document.querySelectorAll(".nomePagina").forEach((nomePagina)=> {
        nomePagina.addEventListener("click", function(event){

            event.preventDefault()
            let pagina = ""

            switch(this.getAttribute("data-pagina")){
                case "fazerPedidoLoja":
                    //pagina = "pgCriarPedidoLoja.php"
                    atualizarURLComParametros({ param: "fazerPedidoLoja" })
                break

                case "alterPedidoLoja":
                    pagina = "funcAlterPedidoLoja.php"
                break

                case "verPedidosLoja":
                    pagina = "funcVerPedidoLoja.php"
                break

                case "pedidosAdm":
                    pagina = "funcPedidoAdm.php"
                break

                case "VerPedidosAdm":
                    pagina = "funcVerPedidoAdm.php"
                break

                case "criarUltilizador":
                    pagina = "funcCriarUltilizador.php"
                break

                case "listarUltilizador":
                    pagina = "funcListarUltilizador.php"
                break

                default:
                    pagina = "bemVindo.php"
                break

            }
            
            document.querySelectorAll(".menuActive").forEach(removeMenuActive => {
                removeMenuActive.classList.remove("menuActive")
            })
            
            event.target.parentNode.classList.add("menuActive")

            document.querySelector("#containerContent").innerHTML = ""
            //nomeJanela(pagina)
        })
    })
}

//fecha modal
function closeModal(){
    let closeModal = document.querySelector("#btnCloseModal")
    if(closeModal){
        closeModal.addEventListener("click", function(){
            $("#divModal").remove()
        })
    }
}

//comprimir img
async function compressImages(files, maxWidth, maxHeight, quality) {
    const promises = Array.from(files).map(file => {
        return compressImage(file, maxWidth, maxHeight, quality)
    })

    return Promise.all(promises)
        .then(compressedImages => {
            return compressedImages
        })
        .catch(error => {
            console.error("Erro ao compactar as imagens:", error)
            throw error
        })
}

//comprimir img
async function compressImage(file, maxWidth, maxHeight, quality) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onload = event => {
            const img = new Image()
            img.src = event.target.result

            img.onload = () => {
                const canvas = document.createElement('canvas')
                let width = img.width
                let height = img.height

                if (width > maxWidth || height > maxHeight) {
                    if (width > height) {
                        height = Math.round((height * maxWidth) / width)
                        width = maxWidth;
                    } else {
                        width = Math.round((width * maxHeight) / height)
                        height = maxHeight
                    }
                }

                canvas.width = width
                canvas.height = height
                const ctx = canvas.getContext('2d')
                ctx.drawImage(img, 0, 0, width, height)

                canvas.toBlob(
                    blob => {
                        if (blob) {
                            resolve(blob)
                        } else {
                            reject(new Error("Erro ao gerar o Blob da imagem."))
                        }
                    },
                    'image/jpeg',
                    quality
                )
            }

            img.onerror = err => reject(err)
        }

        reader.onerror = err => reject(err)
    })
}

//filtra a url
function pegarParteURL() {
    url = window.location.pathname
    partsFilterLoadEncomendaEntrega = window.location.href.split('/')
    lastPartFilterLoadEncomendaEntrega = partsFilterLoadEncomendaEntrega.pop()

    return lastPartFilterLoadEncomendaEntrega.split("?", 1)[0]
}

//controla a barra lateral
async function controlBarra(){
    document.querySelector("#containerMenu").classList.toggle("showContainerMenu")
    document.querySelectorAll(".menuText").forEach(item => {
        item.classList.toggle("showMenuSimples")
    })

    document.querySelectorAll(".subMenuText").forEach(item => {
        item.classList.toggle("showMenuSimples")
    })

    document.querySelector("#groupInfoUser").classList.toggle("showMenuSimples")
}

async function preLoad(display,title,mensagem,){
    try {
        let teste = document.getElementById("preload")

        if(!teste){

            teste = document.createElement("div")
            teste.id = "preload"

            teste.innerHTML = `<div class='modal show' tabindex='-1' style='display: block;' aria-modal='true' role='dialog'> 
                                <div class='modal-dialog modal-dialog-centered modal-lg' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-fluid'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title'>${title}</h5>
                                            </div>

                                            <div class='modal-body'>
                                                <div class='container-fluid'>
                                                    <div class='' style='padding: 50px 60px; font-size: 3rem; boxShadow: "2px 2px 10px rgba(0,0,0,0.1);'>
                                                        <p>${mensagem}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='modal-backdrop show'></div>`

            document.querySelector("#divModal").append(teste)
        }
        
        teste.style.display = display

    } catch (error) {
        console.error("Não foi possivel abrir o preload", error)
    }
}

//load espere pela acao
async function loadStepAction(display,title,msg,body){
    try {
        let teste = document.getElementById("preload")


        if(!teste){

            teste = document.createElement("div")
            teste.id = "preload"

            teste.innerHTML = `<div class='modal show' tabindex='-1' style='display: block;' aria-modal='true' role='dialog'> 
                                <div class='modal-dialog modal-dialog-centered' role='document'>
                                    <div class='modal-content'>
                                        <div class='modal-fluid'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title'>${title}</h5>
                                            </div>

                                            <div class='modal-body'>
                                                <div class='container-fluid'>
                                                    <div class='' style='padding: 50px 60px; font-size: 3rem; boxShadow: "2px 2px 10px rgba(0,0,0,0.1);'>
                                                        <p>${msg}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='modal-backdrop show'></div>`

            if(body == "" || body == null || body == undefined){
                document.body.append(teste)
            } else {
                document.getElementById(body).append(teste)
            }
        }
        
        teste.style.display = display

    } catch (error) {
        console.error("Não foi possivel abrir o preload", error)
    }
}

//inut sem espaco
function noSpace(event){
    let id = event.getAttribute("id")
    document.getElementById(id).addEventListener("input", function(){
        this.value = this.value.replace(/\s/g,"")
    })
}

//input primeira maiuscula
function capitalizar(str) {
    if (!str) return str
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase()
}

function onlyNumber(event) {
    let id = event.getAttribute("id")
    document.getElementById(id).addEventListener("input", function(){
        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1')
    })
}

//crud de ultilizador
async function crudUltilizador(x,y){
    return new Promise(async (resolve, reject)=> {
        try {

            let casa = document.getElementById("chkReceberEmail")
            let receberEamil = 0
            if(casa){
                if(casa.checked){
                    receberEamil = 1
                } else {
                    receberEamil = 0
                }
            }
            
            let dados = {}
            switch(x){
                case "excluir":
                    dados = {
                        actionSet : x,
                        idUserSet : y,
                    }
                break

                default:
                    dados = {
                        txtClasseSet : document.getElementById("slcLojax") ?.value || "",
                        txtNomeSet : document.getElementById("txtNome") ?.value || "",
                        txtLoginSet : document.getElementById("txtLogin") ?.value || "",
                        txtSenhaSet : document.getElementById("txtSenha") ?.value || "",
                        txtEmailSet : document.getElementById("txtEmail") ?.value || "",
                        slcAtivoSet : document.getElementById("slcAtivox") ?.value || "",
                        txtReceberEmail : receberEamil,
                        actionSet : x,
                        idUserSet : y,
                    }

                break
            }

            let resultCrud = await $.post("././app/controller/function/funcCrudUltilizador.php",dados)
            resolve(resultCrud)
        } catch (error) {
            msgAlert("alert-danger", "Houve um erro ao finalizar ação, tente novamente." + error)
        }
    })
}

//load lista de loja
async function loadListLoja(select,todosGet){
    try {
        let valueInput = document.getElementById(select)

        let dados = {
            todosSet : todosGet,
        }

        let testeVazio = document.createElement("option")
        testeVazio.innerHTML = ""
        valueInput.appendChild(testeVazio)

        let resultInput = await $.post("././app/controller/function/funcListLoja.php",dados)
        let jsonResultInput = JSON.parse(resultInput)
        
        if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
            jsonResultInput.obj.forEach(item => {
                let teste = document.createElement("option")
                
                teste.innerHTML = capitalizar(item.nomeLoja)
                teste.value = item.idLoja
    
                valueInput.appendChild(teste)
            })
        }
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro a consultar lista de loja, atualize a página novamente." + error)
    }
}

async function loadListDepartamentoProduto(select){
    try {
        let valueInput = document.getElementById(select)

        let resultInput = await $.post("././app/controller/function/funcListDepartamentoProduto.php")
        let jsonResultInput = JSON.parse(resultInput)
        
        if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
            jsonResultInput.obj.forEach(item => {
                let teste = document.createElement("option")
                
                teste.innerHTML = capitalizar(item.nomeMostrarDepartamento)
                teste.value = item.idMostrarDepartamento
    
                valueInput.appendChild(teste)
            })
        }
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro a consultar lista de departamento, atualize a página novamente." + error)
    }
}

async function loadListModuloNomeAbrevProduto(select, idDP){
    try {
        let valueInput = document.getElementById(select)

        let dados = {
            idDpSet : idDP,
        }

        valueInput.innerHTML = ""

        let optionVazio = document.createElement("option")
        valueInput.append(optionVazio)

        let resultInput = await $.post("././app/controller/function/funcListModuloProduto.php", dados)
        let jsonResultInput = JSON.parse(resultInput)
        
        if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
            jsonResultInput.obj.forEach(item => {
                let teste = document.createElement("option")
                
                teste.innerHTML = capitalizar(item.nomeAbreviadoModulo)
                teste.value = item.idModulo
                teste.setAttribute("data-submodulo", item.idSubModuloModulo)
    
                valueInput.appendChild(teste)
            })
        }
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro a consultar lista de departamento, atualize a página novamente." + error)
    }
}

async function loadListTipoProduto(select){
    try {
        let valueInput = document.getElementById(select)

        let resultInput = await $.post("././app/controller/function/funcListTipoProduto.php")
        let jsonResultInput = JSON.parse(resultInput)
        
        if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
            jsonResultInput.obj.forEach(item => {
                let teste = document.createElement("option")
                
                teste.innerHTML = capitalizar(item.nomeTipoProduto)
                teste.value = item.idTipoProduto
    
                valueInput.appendChild(teste)
            })
        }
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro a consultar lista de loja, atualize a página novamente." + error)
    }
}

async function loadListClasse(select){
    return new Promise(async (resolve, reject) => {
        try {
            let valueInput = document.getElementById(select)

            let resultInput = await $.post("././app/controller/function/funcListClasse.php")
            let jsonResultInput = JSON.parse(resultInput)
            
            if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
                jsonResultInput.obj.forEach(item => {
                    let teste = document.createElement("option")
                    
                    teste.innerHTML = capitalizar(item.nomeClasse)
                    teste.value = item.codClasse
        
                    valueInput.appendChild(teste)
                })
            }
            resolve()
        } catch (error) {
            msgAlert("alert-danger", "Houve um erro a consultar lista de loja, atualize a página novamente." + error)
        }
    })
}

async function loadListUtilizador(select){
    return new Promise(async (resolve, reject) => {
        try {
            let valueInput = document.getElementById(select)

            let resultInput = await $.post("././app/controller/function/funcListUtilizador.php")
            let jsonResultInput = JSON.parse(resultInput)
            
            if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
                jsonResultInput.obj.forEach(item => {
                    let teste = document.createElement("option")
                    
                    teste.innerHTML = capitalizar(item.nomeUser)
                    teste.value = item.idUser
        
                    valueInput.appendChild(teste)
                })
            }
            resolve()
        } catch (error) {
            msgAlert("alert-danger", "Houve um erro a consultar lista de loja, atualize a página novamente." + error)
        }
    })
}

//load list de dp
async function loadDepartamento(select){
    return new Promise(async (resolve, reject) => {
        try {
            let valueInput = document.getElementById(select)

            let resultInput = await $.post("././app/controller/function/funcListDepartamento.php")
            
            let jsonResultInput = JSON.parse(resultInput)
            
            if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
                jsonResultInput.obj[0].forEach(item => {
                    let teste = document.createElement("option")
                    
                    teste.innerHTML = capitalizar(item.nomeDepartamento)
                    teste.value = item.idDepartamento
        
                    valueInput.appendChild(teste)
                })
            }

            resolve()
        } catch (error) {
            msgAlert("alert-danger", "")
        }
    })
}

//load list de cargo
async function loadCargo(select, dp){
    return new Promise(async (resolve, reject)=> {
        try {

            let valueInput = document.getElementById(select)
            valueInput.innerHTML = ""

            let dados = {
                departamentoSet : dp,
            }

            let resultInput = await $.post("././app/controller/function/funcListCargo.php", dados)
            let jsonResultInput = JSON.parse(resultInput)

            if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
                jsonResultInput.obj.forEach(item => {
                    let teste = document.createElement("option")
                    
                    teste.innerHTML = capitalizar(item.nomeCargo)
                    teste.value = item.idCargo
        
                    valueInput.appendChild(teste)
                })
            }

            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

//load list de assunto dp
async function loadAssuntoDepartamento(select){
    return new Promise(async (resolve, reject) => {
        try {
            let valueInput = document.getElementById(select)
            valueInput.innerHTML = ""

            let resultInput = await $.post("././app/controller/function/funcListAssuntosDepartamento.php")
            let jsonResultInput = JSON.parse(resultInput)
            
            if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
                jsonResultInput.obj.forEach(item => {
                    let teste = document.createElement("option")
                    
                    teste.innerHTML = capitalizar(item.nomeAssuntoDepartamento)
                    teste.value = item.idAssuntoDepartamento
        
                    valueInput.appendChild(teste)
                })
            }


            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

//load list de assunto
async function loadAssunto(select, assuntoDp){
    return new Promise(async (resolve, reject) => {
        try {

            let dados = {
                assuntoDepartamentoSet : assuntoDp,
            }
            let valueInput = document.getElementById(select)
            valueInput.innerHTML = ""
            
            let todosOption = document.createElement("option")
            todosOption.value = ""
            todosOption.innerHTML = "Todos"
            valueInput.appendChild(todosOption)

            let resultInput = await $.post("././app/controller/function/funcListAssuntos.php", dados)

            let jsonResultInput = JSON.parse(resultInput)
            
            if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
                jsonResultInput.obj.forEach(item => {
                    let teste = document.createElement("option")
                    
                    teste.innerHTML = capitalizar(item.nomeAssunto)
                    teste.value = item.idAssunto
                    teste.setAttribute("data-ass-dp", item.idAssuntoDepartamento)
        
                    valueInput.appendChild(teste)
                })
            }


            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

//enviar email
async function enviarEmail(actionGet,numberOrderCompraGet,retornoOrcamentoGet){
    return new Promise(async (resolve, reject)=>{
        try {
            let dados = {
                actionSet : actionGet,
                numberOrderCompraSet : numberOrderCompraGet,
                retornoOrcamentoSet : retornoOrcamentoGet,
            }

            let result = await $.post("././app/controller/function/funcEnviarEmail.php", dados)
            
            resolve(result)
        } catch (error) {
            //fazer erro
            msgAlert("alert-danger", "Houve um erro ao enviar o email." + error)
        }
    })
}

//grupofeira2025

//ver anexo
async function openModalviewAnexo(idAnexoGet,localGet) {
    return new Promise(async (resolve, reject)=>{
        try {

            let dados = {
                idAnexoSet : idAnexoGet,
                localSet : localGet,
            }

            let resultAnexo = await $.post("././app/views/pages/modal/modalViewAnexo.php", dados)

            let teste = document.createElement("div")
            teste.id = "divModal"
            teste.innerHTML = resultAnexo

            document.body.append(teste)

            closeModal()

            document.querySelectorAll(".containerQuadro").forEach(item=>{
                if(item){
                    item.addEventListener("click",async function(){
                        let x = item.querySelector(".title-file")
                        
                        let nomeArquivo = 'documento.jpg'

                        let tipo = await tipoArquivo(x.textContent)
                        await viewAnexo(x.textContent,localGet)


                    })
                }
            })

            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

//ver qual o tipo de anexo
// async function tipoArquivo(nomeArquivo){
//     const extensao = nomeArquivo.slice(
//         (Math.max(0, nomeArquivo.lastIndexOf('.')) || Infinity) + 1
//     )

//     if (extensao.toLowerCase() === 'pdf') {
//         return 'pdf'

//     } else if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(extensao.toLowerCase())){
//         return 'imagem'
//     } else {
//         return 'desconhecido'
//     }
// }

async function tipoArquivo(nomeArquivo){
    const extensao = nomeArquivo.slice(
        (Math.max(0, nomeArquivo.lastIndexOf('.')) || Infinity) + 1
    )

    if (extensao.toLowerCase() === 'pdf') {
        return 'pdf'
    } else if (extensao.toLowerCase() === 'jpg' || extensao.toLowerCase() === 'jpeg') {
        return 'imagem'
    } else if (extensao.toLowerCase() === 'png') {
        return 'imagem'
    } else if (extensao.toLowerCase() === 'gif') {
        return 'imagem'
    } else if (extensao.toLowerCase() === 'webp') {
        return 'imagem'
    } else {
        return 'desconhecido'
    }
}

//abre o anexo
async function viewAnexo(nomeArquivoGet,localGet){
    return new Promise(async (resolve, reject)=>{
        try {
            let containerViewObj = document.getElementById("containerViewObj")
            let nomeArquivo = nomeArquivoGet

            let caminho = ""
            if(localGet == "" || localGet == 0 || localGet == undefined || localGet == null){
                caminho = "././app/views/pages/anexoOrderCompra/"
            } else {
                caminho = "././app/views/pages/anexoOrderCompraEmail/"
            }

            let criarAquivo
            if (await tipoArquivo(nomeArquivo) === "pdf") {
              criarAquivo = document.createElement("iframe")
              criarAquivo.src = `${caminho}${nomeArquivo}`
            } else if (await tipoArquivo(nomeArquivo) === "imagem") {
              criarAquivo = document.createElement("img")
              criarAquivo.src = `${caminho}${nomeArquivo}`
            } else {
                let link = document.createElement("a")
                link.classList.add("btn")
                link.classList.add("btn-info")
                link.href = `${caminho}${nomeArquivo}`
                link.downlaod = nomeArquivo
                link.setAttribute("target","_blank")
                link.innerText = `Não conseguimos abrir este tipo de arquivo, então clique aqui para baixar o arquivo ${nomeArquivo}`

                containerViewObj.innerHTML = ""
                containerViewObj.appendChild(link)
            }
      
            if (criarAquivo) {
                containerViewObj.innerHTML = ""
                containerViewObj.appendChild(criarAquivo)
            }
      
            resolve()
          } catch (error) {
            console.error("Erro ao exibir anexo:", error)
            reject(error)
          }
    })
}

//format data iso dd/mm/yyy
function dataIso(x){
    let data = x.split("-")
    if(data.length == 3){
        let dia = data[2]
        let mes = data[1]
        let ano = data[0]
        return `${dia}/${mes}/${ano}`
    } else {
        return x
    }
}

//paginador
async function pagination(select, qtdpaginaGet, paginaGet, limiteGet) {
    try {
        let paginationValue = document.getElementById(select)
        paginationValue.innerHTML = ""

        let limite = limiteGet

        let pagina = (parseInt(paginaGet) == "" ? 1 : parseInt(paginaGet) )
        
        let inicio = (pagina * limite) - limite
        
        let qtdPagina = qtdpaginaGet
        
        let valuePagina = ""

        valuePagina += `<li class=''><button class='btn btn-outline-info btnPgane' data-corrida='0' data-pagina='-'><i class="bi bi-chevron-double-left"></i></buton></li>`

        inicio = (inicio == 0 ? 1 : inicio)
        fim = Math.min([qtdPagina], [(pagina + 5)])
        while (fim - inicio < 5 && inicio > 1) {
            inicio--
        }

        while (fim - inicio < 5 && fim < qtdPagina) {
            fim++
        }

        for (let i = inicio ; i <= fim; i++) {
            active = (i == pagina) ? "active" : ""
            valuePagina += `<li class=''><button class='btn btn-outline-info btnPgane ${active}' data-corrida='1' data-pagina='${i}'>${i}</buton></li>`
        }

        valuePagina += `<li class=''><button class='btn btn-outline-info btnPgane' data-corrida='0' data-pagina='+' data-fim='${fim}'><i class="bi bi-chevron-double-right"></i></buton></li>`
        // valuePagina += `<li class=''><button class='btn btn-outline-info btnPgane' data-pagina='${fim}'><i class="bi bi-chevron-double-right"></i></buton></li>`

        let teste = document.createElement("ul")
        teste.innerHTML = valuePagina

        paginationValue.appendChild(teste)

    } catch (error) {
        msgAlert("alert-danger", "Erro ao carregar paginador, atualize a página")
    }
}

//mark todos input do mesmo nivel
async function chkAll(select,rowList){
    let chkAll = document.getElementById(select)
    if(chkAll){
        chkAll.addEventListener("click", function(){
    
            if(chkAll.checked == true){
                document.querySelectorAll("."+rowList).forEach(item => {
                    item.cells[0].querySelector("input").checked = true
                })
            } else {
                document.querySelectorAll("."+rowList).forEach(item => {
                    item.cells[0].querySelector("input").checked = false
                })
            }
        })
    }
}

//check se o item ja existe na tabela antes de adicionar
async function verListTable(numberEncomendaGet,nomeTable,nomeLinha,posicao){
    let existe = false
    document.getElementById(nomeTable).querySelectorAll("."+nomeLinha).forEach(item => {
        if(item.cells[posicao].textContent == numberEncomendaGet){
            existe = true
        }
    })
    return existe
}

//remover e usar a func verlistExistenteDupla()
//ver se encomenda já existe na base de dados
async function verlistExistente(numberEncomendaGet){
    let dados = {
        numberEncomendaSet : numberEncomendaGet,
    }

    try {
        
        let response = await fetch("././app/controller/function/funcVerencomendaDupla.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(dados),
        })

        if(!response.ok){
            //let erroAqui = await response.text()
            return false
        }

        let result = await response.json()

        let existe = false
        if(result && Array.isArray(result.obj) && result.obj.length >= 1){
            existe = false
        }

        return existe
    } catch (error) {
        return false
    }
}

//ver se encomenda ou qualquer outra coisa já existe na base de dados
async function verlistExistenteDupla(numberEncomendaGet, tableGet, campotableGet){
    let dados = {
        numberEncomendaSet : numberEncomendaGet,
        tableSet : tableGet,
        campotableSet : campotableGet,
    }

    try {
        
        let result = await $.post("././app/controller/function/funcVerExistenciaDupla.php", dados)

        let JSONResult = JSON.parse(result)
        let existe = false
        if(JSONResult && Array.isArray(JSONResult.obj) && JSONResult.obj.length >= 1){
            existe = true
        }

        return existe
    } catch (error) {
        return false
    }
}

async function checkTableVazio(tbody,rowList){
    let existe = true
    let select = document.getElementById(tbody)
    if(select.querySelectorAll("."+rowList).length == 0){
        existe = false
    }
    return existe
}

//ver se input check esta marcado
async function checkMark(tbody, rowList, posicao){
    let existe = true
    let select = document.getElementById(tbody)

    select.querySelectorAll("."+rowList).forEach(item => {
        if(item.cells[posicao].querySelector("input[type='checkbox']").checked == true){
            existe = false
        }
    })
    
    return existe
}

//excluir linha de tabela
function excluirItemList(event,nomeLinha){
    let row = event.target.closest("."+nomeLinha)
    row.remove()
}

//label do input sobe ao click do mouse
async function campoInputLabelSuspenso(){
    document.querySelectorAll(".form-control, .form-select").forEach(item => {
        if(item){
            item.addEventListener("focus", () => {
                item.parentNode.classList.add('active')
            })
        
            item.addEventListener('blur', () => {
                if (!item.value) {
                    item.parentNode.classList.remove('active')
                }
            })
        
            item.addEventListener('input', () => {
                if (item.value) {
                    item.parentNode.classList.add('active')
                } else {
                    item.parentNode.classList.remove('active')
                }
            })

            item.addEventListener("change", ()=>{
                if(item.value == ""){
                    item.parentNode.classList.remove('active')
                } else {
                    item.parentNode.classList.add('active')
                }    
            })
        }
    })
}


//btn do lado esquerdo do menu
let btnNavControl = document.querySelector("#btnNavControl")
if(btnNavControl){
    btnNavControl.addEventListener("click",async function(){
        await controlBarra()

        document.querySelectorAll(".subMenu").forEach(item => {
            if(item.classList.contains("show")){
                item.classList.remove("show")
            }
        })
    })
}

//btn de sair que ainda falta fazer
let btnExit = document.querySelectorAll(".btnExit").forEach(item=>{
    if(item){
        item.addEventListener("click", function(){
            $.post("./././app/controller/function/funcDestroiSessao.php", function(){
                window.location.href = "login"
            })
        })
    }
})

async function listPaises(select){
    try {

        let aqui = ['Afeganistão',
'África do Sul',
'Albânia',
'Alemanha',
'Andorra',
'Angola',
'Antígua e Barbuda',
'Arábia Saudita',
'Argélia',
'Argentina',
'Armênia',
'Armênia*',
'Austrália',
'Áustria',
'Azerbaijão',
'Azerbaijão*',
'Bahamas',
'Bahrein',
'Bangladesh',
'Barbados',
'Belarus',
'Bélgica',
'Belize',
'Benin',
'Bolívia',
'Bósnia-Herzegóvina',
'Botsuana',
'Brasil',
'Brunei',
'Bulgária',
'Burkina Fasso',
'Burundi',
'Butão',
'Cabo Verde',
'Camarões',
'Camboja',
'Canadá',
'Catar',
'Cazaquistão',
'Chade',
'Chile',
'China',
'Chipre',
'Chipre*',
'Cingapura',
'Colômbia',
'Comores',
'Congo',
'Coreia do Norte',
'Coreia do Sul',
'Costa do Marfim',
'Costa Rica',
'Croácia',
'Cuba',
'Dinamarca',
'Djibuti',
'Dominica',
'Egito*',
'El Salvador',
'Emirados Árabes Unidos',
'Equador',
'Eritreia',
'Eslováquia',
'Eslovênia',
'Espanha',
'Estados Unidos',
'Estônia',
'Etiópia',
'Fiji',
'Filipinas',
'Finlândia',
'França',
'Gabão',
'Gâmbia',
'Gana',
'Geórgia',
'Geórgia*',
'Granada',
'Grécia',
'Guatemala',
'Guiana',
'Guiné',
'Guiné-Bissau',
'Guiné-Equatorial',
'Haiti',
'Honduras',
'Hungria',
'Iêmen',
'Ilhas Marshall',
'Ilhas Salomão',
'Índia',
'Indonésia',
'Irã',
'Iraque',
'Irlanda',
'Islândia',
'Israel',
'Itália',
'Jamaica',
'Japão',
'Jordânia',
'Kiribati',
'Kuwait',
'Laos',
'Lesoto',
'Letônia',
'Líbano',
'Libéria',
'Líbia',
'Liechtenstein',
'Lituânia',
'Luxemburgo',
'Macedônia',
'Madagáscar',
'Malásia',
'Malauí',
'Maldivas',
'Mali',
'Malta',
'Marrocos',
'Maurício',
'Mauritânia',
'México',
'Mianmar',
'Micronésia',
'Moçambique',
'Moldávia',
'Mônaco',
'Mongólia',
'Montenegro',
'Namíbia',
'Nauru',
'Nepal',
'Nicarágua',
'Níger',
'Nigéria',
'Noruega',
'Nova Zelândia',
'Omã',
'Países Baixos',
'Palau',
'Panamá',
'Papua Nova Guiné',
'Paquistão',
'Paraguai',
'Peru',
'Polônia',
'Portugal',
'Quênia',
'Quirguistão',
'Reino Unido**',
'República Centro-Africana',
'República Democrática do Congo',
'República Dominicana',
'República Tcheca',
'Romênia',
'Ruanda',
'Rússia*',
'Rússia*',
'Samoa',
'San Marino',
'Santa Lúcia',
'São Cristóvão e Névis',
'São Tomé e Príncipe',
'São Vicente e Granadinas',
'Seicheles',
'Senegal',
'Serra Leoa',
'Sérvia',
'Síria',
'Somália',
'Sri Lanka',
'Suazilândia',
'Sudão',
'Sudão do Sul',
'Suécia',
'Suíça',
'Suriname',
'Tailândia',
'Tajiquistão',
'Tanzânia',
'Timor-Leste',
'Togo',
'Tonga',
'Trinidad e Tobago',
'Tunísia',
'Turcomenistão',
'Turquia*',
'Tuvalu',
'Ucrânia',
'Uganda',
'Uruguai',
'Uzbequistão',
'Vanuatu',
'Venezuela',
'Vietnã',
'Zâmbia',
'Zimbábue']
        let x = document.getElementById(select)
        aqui.forEach(item=>{
            teste = document.createElement("option")
            teste.innerHTML = item
            teste.value = item
            x.appendChild(teste)

        })

    } catch (error) {
        msgAlert("alert-danger","Houve um erro ao carregar lista de países, atualize a página novamente.")
    }
}

async function loadDiaSelect(select, mes, ano) {
    try {
        let qtdValue = new Date(ano, mes, 0)
        let x = document.getElementById(select)
        x.textContent = ""
        let vazio = document.createElement("option")
        vazio.textContent = ""
        x.appendChild(vazio)

        for(let i = 1 ; i <= qtdValue.getDate() ; i++){
            let teste = document.createElement("option")
            teste.textContent = i
            teste.value = i
            x.appendChild(teste)
        }
    } catch (error) {
        msgAlert("alert-danger","Erro ao carregar lista com os dias, tente atualizar a página")
    }
}


async function loadMesSelect(select, ano, exibicao) {
    try {
        let x = document.getElementById(select)
        let mes = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]

        let data = new Date()
        let anoCorrente = data.getFullYear()

        if(ano == null || ano == ""){
            ano = anoCorrente
        }
        
        let z = 1
        
        if(exibicao == 1){
            if(ano == anoCorrente){
                 z = (data.getMonth() + 1)
            }
        }
        

        x.textContent = ""
        let vazio = document.createElement("option")
        vazio.textContent = ""
        x.appendChild(vazio)

        for(let i = z ; i <= 12 ; i++){
            let teste = document.createElement("option")
            teste.textContent = mes[i-1]
            teste.value = i
            x.appendChild(teste)
        }
    } catch (error) {
        msgAlert("alert-danger","Erro ao carregar lista com os dias, tente atualizar a página")
    }
}


async function loadAnoSelect(select) {
    try {
        let x = document.getElementById(select)
        let ano = new Date()
        let anoValue = ano.getFullYear()
        x.textContent = ""
        let vazio = document.createElement("option")
        vazio.textContent = ""
        x.appendChild(vazio)
        for(let i = anoValue ; i < (anoValue + 3) ; i++){
                let teste = document.createElement("option")
                teste.textContent = i
                teste.value = i
                x.appendChild(teste)
        }
    } catch (error) {
        msgAlert("alert-danger","Erro ao carregar lista com os dias, tente atualizar a página")
    }
}

function FeriadosFixos(ano){
    try {
        var resultados = []
        //Array de datas no formato mes/dia.
        //OBS: O primeiro mes é 0 e o último mes é 11
        var datas = [[0,  1], [3,  21],[4,  1], [8,  7], [9,  12], [10,  2], [10, 15], [11, 25]]

        for (z = 0; z < datas.length; z++){
            resultados.push(new Date(ano, datas[z][0],  datas[z][1]).getTime())
        }
        return resultados
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao buscar lista de feriados" + error)
    }

}

function Pascoa(Y) {
    try {
        var C = Math.floor(Y/100)
        var N = Y - 19*Math.floor(Y/19)
        var K = Math.floor((C - 17)/25)
        var I = C - Math.floor(C/4) - Math.floor((C - K)/3) + 19*N + 15
        I = I - 30*Math.floor((I/30))
        I = I - Math.floor(I/28)*(1 - Math.floor(I/28)*Math.floor(29/(I + 1))*Math.floor((21 - N)/11))
        var J = Y + Math.floor(Y/4) + I + 2 - C + Math.floor(C/4)
        J = J - 7*Math.floor(J/7)
        var L = I - J
        var M = 3 + Math.floor((L + 40)/44)
        var D = L + 28 - 31*Math.floor(M/4)

        return new Date(Y, M, D)
    } catch (error) {
        console.log(error)
    }

}

function DataAdicionar(data_informada, quantidade) {
    try {
        var fator = 24 * 60 * 60 * 1000
        var nova_data = new Date(data_informada.getTime() + quantidade * fator)
        nova_data.setHours(0,0,0,0)

        return nova_data
    } catch (error) {
        console.log(error)
    }

}

function DataSubtrair(data_informada, quantidade) {
    try {
        var fator = 24 * 60 * 60 * 1000
        var nova_data = new Date(data_informada.getTime() - quantidade * fator)
        nova_data.setHours(0,0,0,0)
        
        return nova_data
    } catch (error) {
        console.log(error)
    }

}

async function getnumDiasUteis(startDate, dataFinal) {
    try {
        var numDiasUteis = 0
        var arr1 = startDate.split('/')
        var arr2 = dataFinal.split('/')
        var dataAtual = new Date(arr1[0],arr1[1]-1, arr1[2])
        dataFinal = new Date(arr2[0],arr2[1]-1, arr2[2])
        var ano_inicial = dataAtual.getFullYear()
        var ano_final = dataFinal.getFullYear()
        var ano = ano_inicial
        var feriados = []

        for (let x = ano ; x <= ano_final; x++){
            //OBS: O primeiro mes é 0 e o último mes é 11
            //Feriados fixos.
            feriados = feriados.concat(FeriadosFixos(ano))
            data_pascoa = Pascoa(ano) 

            //Feriados variaveis de acordo com a data da Pascoa
            feriados.push(data_pascoa.getTime())
            feriados.push(DataAdicionar(data_pascoa, 60).getTime())
            feriados.push(DataSubtrair(data_pascoa, 48).getTime())
            feriados.push(DataSubtrair(data_pascoa, 47).getTime())
            feriados.push(DataSubtrair(data_pascoa, 2).getTime())
            ano++
        }

        let x = dataAtual.getTime() / (1000 * 60 * 60 * 24)
        let y = dataFinal.getTime() / (1000 * 60 * 60 * 24)
        let xy = Math.abs(x - y)
        
        let za = ""
        for(let i = 0 ; i <= xy ; i++){
            za = (new Date(`${dataAtual.getFullYear()}/${dataAtual.getMonth() + 1 }/${dataAtual.getDate() + i}`))
            if(za.getDay() !== 0 && za.getDay() !== 6){
                if (!feriados.includes(za.getTime())){
                    numDiasUteis++
                }
            }
        }
        return numDiasUteis
    } catch (error) {
        console.log(error)
    }
}