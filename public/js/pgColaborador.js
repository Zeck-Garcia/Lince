window.addEventListener("DOMContentLoaded",async function(){
    try {
        await listPaises("slcNacionalidade")
        await listPaises("slcNaturalidade")
        

    } catch (error) {
        //fazer erro
    }
})

let campos = camposPaginaColaborador()

async function fazerFuncSalvar(){
    return 1
}

function camposPaginaColaborador(){
    return {
        txtNomeCompleto : document.getElementById("txtNomeCompleto"),
        txtDataNascimento : document.getElementById("txtDataNascimento"),
        txtContacto1 : document.getElementById("txtContacto1"),
        txtContacto2 : document.getElementById("txtContacto2"),
        txtContactoEmergencia : document.getElementById("txtContactoEmergencia"),
        txtEmail : document.getElementById("txtEmail"),
        txtNumeroIdentificacao : document.getElementById("txtNumeroIdentificacao"),
        txtNumeroIdentificacaoValidade : document.getElementById("txtNumeroIdentificacaoValidade"),
        txtNIF : document.getElementById("txtNIF"),
        txtNISS : document.getElementById("txtNISS"),
        txtMorada : document.getElementById("txtMorada"),
        txtPorta : document.getElementById("txtPorta"),
        txtAndar : document.getElementById("txtAndar"),
        txtCodPostal : document.getElementById("txtCodPostal"),
        txtLocalidade : document.getElementById("txtLocalidade"),
        txtConcelho : document.getElementById("txtConcelho"),
        txtDistrito : document.getElementById("txtDistrito"),
        slcNacionalidade : document.getElementById("slcNacionalidade"),
        slcNaturalidade : document.getElementById("slcNaturalidade"),
        txtConcelhoNaturalidade : document.getElementById("txtConcelhoNaturalidade"),
        txtFreguesiaNaturalidade : document.getElementById("txtFreguesiaNaturalidade"),
        slcHabilitacaoLiteraria : document.getElementById("slcHabilitacaoLiteraria"),
        txtQualCurso : document.getElementById("txtQualCurso"),
        slcNumeroDependentes : document.getElementById("slcNumeroDependentes"),
        slcNumeroTitularRendimento : document.getElementById("slcNumeroTitularRendimento"),
        slcParentesco : document.getElementById("slcParentesco"),
        txtQualParentesco : document.getElementById("txtQualParentesco"),
        txtNomeParentesco : document.getElementById("txtNomeParentesco"),
        txtDataNascimentoParentesco : document.getElementById("txtDataNascimentoParentesco"),
        txtNIFParentesco : document.getElementById("txtNIFParentesco"),
        slcEstadoCivil : document.getElementById("slcEstadoCivil"),
        txtNomeConjuge : document.getElementById("txtNomeConjuge"),
        txtNumeroIdentificacaoConjuge : document.getElementById("txtNumeroIdentificacaoConjuge"),
        sltUniforme : document.getElementById("sltUniforme"),
        slcTipoUniforme : document.getElementById("slcTipoUniforme"),
        slcTamanhoUniforme : document.getElementById("slcTamanhoUniforme"),
        
        rdDoenca : document.getElementsByName("rdDoenca"),
        rdAutorizoContacte : document.getElementsByName("rdAutorizoContacte"),
        rdCertificadoHabilitacao : document.getElementsByName("rdCertificadoHabilitacao"),
        rdIBAN : document.getElementsByName("rdIBAN"),

        slcDeclaranteUnico : document.getElementById("slcDeclaranteUnico"),
        slcRendimentoMais : document.getElementById("slcRendimentoMais"),
        slcRendimentoMenos : document.getElementById("slcRendimentoMenos"),
        slcCasadoUnico : document.getElementById("slcCasadoUnico"),
        slcRetencaoMensal : document.getElementById("slcRetencaoMensal"),
        txtRetencaoMensal : document.getElementById("txtRetencaoMensal"),
        slcRecebePensao : document.getElementById("slcRecebePensao"),
        txtNomePensao : document.getElementById("txtNomePensao"),
        txtValorPensao : document.getElementById("txtValorPensao"),
        flFichaColaborador : document.getElementById("flFichaColaborador"),
        flIBAN : document.getElementById("flIBAN"),
        flDeclaracaoFiscal : document.getElementById("flDeclaracaoFiscal"),
        flCertificadoHabilitacao : document.getElementById("flCertificadoHabilitacao"),
    }
}

let containerGoupNewCadastro = document.getElementById("containerGoupNewCadastro")
let btnNewColaborador = document.getElementById("btnNewColaborador")
if(btnNewColaborador){
    btnNewColaborador.addEventListener("click", ()=>{
        containerGoupNewCadastro.classList.toggle("hidder")
        containerAnexoDoc.classList.add("hidder")
    })
}

