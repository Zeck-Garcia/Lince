window.addEventListener("DOMContentLoaded",async function(){
    try {
        await loadAnulacao("",0,"")
        
    } catch (error) {
        //fazer erro
    }
})

async function loadAnulacao(txtSearchUserGet,slcFeitoGet,paginaGet){
    return new Promise(async (resolve, reject)=>{
        try {
            
            let dados = {
                txtSearchUserSet : txtSearchUserGet,
                slcFeitoSet : slcFeitoGet,
                paginaSet : paginaGet,
            }

            let result = await $.post("././app/controller/function/funcLoadAnularDocumento.php", dados)
            console.log(result)

            let jsonResultInput = JSON.parse(result)
            let tbodyAnularDoc = document.getElementById("tbodyAnularDoc")
            tbodyAnularDoc.innerHTML = ""

            if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
                jsonResultInput.obj.forEach(element => {
                    let teste = document.createElement("tr")
                    teste.classList.add("rowList")
    
                    teste.innerHTML = `<td>${element.estadoAnulacao == 0 ? 'Por fazer' : 'Feito'}</td>
                                        <td>${dataIso(element.dataCriadoAnulacao)}</td>
                                        <td>${element.encomendaAnulacao}</td>
                                        <td>${(element.guiaFaturaAnulacao == null ? "" : element.guiaFaturaAnulacao)}</td>
                                        <td><i class='bi bi-ticket-detailed btn btn-outline-info' ></i></td>
                                        <td>${(element.estadoAnulacao == 0 ? "<i class='bi bi-trash btn btn-outline-info' onclick='exibirDetailsAnulacao(event)'></i>" : "")}</td>`
    
                    tbodyAnularDoc.appendChild(teste)
                })
            }

            let qtdRegistro = jsonResultInput.obj[0].totalRegistro
            let qtdPagina = Math.ceil(qtdRegistro / jsonResultInput.limite)
            let limite = jsonResultInput.limite

            await pagination("paginationHome",qtdPagina,paginaGet, limite)

            document.querySelectorAll(".btnPgane").forEach(item => {
                if(item){
                    item.addEventListener("click",async function(){

                        let txtSearchUser = document.getElementById("txtSearchUser") ?.value || ""
                        let slcFeito = document.getElementById("slcFeito")
                        let pagina = item.getAttribute("data-pagina")

                        await loadAnulacao(txtSearchUser, slcFeito.value, pagina)
                    })
                }
            })

            resolve()
        } catch (error) {
            
        }
    })
}

