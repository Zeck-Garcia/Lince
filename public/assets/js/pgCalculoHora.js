$(document).ready(async()=>{
    
})
//cores dos l1 l2 L alguma cosia
function listCorL(id){
    let corL = ["#1409a9", "#0ea0c9", "#3d0fa8", "#d09216", "#2dd378", "#556B2F", "#7A7A00", "#018790", "#9e0b41", "#ed0982"]
    return corL[id]
}

//cores da legenda
function listCorFFF(id){
    let corFFF = ["#b40707", "#c36207", "#058c90"]
    return corFFF[id]
}

function monteRegras(){
    try {
        let containerRegras = document.getElementById("containerRegras")
        containerRegras.innerHTML = ''

        //duas picagem
        let newLegend2Picagem = document.createElement("div")
        newLegend2Picagem.classList.add("col-md-2")
        newLegend2Picagem.innerHTML = `<div class="form-floating">
                                        <select class="form-select" id="slc2Picagem">
                                            <option value="0">Não</option>
                                            <option value="1" selected>Sim</option>
                                        </select>
                                        <label for="">Contar 2 Picagem</label>
                                    </div>`
        containerRegras.append(newLegend2Picagem)
        
        //imprimir indiferente
        let newLegendImpirmirIndiferente = document.createElement("div")
        newLegendImpirmirIndiferente.classList.add("col-md-2")
        newLegendImpirmirIndiferente.innerHTML = `<div class="form-floating">
                                <select class="form-select" id="slcImprimirIndiferente">
                                    <option value="0" selected>Não</option>
                                    <option value="1">Sim</option>
                                </select>
                                <label for="">Exibir Indefinido</label>
                            </div>`
        containerRegras.append(newLegendImpirmirIndiferente)
        
        //calcular saida
        let newLegendCalcularSaida = document.createElement("div")
        newLegendCalcularSaida.classList.add("col-md-2")
        newLegendCalcularSaida.innerHTML = `<div class="form-floating">
                                <select class="form-select" id="slcCalcularTempo">
                                    <option value="0">Não</option>
                                    <option value="1" selected>Sim</option>
                                </select>
                                <label for="">Calc Int. Auto.</label>
                            </div>`
        containerRegras.append(newLegendCalcularSaida)
        
        //compensar tempo
        let newLegendTCompensar = document.createElement("div")
        newLegendTCompensar.classList.add("col-md-3")
        newLegendTCompensar.innerHTML = `<div class="form-floating">
                                <select class="form-select" id="slcCompensarTempo">
                                    <option value='0' selected>Selecione</option>
                                    <option value='7'>Totalidade</option>
                                    <option value='1'>Metade ½</option>
                                    <option value='2'>Um Terço ⅓</option>
                                    <option value='3'>Dois Terços ⅔</option>
                                    <option value='4'>Um Quarto ¼</option>
                                    <option value='5'>Três Quartos ¾</option>
                                    <option value='6'>Um Quinto ⅕</option>
                                </select>
                                <label for="">Compensar Hora</label>
                            </div>`
        containerRegras.append(newLegendTCompensar)

        //jornada de trabalho
        let newLegendTJornada = document.createElement("div")
        newLegendTJornada.classList.add("col-md-3")
        
        let newDivTJornada = document.createElement("div")
        newDivTJornada.classList.add("form-floating")

        let newLegendTJornadaLabel = document.createElement("label")
        newLegendTJornadaLabel.textContent = "Jornada de Trabalho"

        let newLegendTJornadaSlc = document.createElement("select")
        newLegendTJornadaSlc.id = 'txtHTrabalho'
        newLegendTJornadaSlc.classList.add("form-select")
        newLegendTJornadaSlc.id = 'txtHTrabalho'

        let qtdTempoJornadaTrabalho = 24
        for(let i = 3 ; i < qtdTempoJornadaTrabalho ; i++){
            let newLegendTJornadaOption = document.createElement("option")
            newLegendTJornadaOption.textContent = `${i <= 9 ? '0'+i : i}:00`
            newLegendTJornadaOption.value = `${i <= 9 ? '0'+i : i}:00`
            if(i == 8){
                newLegendTJornadaOption.setAttribute("selected", true)
            }
            newLegendTJornadaSlc.append(newLegendTJornadaOption)
        }
        newDivTJornada.append(newLegendTJornadaSlc)
        newDivTJornada.append(newLegendTJornadaLabel)
        newLegendTJornada.append(newDivTJornada)
        containerRegras.append(newLegendTJornada)

        let slcImprimirIndiferente = document.getElementById("slcImprimirIndiferente")
        if(slcImprimirIndiferente){
            slcImprimirIndiferente.addEventListener("change", ()=>{
                if(slcImprimirIndiferente.value == 0){
                    document.querySelectorAll(".row-subtable").forEach(item=>{
                        item.classList.remove("no-print")
                        let linha = item.cells[10].querySelector("tbody tr td")
                        if(linha && linha.textContent == 'INDEFINIDO'){
                            item.classList.add("no-print")
                            item.classList.add("d-none")
                        }
                    })
                } else {
                    document.querySelectorAll(".row-subtable").forEach(item=>{
                        item.classList.remove("d-none")
                        item.classList.remove("no-print")
                    })
                }
            })
        }
    } catch (error) {
        console.log(error)
    }
}

