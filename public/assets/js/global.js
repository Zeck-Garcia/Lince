$(document).ready(function() {
    $(document).ajaxError(function(event, jqXHR, ajaxSettings, thrownError) {
        if (jqXHR.status === 401) {
            msgAlert("alert-danger", "O seu turno de 8h terminou ou a sessão expirou. A redirecionar...")
            
            setTimeout(function() {
                window.location.href = "login"
            }, 2000)
        }
    })

    $(document).on('input', '.so-letras', function() {
        onlyLetra(this)
    })

    $(document).on("input", ".no-space", function(){
        noSpace(this)
    })

    $(document).on("input", ".only-caract", function(){
        onlyCaracter(this)
    })

    $(document).on("input", ".only-number", function(){
        onlyNumber(this)
    })

    $(document).on("input", ".lower-case", function(){
        lowerCaser(this)
    })

    $(document).on("input", ".upper-case", function(){
        upperCase(this)
    })
})

//spinner
window.addEventListener('load', function() {
    try {
        let preloader = document.getElementById('loaderSpinner')
        preloader.classList.remove("active")
    
        let conteudo = document.querySelector('.main-content')
        conteudo.classList.remove("active")
    } catch (error) {
        console.log(error)
    }
})

/**
* 
* @param {string} display use show para exibir o spinner
*/
function loadAwaitAction(display){
    try {
        let loaderSpinner = document.getElementById("loaderSpinner")

        if(display == "show"){
            if(!loaderSpinner.classList.contains("active")){
                loaderSpinner.classList.add("active")
            } else {
                loaderSpinner.classList.remove("active")
            }
        } else {
            loaderSpinner.classList.remove("active")
        }
    } catch (error) {
        msgAlert("alert-danger", "Erro ao mundar codigo" + error)
    }
}

async function exit(){
    try {
        let dados = new FormData();
        dados.append('exit', true);

        let response = await fetch("api/exit", {
            method: "POST",
            body: dados
        });

        if (!response.ok) {
            throw new Error(`Erro HTTP: ${response.status}`);
        }

        let result = await response.text();
        
        if (result.trim() === "sessao_expirada") {
            window.location.href = "home";
        } else {
            console.error("Erro no servidor ao sair:", result);
            msgAlert("alert-danger", "Não foi possível encerrar a sessão.");
        }

    } catch (error) {
        console.error("Erro na ligação:", error);
        msgAlert("alert-danger", "Erro de conexão ao tentar sair.");
    }  
}

// function atualizarURLComParametros(parametros) {
//     const urlAtual = window.location.pathname
    
//     const novaURL = `${urlAtual}?${new URLSearchParams(parametros).toString()}`
    
//     history.pushState(null, "", novaURL)

//     window.location.href = novaURL
// }

document.querySelectorAll(".enterPress").forEach(element=>{
    element.addEventListener("focus", ()=>{
        element.addEventListener("keypress", (e)=>{
            if(e.key === "Enter"){
                element.click()
            }
        })
    })
})

/**
* 
* @param {string} title class do bootstrap para alert, caso nao defina sera usado a class alert-warning
* @param {string} msg mensagem a ser exibida na tela
* @param {int} time tempo de exibição
* @param {string} nameMsg ficara fora de uso 
*/
function msgAlert(title, msg, time, nameMsg){
    let newItem = document.createElement("div")
    newItem.classList.add("textMsgBox")
    newItem.classList.add("alert")
    newItem.classList.add(title || "alert-warning")
    newItem.setAttribute("role", "alert")

    let criarNomeID = msg.replace(/[^a-zA-Z0-9]/g," ").split(" ")
    let nomeID = "mensagemAleatoria"
    criarNomeID.forEach(item=>{
        if(item.length > 3){
            nomeID += item.substring(0, 3)
        }
    })
    
    newItem.id = nomeID
    $(`#${nomeID}`).remove()
    
    newItem.innerHTML = `<span class="msgMsg">${msg}</span><div class='btnCloseMsgBox'>x</div>`
    
    document.getElementById("divBoxMsgBox").style.display = "block"
    document.getElementById("divBoxMsgBox").classList.add("show")
    document.getElementById("divBoxMsgBox").append(newItem)

    let btnClose = newItem.querySelector(".btnCloseMsgBox")
    btnClose.addEventListener("click", function(){
        
        newItem.remove()

        if(document.getElementById("divBoxMsgBox").children.length === 0){
            document.getElementById("divBoxMsgBox").classList.remove("show")
            document.getElementById("divBoxMsgBox").style.display = "none"
        }
    })

    let timee = (time === undefined ? 10000 : time)
    
    setTimeout(function(){
        if(newItem.parentElement){
            newItem.remove()
    
            if(document.getElementById("divBoxMsgBox").children.length === 0){
                document.getElementById("divBoxMsgBox").classList.remove("show")
                document.getElementById("divBoxMsgBox").style.display = "none"
            }
        }
    }, timee)
}

