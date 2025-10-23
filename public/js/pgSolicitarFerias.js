window.addEventListener("DOMContentLoaded",async function(){
    try {
        await campoInputLabelSuspenso()
    } catch (error) {
        //fazer erro
    }
})

let camposSolicitarFerias = camposPaginaSolicitarFerias()

function limparCampoSolicitarFerias(){
    camposSolicitarFerias.slcDeDia.value = ""
    camposSolicitarFerias.slcDeMes.value = ""
    camposSolicitarFerias.slcDeAno.value = ""

    camposSolicitarFerias.slcAteDia.value = ""
    camposSolicitarFerias.slcAteMes.value = ""
    camposSolicitarFerias.slcAteAno.value = ""

    camposSolicitarFerias.slcFeriasFuncionario.value = ""

    camposSolicitarFerias.slcDeDia.textContent = ""
    camposSolicitarFerias.slcAteDia.textContent = ""

    camposSolicitarFerias.slcDeDia.parentNode.classList.remove("active")
    camposSolicitarFerias.slcDeMes.parentNode.classList.remove("active")
    camposSolicitarFerias.slcDeAno.parentNode.classList.remove("active")

    camposSolicitarFerias.slcAteDia.parentNode.classList.remove("active")
    camposSolicitarFerias.slcAteMes.parentNode.classList.remove("active")
    camposSolicitarFerias.slcAteAno.parentNode.classList.remove("active")

    camposSolicitarFerias.slcFeriasFuncionario.parentNode.classList.remove("active")

    tbodyListSendFerias.textContent = ""
}

async function sendListFerias() {
    try {

    } catch (error) {
        
    }
}

function limpardiasSelect(){
    camposSolicitarFerias.slcAteDia.value = ""
    camposSolicitarFerias.slcAteMes.value = ""
    camposSolicitarFerias.slcAteAno.value = ""
}

function limparContarDias(){
    document.getElementById("contarDias").textContent = ""
    document.getElementById("contarDias").parentNode.classList.add("hidder")
}

function camposPaginaSolicitarFerias(){
    return {
       slcDeDia : document.getElementById("slcDeDia"),
       slcDeMes : document.getElementById("slcDeMes"),
       slcDeAno : document.getElementById("slcDeAno"),

        slcAteDia : document.getElementById("slcAteDia"),
        slcAteMes : document.getElementById("slcAteMes"),
        slcAteAno : document.getElementById("slcAteAno"),
        slcFeriasFuncionario : document.getElementById("slcFeriasFuncionario"),
        btnAddFeriasAlista : document.getElementById("btnAddFeriasAlista"),
        btnNovaFerias : document.getElementById("btnNovaFerias"),
        btnCancelarEnvioFerias : document.getElementById("btnCancelarEnvioFerias"),
        btnEnviarEnvioFerias : document.getElementById("btnEnviarEnvioFerias")
    }
}

let containerNovaFerias = document.getElementById("containerNovaFerias")
let tbodyListSendFerias = document.getElementById("tbodyListSendFerias")
let containerSendFerias = document.getElementById("containerSendFerias")

if(camposSolicitarFerias.btnNovaFerias){
    camposSolicitarFerias.btnNovaFerias.addEventListener("click", ()=>{
        if(containerNovaFerias.classList.contains("hidder")){
            containerNovaFerias.classList.remove("hidder")

            loadAnoSelect("slcDeAno")
            loadMesSelect("slcDeMes","",1)
        }
    })
}