async function exibirDetailsAnulacao(event){
    return new Promise(async(resolve, reject) => {
        try {
            
            let numberEncomenda = (event == "" ? "" : event.target.closest(".rowList"))
            let numberEncomendaValue = numberEncomenda.cells[2].textContent
            let slcFeito = document.getElementById("slcFeito")

            let dados = {
                txtSearchUserSet : numberEncomendaValue,
                slcFeitoSet : slcFeito.value,
                paginaSet : 1,
            }

            let containerDetailsEncomendas = document.getElementById("containerDetailsEncomendas")
            containerDetailsEncomendas.style.display = "block"

            let result = await $.post("././app/controller/function/funcLoadAnularDocumento.php", dados)

            let jsonResultInput = JSON.parse(result)

            if(jsonResultInput && Array.isArray(jsonResultInput.obj)){
                jsonResultInput.obj.forEach(element => {
                    document.getElementById("MeuMotivo").textContent = element.motivoAnulacao
                    document.getElementById("ObsDoAnulador").textContent = element.obsAnuladorAnulacao

                    document.getElementById("fornecedor").textContent = (element.pedidoFornecedotAnulacao == 0 ? "Não" : "Sim")
                    document.getElementById("emetidoGuia").textContent = (element.emitidofaturaAnulacao == 0 ? "Não" : "Sim")
                })
            }

            let btnCloseDetailsAnulacao = document.getElementById("btnCloseDetailsAnulacao")
            if(btnCloseDetailsAnulacao){
                btnCloseDetailsAnulacao.addEventListener("click", function(){
                    $(containerDetailsEncomendas).prop("style", "display: none !important")
                })
            }

            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

//sera global
function excluirItemListAnulacao(event){
    let row = event.target.closest(".rowList")
    row.remove()
}

async function checkVazioCampo(){

    let txtNumberOrder = document.getElementById("txtNumberOrder")
    let txtNumberGuia = document.getElementById("txtNumberGuia")
    let txtMoreInfo = document.getElementById("txtMoreInfo")
    let slcFornecedor = document.getElementById("slcFornecedor")
    let slcTipoAnulacao = document.getElementById("slcTipoAnulacao")

    if(slcTipoAnulacao.value == ""){
        msgAlert("alert-danger","Selecione um tipo de anulação.")
        slcTipoAnulacao.classList.add("textObrigatorio")
        return 0
    } else {
        if(slcTipoAnulacao.value == 2){
            if(txtNumberGuia.value == ""){
                msgAlert("alert-danger","Escreva o número da guia remessa")
                txtNumberGuia.classList.add("textObrigatorio")
                return 0
            } else {
                txtNumberGuia.classList.remove("textObrigatorio")
            }
        } else {
            slcTipoAnulacao.classList.remove("textObrigatorio")
        }
    }

    if(txtNumberOrder.value == ""){
        msgAlert("alert-danger","Escreva o múmero da encomenda primeiro.")
        txtNumberOrder.classList.add("textObrigatorio")
        return 0
    } else {
        txtNumberOrder.classList.remove("textObrigatorio")
    }

    if(txtMoreInfo.value == ""){
        msgAlert("alert-danger","Informe qual o motivo do cancelamento.")
        txtMoreInfo.classList.add("textObrigatorio")
        return 0
    } else {
        txtMoreInfo.classList.remove("textObrigatorio")
    }
}

async function addAnulacao(){
    return new Promise(async (resolve, reject) => {
        try {

            let tbodyNovaAnulacao = document.getElementById("tbodyNovaAnulacao")
            let teste = document.createElement("tr")
            teste.classList.add("rowList")

            let slcTipoAnulacao = document.getElementById("slcTipoAnulacao")
            let numberEncomenda = document.getElementById("txtNumberOrder")
            let numberGuia = document.getElementById("txtNumberGuia")
            let obsAnulacao = document.getElementById("txtMoreInfo")

            teste.innerHTML = `<td>${(slcTipoAnulacao.value == 1 ? "Encomenda" : "Documentos")}</td>
                                <td>${numberEncomenda.value}</td>
                                <td>${numberGuia.value}</td>
                                <td>${obsAnulacao.value}</td>
                                <td><i class='bi bi-trash btn btn-sm btn-outline-info' onclick='excluirItemList(event,"rowList")'></i></td>`

            let containerTableListAnulacao = document.getElementById("containerTableListAnulacao")
            if(containerTableListAnulacao.style.display == "none"){
                containerTableListAnulacao.style.display = "block"
            }
            tbodyNovaAnulacao.appendChild(teste)

            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

async function enviarAnular(){
    try {
        
        let dadosIr = {}
        let a = 1
        document.getElementById("tbodyNovaAnulacao").querySelectorAll(".rowList").forEach(rowCol1 => {
            
            if(rowCol1.cells[0].textContent != ""){
                dadosIr[a] = {
                    "encomenda" : rowCol1.cells[0].textContent,
                    "remessa" : rowCol1.cells[1].textContent,
                    "observacao": rowCol1.cells[2].textContent,
                }
                a++
            }
        })

        let dadosSend = {
            dados : dadosIr,
        }

        $.ajax({
            url: "././app/controller/function/funcSalvarAnulacao.php",
            type : "POST",
            contentType : "application/json",
            data : JSON.stringify(dadosSend),
            success : function(result){
                console.log(result)
                try {
                    let response = JSON.parse(result)
                    if(response.status == "success"){
                        msgAlert("alert-success", "Anulacao enviada com sucesso")
                    } else {
                        msgAlert("alert-danger", response.message || "Sem resposta")
                    }
                } catch (error) {
                    msgAlert("alert-danger","Erro ao processar a resposta do servidor")
                }
            },

            erro : function(error){
                console.error("Erro no try ", error)
                msgAlert("alert-danger","Ocorreu um erro.")
            }
        })
    } catch (error) {
        //fazer erro
    }

}

let btnProcurar = document.getElementById("btnProcurar")
if(btnProcurar){
    btnProcurar.addEventListener("click", async function(){
        let txtSearchUser = document.getElementById("txtSearchUser") ?.value || ""
        await loadAnulacao(txtSearchUser, 0, "")
    })
}

let btnNovaAnulacao = document.getElementById("btnNovaAnulacao")
if(btnNovaAnulacao){
    btnNovaAnulacao.addEventListener("click", function(){
        let containerNovaAnulacao = document.getElementById("containerNovaAnulacao")
        containerNovaAnulacao.style.display = "block"

        let btnCancelEnvio = document.getElementById("btnCancelEnvio")
        if(btnCancelEnvio){
            btnCancelEnvio.addEventListener("click", function(){

                document.getElementById("tbodyNovaAnulacao").querySelectorAll(".rowList").forEach(item => {
                    item.remove()
                })

                document.getElementById("containerTableListAnulacao").style.display = "none"

                let txtNumberOrder = document.getElementById("txtNumberOrder")
                let txtNumberGuia = document.getElementById("txtNumberGuia")
                let txtMoreInfo = document.getElementById("txtMoreInfo")

                txtNumberOrder.value = ""
                txtNumberGuia.value = ""
                txtMoreInfo.value = ""

                txtNumberOrder.parentNode.classList.remove("active")
                txtNumberGuia.parentNode.classList.remove("active")
                txtMoreInfo.parentNode.classList.remove("active")

                document.getElementById("containerNovaAnulacao").style.display = "none"
            })
        }

        let slcTipoAnulacao = document.getElementById("slcTipoAnulacao")
        if(slcTipoAnulacao){
            slcTipoAnulacao.addEventListener("change",async function(){
                console.log(1)
                let divNumberGuia = document.getElementById("divNumberGuia")
                if(slcTipoAnulacao.value == 2){
                    await openConfirmar("Confirme a ação","Esse tipo de anulação é indicado para quando já foi emitido guia de remessa e/ou fatura. <br> Deseja seguir?")

                    let btnConfirmar = document.getElementById("btnConfirmar")
                    if(btnConfirmar){
                        btnConfirmar.addEventListener("click", function(){
                            divNumberGuia.classList.remove("hidder")
                        })
                    }

                    let btnClose = document.getElementById("btnCloseModal")
                    if(btnClose){
                        btnClose.addEventListener("click", function(){
                            slcTipoAnulacao.value = ""
                            slcTipoAnulacao.parentNode.classList.remove("active") 
                        })
                    }
                } else {
                    divNumberGuia.classList.add("hidder")
                }
            })
        }
    })
}

let btnAdicionarAnulacao = document.getElementById("btnAdicionarAnulacao")
if(btnAdicionarAnulacao){
    btnAdicionarAnulacao.addEventListener("click",async function(){
        let txtNumberOrder = document.getElementById("txtNumberOrder")
        if(await checkVazioCampo() != 0){
            let result = await verListTable(txtNumberOrder.value,"tbodyNovaAnulacao","rowList",0)
            console.log(result)
            if(!result){
                let result = await verlistExistente(txtNumberOrder.value)
                if(result){
                    msgAlert("alert-danger","Essa encomenda já está em processo de cancelamento ou já foi cancelada, consulte o seu histórico")
                } else {
                    await addAnulacao()
                }
            } else {
                msgAlert("alert-danger","A encomenda já está na lista para ser envida")
            }
        } 

    })
}

let btnEnviarAnulacao = document.getElementById("btnEnviarAnulacao")
if(btnEnviarAnulacao){
    btnEnviarAnulacao.addEventListener("click", async function(){
        
        let result = await checkTableVazio("tbodyNovaAnulacao","rowList")
        if(result){
            await enviarAnular()
        } else {
            msgAlert("alert-danger","Nenhuma encomenda foi adicionada, primeiro adicione uma encomenda para poder enviar.")
        }
    })
}

let slcFeito= document.getElementById("slcFeito")
if(slcFeito){
    slcFeito.addEventListener("change",async function(){
        await loadAnulacao("",this.value,"")
    })
}