window.addEventListener("DOMContentLoaded",async function(){
    try {
        await loadListaOrderCompra("",3,0,0)

        if(document.getElementById("slcFeito")){
            await loadListUtilizador("slcFeito")
        }
        
    } catch (error) {
        //fazer erro
    }
})

async function loadDadosOrderCompra(event,x){
    return new Promise(async (resolve, reject) => {
        try {
            let cama =  (event == "" ? "" : event.target.closest(".rowLine"))
            
            numberOrderCompra = (x == "" ? cama.cells[0].textContent : x)

            let dados = {
                numberOrderCompraSet : (x == "" ? cama.cells[0].textContent : x),
            }

            let resultDados = await $.post("././app/controller/function/funcLoadDadosOrderCompra.php", dados)
            let teste = document.createElement("div")

            teste.innerHTML = resultDados

            let infoOrdemCompra = document.querySelector("#infoOrdemCompra")
            infoOrdemCompra.textContent = ""

            infoOrdemCompra.appendChild(teste)

            let btnAprovar = document.querySelector("#btnAprovar")
            if(btnAprovar){
                btnAprovar.addEventListener("click", function(){

                    modalAprovarOrderCompra(numberOrderCompra,"aprovar")
                })
            }

            let btnRejeitar = document.querySelector("#btnRejeitar")
            if(btnRejeitar){
                btnRejeitar.addEventListener("click", function(){

                    modalAprovarOrderCompra(numberOrderCompra,"rejeitar")
                })
            }

            let divArquivo = document.getElementById("divArquivo")
            if(divArquivo){
                divArquivo.addEventListener("click", ()=>{
                    openModalviewAnexo(divArquivo.querySelector("span").textContent,1)

                })
            }

            await btnOpenAnexo(numberOrderCompra)
            resolve()
        } catch (error) {
            msgAlert("alert-danger", "Houve um erro ao carregar os detalhes da ordem de compra, atualize a página." + error)
        }
    })
}

async function btnOpenAnexo(numberOrderCompra){
    document.querySelectorAll(".anexoGroup").forEach((item => {
        if(item){
            item.addEventListener("click",async function(){
                await openModalviewAnexo(numberOrderCompra)
            })
        }
    }))
}

function loadListaOrderCompra(numberOrderCompraGet, aprovadoGet, feitoGet, paginaGet){
    return new Promise(async (resolve, reject) =>{
        try {

            let dados = {
                feitoSet : feitoGet,
                numberOrderCompraSet : numberOrderCompraGet,
                aprovadoSet : aprovadoGet,
                paginaSet : paginaGet,
            }

            let tbodyListOrder = document.querySelector("#tbodyListOrder")
            tbodyListOrder.innerHTML = ""

            let resultList = await $.post("././app/controller/function/funcListOrderCompra.php",dados)
            let JSONResultList = JSON.parse(resultList)

            if(JSONResultList && Array.isArray(JSONResultList.obj) && JSONResultList.obj.length > 0){
                JSONResultList.obj.forEach(element => {
                    let teste = document.createElement("tr")
                    if(element.aprovadoRejeitadoOrderCompra == 0){
                        teste.classList.add("rejeitado")
                    } else if(element.aprovadoRejeitadoOrderCompra == 1){
                        teste.classList.add("aprovado")
                    }

                    teste.classList.add("rowLine")
                    let mesa = ""
                    if(element.aprovadoRejeitadoOrderCompra == 1){
                        mesa = (element.emailEnviadoAoFornecedorOrderCompra == 1 ? "Sim" : "<i class='bi bi-send btn btn-outline-info btn-sm' onclick='enviarEmailFornecedot(event)'></i>");
                    }

                    teste.innerHTML = `<td>${element.codOrderCompra}</td>
                                        <td>${element.nomeUser}</td>
                                        <td>${dataIso(element.dataCriacaoOrderCompra)}</td>
                                        <td>${mesa}</td>
                                        <td><i class='bi bi-info btn btn-outline-info btn-sm' onclick="loadDadosOrderCompra(event,'')"></i></td>`
        
                    tbodyListOrder.appendChild(teste)
                })

                //pagination inicio
                let x = 0
                let btnActive = 0

                let qtdRegistro = (JSONResultList.obj.length == 0 ? "" : JSONResultList.obj[0].totalRegistro )
                let qtdPagina = Math.ceil(qtdRegistro / JSONResultList.limite)
                let limite = JSONResultList.limite

                let y = await pagination("paginationHome", qtdPagina, paginaGet, limite)

                document.querySelectorAll(".btnPgane").forEach(item => {
                    if(item){
                        item.addEventListener("click",async function(){
                            let numberOrderCompra = document.querySelector("#numberOrderCompra") ?.value || ""
                            let slcPedido = document.getElementById("slcPedido") ?.value || ""
                            let feito = document.getElementById("slcFeito") ?.value || ""

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
                            
                            await loadListaOrderCompra(numberOrderCompra,slcPedido,feito,x)
                        })
                    }
                })
                //pagination fim

            }

            resolve()
        } catch (error) {
            msgAlert("alert-danger", "Houve um erro ao carregar a lista com as ordens de compra. Atualize a página novamente." + error)
        }
    })
}