let containerAnexoDoc = document.getElementById("containerAnexoDoc")

let btnSalvarColaborador = document.getElementById("btnSalvarColaborador")
if(btnSalvarColaborador){
    btnSalvarColaborador.addEventListener("click",async ()=>{
        //criar uma func para salvar
        //ao finalizar abrir uma nova pagina para imprimir o fomulario preenhecido
        //abrir tudo em uma pagina só
        let result = await fazerFuncSalvar()
        if(result == 1){
            //trazer o numero do cadastro para passar para a div de anexo            
            containerGoupNewCadastro.classList.toggle("hidder")
            containerAnexoDoc.classList.toggle("hidder")
            containerAnexoDoc.setAttribute("data-number-cadastro", 2541)
        }
    })
}

let btnAnexarDocumentoNewCadastro = document.getElementById("btnAnexarDocumentoNewCadastro")
if(btnAnexarDocumentoNewCadastro){
    btnAnexarDocumentoNewCadastro.addEventListener("click", ()=>{
        //criar uma func para salvar os doc

        containerAnexoDoc.querySelectorAll("input[type='file']").forEach(async item=>{
            if(item.files.length != 0){
                let result = await fazerFuncSalvar()//
                if(result == 1){
                    item.classList.add("hidder")
                }
            }
        })
    })
}

let btnCancelarColaborador = document.getElementById("btnCancelarColaborador")
if(btnCancelarColaborador){
    btnCancelarColaborador.addEventListener("click", ()=>{
        containerGoupNewCadastro.classList.toggle("hidder")
    })
}

let sltUniforme = document.getElementById("sltUniforme")
if(sltUniforme){
    sltUniforme.addEventListener("change", ()=>{
        let containerUniforme= document.getElementById("containerUniforme")
        let tbodyUniforme = document.getElementById("tbodyUniforme")
        let x = campos.slcTipoUniforme
        let y = campos.slcTamanhoUniforme
        let btnAddUniforme = document.getElementById("btnAddUniforme")

        if(campos.sltUniforme.value == 1){
            containerUniforme.classList.remove("hidder")

            btnAddUniforme.addEventListener("click", ()=>{
                if(x.value == "" || y.value == ""){
                    msgAlert("alert-danger", "Primeiro selecione um uniforme e tamanho para poder adicionar")
                } else {
                    let xValue = x.options[x.selectedIndex]
    
                    let yValue = y.options[y.selectedIndex]
        
                    let teste = document.createElement("tr")
                    teste.classList.add("rowList")
                    teste.innerHTML = `<td data-tipo-uniforme='${x.value}'>${xValue.text}</td>
                                        <td data-tamanho.uniform='${y.value}'>${(yValue.text).toUpperCase()}</td>
                                        <td><i class='bi bi-trash btn btn-sm btn-outline-info' onclick='excluirItemList(event,"rowList")'></i></td>`
        
                    tbodyUniforme.appendChild(teste)
                }
            })

            let opacaoTamanhoCalcado = ["34","35","36","37","38","39","40","41","42","43","44","45","46"]
            let opacaoTamanhoRoupa = ["xs","s","m","l","xl","xll","xlll","xllll"]
            let slcTamanhoUniforme = document.getElementById("slcTamanhoUniforme")

            x.addEventListener("change", ()=>{
                slcTamanhoUniforme.textContent = ""
                let z = x.options[x.selectedIndex]

                let ab = document.createElement("option")
                slcTamanhoUniforme.appendChild(ab)

                if(z.getAttribute("data-calcado") == 1){
                    opacaoTamanhoCalcado.forEach(item=>{
                        let teste = document.createElement("option")
                        teste.innerHTML = item
                        teste.value = item
    
                        slcTamanhoUniforme.appendChild(teste)
                    })
                } else {
                    opacaoTamanhoRoupa.forEach(item=>{
                        let teste = document.createElement("option")
                        teste.innerHTML = item.toUpperCase()
                        teste.value = item
    
                        slcTamanhoUniforme.appendChild(teste)
                    })
                }
            })
        } else {
            tbodyUniforme.textContent = ""
            containerUniforme.classList.add("hidder")

            campos.slcTipoUniforme.parentNode.classList.remove("active")
            campos.slcTamanhoUniforme.parentNode.classList.remove("active")

            campos.slcTipoUniforme.value = ""
            campos.slcTamanhoUniforme.value = ""
        }
    })
}

