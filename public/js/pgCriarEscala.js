window.addEventListener("DOMContentLoaded",async function(){
    try {
        let dataAtual = new Date()
        await  loadAnoSelect("slcFilterAno")
        await loadMesSelect("slcFilterMes", slcFilterAno.value, 0)

        slcFilterAno.value = dataAtual.getFullYear()
        slcFilterMes.value = dataAtual.getMonth() + 1

    } catch (error) {
        //fazer erro
    }
})

async function colorDiaEscala() {
    document.querySelectorAll(".slcEsclherDia").forEach(item=>{
        item.addEventListener("change", ()=>{
            switch(item.value){
                case "M":
                    item.classList.add("manha")
    
                    item.classList.remove("intermedio")
                    item.classList.remove("tarde")
                    item.classList.remove("folga")
                    item.classList.remove("ferias")
                    item.classList.remove("feriado")
                break
    
                case "I":
                    item.classList.add("intermedio")
    
                    item.classList.remove("manha")
                    item.classList.remove("tarde")
                    item.classList.remove("folga")
                    item.classList.remove("ferias")
                    item.classList.remove("feriado")
                break
    
                case "T":
                    item.classList.add("tarde")
    
                    item.classList.remove("manha")
                    item.classList.remove("intermedio")
                    item.classList.remove("folga")
                    item.classList.remove("ferias")
                    item.classList.remove("feriado")
                break
    
                case "FG":
                    item.classList.add("folga")
    
                    item.classList.remove("manha")
                    item.classList.remove("intermedio")
                    item.classList.remove("tarde")
                    item.classList.remove("ferias")
                    item.classList.remove("feriado")
                break
    
                case "FR":
                    item.classList.add("ferias")
    
                    item.classList.remove("manha")
                    item.classList.remove("intermedio")
                    item.classList.remove("tarde")
                    item.classList.remove("folga")
                    item.classList.remove("feriado")
                break
    
                case "FD":
                    item.classList.add("feriado")
    
                    item.classList.remove("manha")
                    item.classList.remove("intermedio")
                    item.classList.remove("tarde")
                    item.classList.remove("folga")
                    item.classList.remove("ferias")
                break
    
                default:
                    item.classList.remove("manha")
                    item.classList.remove("intermedio")
                    item.classList.remove("tarde")
                    item.classList.remove("folga")
                    item.classList.remove("ferias")
                    item.classList.remove("feriado")
                break
            }
        })
    })
    
}

let tbodyCriarEscala = document.getElementById("tbodyCriarEscala")
let valorResponsavel = 0

