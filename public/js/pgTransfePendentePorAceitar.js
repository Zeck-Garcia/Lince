window.addEventListener("DOMContentLoaded",async function(){
    try {
        await loadTransferencia("",0,"")
    } catch (error) {
        //fazer erro
    }
})

async function loadTransferencia(txtSearchUserGet,slcFeitoGet,paginaGet) {
    return new Promise(async (resolve, reject)=>{
        try {
            let tbodyListTrasnf = document.getElementById("tbodyListTrasnf")
            tbodyListTrasnf.innerHTML = ""

            let dados = {
                txtSearchUserSet : txtSearchUserGet,
                slcFeitoSet : slcFeitoGet,
                lojaSet : 0,
                paginaSet : paginaGet,
            }

            let result = await $.post("././app/controller/function/funcLoadVerTransferencia.php",dados)

            let JSONResult = JSON.parse(result)

            if(JSONResult && Array.isArray(JSONResult.obj)){
                JSONResult.obj.forEach(Element=>{
                    let teste = document.createElement("tr")
                    teste.classList.add("rowList")
                    teste.innerHTML = `<td>${(Element.estadoTransferencia == 0 ? "Por fazer" : "Feita" )}</td>
                                        <td>${(Element.tipoTransferencia == 1 ? "Pendente de aceitar" : "Falta de stock" )}</td>
                                        <td>${dataIso(Element.criadoEmTransferencia)}</td>
                                        <td>${(Element.numeroTransferenciaTransferencia == null ? "" : Element.numeroTransferenciaTransferencia)}</td>
                                        <td>${(Element.encomedaTransferencia == null ? "" : Element.encomedaTransferencia )}</td>
                                        <td>${(Element.artigoTransferencia).replace(/\,/g,"<br>")}</td>
                                        <td>${(Element.estadoTransferencia == 0 ? "<i class='bi bi-trash btn btn-outline-info' onclick=''></i>" : "")}</td>`
    
                    tbodyListTrasnf.append(teste)
                })
            }

            let qtdRegistro = JSONResult.obj[0].totalRegistro
            let qtdPagina = Math.ceil(qtdRegistro / JSONResult.limite)
            let limite = JSONResult.limite

            await pagination("paginationHome",qtdPagina,paginaGet, limite)

            document.querySelectorAll(".btnPgane").forEach(item => {
                if(item){
                    item.addEventListener("click",async function(){

                        let pagina = item.getAttribute("data-pagina")
                        let txtSearchUser = document.getElementById("txtSearchUser") ?.value || ""
                        let slcFeito = document.getElementById("slcFeito")

                        await loadTransferencia(txtSearchUser, slcFeito.value, pagina)
                    })
                }
            })

            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

async function checkVazio(){

    let slcTipoTransf = document.getElementById("slcTipoTransf")
    let txtNumberTransf = document.getElementById("txtNumberTransf")
    let txtNumberOrder = document.getElementById("txtNumberOrder")
    let tableAddItem  = document.getElementById("tableAddItem")
    let txtNumberItem = document.getElementById("txtNumberItem")

    if(slcTipoTransf.value.length == ""){
        slcTipoTransf.classList.add("textObrigatorio")
        msgAlert("alert-danger","Informe qual é o tipo de transferência")
        return 0
    } else {
        slcTipoTransf.classList.remove("textObrigatorio")
    }

    if(txtNumberTransf.value == ""){
        if(txtNumberOrder.value != ""){
            txtNumberTransf.classList.remove("textObrigatorio")
            txtNumberOrder.classList.remove("textObrigatorio")
        } else {
            if(txtNumberTransf.value.length < 4){
                txtNumberTransf.classList.add("textObrigatorio")
                txtNumberOrder.classList.add("textObrigatorio")
                msgAlert("alert-danger","Informe o número da transferência ou o numero da encomenda")
                return 0
            } else {
                txtNumberTransf.classList.remove("textObrigatorio")
                txtNumberOrder.classList.remove("textObrigatorio")
            }
        }
    } else {
        if(txtNumberOrder.value != ""){
            txtNumberTransf.classList.remove("textObrigatorio")
            txtNumberOrder.classList.remove("textObrigatorio")
        } else {
            if(txtNumberTransf.value != ""){
                txtNumberTransf.classList.remove("textObrigatorio")
                txtNumberOrder.classList.remove("textObrigatorio")
            } else {
                if(txtNumberOrder.value.length < 4){
                    txtNumberOrder.classList.add("textObrigatorio")
                    msgAlert("alert-danger","Informe o número da transferência")
                    return 0
                } else {
                    txtNumberOrder.classList.remove("textObrigatorio")
                }
            }
        }
    }

    if(tableAddItem.querySelectorAll(".rowList").length == 0){
        txtNumberItem.classList.add("textObrigatorio")
        msgAlert("alert-danger","Informe ao menos um artigo para remoção")
        return 0
    } else {
        txtNumberItem.classList.remove("textObrigatorio")
    }
}

let btnCancelNovo = document.getElementById("btnCancelNovo")
if(btnCancelNovo){
    btnCancelNovo.addEventListener("click", function(){
        let txtNumberTransf = document.getElementById("txtNumberTransf")
        let txtNumberOrder = document.getElementById("txtNumberOrder")
        let txtNumberItem = document.getElementById("txtNumberItem")
        let tableAddItem = document.getElementById("tableAddItem")

        txtNumberTransf.value = ""
        txtNumberOrder.value = ""
        txtNumberItem.value = ""
        tableAddItem.value = ""

        txtNumberTransf.parentNode.classList.remove("active")
        txtNumberOrder.parentNode.classList.remove("active")
        txtNumberItem.parentNode.classList.remove("active")
        tableAddItem.parentNode.classList.remove("active")

        document.getElementById("tableAddItem").querySelectorAll(".rowList").forEach(item=>{
            item.remove()
        })

        document.getElementById("containerNovaTransf").style.display = "none"
        document.getElementById("containerTableList").style.display = "none"

    })
}

let btnNovaTranfe = document.getElementById("btnNovaTranfe")
if(btnNovaTranfe){
    btnNovaTranfe.addEventListener("click", function(){
        document.getElementById("containerNovaTransf").style.display = "block"
    })
}

let slcFeito = document.getElementById("slcFeito")
if(slcFeito){
    slcFeito.addEventListener("change", async function(){
        loadTransferencia("", this.value, "")
    })
}

let btnProcurar = document.getElementById("btnProcurar")
if(btnProcurar){
    btnProcurar.addEventListener("click",async function(){
        let txtSearchUser = document.getElementById("txtSearchUser") ?.value || ""
        await loadTransferencia(txtSearchUser, "", "")
    })
}

let btnAddArtigo = document.getElementById("btnAddArtigo")
if(btnAddArtigo){
    btnAddArtigo.addEventListener("click",async function(){
        //chamar func add
        let tbodyItem = document.getElementById("tbodyItem")
        let txtNumberItem = document.getElementById("txtNumberItem")

        if(txtNumberItem.value.length > 12){
            let result = await verListTable(txtNumberItem.value,"tbodyItem","rowList",0)
            if(result){
                msgAlert("alert-danger","O item já está na lista")
            } else {
                let teste = document.createElement("tr")
                teste.classList.add("rowList")
                teste.innerHTML = `<td>${txtNumberItem.value}</td>
                                    <td><i class='bi bi-trash btn tbn-outline' onclick='excluirItemList(event,"rowList")'></i></td>`
        
                tbodyItem.append(teste)
        
                txtNumberItem.value = ""
                txtNumberItem.parentNode.classList.remove("active")
            }
        } else {
            msgAlert("alert-danger", "Informe o código do produto.")
        }
    })
}

let btnAddListEnvio = document.getElementById("btnAddListEnvio")
if(btnAddListEnvio){
    btnAddListEnvio.addEventListener("click",async function(){

        let tbodyenviarTransf = document.getElementById("tbodyenviarTransf")
        let txtNumberTransf = document.getElementById("txtNumberTransf")
        let txtNumberOrder = document.getElementById("txtNumberOrder")

        let resultTransAqui = await verlistExistenteDupla(txtNumberTransf.value, "tbTransferencia", "numeroTransferenciaTransferencia")

        if(resultTransAqui){
            msgAlert("alert-danger",`A transferência já existe, entre em contacto com o departamento de encomendas para saber mais.`)
        } else {
            let resultEncomenda = await verlistExistenteDupla(txtNumberOrder.value, "tbTransferencia", "encomedaTransferencia")
            if(resultEncomenda){
                msgAlert("alert-danger",`A encomenda ja tem uma transferência em curso, entre em contacto com o departamento de encomendas para saber mais.`)
            } else {

                let cama = []
                document.getElementById("tbodyItem").querySelectorAll(".rowList").forEach(item=>{
                    cama.push(item.cells[0].textContent)
                })

                let resultVazio = await checkVazio()
                if(resultVazio != 0){
                    document.getElementById("containerTableList").style.display = "block"

                    let teste = document.createElement("tr")
                    teste.classList.add("rowList")
                    teste.innerHTML = `<td>${txtNumberTransf.value}</td>
                                        <td>${txtNumberOrder.value}</td>
                                        <td>${cama}</td>
                                        <td><i class='bi bi-trash btn tbn-outline' onclick='excluirItemList(event,"rowList")'></i></td>`
            
                    tbodyenviarTransf.append(teste)

                    document.getElementById("tableAddItem").querySelectorAll(".rowList").forEach(item => {
                        item.remove()
                    })

                    document.getElementById("txtNumberTransf").value = ""
                    document.getElementById("txtNumberOrder").value = ""
                    document.getElementById("txtNumberItem").value = ""
                    
                    document.getElementById("txtNumberTransf").parentNode.classList.remove("active")
                    document.getElementById("txtNumberOrder").parentNode.classList.remove("active")
                    document.getElementById("txtNumberItem").parentNode.classList.remove("active")

                }

            }
        }
    })
}