async function enviarEmailFornecedot(event) {
    try {
        await openConfirmar("Enviar email", "Deseja realmente enviar um email ao forncedor infomando do orçamento requerido.")

        let btnConfirmar = document.getElementById("btnConfirmar")
        if(btnConfirmar){
            btnConfirmar.addEventListener("click", async ()=>{
                loadStepAction("block","Aguarde...","Aguarde enquanto enviamos o email para o fornecedor.", "divModalConfirmar")
                numberOrderCompra = event.target.parentNode.parentNode.cells[0].textContent
        
                let dados = {
                    numberOrderCompraSet : numberOrderCompra,
                    actionSet : "solicitarOrcamento",
                    retornoOrcamentoSet : "",
                }
        
                let result = await $.post("././app/controller/function/funcEnviarEmail.php", dados)
                if(result == 1){
                    document.querySelector("#tbodyListOrder").querySelectorAll(".rowLine").forEach(item=>{
                        if(item.cells[0].textContent == numberOrderCompra){
                            loadStepAction("none","","")
                            item.cells[3].textContent = "Sim"
                        }
                    })
                    msgAlert("alert-success", "Email enviado com sucesso.")
                } else {
                    msgAlert("alert-danger", "Houve um erro ao enviar email para o fornecedor, atualize a página e volte a tentar.")
                }
                
                $("#divModalConfirmar").remove()
            })
        }

    } catch (error) {
        msgAlert("alert-danger","Erro ao enviar email ao fornecedor." + error)
    }
}

async function modalAprovarOrderCompra(x,y){
    try {
        let dados = {
            numberOrderCompraSet : x,
            aprovaRejeitaSet : y,
        }

        $.post("././app/views/pages/modal/modalAprovarOrderCompra.php",dados)
            .done(function(result){
                if(result != ""){
                    let teste = document.createElement("div")
                    teste.id = "divModal"
                    teste.innerHTML = result

                    document.body.append(teste)

                    closeModal()
                    let btnConfirmar = document.querySelector("#btnConfirmar")
                    if(btnConfirmar){
                        btnConfirmar.addEventListener("click", async function(){
                            loadStepAction("block","Espere","Aguarde enquanto finalizamos a ação.")

                            //chamar func para salvar
                            if(document.getElementById("txtAreaAprova").value != ""){
                                salvarAprovarRejeitarOrder(x,y)
                                
                            } else {
                                msgAlert("alert-danger", "Escreva alguma coisa.")
                            }
                        })
                    }
                }
            })

            .fail(function(){
                //fazer mensagem de erro
            })
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao abrir janela, tente atualizar a página.")
    }
}

async function salvarAprovarRejeitarOrder(x,y){
    return new Promise(async (resolve, reject)=>{
        try {
            
            let txtAreaAprovaGet = document.querySelector("#txtAreaAprova")

            let dados = {
                numberOrderCompraSet : x,
                aprovaRejeitaSet : y,
                txtAreaAprovaSet : txtAreaAprovaGet.value,
            }

            let resultSalve = await $.post("././app/controller/function/funcAprovarRejeitarOrderCompra.php",dados)
            let resultJson = JSON.parse(resultSalve)
            
            if(resultJson && Array.isArray(resultJson.obj)){
                if(resultJson.obj[0].msg == "success"){
                    msgAlert("alert-success","Ordem salva com sucesso.")

                    document.querySelectorAll(".rowLine").forEach(item => {
                        if(item.cells[0].textContent == x){
                            item.classList.add((y == "aprovar" ? "aprovado" : "rejeitado" ))
                        }
                    })

                    if(resultJson.obj[0].email == 1){
                        //enviar email
                        let result = await enviarEmail("solicitarOrcamento",x,"avisarSolicitante")
                        if(result != 1){
                            msgAlert("alert-danger","Houve um erro ao enviar o email para o fornecedor.")
                        }
                    } else {
                        document.getElementById("tbodyListOrder").querySelectorAll(".rowLine").forEach(item=>{
                            if(item.cells[0].textContent == x){
                                item.cells[3].innerHTML = `<i class='bi bi-send btn btn-outline-info btn-sm' onclick='enviarEmailFornecedot(event)'></i>`
                            }
                        })
                    }
                } else {
                    msgAlert("alert-danger","Houve um erro ao salvar a sua solicitação, verifique se foi salva.")
                }
            }
            
            loadStepAction("none","","")
            await loadDadosOrderCompra("",x)

            $("#divModal").remove()

            resolve()
        } catch (error) {
            msgAlert("alert-danger","Houve um erro ao salvar a sua ação,atualize a página e tente novamente." + error)
        }
    })
}

let btnProcurarOrderCompra = document.querySelector("#btnProcurarOrderCompra")
if(btnProcurarOrderCompra){
    btnProcurarOrderCompra.addEventListener("click",async function(){
        let numberOrderCompra = document.querySelector("#numberOrderCompra")
        let slcPedido = document.querySelector("#slcPedido").value
        await loadListaOrderCompra(numberOrderCompra.value,slcPedido,0,"")
        document.getElementById("infoOrdemCompra").innerHTML = ""
    })
}

let slcPedido = document.querySelector("#slcPedido")
if(slcPedido){
    slcPedido.addEventListener("change",async function(){
        let x = ""
        if(slcFeito){
            x = slcFeito.value
        } else {
            x = ""
        }
        await loadListaOrderCompra("",this.value,x,"")
        document.getElementById("infoOrdemCompra").innerHTML = ""
    })
}

document.querySelectorAll(".titleFile").forEach(item => {
    if(item){
        item.addEventListener("click", function(){
            viewAnexo("idAnexoGet")
        })
    }
})

let slcFeito = document.getElementById("slcFeito")
if(slcFeito){
    slcFeito.addEventListener("change", async ()=>{
        await loadListaOrderCompra("",slcPedido.value,slcFeito.value,"")
        document.getElementById("infoOrdemCompra").innerHTML = ""
    })
}