async function selectDiaEscla(){
    document.querySelectorAll(".slcEsclherDia").forEach(item=>{
        item.addEventListener("change", ()=>{
    
            if(item.parentNode.parentNode.querySelector(".slcEscalaColaborador").value == ""){
                msgAlert("alert-danger","Essa linha ainda não foi atribuida um colaborador, então escolha um colaborador.")
                item.value = ""
            }
            
            let numberColuna = item.getAttribute("data-row-dia")
            
            let valorM = 0
            let valorI = 0
            let valorT = 0
            let valorFG = 0
            let valorFR = 0
            let valorFD = 0
    
            let campoManha = document.querySelector(".rowListFoot").cells[numberColuna].querySelector(".qtdManha")
            let campoIntermedio = document.querySelector(".rowListFoot").cells[numberColuna].querySelector(".qtdIntermedio")
            let campoTarde = document.querySelector(".rowListFoot").cells[numberColuna].querySelector(".qtdTarde")
            let campoFolga = document.querySelector(".rowListFoot").cells[numberColuna].querySelector(".qtdFolga")
            let campoFerias = document.querySelector(".rowListFoot").cells[numberColuna].querySelector(".qtdFerias")
            let campoFeriado = document.querySelector(".rowListFoot").cells[numberColuna].querySelector(".qtdFeriado")
    
            let ag = []
            tbodyCriarEscala.querySelectorAll(".rowList").forEach(element=>{
                let pegarResponsavel = element.cells[0]
    
                if(pegarResponsavel.getAttribute("data-responsavel") == 1 ){
                    ag.push(element.cells[numberColuna].querySelector(".slcEsclherDia").value)
                }
            })
    
            console.log(ag)
            let arrayLimpo = ag.filter(x => x)
            console.log(arrayLimpo)
            if(arrayLimpo.length >= 2){

                if(arrayLimpo[0] == arrayLimpo[1] && arrayLimpo[0] == "FG" && arrayLimpo[1] == "FG"){
                    document.querySelectorAll(".rowList").forEach(item=>{
                        item.cells[numberColuna].classList.add("bgRed")
                    })
                    msgAlert("alert-warning","Exite dois responsáveis de loja de folga no mesmo dia. Por motivo de boas maneiras isso não pode acontecer.")
                } else {
                    document.querySelectorAll(".rowList").forEach(item=>{
                        item.cells[numberColuna].classList.remove("bgRed")
                    })
                }

            }
    
            tbodyCriarEscala.querySelectorAll(".rowList").forEach(element=>{
                if(element.cells[numberColuna].querySelector(".slcEsclherDia").value == "M"){
                    valorM ++
                }
            })
    
            tbodyCriarEscala.querySelectorAll(".rowList").forEach(element=>{
                if(element.cells[numberColuna].querySelector(".slcEsclherDia").value == "I"){
                    valorI ++
                }
            })
    
            tbodyCriarEscala.querySelectorAll(".rowList").forEach(element=>{
                if(element.cells[numberColuna].querySelector(".slcEsclherDia").value == "T"){
                    valorT ++
                }
            })
    
            tbodyCriarEscala.querySelectorAll(".rowList").forEach(element=>{
                if(element.cells[numberColuna].querySelector(".slcEsclherDia").value == "FG"){
                    valorFG ++
                }
            })
    
            tbodyCriarEscala.querySelectorAll(".rowList").forEach(element=>{
                if(element.cells[numberColuna].querySelector(".slcEsclherDia").value == "FR"){
                    valorFR ++
                }
            })
    
            tbodyCriarEscala.querySelectorAll(".rowList").forEach(element=>{
                if(element.cells[numberColuna].querySelector(".slcEsclherDia").value == "FD"){
                    valorFD ++
                }
            })
    
            campoManha.textContent = valorM
            campoIntermedio.textContent = valorI
            campoTarde.textContent = valorT
            campoFolga.textContent = valorFG
            campoFerias.textContent = valorFR
            campoFeriado.textContent = valorFD
    
            if(Number(campoManha.textContent) > 0){
                campoManha.parentNode.classList.remove("hidder")
            } else {
                campoManha.parentNode.classList.add("hidder")
            }
    
            if(Number(campoIntermedio.textContent) > 0){
                campoIntermedio.parentNode.classList.remove("hidder")
            } else {
                campoIntermedio.parentNode.classList.add("hidder")
            }
    
            if(Number(campoTarde.textContent) > 0){
                campoTarde.parentNode.classList.remove("hidder")
            } else {
                campoTarde.parentNode.classList.add("hidder")
            }
    
            if(Number(campoFolga.textContent) > 0){
                campoFolga.parentNode.classList.remove("hidder")
            } else {
                campoFolga.parentNode.classList.add("hidder")
            }
    
            if(Number(campoFerias.textContent) > 0){
                campoFerias.parentNode.classList.remove("hidder")
            } else {
                campoFerias.parentNode.classList.add("hidder")
            }
    
            if(Number(campoFeriado.textContent) > 0){
                campoFeriado.parentNode.classList.remove("hidder")
            } else {
                campoFeriado.parentNode.classList.add("hidder")
            }
            
        })
    })
}