/**
* close modal
*/
function closeModal(){
    $(".modal-backdrop").remove()
    let container = document.getElementById('modal-container')
    if(container) container.innerHTML = ""

    let body = document.querySelector("body")
    body.classList.remove("modal-open")
    
    body.style.overflow = ""
    body.style.paddingRight = ""
    return true
}

/**
* close submodal
*/
function closeModalSubTela(){
    if(document.querySelector("#divModalSubTela")){
        document.querySelector("#divModalSubTela").remove()
    }
}

/**
* 
* @returns recebe a data no formaro yyyy-mm-dd retorna a data no format dd/mm/yyyy
*/
function funcDataAtual(){
    let dataAtual = new Date()
    let dia = String(dataAtual.getDate()).padStart(2,0)
    let mes = String(dataAtual.getMonth() + 1 ).padStart(2,0)
    let ano = dataAtual.getFullYear()

    return `${dia}/${mes}/${ano}`
}

/**
* 
* @param {string} dataPrimaria A data deve ser no formato dd/mm/aaaa, caso o primeiro paramento seja "" sera usado a data atual data1 < data2
* @param {string} dataSecundaria a data que deseja comparar dd/mm/aaaa
* @param {string} acao operador de comparacao que sera usado na acao
* @returns true ou false
* se precisar converter para esse formato use a func dataIso()
*/
function compareDate(dataPrimaria, dataSecundaria, acao){

    let valorDataPrimaria = ""

    let [diaSec,mesSec,anoSec] = dataSecundaria.split("/")
    let valorDataSecundario = new Date(anoSec,mesSec - 1, diaSec).getTime()

    if(dataPrimaria == ""){
        valorDataPrimaria = new Date().getTime()
    } else {
        let [dia,mes,ano] = dataPrimaria.split("/")
        valorDataPrimaria = new Date(ano,mes - 1, dia).getTime()
    }

    let result = false

    switch(acao){
        case "<":
            result = valorDataPrimaria < valorDataSecundario
        break

        case ">":
            result = valorDataPrimaria > valorDataSecundario
        break

        case "<=":
            result = valorDataPrimaria <= valorDataSecundario
        break

        case ">=":
            result = valorDataPrimaria >= valorDataSecundario
        break

        case "==":
            result = valorDataPrimaria == valorDataSecundario
        break

        case "!=":
            result = valorDataPrimaria != valorDataSecundario
        break

        default:
            return false
    }

    return result
}

/**
* 
* @param {data} data recebe a data no format yyyy-mm-dd e tranforma para dd/mm/yyyy
* @returns 
*/
function dataIso(data) {
    if (typeof data == 'string') {
    let novaData = data.split("-")
    if (novaData.length === 3) {
        let dia = novaData[2]
        let mes = novaData[1]
        let ano = novaData[0]
        return `${dia}/${mes}/${ano}`
    } else {
        
        let dateObj = new Date(data)
        if (!isNaN(dateObj)) {
        let dia = dateObj.getDate()
        let mes = dateObj.getMonth() + 1
        let ano = dateObj.getFullYear()

        return `${dia}/${mes}/${ano}`
        } else {
        return data
        }
    }
    } else if (data instanceof Date) {
    let dia = data.getDate()
    let mes = data.getMonth() + 1
    let ano = data.getFullYear()

    return `${dia}/${mes}/${ano}`
    } else {
    return data
    }
}