if(camposSolicitarFerias.slcDeDia){
    camposSolicitarFerias.slcDeDia.addEventListener("change", ()=>{

        camposSolicitarFerias.slcAteAno.textContent = ""
        camposSolicitarFerias.slcAteAno.parentNode.classList.add("active")
        for(let i = 0 ; i < 2 ; i++){
            let teste = document.createElement("option")
            teste.innerHTML = Number(camposSolicitarFerias.slcDeAno.value) + i
            teste.value = Number(camposSolicitarFerias.slcDeAno.value) + i
            camposSolicitarFerias.slcAteAno.append(teste)
        }

        camposSolicitarFerias.slcAteMes.textContent = ""
        camposSolicitarFerias.slcAteMes.parentNode.classList.add("active")
        let x = Number(camposSolicitarFerias.slcDeMes.value)
        
        let mes = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]

        for(let i = (x - 1) ; i < 12 ; i++){
            let teste = document.createElement("option")
            teste.innerHTML = mes[i]
            teste.value = i + 1
            camposSolicitarFerias.slcAteMes.append(teste)
        }

        let y = camposSolicitarFerias.slcDeDia.value
        camposSolicitarFerias.slcAteDia.innerHTML = "" 
        camposSolicitarFerias.slcAteDia.parentNode.classList.add("active")
        let qtdValue = new Date(camposSolicitarFerias.slcAteAno.value, camposSolicitarFerias.slcAteMes.value, 0)
        for(let i = y ; i <= qtdValue.getDate() ; i++){
            let teste = document.createElement("option")
            teste.innerHTML = i
            camposSolicitarFerias.slcAteDia.append(teste)
        }
    })
}

if(camposSolicitarFerias.slcDeMes){

    camposSolicitarFerias.slcDeAno.addEventListener("change", ()=>{
        limpardiasSelect()
        limparContarDias()
        loadMesSelect("slcDeMes",camposSolicitarFerias.slcDeAno.value,1)

        if(camposSolicitarFerias.slcDeMes.value != ""){
            loadDiaSelect("slcDeDia", camposSolicitarFerias.slcDeMes.value, camposSolicitarFerias.slcDeAno.value)
        }
    })

    camposSolicitarFerias.slcDeMes.addEventListener("change", ()=>{
        limpardiasSelect()
        limparContarDias()
        if(camposSolicitarFerias.slcDeAno.value == ""){
            msgAlert("alert-warning","Agora selecione o ano.")
        } else {
            
            if(camposSolicitarFerias.slcDeMes.value != ""){
                loadDiaSelect("slcDeDia", camposSolicitarFerias.slcDeMes.value, camposSolicitarFerias.slcDeAno.value)
            }
        }

    })
}


if(camposSolicitarFerias.slcAteMes){
    camposSolicitarFerias.slcAteMes.addEventListener("change", ()=>{
        if(camposSolicitarFerias.slcAteAno.value == ""){
            msgAlert("alert-warning","Agora selecione o ano.")
        } else {
            if(camposSolicitarFerias.slcAteMes.value != ""){
                loadDiaSelect("slcAteDia", camposSolicitarFerias.slcAteMes.value, camposSolicitarFerias.slcAteAno.value)
            }
        }
        limparContarDias()
    })

    camposSolicitarFerias.slcAteAno.addEventListener("change", ()=>{
        loadMesSelect("slcAteMes",camposSolicitarFerias.slcAteAno.value,1)

        if(slcAteMes.value != ""){
            loadDiaSelect("slcAteDia", camposSolicitarFerias.slcAteMes.value, camposSolicitarFerias.slcAteAno.value)
        }
        limparContarDias()
    })
}

async function contarDiasDerias(){
        let deAno = camposSolicitarFerias.slcDeAno.value
        let deMes = camposSolicitarFerias.slcDeMes.value
        let deDia = camposSolicitarFerias.slcDeDia.value

        let ateAno = camposSolicitarFerias.slcAteAno.value
        let ateMes = camposSolicitarFerias.slcAteMes.value
        let ateDia = camposSolicitarFerias.slcAteDia.value

        let result = (await getnumDiasUteis(`${deAno}/${deMes}/${deDia}`, `${ateAno}/${ateMes}/${ateDia}`))
        let contarDias = document.getElementById("contarDias")
        contarDias.parentNode.classList.remove("hidder")
        contarDias.textContent = `${result} ${(result == 1 ? " dia" : "dias")}`
}