function monteTempo(){
    try {
        let containerTempo = document.getElementById("containerTempo")
        containerTempo.innerHTML = ''
        
        //tempo jornada de trabalho
        let newLegendTJornada = document.createElement("div")
        newLegendTJornada.classList.add("col-md-3")
        
        let newLegendAlmoco = document.createElement("div")
        newLegendAlmoco.classList.add("form-floating")

        let newLegendAlmocoLabel = document.createElement("label")
        newLegendAlmocoLabel.textContent = 'Tempo Almoço em (min)'

        let newLegendAlmocoSlc = document.createElement("select")
        newLegendAlmocoSlc.classList.add("form-select")
        newLegendAlmocoSlc.id = "slcTAlmoco"
        
        let QtdOptionTAlmoco = 150
        for(let i = 30 ; i <= QtdOptionTAlmoco; i+= 10){
            let newLegendAlmocoOption = document.createElement("option")
            newLegendAlmocoOption.textContent = i
            newLegendAlmocoOption.value = i
            if(i == 60){
                newLegendAlmocoOption.setAttribute("selected", true)
            }
            newLegendAlmocoSlc.append(newLegendAlmocoOption)
        }

        newLegendAlmoco.append(newLegendAlmocoSlc)
        newLegendAlmoco.append(newLegendAlmocoLabel)
        newLegendTJornada.append(newLegendAlmoco)
        containerTempo.append(newLegendTJornada)
        

        //ferias
        let newLegend = document.createElement("div")
        newLegend.classList.add("col-md-3")
        newLegend.id = 'contaierLegendFFF'
        newLegend.innerHTML = `<div class="d-flex align-items-center justify-content-center gap-2 border py-1 px-0 rounded-3">
                <div class="row m-1">
                    <span class="badge legend" style="background: ${listCorFFF(0)}; color: #fff;">HFLG</span>
                    <small>Folga</small>
                </div>
                <div class="row m-1">
                    <span class="badge legend" style="background: ${listCorFFF(1)}; color: #fff;">FE</span>
                    <small>Ferias</small>
                </div>
                <div class="row m-1">
                    <span class="badge legend" style="background: ${listCorFFF(2)}; color: #fff;">FD</span>
                    <small>Feriado</small>
                </div>
            </div>`
        containerTempo.append(newLegend)
        
        let totalLegend = 6
        for(let a = 1 ; a <= totalLegend ; a++){
            let createDiv = document.createElement("div")
            createDiv.classList.add("col-md-3")

            createDiv.innerHTML = `<div class="d-flex align-items-center justify-content-center gap-2 border py-2 px-0 rounded-3 groupLengend">
                                        <div class="">
                                            <span class="badge legend" style="background: ${listCorL(a)}; color: #fff;">L${a}</span>
                                        </div>
                                        <div class="">
                                            <select class="form-select tempoCorrido" id="slcLDe-${a}">
                                            </select>
                                        </div>

                                        <div class="">
                                            <select class="form-select tempoCorrido" id="slcLAte-${a}">
                                            </select>
                                        </div>
                                    </div>`

            containerTempo.append(createDiv)

            document.querySelectorAll(".tempoCorrido").forEach(item=>{
                item.innerHTML = ''
                let newItemEmpty = document.createElement("option")
                newItemEmpty.value = ""
                item.append(newItemEmpty)

                let fimHora = 24
                for(let i = 6 ; i < fimHora ; i++){
                    for(let x = 0 ; x < 60 ; x += 15){
                        let newItem = document.createElement("option")
                        let minuto = x.toString().padStart(2, '0')
                        newItem.value = `${i}:${minuto}`
                        newItem.textContent = `${i}:${minuto}`
                        item.append(newItem)
                    }
                }
            })
            containerTempo.append(createDiv)
        }

        let slcTAlmoco = document.getElementById("slcTAlmoco")
        if(slcTAlmoco){
            slcTAlmoco.addEventListener("change", ()=>{
                contarTempoTrabalho(slcTAlmoco, false)
            })
        }

        document.querySelectorAll(".tempoCorrido").forEach(element=>{
            element.addEventListener("change", ()=>{
                contarTempoTrabalho(element, false)
            })
        })

        return totalLegend
    } catch (error) {
        console.log(error)
    }
}

//voltar e rever isso
function contarTempoTrabalho(element, action){
    try {
        console.log(element)
        let txtHTrabalho = document.getElementById("txtHTrabalho")
        let tempoFrente = converteHoraMinuto(txtHTrabalho.value) || 480
        let slcCalcularTempo = document.getElementById("slcCalcularTempo")
        let [nome, id] = element.id.split("-")
        
        if(nome == "slcTAlmoco"){
            console.log("A")
            //aqui eh quando o tempo de almoco e alterado
            let tempoAlmo = element.value =! "" ? Number(element.value) : 0
            document.querySelectorAll(".tempoCorrido").forEach(item=>{
                let [nome, id] = item.id.split("-")
                let campoDe = document.getElementById(`slcLDe-${id}`)
                let valorL = converteHoraMinuto(campoDe ?.value || 0)

                if(slcCalcularTempo.value == 1 && campoDe.value != '' && nome == 'slcLAte'){
                    document.getElementById(`slcLAte-${id}`).value = converteMinutoHora(valorL + tempoFrente + tempoAlmo)
                    criarOptionValorParaSLCL(item, 0)
                }
            })
        } else {
            console.log("B")
            //aqui eh quando o tempo eh mudado direto no L
            let nomeCampoMuda = (nome == 'slcLDe' ? 'slcLAte' : 'slcLDe' )
            if(slcCalcularTempo.value == 1){
                valorParaSLCL(element)
            } else {
                document.getElementById(`${nomeCampoMuda}-${id}`).value = ''
            }
        }
    } catch (error) {
        console.log(error)
    }
}

function valorParaSLCL(element){
    try {
        let txtHTrabalho = document.getElementById("txtHTrabalho")
        let campoDe = element ?.value || 0
        let slcTAlmoco = document.getElementById("slcTAlmoco") ?.value || 0
        let [nome, id] = element.id.split("-")
        let tempoFrente = converteHoraMinuto(txtHTrabalho.value) || 480

        let campoMuda = (nome == 'slcLDe' ? 'slcLAte' : 'slcLDe' )
        let nomeCampoMuda = ""
        let oQFaz = ''

        if(nome == 'slcLDe'){
            nomeCampoMuda = 'slcLAte'
            oQFaz = tempoFrente + Number(slcTAlmoco) + converteHoraMinuto(campoDe)
        } else {
            nomeCampoMuda = 'slcLDe'
            oQFaz = (converteHoraMinuto(campoDe) - tempoFrente - Number(slcTAlmoco))
        }
        criarOptionValorParaSLCL(element,1)
    } catch (error) {
        console.log(error)
    }
}

//refazer calculo
function criarOptionValorParaSLCL(element, cod){
    try {
        let campoDe = element ?.value || 0
        let slcTAlmoco = document.getElementById("slcTAlmoco") ?.value || 0
        let [nome, id] = element.id.split("-")
        let tempoFrente = converteHoraMinuto(txtHTrabalho.value) || 480

        console.log(campoDe)
    
        if(nome == 'slcLDe'){
            nomeCampoMuda = `slcLAte`
            oQFaz = tempoFrente + Number(slcTAlmoco) + converteHoraMinuto(campoDe)
        } else if(nome == 'slcTAlmoco'){
            console.log('A')
            nomeCampoMuda = `slcLAte`
            oQFaz = tempoFrente + Number(slcTAlmoco) + converteHoraMinuto(campoDe)
        } else {
            console.log('CC')
            nomeCampoMuda = `slcLDe`
            oQFaz = (converteHoraMinuto(campoDe) - tempoFrente - Number(slcTAlmoco))
        }

        if(cod == 0){
            //o de fica o mesmo valor e nao altera
            //document.getElementById(`slcAte-${id}`).value = converteMinutoHora(oQFaz)
        } else {
            //pode passar para ver o que faz
        }

        let getOption = Array.from(document.getElementById(`${nomeCampoMuda}-${id}`).options)

        let optionExiste = getOption.some(opt => opt.value == converteMinutoHora(oQFaz))

        if(optionExiste){
            // console.log("+" + nomeCampoMuda)
            document.getElementById(`${nomeCampoMuda}-${id}`).value = converteMinutoHora(oQFaz)
        } else {
            // console.log("-" + nomeCampoMuda)
            let criaOption = document.createElement("option")
            criaOption.value = converteMinutoHora(oQFaz)
            criaOption.textContent = converteMinutoHora(oQFaz)
            criaOption.setAttribute("selected", true)
            document.getElementById(`${nomeCampoMuda}-${id}`).append(criaOption)
        }

    } catch (error) {
        console.log(error)
    }
}