/**
* 
* @param {string} data recebe a data no format dd/mm/yyyy e return yyyy-mm-dd
* @returns 
*/
function dataDB(data){
    let pad = (n) => String(n).padStart(2, '0')
    console.log(data)
    if (typeof data == 'string') {
    let novaData = data.split("/")
    if (novaData.length === 3) {
        let [dia, mes, ano] = novaData
        return `${ano}-${pad(mes)}-${pad(dia)}`
    } else {
        
        let dateObj = new Date(data)
        if (!isNaN(dateObj)) {
        return `${dateObj.getFullYear()}-${pad(dateObj.getMonth() + 1)}-${pad(dateObj.getDate())}`
        } else {
        return data
        }
    }
    }
    
    if (data instanceof Date) {
    return `${data.getFullYear()}-${pad(data.getMonth() + 1)}-${pad(data.getDate())}`
    }
    
    if (typeof data === 'number') {
        let dateObj = new Date(data)
        if (!isNaN(dateObj)) {
            return `${dateObj.getFullYear()}-${pad(dateObj.getMonth() + 1)}-${pad(dateObj.getDate())}`
        }
    }

    return data
}

function formatarMes(data) {
    if (!data) return '---';
    let meses = ["JAN", "FEV", "MAR", "ABR", "MAI", "JUN", "JUL", "AGO", "SET", "OUT", "NOV", "DEZ"]
    return meses[new Date(data).getMonth()]
}

function formatarDia(data) {
    if (!data) return '--'
    return new Date(data).getDate()
}

/**
* 
* @param {int} totalRegistros total de registro
* @param {int} limite limite de registro por pagina
* @param {int} paginaAtual pagina atual
* @param {string} divContainer local onde esta o paginador
* @param {string} titleOnClick nome da func para passar o paginador
*/
async function pagination(totalRegistros, limite, paginaAtual, divContainer, titleOnClick) {
    try {
        let totalPaginas = Math.ceil(totalRegistros / limite)
        let container = document.getElementById(divContainer)
        let html = ''

        if(totalPaginas == 0){
            html += `<span class="badge rounded-pill bg-light text-dark border shadow-sm p-2 animate__animated animate__fadeIn" 
                        style="font-size: 0.85rem; font-weight: 500;">
                    <i class="bi bi-info-circle me-1 text-primary"></i> 
                    Listagem completa: todos os registos já estão visíveis nesta página.
                    </span>`
        }
        html += `
            <li class="page-item ${paginaAtual === 0 || paginaAtual === 1 ? 'disabled' : ''}">
                <a class="page-link" href="javascript:void(0)" onclick="${titleOnClick}(${paginaAtual - 1})">Anterior</a>
            </li>`

        for (let i = 1; i <= totalPaginas; i++) {

            if (i === paginaAtual) {
                html += `<li class="page-item active"><a class="page-link">${i}</a></li>`;
            } else {
                if (i <= 3 || i > totalPaginas - 1 || (i >= paginaAtual - 1 && i <= paginaAtual + 1)) {
                    html += `<li class="page-item ${paginaAtual == 0 && i == 1 ? 'active' : ''}"><a class="page-link" href="javascript:void(0)" onclick="${titleOnClick}(${i})">${i}</a></li>`
                } else if (i === 4) {
                    html += `<li class="page-item disabled"><a class="page-link">...</a></li>`
                }
            }
        }

        html += `
            <li class="page-item ${paginaAtual === totalPaginas ? 'disabled' : ''}">
                <a class="page-link" href="javascript:void(0)" onclick="${titleOnClick}(${paginaAtual + 1})">Próximo</a>
            </li>`

        container.innerHTML = html

    } catch (error) {
        console.log(error)
        msgAlert("alert-danger", "Erro ao carregar paginador, atualize a página" + error)
    }
}

