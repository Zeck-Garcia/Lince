window.addEventListener("DOMContentLoaded",async function(){
    try {
        await loadListLoja("slcLoja")
        await loadRemocaoArtigo("",0,0,"")
    } catch (error) {
        //fazer erro
    }
})



async function loadRemocaoArtigo(txtSearchGet,lojaGet, feitoGet,paginaGet){
    return new Promise(async (resolve, reject)=> {
        try {

            let campos = await camposPage()

            let tbodyViewAnulacao = document.getElementById("tbodyViewAnulacao")
            tbodyViewAnulacao.innerHTML = ""
            
            let dados = {
                txtSearchSet : txtSearchGet,
                lojaSet : lojaGet,
                feitoSet : feitoGet,
                paginaSet : paginaGet,
            }

            let result = await $.post("././app/controller/function/funcLoadVerArtigoRemovido.php", dados)

            console.log(result)
            let JsonResult = JSON.parse(result)

            if(JsonResult && Array.isArray(JsonResult.obj)){
                JsonResult.obj.forEach(element => {

                    let teste = document.createElement("tr")
                    teste.classList.add("rowList")
                    teste.innerHTML = `<td>${(element.estadoRemoverArtigo == 1 ? "Feito" : "Por fazer")}</td>
                                        <td data-id='${element.idRemoverArtigo}'>${element.encomendaRemoverArtigo}</td>
                                        <td>${(element.artigoRemoverArtigo).replace(/\,/g,"<br>")}</td>
                                        <td>${dataIso(element.dataCriacaoRemoverArtigo)}</td>
                                        <td>${element.motivoRemoverArtigo}</td>
                                        <td>${(element.estadoRemoverArtigo == 1 ? "" : "<i class='bi bi-trash btn btn-outline-info' onclick='excluirCancelarRemoverArtigo(event)'>")}</i></td>`

                    tbodyViewAnulacao.append(teste)

                })
            }

            let qtdRegistro = JsonResult.obj[0].totalRegistro
            let qtdPagina = Math.ceil(qtdRegistro / JsonResult.limite)
            let limite = JsonResult.limite

            await pagination("paginationHome",qtdPagina,paginaGet, limite)

            document.querySelectorAll(".btnPgane").forEach(item => {
                if(item){
                    item.addEventListener("click",async function(){
                        let pagina = item.getAttribute("data-pagina")

                        await loadRemocaoArtigo(campos.txtSearchUser.value, campos.slcLoja.value, campos.slcFeito.value,pagina)
                    })
                }
            })

            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

async function camposPage() {
    return {
        txtSearchUser : document.getElementById("txtSearchUser"),
        slcLoja : document.getElementById("slcLoja"),
        slcFeito : document.getElementById("slcFeito"),
        txtNumberOrder : document.getElementById("txtNumberOrder"),
        txtNumberItem : document.getElementById("txtNumberItem"),
        txtMoreInfo : document.getElementById("txtMoreInfo"),
    }
}

async function excluirCancelarRemoverArtigo(event){
        try {

            let campos = await camposPage()

            let idEncomenda = event.target.closest(".rowList")
            let idEncomendaValue = idEncomenda.cells[1].getAttribute("data-id")
            let idEncomendaNumber = idEncomenda.cells[1].textContent
            
            await openConfirmar("Excluir encomenda",`Deseja mesmo excluir a encomenda <strong>${idEncomendaNumber}</strong>? \n Não será mais possivel recupara-la.`)

            let btnConfirmar = document.getElementById("btnConfirmar")
            if(btnConfirmar){
                btnConfirmar.addEventListener("click", async function(){
                    
                    await enviarRemocaoArtigo("Excluir",idEncomendaValue)

                    // await loadRemocaoArtigo(campos.txtSearchUser.value,campos.slcLoja.value,campos.slcFeito.value,"")
                })
            }

        } catch (error) {
            //fazer erro
        }
}

async function enviarRemocaoArtigo(actionGet,numberEncomendaGet) {
    try {
        let campos = await camposPage()

        let dadosIr = {}

        switch(actionGet){
            case "Salvar":
                let txtNumberOrder = document.getElementById("txtNumberOrder")
                let txtMoreInfo = document.getElementById("txtMoreInfo")

                let tbodyItemRemocao = document.getElementById("tbodyItemRemocao")
        
                let artigo = []
                tbodyItemRemocao.querySelectorAll(".rowList").forEach(item=>{
                    artigo.push(item.cells[0].textContent)
                })

                dadosIr = {
                    "idEncomenda" : txtNumberOrder.value,
                    "motivo" : txtMoreInfo.value,
                    "artigo" : JSON.stringify(artigo),

                }
            break

            case "Excluir":
                dadosIr = {
                    "idEncomenda" : numberEncomendaGet,
                }
            break
        }

        let dadosSend = {
            dados : dadosIr,
            action : actionGet,
        }

        console.log(dadosIr)
        console.log(actionGet)

        $.ajax({
            url: "././app/controller/function/funcCRUDRemocaoArtigo.php",
            type : "POST",
            contentType : "application/json",
            data : JSON.stringify(dadosSend),
            success : function(result){
                console.log(result)
                
                try {
                    let response = result
                    if(response.status == "success"){
                        msgAlert("alert-success", response.message || "Alteração finalizada com sucesso")
                    } else {
                        msgAlert("alert-danger","Sem resposta")
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

        await loadRemocaoArtigo(campos.txtSearchUser.value,campos.slcLoja.value,campos.slcFeito.value,"")
        
    } catch (error) {
        //fazer erro
    }
}

async function checkVazio(){
    let txtNumberOrder = document.getElementById("txtNumberOrder")
    let txtMoreInfo = document.getElementById("txtMoreInfo")
    let tbodyItemRemocao = document.getElementById("tbodyItemRemocao")

    if(txtNumberOrder.value.length < 7){
        txtNumberOrder.classList.add("textObrigatorio")
        msgAlert("alert-danger","Informe o número da encomenda")
        return 0
    } else {
        txtNumberOrder.classList.remove("textObrigatorio")
    }

    if(txtMoreInfo.value.length < 7){
        txtMoreInfo.classList.add("textObrigatorio")
        msgAlert("alert-danger","Escreva o motivo pelo qual será removido item")
        return 0
    } else {
        txtMoreInfo.classList.remove("textObrigatorio")
    }

    let txtNumberItem = document.getElementById("txtNumberItem")
    if(tbodyItemRemocao.querySelectorAll(".rowList").length == 0){
        txtNumberItem.classList.add("textObrigatorio")
        msgAlert("alert-danger","Informe ao menos um artigo para remoção")
        return 0
    } else {
        txtNumberItem.classList.remove("textObrigatorio")
    }
}

let btnProcurar = document.getElementById("btnProcurar")
if(btnProcurar){
    btnProcurar.addEventListener("click", async function(){
        let txtSearchUser = document.getElementById("txtSearchUser")

        await loadRemocaoArtigo(txtSearchUser.value,slcLoja.value,slcFeito.value,"")
    })
}

let slcLoja = document.getElementById("slcLoja")
if(slcLoja){
    slcLoja.addEventListener("change", async function(){
        await loadRemocaoArtigo("",this.value,slcFeito.value,"")
    })
}

let slcFeito = document.getElementById("slcFeito")
if(slcFeito){
    slcFeito.addEventListener("change", async function() {
        await loadRemocaoArtigo("",slcLoja.value,this.value,"")
    })
}

let btnNovaRemocao = document.getElementById("btnNovaRemocao")
if(btnNovaRemocao){
    btnNovaRemocao.addEventListener("click",async function(){
        let campos = await camposPage()
        let containerNovaAnulacao = document.getElementById("containerNovaAnulacao")
        containerNovaAnulacao.style.display = "block"

        //add item 
        let btnAddItemRemocao = document.getElementById("btnAddItemRemocao")
        if(btnAddItemRemocao){
            btnAddItemRemocao.addEventListener("click",async function(){
                let tbodyItemRemocao = document.getElementById("tbodyItemRemocao")
                let txtNumberItem = document.getElementById("txtNumberItem")
        
                if(txtNumberItem.value.length > 12){
                    let result = await verListTable(txtNumberItem.value,"tableAddItemRemocao","rowList",0)
                    if(result){
                        msgAlert("alert-danger","O item já está na lista")
                    } else {
                        let teste = document.createElement("tr")
                        teste.classList.add("rowList")
                        teste.innerHTML = `<td>${txtNumberItem.value}</td>
                                            <td><i class='bi bi-trash btn tbn-outline' onclick='excluirItemList(event,"rowList")'></i></td>`
                
                        tbodyItemRemocao.append(teste)
                
                        txtNumberItem.value = ""
                    }
                } else {
                    msgAlert("alert-danger", "Informe o código do produto.")
                }
        
            })
        }

        //enviar remocao
        let btnEnviarRemoverArtigo = document.getElementById("btnEnviarRemoverArtigo")
        if(btnEnviarRemoverArtigo){
            btnEnviarRemoverArtigo.addEventListener("click",async function(){
                //chamar func para enviar
                let result = await checkVazio()
                console.log(result)
                if(result != 0){
                    await enviarRemocaoArtigo("Salvar","")
                }
            })
        }

        //cancelar removao
        let btnCancelRemocao = document.getElementById("btnCancelRemocao")
        if(btnCancelRemocao){
            btnCancelRemocao.addEventListener("click", function(){
                
                campos.txtNumberOrder.value = ""
                campos.txtMoreInfo.value = ""
                
                document.getElementById("tbodyItemRemocao").querySelectorAll(".rowList").forEach(item=>{
                    item.remove()
                })

                containerNovaAnulacao.style.display = "none"
            })
        }
    })
}