//ler a escala para e trata os dados para repassar
function lerEscala(texto){
    try {
        let linhas = texto.split(/\r?\n/).filter(l => l.trim() != "")
        let resultadoFinal = []

        for (let i = 0; i < linhas.length; i++) {
            let colunas = linhas[i].split(",")

            let idColaborador = colunas[33]?.replace(/"/g, "").trim()
            let nomeColaborador = colunas[34]?.replace(/"/g, "").trim()

            if (idColaborador && !isNaN(idColaborador)) {
                let turnosDoColaborador = []

                for (let a = 34; a < colunas.length; a++) {
                    let valorCelula = colunas[a]?.replace(/"/g, "").trim()

                    if(valorCelula.length < 5){
                        turnosDoColaborador.push({
                            dia: a - 33,
                            turno: valorCelula
                        })
                    }
                }

                if (turnosDoColaborador.length > 0) {
                    resultadoFinal.push({
                        id: idColaborador,
                        nome: nomeColaborador,
                        escalas: turnosDoColaborador
                    })
                }
            }
        }

        criarEscala(resultadoFinal)
        return resultadoFinal
    } catch (error) {
        console.log(error)
    }
}

//monta a escala
function criarEscala(result){
    try {
        monteRegras()
        let totalSelect = monteTempo()
        let dataAtual = new Date()

        loadCriarEscala(dataAtual.getFullYear(), dataAtual.getMonth() + 1)

        let tbodyCriarEscala = document.getElementById("tbodyCriarEscala")
        tbodyCriarEscala.textContent = ''

        console.log(result)
        result.forEach(item=>{
            let newTR = document.createElement("tr")
            newTR.classList.add("rowList")
            newTR.innerHTML = `<td class="text-center" data-id-cod-colaborador='${item.id}'><small>${item.nome}<br>- ${item.id}</small></td>`

            item.escalas.forEach((element, index) => {
                let newTD = document.createElement("td")
                let newSelect = document.createElement("select")
                newSelect.classList.add("form-control")
                newSelect.setAttribute("style", "font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;")
                
                let newItemEmpty = document.createElement("option")
                newItemEmpty.textContent = ''
                newSelect.append(newItemEmpty)
                
                for(let i = 1 ; i <= totalSelect ; i++){
                    let newOption = document.createElement("option")
                    newOption.textContent = `L${i}`
                    newOption.value = `L${i}`
                    if(element.turno == newOption.value){
                        newOption.setAttribute("selected", true)
                    }   
                    newSelect.append(newOption)
                }
                
                let newOptionFolga = document.createElement("option")
                newOptionFolga.textContent = `HFLG`
                newOptionFolga.value = `HFLG`
                if(element.turno == newOptionFolga.value){
                    newOptionFolga.setAttribute("selected", true)
                }
                newSelect.append(newOptionFolga)

                let newOptionFerias = document.createElement("option")
                newOptionFerias.textContent = `FE`
                newOptionFerias.value = `FE`
                if(element.turno == newOptionFerias.value){
                    newOptionFerias.setAttribute("selected", true)
                }
                newSelect.append(newOptionFerias)

                let newOptionFeriado = document.createElement("option")
                newOptionFeriado.textContent = `FD`
                newOptionFeriado.value = `FD`
                if(element.turno == newOptionFeriado.value){
                    newOptionFeriado.setAttribute("selected", true)
                }
                newSelect.append(newOptionFeriado)

                newTD.append(newSelect)
                newTR.append(newTD)
            })
            
            tbodyCriarEscala.append(newTR)
        })

        tbodyCriarEscala.querySelectorAll("select").forEach(item=>{
            document.querySelectorAll(".legend").forEach(elementL => {
                if(item.value == elementL.textContent){
                    let conj = item.getAttribute("style") + elementL.getAttribute("style")
                    item.setAttribute("style", item.getAttribute("style") + elementL.getAttribute("style"))
                }
            })
        })

        tbodyCriarEscala.querySelectorAll("select").forEach(item=>{
            item.addEventListener("change", ()=>{
                document.querySelectorAll(".legend").forEach(elementL => {
                    if(item.value == elementL.textContent){
                        item.setAttribute("style", item.getAttribute("style") + elementL.getAttribute("style"))
                    }

                    if(item.value == ""){
                       item.removeAttribute("style")
                    }
                })
            })
        })
        
    } catch (error) {
        console.log(error)
    }
}

//monta escala
function loadCriarEscala(ano, mes) {
    try {
        let tableCriarEscala = document.getElementById("tableCriarEscala")
        if(tableCriarEscala.querySelector("thead")){
            tableCriarEscala.querySelector("thead").remove()
        }

        let semana = ["DOM", "SEG", "TER", "QUA", "QUI", "SEX", "SAB"]

        let newThead = document.createElement("thead")
        let newTrTDia = document.createElement("tr")
        
        let newTdTDia = document.createElement("td")
        newTdTDia.innerHTML = `
                                <select id="slcAnoNovaEscala" class="form-control" style="font-size: 12px !important; height: 27px !important; width: 60px !important; padding: 0 5px !important;">
                                    <option value="">2025</option>
                                </select>

                                <select id="slcMesNovaEscala" class="form-control" style="font-size: 12px !important; height: 27px !important; width: 60px !important; padding: 0 5px !important;">
                                    <option value="">JAN</option>
                                </select>`
        newTrTDia.append(newTdTDia)

        let dataAtual = new Date()
        let criarDiaSemana = document.createElement("tr")
        criarDiaSemana.classList.add("rowListSemana")

        let anoValue = (ano || dataAtual.getFullYear())
        let mesValue = (mes || dataAtual.getMonth() + 1)

        let dataMes = new Date(anoValue, mesValue, 0)
        let diaSemana = ""

        let newTD = document.createElement("td")
        newTD.innerHTML = `<span class="fw-bold" style='font-size: 10px;'>Semana</span>`
        criarDiaSemana.append(newTD)

        for (let i = 1; i <= dataMes.getDate(); i++) {
            diaSemana = new Date(anoValue, mesValue - 1, i)
            let a = document.createElement("td")

            let newdiaMes = document.createElement("td")
            newdiaMes.innerHTML = `<span style='font-size: 12px;'>${i}</span>`

            if (diaSemana.getDay() == 6 || diaSemana.getDay() == 0) {
                newdiaMes.classList.add("bg-danger", "text-white")
                a.classList.add("bg-danger", "text-white")
            }

            a.innerHTML = `<span style='font-size: 10px;'>${semana[diaSemana.getDay()]}</span>`
            criarDiaSemana.append(a)

            newTrTDia.append(newdiaMes)
        }

        newThead.appendChild(newTrTDia)
        newThead.appendChild(criarDiaSemana)
        tableCriarEscala.insertBefore(newThead, tableCriarEscala.querySelector("tbody"))

        let slcMesNovaEscala = document.getElementById("slcMesNovaEscala")

        loadAnoSelect("slcAnoNovaEscala", ano)
        loadMesSelect("slcMesNovaEscala", slcMesNovaEscala.value, 0, mes)

        if(slcMesNovaEscala){
            slcMesNovaEscala.addEventListener("change", ()=>{
                loadCriarEscala(ano, slcMesNovaEscala.value)
            })
        }
        
        //ler o arquivo de novo
    } catch (error) {
        console.log(error)
    }
}

//pega a escala e trata os dados e envia para carregar a tabela
function getEscala(){
    try {
        let getCampo = document.getElementById("fileEscala")
        let file = getCampo.files[0]
        if(!file) return alert("Por favor, selecione um ficheiro primeiro.1")

        let reader = new FileReader()

        reader.onload = function(e) {
            let conteudoCSV = e.target.result
            lerEscala(conteudoCSV)
        }

        reader.readAsText(file, "ISO-8859-1")
    } catch (error) {
        console.log(error)
    }
}

//load select do mes
//rece o mes e ano e mais alguma coisa que nao lemrbro
function loadMesSelect(select, ano, exibicao, mes) {
    try {
        let campo = document.getElementById(select)
        let mesExtenso = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]

        let data = new Date()
        let anoCorrente = data.getFullYear()
        let mesAtual = data.getMonth() + 1

        if (ano == null || ano == "") {
            ano = anoCorrente
        }

        let z = 1

        if (exibicao == 1) {
            if (ano == anoCorrente) {
                z = (data.getMonth() + 1)
            }
        }

        campo.textContent = ""
        let vazio = document.createElement("option")
        vazio.textContent = ""
        campo.appendChild(vazio)

        for (let i = z; i <= 12; i++) {
            let newItem = document.createElement("option")
            newItem.textContent = mesExtenso[i - 1]
            newItem.value = i
            campo.appendChild(newItem)
            if (mes == i) {
                newItem.setAttribute("selected", true)
            }
        }
    } catch (error) {
        console.log(error)
    }
}

//load select do ano
function loadAnoSelect(select) {
    try {
        let campo = document.getElementById(select)
        let ano = new Date()
        let anoValue = ano.getFullYear() - 3
        campo.textContent = ""
        let vazio = document.createElement("option")
        vazio.textContent = ""
        campo.appendChild(vazio)
        for (let i = anoValue; i < (anoValue + 7); i++) {
            let newItem = document.createElement("option")
            newItem.textContent = i
            newItem.value = i
            campo.appendChild(newItem)
            if (newItem.value == ano.getFullYear()) {
                newItem.setAttribute("selected", true)
            }
        }
    } catch (error) {
        console.log(error)
    }
}

// converte hora
function converteHoraMinuto(hm) {
    if (!hm || !hm.includes(":")) return null
    let [h, m] = hm.split(":").map(Number)
    return (h * 60) + m
}

//converte minuto
function converteMinutoHora(totalMinutos) {
    let sinal = totalMinutos < 0 ? "-" : ""
    let minAbs = Math.abs(Math.round(totalMinutos))
    let h = Math.floor(minAbs / 60)
    let m = minAbs % 60
    return `${sinal}${h.toString().padStart(2, "0")}:${m.toString().padStart(2, "0")}`
}

//remove caract fdp
function capitalize(texto) {
    return texto ? texto.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "").trim() : ""
}

//colapse
function toggleCollapse(id) {
    let open = document.getElementById(id)
    open.style.display = (open.style.display === "table-row") ? "none" : "table-row"
}

let fileEscala = document.getElementById("fileEscala")
if(fileEscala){
    fileEscala.addEventListener("change", function (e) {
        try {
            let file = fileEscala.files[0]
            if(!file) return msgAlert("alert-warning","Por favor, selecione um ficheiro primeiro.3")

            let containerPicagem = document.getElementById("containerPicagem")
            if(containerPicagem){
                containerPicagem.classList.remove("d-none")
            }
            fileEscala.parentNode.parentNode.classList.add("bg-success", "rounded", "text-white")
            msgAlert("alert-success","Documento carregado com sucesso")

            let reader = new FileReader()

            reader.onload = function(e) {
                let conteudoCSV = e.target.result
                lerEscala(conteudoCSV)
            }

            reader.readAsText(file, "ISO-8859-1")
        } catch (error) {
            console.log(error)
        }
    })
}

//load scv
let fileCSV = document.getElementById("fileCSV")
if(fileCSV){
    fileCSV.addEventListener("change", function (e) {
        let file = e.target.files[0]
        if (!file) return msgAlert("alert-warning","Por favor, selecione um ficheiro primeiro.2")

        fileCSV.parentNode.parentNode.classList.add("bg-success", "rounded", "text-white")
        msgAlert("alert-success","Documento carregado com sucesso")
        //fileCSV.parentNode.parentNode.innerHTML += "Documento carregado com sucesso!"
        //document.querySelector(".groupBTN").style.display  = "grid"
        //e.target.parentNode.classList.add("bd-green")
        //e.target.parentNode.querySelector("p").textContent = "Documento carregado com sucesso!"
        // let reader = new FileReader()
        // reader.readAsText(file, "ISO-8859-1")
        // reader.onload = function (event) { processarRelatorio(event.target.result) }
    })
}

function getHorario(){
    try {
        let fileEscala = document.getElementById("fileEscala")
        let getCampo = document.getElementById("fileCSV")

        let file = getCampo.files[0]
        if(!file) return alert("Por favor, selecione um ficheiro primeiro.4")

        let reader = new FileReader()

        reader.onload = function(e) {
            let conteudoCSV = e.target.result
            processarRelatorio(conteudoCSV)
            document.getElementById("slcImprimirIndiferente").value = 1
        }

        reader.readAsText(file, "ISO-8859-1")
    } catch (error) {
        console.log(error)
    }
}

function processarRelatorio(texto) {
    try {
        let linhas = texto.split(/\r?\n/).filter(l => l.trim() != "")
        if (linhas.length < 2) return

        let cabecalho = linhas[0].split(";").map(c => capitalize(c))
        let idxNum = cabecalho.indexOf("numero"), 
            idxNome = cabecalho.indexOf("nome"),
            idxTipo = cabecalho.indexOf("tipo"), 
            idxData = cabecalho.indexOf("data"),
            idxE1 = cabecalho.indexOf("e1"), 
            idxS1 = cabecalho.indexOf("s1"),
            idxE2 = cabecalho.indexOf("e2"), 
            idxS2 = cabecalho.indexOf("s2")

        // pega os L
        let horariosLegenda = {}
        document.querySelectorAll(".groupLengend").forEach(group => {
            let label = group.querySelector("span")?.textContent
            if (label && label.startsWith("L")) {
                let id = label.replace("L", "")
                horariosLegenda[label] = {
                    inicio: converteHoraMinuto(document.getElementById(`slcLDe-${id}`)?.value),
                    fim: converteHoraMinuto(document.getElementById(`slcLAte-${id}`)?.value)
                }
            }
        })

        // pega escala
        let escalaPlaneada = {}
        document.querySelectorAll("#tbodyCriarEscala tr").forEach(tr => {
            let idFunc = tr.cells[0].getAttribute("data-id-cod-colaborador")
            escalaPlaneada[idFunc] = []
            for (let i = 1; i < tr.cells.length; i++) {
                let sel = tr.cells[i].querySelector("select")
                escalaPlaneada[idFunc][i] = sel ? sel.value : ""
            }
        })

        let qtdL = Object.keys(horariosLegenda).length
        let escalaVazia = {}
        document.querySelectorAll(".tempoCorrido").forEach(select => {
            for (let i = 1 ; i <= qtdL ; i++) {
                escalaVazia[`L${i}`] = {
                    inicio: converteHoraMinuto(document.querySelector(`#slcLDe-${i}`)?.value),
                    fim: converteHoraMinuto(document.querySelector(`#slcLAte-${i}`)?.value)
                }
            }
        })

        let contar2Picagem = document.getElementById("slc2Picagem")
        let pAlmocoDefinido = parseInt(document.getElementById("slcTAlmoco")?.value || 60)
        let tempoDiarioPadrao = converteHoraMinuto(document.getElementById("txtHTrabalho").value)
        
        let slcCompensarTempo = document.getElementById("slcCompensarTempo")

        let total = {}

        for (let i = 1; i < linhas.length; i++) {
            let colunas = linhas[i].split(";")
            let idFunc = colunas[idxNum]?.trim()
            let nome = colunas[idxNome]?.trim()
            let dataStr = colunas[idxData]?.trim() || ""
            let estaNaEscala = (escalaPlaneada[idFunc] !== undefined)
            if (!nome || !idFunc) continue

            let dia = parseInt(dataStr.split(/[\/\-]/)[0])
            let turnoDia = (escalaPlaneada[idFunc] && escalaPlaneada[idFunc][dia]) ? escalaPlaneada[idFunc][dia] : ""

            let hInicioRef, hFimRef

            if (turnoDia && horariosLegenda[turnoDia]) {
                hInicioRef = horariosLegenda[turnoDia].inicio
                hFimRef = horariosLegenda[turnoDia].fim
            } else {
                let escalaPadrao = escalaVazia["L1"]
                hInicioRef = escalaPadrao ? escalaPadrao.inicio : null
                hFimRef = escalaPadrao ? escalaPadrao.fim : null
                if (!turnoDia) turnoDia = "L1"
            }

            if (!total[nome]) {
                total[nome] = {
                    id: idFunc, falta: 0, previsto: 0, realizado: 0, saldo: 0,
                    cE1: 0, cAlm: 0, cS2: 0, historicoProblemas: [],
                    foraDaEscala: !estaNaEscala,
                    tAtraso: 0, tCedo: 0, tFalta: 0, saldoPositivo: 0, saldoNegativo: 0, saldoCompensado: 0, saldoPositivoCompensado: 0, saldoNegativoCompensado: 0
                }
            }

            let e1 = converteHoraMinuto(colunas[idxE1]),
                s1 = converteHoraMinuto(colunas[idxS1]),
                e2 = converteHoraMinuto(colunas[idxE2]),
                s2 = converteHoraMinuto(colunas[idxS2])

            let tAlmoco = (s1 != null ? (s2 == null ? pAlmocoDefinido : (e2 != null && s1 != null ? e2 - s1 : null ) ) : null)
            
            let tFalta = 0
            if(s1 == null){
                tFalta = 0
            } else if(e2 == null){
                tFalta = (s1 - e1 - tempoDiarioPadrao - pAlmocoDefinido)
            } else if (s2 == null){
                tFalta = (e2 - e1 - tempoDiarioPadrao - pAlmocoDefinido)
            } else {
                tFalta = (s2 - e1) - (e2 - s1) - tempoDiarioPadrao
            }

            // pega o estado 
            let eFalta = capitalize(colunas[idxTipo]).includes("falta")
            // let eFalta = capitalize(colunas[idxTipo]).includes("falta") && e1 == null && !["HFLG", "FD", "FE"].includes(turnoDia)
            let eFolga = capitalize(colunas[idxTipo]).includes("folga")
            let eFolgaEscala = !["HFLG", "FD", "FE"].includes(turnoDia)
            let eIndefinido = capitalize(colunas[idxTipo]).includes("indefinido")
            let eFerias = capitalize(colunas[idxTipo]).includes("ferias")


            let isFolga = ["HFLG", "FD", "FE"].includes(turnoDia)
            // contar tempo de trabalho
            let tTrabalhado = 0;
            if(e1 && s1 && !e2 && !s2) tTrabalhado += (s1 - e1) - tAlmoco //2 picagem 
            if(e1 && s1 && e2 && !s2) tTrabalhado += (e2 - e1) - tAlmoco //3 picagem
            if(e1 && s1 && e2 && s2) tTrabalhado += (s2 - e1) - (e2 - s1)

            let tAtraso = (e1 != null && hInicioRef != null && e1 > hInicioRef) ? (e1 - hInicioRef) : 0
            let tCedo = 0

            if(s2 && s2 < hFimRef){
                tCedo = hFimRef - s2
                console.log(`data - ${dia} A `) //tAlmocoReal
            } else if(!s2 && e2 && e2 < hFimRef) {
                tCedo = hFimRef - e2
                console.log(`data - ${dia} B `) //tAlmocoReal
            } else if(!s2 && !e2 && s1 && s1 < hFimRef){
                console.log(`data - ${dia} C `) //tAlmocoReal
                tCedo = hFimRef - s1
            }
            
            let tAlmocoReal = (s1 != null && e2 != null && s2 != null && (e2 - s1) || null)
            
            //console.log(`data - ${dia} hora ` + (tFalta)) //tAlmocoReal

            // flag
            let eAtrasada = tAtraso > 0
            let eCedo = tCedo > 0
            let eIncon = ((e1 != null && s2 == null) || (e1 == null && s2 != null))
            let eAlmocoLongo = (tAlmocoReal != null && tAlmocoReal > pAlmocoDefinido)

            let ano = document.getElementById("slcAnoNovaEscala")
            let mes = document.getElementById("slcMesNovaEscala")

            let [ax, bx, cx,] = dataStr.split("-")
            let trabalhouNaFolga = null
            if(dataStr == `${ax.padStart(2,0)}-${mes.value.padStart(2,0)}-${ano.value}`){
                trabalhouNaFolga = isFolga && (e1 != null || s2 != null)
            }

            let xAtraso = (e1 != null && hInicioRef != null && e1 > hInicioRef) ? (e1 - hInicioRef) : 0
            let xAlmocoExtra = tAlmocoReal != null && slcCompensarTempo.value != 0 ? (tAlmocoReal - pAlmocoDefinido) : 0
            
            let xCedo = 0
            if(s2 && s2 < hFimRef){
                xCedo = hFimRef - s2
            } else if(!s2 && e2 && e2 < hFimRef){
                xCedo = hFimRef - e2
            } else if(!s2 && !e2 && s1 && s1 < hFimRef){
                console.log(`data - ${dia} D `) //tAlmocoReal
                xCedo = hFimRef - s1
            }

            let xSomaDebito = xAtraso + xAlmocoExtra + xCedo 
            let creditoInicio = 0
            
            creditoInicio = (e1 != null && hInicioRef != null && e1 < hInicioRef) ? (e1 - hInicioRef) : 0
            let creditoFim = 0
            if(s2 != null){
                creditoFim = s2 - hFimRef
            } else if (!s2 && e2 != null) {
                creditoFim = e2 - hFimRef
            } else if (!s2 && !e2 && s1 != null){
                creditoFim = s1 - hFimRef
            }

            let tempoCompensadoInicio = 0
            let tempoCompensadoFim = 0

            let fatorCompensacao = 0;
            switch (Number(slcCompensarTempo.value)) {
                case 1: fatorCompensacao = Math.abs(xSomaDebito) / 2; break
                case 2: fatorCompensacao = Math.abs(xSomaDebito) / 3; break
                case 3: fatorCompensacao = (Math.abs(xSomaDebito) / 4) * 2; break
                case 4: fatorCompensacao = Math.abs(xSomaDebito) / 4; break
                case 5: fatorCompensacao = (Math.abs(xSomaDebito) / 4) * 3; break
                case 6: fatorCompensacao = Math.abs(xSomaDebito) / 5; break
                case 7: fatorCompensacao = Math.abs(xSomaDebito); break
                default: fatorCompensacao = 0; break
            }

            if (xSomaDebito != 0) {
                tempoCompensadoInicio = creditoInicio
                tempoCompensadoFim = creditoFim
            }

            //console.log(`data - ${dia} tempoCompensadoInicio ` + tempoCompensadoInicio) //tAlmocoReal
            //console.log(`data - ${dia} tempoCompensadoFim ` + tempoCompensadoFim) //tAlmocoReal

            let somaCompesacao = 0
            let teste = 0
            if(fatorCompensacao != 0){
                somaCompesacao = (tempoCompensadoInicio + tempoCompensadoFim)
                teste = xSomaDebito 
            }

            let previstoHoje = isFolga && s1 == null ? 0 : tempoDiarioPadrao
            let saldoDia = eFolga && s1 == null ? 0 : eIndefinido == true ? 0 : eFerias == true ? 0 : tTrabalhado - previstoHoje

            // acumulador
            if (e1 != null) total[nome].cE1++
            if (s1 != null || e2 != null) total[nome].cAlm++
            if (s2 != null) total[nome].cS2++

            let xFalta = xSomaDebito - somaCompesacao

            total[nome].realizado += tTrabalhado
            total[nome].previsto += previstoHoje
            total[nome].saldoPositivo += ((tFalta > 0 ? tFalta : 0))
            // total[nome].saldoPositivo += ((tFalta > 0 ? tFalta : 0))
            total[nome].saldoNegativo += (eFalta && s1 ? -480 : (tFalta < 0 ? tFalta : 0))
            // total[nome].saldoNegativo += (eFalta ? -480 : (tFalta < 0 ? tFalta : 0))
            total[nome].saldo += (eFalta && s1 ? -480 : tFalta)
            
            //xSomaDebito - somaCompesacao
            total[nome].saldoPositivoCompensado += ((s1 && tFalta> 0 ? tFalta : 0) + tempoDiarioPadrao - xSomaDebito + somaCompesacao)
            total[nome].saldoNegativoCompensado += (eFalta && s1 ? -480 : xFalta)
            total[nome].saldoCompensado += (eFalta && s1 ? -480 : tFalta)

            // total[nome].saldoPositivoCompensado += ((tFalta > 0 ? tFalta : 0) + tempoDiarioPadrao - (xSomaDebito) + somaCompesacao)
            // total[nome].saldoNegativoCompensado += (eFalta ? -480 : (tFalta < 0 ? tFalta + somaCompesacao : 0))
            // total[nome].saldoCompensado += (eFalta ? -480 : tFalta)
            
            // console.log(`data - ${dia} tempoDiarioPadrao ` + tempoDiarioPadrao) //tAlmocoReal
            // console.log(`data - ${dia} xSomaDebito ` + xSomaDebito) //tAlmocoReal
            // console.log(`data - ${dia} tFalta ` + tFalta) //tAlmocoReal
            // console.log(`data - ${dia} somaCompesacao ` + somaCompesacao) //tAlmocoReal
            //console.log(`data - ${dia} xFalta ` + xFalta) //tAlmocoReal
            
            if (eFalta && !isFolga) total[nome].falta++

            let htmlMotivos = "<table class='table table-sm text-center' id='tableInfoHora' style='margin-top: 0;'>"
            htmlMotivos += (eFalta ? `<tr><td colspan='2'>FALTA PICAGEM</td></tr>` : '')
            htmlMotivos += (trabalhouNaFolga ? `<tr><td colspan='2'>FOLGA ESCALA, MAS TRABALHOU</td></tr>` : '')
            htmlMotivos += (eAtrasada ? `<tr><td class='text-danger fw-bold'>ATRASADA</td><td class='text-danger fw-bold'> ${converteMinutoHora(tAtraso)}</td></tr>` : '')
            htmlMotivos += (eFerias ? `<tr><td colspan='2'>FÉRIAS</td></tr>` : '')
            htmlMotivos += (eIndefinido ? `<tr><td colspan='2'>INDEFINIDO</td></tr>` : '')
            htmlMotivos += (isFolga  ? `<tr><td colspan='2'>FOLGA ESCALA</td></tr>` : '')
            htmlMotivos += (eFolga  ? `<tr><td colspan='2'>FOLGA PICAGEM</td></tr>` : '')
            htmlMotivos += (eCedo ? `<tr><td class='text-danger fw-bold'>CEDO</td><td class='text-danger fw-bold'>${converteMinutoHora(tCedo)}</td></tr>` : '')
            htmlMotivos += (eIncon ? `<tr><td colspan='2'>INCONSISTENTE</td></tr>` : '')
            htmlMotivos += (eAlmocoLongo ? `<tr><td>ALMOÇO</td><td>${converteMinutoHora(tAlmocoReal - pAlmocoDefinido)}</td></tr>` : '')
            htmlMotivos += "</table>"

            total[nome].historicoProblemas.push({
                data: dataStr,
                e1: colunas[idxE1] || "---",
                s1: colunas[idxS1] || "---",
                e2: colunas[idxE2] || "---",
                s2: colunas[idxS2] || "---",
                t1: tAlmocoReal || "---",
                tf: saldoDia,
                tT: tTrabalhado,
                ta: tAtraso,
                tc: tCedo,
                tipo: (eFalta ? "FALTA" : (eAtrasada ? `ATRASADA` : (eCedo ? "CEDO" : (eIncon ? "INCONSISTENTE" : (eAlmocoLongo ? "ALMOÇO" : ""))))),
                teste: htmlMotivos,
                horaCompensado : tempoDiarioPadrao - (xSomaDebito) + somaCompesacao,
                minutoCompensado : xSomaDebito - somaCompesacao,
                OlhaLaS2 : e1,
                tipoTrabalhoFolga : trabalhouNaFolga || 'FOLGA/TRAB',
                tipoFolgaEscala : eFolga && colunas[idxE1]|| '',
            })
        }
        exibirTabela(total)
    } catch (error) {
        console.error(error)
    }
}

function exibirTabela(dados) {
    let corpo = document.getElementById("bodyTable")
    let tableCriarEscala = document.getElementById("tableCriarEscala")
    let tbodyCriarEscala = tableCriarEscala.querySelector("#tbodyCriarEscala")

    corpo.innerHTML = ""
    let htmlFinal = ""
    let htmlEscala = ""
    Object.entries(dados).forEach(([nome, info]) => {
        let yAtraso = info.historicoProblemas.reduce((acc, p) => acc + (Number(p.ta) || 0), 0)
        let yCedo = info.historicoProblemas.reduce((acc, p) => acc + (Number(p.tc) || 0), 0)

        tbodyCriarEscala.querySelectorAll(".rowList").forEach(item=>{
            let getId = item.cells[0].getAttribute("data-id-cod-colaborador")
            if(Number(getId) == Number(info.id)){
                let colDia = tableCriarEscala.querySelector("thead tr")
                let colSemana = tableCriarEscala.querySelector(".rowListSemana")
                htmlEscala = `
                        <td class="" colspan="9">
                            <table class="col w-100 d-none" id="continerSubEscala">
                                <thead>
                                    <tr>
                                        <th class="border border-dark"><span>${colDia.cells[1].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[2].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[3].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[4].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[5].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[6].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[7].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[8].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[9].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[10].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[11].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[12].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[13].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[14].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[15].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[16].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[17].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[18].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[19].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[20].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[21].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[22].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[23].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[24].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[25].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[26].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[27].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[28].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[29].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[30].textContent}</span></th>
                                        <th class="border border-dark"><span>${colDia.cells[31].textContent}</span></th>
                                    </tr>
                                    <tr>
                                        <th class="border border-dark"><span>${colSemana.cells[1].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[2].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[3].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[4].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[5].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[6].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[7].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[8].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[9].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[10].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[11].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[12].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[13].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[14].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[15].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[16].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[17].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[18].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[19].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[20].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[21].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[22].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[23].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[24].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[25].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[26].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[27].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[28].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[29].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[30].textContent.substring(0,1)}</span></th>
                                        <th class="border border-dark"><span>${colSemana.cells[31].textContent.substring(0,1)}</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-dark">${item.cells[1].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[2].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[3].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[4].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[5].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[6].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[7].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[8].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[9].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[10].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[11].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[12].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[13].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[14].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[15].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[16].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[17].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[18].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[19].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[20].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[21].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[22].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[23].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[24].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[25].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[26].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[27].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[28].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[29].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[30].querySelector("select").value}</td>
                                        <td class="border border-dark">${item.cells[31].querySelector("select").value}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                `


            }
        })

        let row = `
        <tr class="row-colaborador row-detalhes quebra-pagina" 
            data-bs-toggle="collapse" 
            data-bs-target="#detalhe_${info.id}" 
            style="cursor: pointer;">
            <td>${info.id}</td>
            <td class="text-start">${nome} <br>${info.foraDaEscala ? '<small class="text-muted" style="font-size: 9px;">Fora da escala</small>' : ''}</td>
            <td><span class="badge bg-danger">${info.historicoProblemas.filter(p => p.tipoTrabalhoFolga != 'FOLGA/TRAB').length}</span></td>
            <td><span class="text-success fw-bold">${converteMinutoHora(info.saldoPositivo)}</span></td>
            <td><span class="text-danger fw-bold">${converteMinutoHora(info.saldoNegativo)}</span></td>
            <td>${converteMinutoHora(info.saldo)}</td>
            <td><span class="badge bg-danger">${info.historicoProblemas.filter(p => p.tipo === "FALTA").length}</span></td>
            <td><span class="badge bg-danger">${info.historicoProblemas.filter(p => p.tipo === "ATRASADA").length}</span><small>${(yAtraso != 0 ? converteMinutoHora(yAtraso) + 'h' : '')}</small></td>
            <td><span class="badge bg-danger">${info.historicoProblemas.filter(p => p.tipo === "CEDO").length}</span><small>${(yCedo != 0 ? converteMinutoHora(yCedo) + 'h' : '')}</small></td>
            <td></td>
        </tr>

        <tr class="">
            ${htmlEscala}
        </tr>
        <tr>
            <td colspan="13" class="p-0 border-0">
                <div id="detalhe_${info.id}" class="collapse bg-light p-3">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered bg-white">
                            <thead class="small shadow-sm">
                                <tr>
                                    <th>Data</th>
                                    <th>E1</th>
                                    <th>S1</th>
                                    <th>E2</th>
                                    <th>S2</th>
                                    <th>Almoço</th>
                                    <th>Total</th>
                                    <th>Saldo</th>
                                    <th>H<br>Compensado</th>
                                    <th>T<br>Compensado</th>
                                    <th>Motivo</th>
                                </tr>
                            </thead>
                            <tbody class="small">
                            ${info.historicoProblemas.map(p =>`
                                <tr class='row-subtable'>
                                    <td>${p.data}</td>
                                    <td>${p.e1}</td>
                                    <td>${p.s1}</td>
                                    <td>${p.e2}</td>
                                    <td>${p.s2}</td>
                                    <td>${(p.t1 != '---' ? converteMinutoHora(p.t1) : '---')}</td>
                                    <td>${(p.tT != 0 ? converteMinutoHora(p.tT) : '---')}</td>
                                    <td ${p.tf < 0 ? "class='text-danger fw-bold'" : ''}>${(p.tf != 0 ? converteMinutoHora(p.tf) : '---')}</td>
                                    <td>${p.OlhaLaS2 ? converteMinutoHora(p.horaCompensado) : '---' }</td>
                                    <td>${p.OlhaLaS2 ? converteMinutoHora(p.minutoCompensado) : '---'}</td>
                                    <td><small>${p.teste}</small></td>
                                </tr>
                                `).join('') || '<tr><td colspan="6">Nenhuma ocorrência encontrada.</td></tr>'}
                            </tbody>
                        </table>
                    </div>
                </div>
            </td>
        </tr>`
        htmlFinal += row
        // corpo.innerHTML += row
    })

    corpo.innerHTML = htmlFinal
}

// imprimir
function imprimir(){
    let corpoTabela = document.getElementById("bodyTable")
    
    if (!corpoTabela || corpoTabela.rows.length === 0) {
        return msgAlert("alert-warning", "O documento ainda não foi gerado \n Clique em 'Carregar' para gerar.")
    }
    window.print()
}

//btn baixa arquivo
function baixar(){
    let corpoTabela = document.getElementById("bodyTable")
    if (!corpoTabela || corpoTabela.rows.length === 0) {
        alert("O documento ainda não foi gerado \n Clique em 'Carregar documento' para gerar. \n NÃO DESABILITE ESSA CAIXA POR FAVOR.")
        return
    }
    baixarCSV()
}

//baixa csv (mantido igual)
function baixarCSV() {
    let corpoTabela = document.getElementById("bodyTable")

    let csv = "zeruela=;\n"
    csv += "Nº;Nome;Data;E1;S1;E2;S2;Almoco;Total;Saldo;H Padrao;T Padrao;Motivo;Hora (+);Hora (-);Saldo (=);Qtd Faltas;Tempo Atraso;Tempo Saida +Cedo\n"

    let linhas = corpoTabela.querySelectorAll("tr")

    linhas.forEach((linha) => {
        if (linha.classList.contains("row-colaborador")) {
            let col = linha.querySelectorAll("td")
            let id = col[0].innerText.trim() //cod funcionario
            let nome = col[1].innerText.trim() //nome
            let saldoPositivo = col[3].innerText.trim() // saldo +
            let saldoNegativo = col[4].innerText.trim() //saldo -
            let saldoHora = col[5].innerText.trim() //saldo =
            let faltas = col[6].innerText.trim() //faltas
            let tAraso = col[7].querySelector("small").textContent.trim() || '' //total atraso
            let tCedo = col[8].querySelector("small").textContent.trim() //total cedo

            csv += `${id};${nome};;;;;;;;;;;;${saldoPositivo};${saldoNegativo};${saldoHora};${faltas};${tAraso};${tCedo}\n`

            let detalheRow = linha.nextElementSibling
            console.log(detalheRow)
            if (detalheRow && detalheRow.querySelectorAll(".row-subtable")) {

                detalheRow.querySelectorAll(".row-subtable").forEach(sub => {
                    let subCol = sub.querySelectorAll("td")
                    if (subCol.length >= 7) {
                        csv += `${id};${nome};${subCol[0].innerText.trim()};${subCol[1].innerText.trim()};${subCol[2].innerText.trim()};${subCol[3].innerText.trim()};${subCol[4].innerText.trim()};${subCol[5].innerText.trim()};${subCol[6].innerText.trim()};${subCol[7].innerText.trim()};${subCol[8].innerText.trim()};${subCol[9].innerText.trim()};${subCol[10].innerText.trim().split("td")};\n`
                    }
                })
            }
            csv += ";;;;;;;;;;;;;\n"
        }
    })

    let blob = new Blob(["\ufeff" + csv], { type: "text/csv;charset=utf-8;" })
    let url = URL.createObjectURL(blob)
    let link = document.createElement("a")
    link.setAttribute("href", url)
    link.setAttribute("download", "Auditoria_de_Hora.csv")
    document.body.appendChild(link)
    link.click()
    document.body.removeChild(link)
}

function verEscala(btn){
    try {
        let containerNovaEscala = document.getElementById("containerNovaEscala")

        //containerNovaEscala.classList.toggle("hidder")

        let catainerEscala = document.getElementById("catainerEscala")
        
        if(containerNovaEscala.classList.contains("hidder")){
            btn.textContent = "Ocultar Escala"
            containerNovaEscala.classList.remove("hidder")
            document.getElementById("infoEscalaOculta").classList.add("hidder")
        } else {
            containerNovaEscala.classList.add("hidder")
            document.getElementById("infoEscalaOculta").classList.remove("hidder")
            btn.textContent = "Ver Escala"
        }
    } catch (error) {
        console.log(erro)
    }
}