/**
* 
* @param {array} dados array com os dados para o email
* 
*/
async function enviarEmail(dadosGet){
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)

        let response = await fetch("api/enviar-email",{
            method : "POST",
            body : dados
        })

        if(!response.ok) throw new Error("Erro")

        let result = await response.json()

        if(result.obj &&  typeof result.obj == 'object'){
            if(result.obj.sucesso){
                msgAlert("alert-success", result.obj.msg)
            } else if(result.obj.sucesso) {
                console.log(2)
                msgAlert("alert-warning", result.obj.msg)
            }  
        }

    } catch (error) {
        console.log(error)
        msgAlert("alert-danger", "Houve um erro ao enviar email" + error)
    }
}

/**
* 
* @param {array} dados dados com o array para envio
* 
*/
async function enviarSMS(dadosGet){
    try {
        let dados = new FormData()
            dados.append("dados", dadosGet)
    
        let response = await fetch("api/enviar-sms",{
            method : "POST",
            body : dados,
        })
    
        if(!response.ok) throw new Error("Erro")
        
        let result = await response.json()
        console.log(result.obj.sucesso)
        if(result.obj && typeof result.obj == 'object'){
            if(result.obj.sucesso){
                msgAlert("alert-success", result.obj.msg)
            } else {
                msgAlert("alert-warning", result.obj.msg)
            }  
        } else {
            msgAlert("alert-danger", "Houve um erro")
        }
    } catch (error) {
        console.log(error)
        msgAlert("alert-warning", "Erro ...")        
    }
}

/**
* 
* @param {string} rota nome do submodal a ser aberto 
* @returns 
*/
async function openSubModal(rota, title, msg){
    try {
        let response = await fetch(`modal/${rota}`)
        let html = await response.text()

        let modalSubcontainer = document.getElementById("modalSub-container")
        modalSubcontainer.textContent = ''

        let tempDiv = document.createElement('div')
        tempDiv.innerHTML = html
        
        let modalEl = tempDiv.querySelector('.modal')
        modalSubcontainer.appendChild(modalEl)

        let instance = new bootstrap.Modal(modalEl, {
            backdrop: false,
            keyboard: false
        })
        
        instance.show()
        
        modalEl.addEventListener("shown.bs.modal",async ()=>{
            let msgModal = modalEl.querySelector("#confirmMessage")
            msgModal.innerHTML = msg || 'Deseja realmente prosseguir com esta ação?'
    
            let titleModal = modalEl.querySelector(".modal-title")
            titleModal.innerHTML += title || 'Confirmar'

            document.querySelectorAll(".btnCloseSubModal").forEach(btnCloseSubModal=>{
                if(btnCloseSubModal){
                    btnCloseSubModal.addEventListener("click", ()=> {
                        $("#modalSub-container").textContent = ''
                        //$(".modal-backdrop").remove()
                        modalEl.remove()
                    })
                }
            })
        })

        return modalEl
    } catch (error) {
        console.log(error)
    }
}

async function openModal(router, title){
    try {
        let nomeRoute = {title : title}
        if (router == '') {
            msgAlert("alert-warning", "Houve um erro nenhum janela encontrada.")
            return
        }
        let response = await fetch("modal/" + router)
        let html = await response.text()

        let container = document.getElementById('modal-container')
        container.innerHTML = ''
        
        let tempDiv = document.createElement('div')
        tempDiv.innerHTML = html
        
        let modalEl = tempDiv.querySelector('.modal')
        container.appendChild(modalEl)

        let instance = new bootstrap.Modal(modalEl, {
            backdrop: 'static',
            keyboard: false
        })
        instance.show()

        let titleModal = container.querySelector(".modal-title")
        titleModal.innerHTML += title

        return {
            modalEl,
            container,
            nomeRoute
        }
    } catch (error) {
        console.log(error)
    }
}

/**
* 
* @param {double} valor recebe um valor e converter para format EURO 
* @returns 
*/
function formatarMoeda(valor) {
    return parseFloat(valor).toLocaleString("pt-PT", {style: "currency", currency : "EUR"})
}

/**
* 
* @param {string} str texto que deve ter o toLwerCase 
* @returns 
*/
function capitalizar(str) {
    if (!str) return str
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase()
}