async function loadCriarEscala(ano, mes) {
    try {

        let semana = ["DOM", "SEG", "TER", "QUA", "QUI", "SEX", "SAB"]
        let tbodyCriarEscala = document.getElementById("tbodyCriarEscala")
        tbodyCriarEscala.innerHTML = ""
        let dataAtual = new Date()
        let criarDiaSemana = document.createElement("tr")
        criarDiaSemana.classList.add("rowListSemana")

        let anoValue = (ano || dataAtual.getFullYear()) 
        let mesValue = (mes || dataAtual.getMonth() + 1)

        let x = new Date(anoValue, mesValue, 0)
        let y = ""
        
        let z = document.createElement("td")
        z.textContent = "Colaborador"
        criarDiaSemana.append(z)

        let pa = null
        for(let i = 1 ; i <= x.getDate() ; i++){
            y = new Date(anoValue, mesValue -1, i)
            let a = document.createElement("td")

            if(y.getDay() == 6 || y.getDay() == 0){
                pa = "pintar"
            } else {
                pa = null
            }
            
            a.classList.add(pa)
            a.classList.add("diaSemana")
            a.innerHTML = semana[y.getDay()]
            criarDiaSemana.append(a)
        }
        
        tbodyCriarEscala.appendChild(criarDiaSemana)

        let nome = [
            {"colaborador" : "Colaborador 1", "responsavel" : 0},
            {"colaborador" : "Colaborador 2", "responsavel" : 1},
            {"colaborador" : "Colaborador 3", "responsavel" : 0},
            {"colaborador" : "Colaborador 4", "responsavel" : 0},
            {"colaborador" : "Colaborador 5", "responsavel" : 1},
        ]

        //retorno da funcao com as ferias
        let ferias = [
            {"colaborador" : "Colaborador 1", "feriasInicio" : "2025-05-20", "feriasFim" : "2025-06-10"},
            {"colaborador" : "Colaborador 1", "feriasInicio" : "2025-06-17", "feriasFim" : "2025-06-22"},
            {"colaborador" : "Colaborador 2", "feriasInicio" : "2025-06-05", "feriasFim" : "2025-06-10"},
        ]

        let pintar = null
        let responsavel = null
        //pegar cada funcionario para montar a escala
        for(let i = 0 ; i < nome.length ; i++){
            let b = document.createElement("tr")
            b.classList.add("rowList")

            responsavel = (nome[i]["responsavel"] == 1 ? "responsavel" : "")

            b.innerHTML = `<td class='slcEscalaColaborador ${responsavel}' data-responsavel='${nome[i]["responsavel"]}'>${nome[i]["colaborador"]}</td>`
            
            let meu = document.querySelector(".rowListSemana")
                    
            //roda o for para monstar cada dia
            for (let a = 1; a <= x.getDate() ; a++) {
                if(meu.cells[a].textContent == "SAB" || meu.cells[a].textContent == "DOM"){
                    pintar = "pintar"
                } else {
                    pintar = null
                }

                
                let da = ""
                let de = ""
                if(nome[i]["feriasInicio"] || nome[i]["feriasFim"]){
                    da = (nome[i]["feriasInicio"]).split("-")
                    de = (nome[i]["feriasFim"]).split("-")
                }

                let selectValueFerias = ""
                let classFerias = ""

                //marca os dias de ferias
                for(let b = 0 ; b < ferias.length ; b++){
                    let ca = (ferias[b]["feriasInicio"]).split("-")
                    let ce = (ferias[b]["feriasFim"]).split("-")

                    if(ferias[b]["colaborador"] == nome[i]["colaborador"] && (ca[0]+ca[1]) == `${anoValue}${String(mesValue).padStart(2,0)}` || ferias[b]["colaborador"] == nome[i]["colaborador"] && (ce[0]+ce[1]) == `${anoValue}${String(mesValue).padStart(2,0)}`){
                        let zaInicio = (ferias[b]["feriasInicio"]).split("-")
                        let zaFim = (ferias[b]["feriasFim"]).split("-")

                        if(`${zaInicio[0]}${zaInicio[1]}${zaInicio[2]}` <= `${anoValue}${String(mesValue).padStart(2,0)}${String(a).padStart(2,0)}` && `${zaFim[0]}${zaFim[1]}${zaFim[2]}` >= `${anoValue}${String(mesValue).padStart(2,0)}${String(a - 1).padStart(2,0)}}`){
                            console.log("0")
                            selectValueFerias = "selected"
                            classFerias = "ferias"
                        }
                    }
                }

                //monsta os dias
                let ab = document.createElement("td")
                ab.classList.add(pintar)
                ab.innerHTML = `<select id='' class='slcEsclherDia ${classFerias}' data-row-dia='${a}'>
                                            <option value=''></option>
                                            <option value='M'>M</option>
                                            <option value='I'>I</option>
                                            <option value='T'>T</option>
                                            <option value='FG'>FG</option>
                                            <option value='FR'${selectValueFerias}>FR</option>
                                            <option value='FD'>FD</option>
                                        </select>`
                b.appendChild(ab)
            }
            tbodyCriarEscala.appendChild(b)
        }

        await selectDiaEscla()
        await colorDiaEscala()




    } catch (error) {
        console.log(error)
        msgAlert("alert-danger","Houve um erro ao criar escala, atualize a página." + error)
    }
}