let slcNumeroDependentes = document.getElementById("slcNumeroDependentes")
if(slcNumeroDependentes){
    slcNumeroDependentes.addEventListener("change", async ()=>{
        let x = slcNumeroDependentes.value
        let containerDependente = document.getElementById("containerDependente")

            document.querySelectorAll(".containerInputDependente").forEach(item=>{
                item.remove()
            })

        for(let i = 0 ; i < x ; i++){
            let teste = document.createElement("div")
            teste.classList.add("row1")
            teste.classList.add("mt-3")
            teste.classList.add("containerInputDependente")
            teste.id = `container${i}`
            teste.innerHTML = `<div class='CampoGroup'>
                                <select id='' class='form-select slcParentesco'>
                                    <option value=''></option>
                                    <option value='1'>Mãe / Pai</option>
                                    <option value='2'>Filha / Filho</option>
                                    <option value='3'>Avó / Avô</option>
                                    <option value='4'>Irmã / Irmão</option>
                                    <option value='5'>Enteada / Enteado</option>
                                    <option value='6'>Tia / Tio</option>
                                    <option value='7'>Bisavó / Bisavô</option>
                                    <option value='8'>Mãe / Pai do cônjuge</option>
                                    <option value='9'>Irmã / irmão do cônjuge</option>
                                    <option value='10'>Prima / Primo</option>
                                    <option value='11'>Outros</option>
                                </select>
                                <label>Parentesco</label>
                            </div>
    
                            <div class='CampoGroup col-2 hidder divQualParentesco'>
                                <input type='text' id='' class='form-control txtQualParentesco'>
                                <label>Qual?</label>
                            </div>
    
                            <div class='CampoGroup w-100'>
                                <input type='text' id='' class='form-control txtNomeParentesco'>
                                <label>Nome</label>
                            </div>
    
                            <div class='CampoGroup col-2'>
                                <input type='text' id='' class='form-control txtDataNascimentoParentesco'>
                                <label>Data nascimento</label>
                            </div>
    
                            <div class='CampoGroup col-2'>
                                <input type='text' id='' class='form-control txtNIFParentesco'>
                                <label>NIF</label>
                            </div>
                            
                            <div>
                                <button class='btn btn-sm btn-outline-info btnLimparInputDependente'><i class='bi bi-eraser'></i></button>
                            </div>`

            containerDependente.appendChild(teste)
            await campoInputLabelSuspenso()
        }

        document.querySelectorAll(".btnLimparInputDependente").forEach(item=>{
            item.addEventListener("click", ()=>{
                let y = item.parentNode.parentNode
    
                y.querySelectorAll("input[type='text'], select").forEach(element=>{
                    element.value = ""
                    element.parentNode.classList.remove("active")

                    if(element.parentNode.classList.contains("divQualParentesco")){
                        element.parentNode.classList.add("hidder")
                    }
                })
            })
        })

        document.querySelectorAll(".slcParentesco").forEach(item=>{
            let y = item.parentNode.parentNode

            item.addEventListener("change", ()=>{
                if(item.value == 11){
                    y.querySelector(".divQualParentesco").classList.remove("hidder")
                } else {
                    y.querySelector(".divQualParentesco").classList.add("hidder")
                }
            })
        })
 
    })
}

let slcEstadoCivil = document.getElementById("slcEstadoCivil")
if(slcEstadoCivil){
    slcEstadoCivil.addEventListener("change", ()=>{
        let containerConjuge = document.getElementById("containerConjuge")
        if(slcEstadoCivil.value == 2){
            containerConjuge.classList.remove("hidder")
            containerConjuge.classList.add("row1")
        } else {
            containerConjuge.classList.add("hidder")
            containerConjuge.classList.remove("row1")
        }
    })
}

let slcHabilitacaoLiteraria = document.getElementById("slcHabilitacaoLiteraria")
if(slcHabilitacaoLiteraria){
    slcHabilitacaoLiteraria.addEventListener("change", ()=>{
        let containerHabilitacaoLiteraria = document.getElementById("containerHabilitacaoLiteraria")
        let containerConfirmaEnvioCertificadoLiterario = document.getElementById("containerConfirmaEnvioCertificadoLiterario")
        if(slcHabilitacaoLiteraria.options[slcHabilitacaoLiteraria.selectedIndex].getAttribute("data-habilitacao") == 1){
            containerHabilitacaoLiteraria.classList.remove("hidder")
            containerConfirmaEnvioCertificadoLiterario.classList.remove("hidder")
        } else {
            containerHabilitacaoLiteraria.querySelector("#txtQualCurso").value = ""
            containerHabilitacaoLiteraria.classList.add("hidder")
            containerConfirmaEnvioCertificadoLiterario.classList.add("hidder")
        }
    })
}