/**
* 
* @param {string} str texto a ser capitado a inicial 
* @returns retorna a inicial do nome em caixa alta
*/
function obterIniciais(str) {
    if (!str) return ""
    let txt = str.trim().split(/\s+/)

    let primeiroNome = txt[0];
    let ultimoNome = txt.length > 1 ? txt[txt.length - 1] : ""

    let inicialPrimeiro = primeiroNome.charAt(0)
    let inicialUltimo = ultimoNome ? ultimoNome.charAt(0) : ""
    return (inicialPrimeiro + inicialUltimo).toUpperCase()
}

function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('collapsed')
}

    //label do input sobe ao click do mouse
// function campoInputLabelSuspenso(){
//     document.querySelectorAll(".form-control, .form-select").forEach(item => {
//         if(item){
//             item.addEventListener("focus", () => {
//                 item.parentNode.classList.add('active')
//             })
        
//             item.addEventListener('blur', () => {
//                 if (!item.value) {
//                     item.parentNode.classList.remove('active')
//                 }
//             })
        
//             item.addEventListener('input', () => {
//                 if (item.value) {
//                     item.parentNode.classList.add('active')
//                 } else {
//                     item.parentNode.classList.remove('active')
//                 }
//             })

//             item.addEventListener("change", ()=>{
//                 if(item.value == ""){
//                     item.parentNode.classList.remove('active')
//                 } else {
//                     item.parentNode.classList.add('active')
//                 }    
//             })
//         }
//     })
// }

/**
 * 
 * @param {string} select campo a receber a lista de valores 
 * @returns 
 */
async function loadListLojaSLC(select){
    let slcNew = document.getElementById(select)
    let response = await fetch("api/load-list-loja-slc", {
        method : "POST",
    })

    if(!response.ok) throw new Error("Erro na rede")

    let result = await response.json()
    slcNew.innerHTML = ""

    let newInputEmpty = document.createElement("option")
    newInputEmpty.innerHTML = "Selecione"
    newInputEmpty.value = "0"
    newInputEmpty.disabled = true
    newInputEmpty.selected = true
    slcNew.appendChild(newInputEmpty)

    try {
        if(result.obj && Array.isArray(result.obj)){
            result.obj.forEach(item=>{
                if(item.ativo == 1){
                    let newInput = document.createElement("option")
                    newInput.innerHTML = capitalizar(item.nome)
                    newInput.value = item.id
                    slcNew.appendChild(newInput)
                }
            })
        } else {
            msgAlert("alert-danger", "Erro no retorno do banco de dados, atualize a página.")
        }
    } catch (error) {
        msgAlert("alert-danger", "Campo de loja não encontrado")
    }
}

/**
 * 
 * @param {string} select campo a receber a lista de valores 
 * @returns 
 */
async function loadListCursoSLC(select){
    let slcNew = document.getElementById(select)
    let response = await fetch("api/load-list-curso-slc", {
        method : "POST",
    })

    if(!response.ok) throw new Error("Erro na rede")

    let result = await response.json()
    slcNew.innerHTML = ""

    let newInputEmpty = document.createElement("option")
    newInputEmpty.innerHTML = "Selecione"
    newInputEmpty.value = "0"
    newInputEmpty.disabled = true
    newInputEmpty.selected = true
    slcNew.appendChild(newInputEmpty)

    try {
        if(result.obj && Array.isArray(result.obj)){
            result.obj.forEach(item=>{
                if(item.ativo == 1){
                    let newInput = document.createElement("option")
                    newInput.innerHTML = capitalizar(item.nome)
                    newInput.value = item.id
                    slcNew.appendChild(newInput)
                }
            })
        } else {
            msgAlert("alert-danger", "Erro no retorno do banco de dados, atualize a página.")
        }
    } catch (error) {
        msgAlert("alert-danger", "Campo de loja não encontrado")
    }
}

/**
 * 
 * @param {string} select campo a receber a lista de valores 
 * @returns 
 */