function limparCriartabela(){
    document.querySelectorAll(".qtdManha").forEach(item=>{
        item.textContent = ""
    })

    document.querySelectorAll(".qtdIntermedio").forEach(item=>{
        item.textContent = ""
    })

    document.querySelectorAll(".qtdTarde").forEach(item=>{
        item.textContent = ""
    })

    document.querySelectorAll(".qtdFolga").forEach(item=>{
        item.textContent = ""
    })

    document.querySelectorAll(".qtdFerias").forEach(item=>{
        item.textContent = ""
    })

    document.querySelectorAll(".qtdFeriado").forEach(item=>{
        item.textContent = ""
    })

    document.querySelectorAll(".spanQTDManha").forEach(item=>{
    item.classList.add("hidder")
    })

    document.querySelectorAll(".spanQTDIntermedio").forEach(item=>{
    item.classList.add("hidder")
    })
    
    document.querySelectorAll(".spanQTDtarde").forEach(item=>{
    item.classList.add("hidder")
    })
    
    document.querySelectorAll(".spanQTDFolga").forEach(item=>{
    item.classList.add("hidder")
    })
    
    document.querySelectorAll(".spanQTDFerias").forEach(item=>{
    item.classList.add("hidder")
    })
    
    document.querySelectorAll(".spanQTDFeriado").forEach(item=>{
    item.classList.add("hidder")
    })


}

let slcAnoNovaEscala = document.getElementById("slcAnoNovaEscala")
if(slcAnoNovaEscala){
    slcAnoNovaEscala.addEventListener("change",async ()=>{
        await loadMesSelect("slcMesNovaEscala", slcAnoNovaEscala.value,0)
    })
}

let slcMesNovaEscala = document.getElementById("slcMesNovaEscala")
if(slcMesNovaEscala){
    slcMesNovaEscala.addEventListener("change", async ()=>{
        if(slcAnoNovaEscala.value == ""){
            msgAlert("alert-danger", "Primeiro selecione o ano.")
            slcMesNovaEscala.value = ""
        } else {
            loadCriarEscala(slcAnoNovaEscala.value, slcMesNovaEscala.value)
            limparCriartabela()
        }
    })
}

let containerNovaEscala = document.getElementById("containerNovaEscala")
let btnCancelarEscala = document.getElementById("btnCancelarEscala")
if(btnCancelarEscala){
    btnCancelarEscala.addEventListener("click", ()=>{
        containerNovaEscala.classList.add("hidder")

        slcAnoNovaEscala.value = ""
        slcMesNovaEscala.value = ""
    })
}

let btnCriarEscala= document.getElementById("btnCriarEscala")
if(btnCriarEscala){
    btnCriarEscala.addEventListener("click",async ()=>{
        containerNovaEscala.classList.remove("hidder")

        let dataAtual = new Date()
        await loadCriarEscala()
        await loadAnoSelect("slcAnoNovaEscala")
        await loadMesSelect("slcMesNovaEscala", dataAtual.getFullYear(),0)
        limparCriartabela()

        slcAnoNovaEscala.value = dataAtual.getFullYear()
        slcMesNovaEscala.value = dataAtual.getMonth() + 1 

    })
}

let slcFilterAno = document.getElementById("slcFilterAno")
if(slcFilterAno){
    slcFilterAno.addEventListener("change", ()=>{
        loadMesSelect("slcFilterMes", slcFilterAno.value,1)
    })
}

let slcFilterMes = document.getElementById("slcFilterMes")
if(slcFilterMes){
    slcFilterMes.addEventListener("change", ()=>{
        //chamar func para mostar escala
    })
}