if(camposSolicitarFerias.slcAteDia){
    camposSolicitarFerias.slcAteDia.addEventListener("change", async ()=>{
        contarDiasDerias()
    })
}

if(camposSolicitarFerias.btnAddFeriasAlista){
    camposSolicitarFerias.btnAddFeriasAlista.addEventListener("click",async ()=>{
        if(camposSolicitarFerias.slcDeDia.value != "" && camposSolicitarFerias.slcDeMes.value != "" && camposSolicitarFerias.slcDeAno.value != "" && camposSolicitarFerias.slcAteDia.value != "" && camposSolicitarFerias.slcAteMes.value != "" && camposSolicitarFerias.slcAteAno.value != "" && camposSolicitarFerias.slcFeriasFuncionario.value != "" ){
            let slcTextFeriasFuncionario = camposSolicitarFerias.slcFeriasFuncionario.options[camposSolicitarFerias.slcFeriasFuncionario.selectedIndex]

            let deInicio = `${camposSolicitarFerias.slcDeDia.value}/${camposSolicitarFerias.slcDeMes.value}/${camposSolicitarFerias.slcDeAno.value}`
            let ateFim = `${camposSolicitarFerias.slcAteDia.value}/${camposSolicitarFerias.slcAteMes.value}/${camposSolicitarFerias.slcAteAno.value}`

            let resultFuncionario = await verListTable(slcTextFeriasFuncionario.text,"tbodyListSendFerias","rowList",1)
            let resultDe = await verListTable(deInicio,"tbodyListSendFerias","rowList",2)
            let resultAte = await verListTable(ateFim,"tbodyListSendFerias","rowList",3)

            if(resultDe && resultAte){
                msgAlert("alert-danger", "O periodo de ferias para esse funcionário já está na lista para ser enviado.")
            } else {
                if(containerSendFerias.classList.contains("hidder")){
                    containerSendFerias.classList.remove("hidder")
                }

                let teste = document.createElement("tr")
                teste.classList.add("rowList")
                teste.innerHTML = `<td></td>
                                    <td data-id-colaborador='${camposSolicitarFerias.slcFeriasFuncionario.value}'>${slcTextFeriasFuncionario.text}</td>
                                    <td>${camposSolicitarFerias.slcDeDia.value}/${camposSolicitarFerias.slcDeMes.value}/${camposSolicitarFerias.slcDeAno.value}</td>
                                    <td>${camposSolicitarFerias.slcAteDia.value}/${camposSolicitarFerias.slcAteMes.value}/${camposSolicitarFerias.slcAteAno.value}</td>
                                    <td><i class='bi bi-trash btn tbn-sm btn-outline-info' onclick='excluirItemList(event,"rowList")'></i></td>`
                               
                tbodyListSendFerias.appendChild(teste)
            }

        } else {
            msgAlert("alert-danger", "Existe campos vazios nas datas que precisam ser prenhecidas")
        }
    })
}

if(camposSolicitarFerias.btnCancelarEnvioFerias){
    camposSolicitarFerias.btnCancelarEnvioFerias.addEventListener("click", ()=>{
        limparContarDias()
        limparCampoSolicitarFerias()
        containerNovaFerias.classList.add("hidder")
        containerSendFerias.classList.add("hidder")
    })
}

if(camposSolicitarFerias.btnEnviarEnvioFerias){
    camposSolicitarFerias.btnEnviarEnvioFerias.addEventListener("click",async ()=>{
        if(tbodyListSendFerias.querySelectorAll("rowList").length == 0){
            msgAlert("alert-danger", "A lista de férias está vazia, primeiro monte a lista para poder enviar.")
        } else {
            let result = await sendListFerias()
            if(result == 1){
                tbodyListSendFerias.querySelectorAll(".rowList").forEach(item=>{
                    item.cells[0].textContent = "Enviado"
                })
            }
        }
    })
}


// console.log(getnumDiasUteis('2025-01-01', '2025-01-31'))