async function loadListDepartamentoSLC(select){
    let slcNew = document.getElementById(select)
    let response = await fetch("api/load-list-departamento-slc", {
        method : "POST",
    })

    if(!response.ok) throw new Error("Erro na rede")

    let result = await response.json()
    slcNew.innerHTML = ""

    let newInputEmpty = document.createElement("option")
    newInputEmpty.innerHTML = "Selecione"
    newInputEmpty.value = "0"
    newInputEmpty.disabled = true
    newInputEmpty.selected = true
    slcNew.appendChild(newInputEmpty)

    try {
        if(result.obj && Array.isArray(result.obj)){
            result.obj.forEach(item=>{
                if(item.ativo == 1){
                    let newInput = document.createElement("option")
                    newInput.innerHTML = capitalizar(item.nome)
                    newInput.value = item.id
                    slcNew.appendChild(newInput)
                }
            })
        } else {
            msgAlert("alert-danger", "Erro no retorno do banco de dados, atualize a página.")
        }
    } catch (error) {
        msgAlert("alert-danger", "Campo de loja não encontrado")
    }
}

/**
 * 
 * @param {string} select campo a receber a lista de valores 
 * @returns 
 */
async function loadListCargoSLC(select,id){
    
    let dados = new FormData()
    dados.append("id", id)

    let slcNew = document.getElementById(select)
    let response = await fetch("api/load-list-cargo-slc", {
        method : "POST",
        body : dados
    })

    if(!response.ok) throw new Error("Erro na rede")

    let result = await response.json()
    slcNew.innerHTML = ""

    let newInputEmpty = document.createElement("option")
    newInputEmpty.innerHTML = "Selecione"
    newInputEmpty.value = "0"
    newInputEmpty.disabled = true
    newInputEmpty.selected = true
    slcNew.appendChild(newInputEmpty)

    try {
        if(result.obj && Array.isArray(result.obj)){
            result.obj.forEach(item=>{
                if(item.ativo == 1){
                    let newInput = document.createElement("option")
                    newInput.innerHTML = capitalizar(item.nome)
                    newInput.value = item.id
                    slcNew.appendChild(newInput)
                }
            })
        } else {
            msgAlert("alert-danger", "Erro no retorno do banco de dados, atualize a página.")
        }
    } catch (error) {
        msgAlert("alert-danger", "Campo de loja não encontrado")
    }
}

/**
 * 
 * @param {string} select campo a receber a lista de valores 
 * @returns 
 */
async function loadListUtilizador(dadosGet){
    try {
        let dados = new FormData()
        dados.append("dados", dadosGet)
    
        let response = await fetch("api/load-list-utilizador", {
            method : "POST",
            body : dados
        })
    
        if(!response.ok) throw new Error("Erro na rede")
    
        return await response.json()
        
    } catch (error) {
        console.log(error)
    }
}

async function compressImages(files, maxWidth, maxHeight, quality) {
    let promises = Array.from(files).map(file => {
        return compressImage(file, maxWidth, maxHeight, quality)
    })

    return Promise.all(promises)
        .then(compressedImages => {
            // Aqui você tem um array com todos os blobs compactados
            return compressedImages
        })
        .catch(error => {
            console.error("Erro ao compactar as imagens:", error)
            throw error
        })
}

async function compressImage(file, maxWidth, maxHeight, quality) {
    return new Promise((resolve, reject) => {
        let reader = new FileReader()
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
                            resolve(blob); // Retorna o Blob compactado
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

function tipoArquivo(nomeArquivo){
    let extensao = nomeArquivo.slice(
        (Math.max(0, nomeArquivo.lastIndexOf('.')) || Infinity) + 1
    )

    if (extensao.toLowerCase() === 'pdf') {
        return 'pdf'
    } else if (extensao.toLowerCase() === 'jpg' || extensao.toLowerCase() === 'jpeg') {
        return 'image/jpeg'
    } else if (extensao.toLowerCase() === 'png') {
        return 'image/png'
    } else if (extensao.toLowerCase() === 'gif') {
        return 'image/gif'
    } else if (extensao.toLowerCase() === 'webp') {
        return 'image/webp'
    } else {
        return 'desconhecido'
    }
}