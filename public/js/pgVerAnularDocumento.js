window.addEventListener("DOMContentLoaded",async function(){
    try {
        await loadListLoja("slcLoja",0)
        await loadListVerAnulacao("",0, 0, "")
    } catch (error) {
        //fazer erro
    }
})


async function loadListVerAnulacao(txtSearchGet, lojaGet, feitoGet, paginaGet){
    return new Promise(async (resolve, reject)=> {
        try {
            
            let dados = {
                txtSearchSet : txtSearchGet,
                lojaSet : lojaGet,
                feitoSet : feitoGet,
                paginaSet : paginaGet,
            }

            let tbodyViewAnulacao = document.getElementById("tbodyViewAnulacao")
            tbodyViewAnulacao.innerHTML = ""

            let result = await $.post("././app/controller/function/funcLoadVerAnularDocumento.php", dados)

            console.log(result)
            let JSONResult = JSON.parse(result)

            if(JSONResult && Array.isArray(JSONResult.obj)){
                JSONResult.obj.forEach(element => {
            
                    let teste = document.createElement("tr")
                    teste.classList.add("rowList")
                    teste.innerHTML = `<td data-id='${element.idAnulacao}'><input type='checkbox'></td>
                                        <td>${capitalizar(element.nomeLoja)}</td>
                                        <td>${element.encomendaAnulacao}</td>
                                        <td>${dataIso(element.dataCriadoAnulacao)}</td>`

                    tbodyViewAnulacao.appendChild(teste)
                })
            }

            await chkAll("chkAll","rowList")

            let campos = camposPage()



            if(campos){
                campos.tbnFecharEnvio.addEventListener("click", function(){
                    let containerFinalizarAnulacao = document.getElementById("containerFinalizarAnulacao")

                    document.getElementById("containerFinalizarAnulacao").querySelectorAll(".rowList").forEach(item => {
                        item.remove()
                    })
                    containerFinalizarAnulacao.style.display = "none"
                })
            }

            let qtdRegistro = JSONResult.obj[0].totalRegistro
            let qtdPagina = Math.ceil(qtdRegistro / JSONResult.limite)
            let limite = JSONResult.limite

            await pagination("paginationHome",qtdPagina,paginaGet, limite)

            document.querySelectorAll(".btnPgane").forEach(item => {
                if(item){
                    item.addEventListener("click",async function(){
                        let pagina = item.getAttribute("data-pagina") //nao remover
                        let slcLoja = document.getElementById("slcLoja")
                        let slcFeito = document.getElementById("slcFeito")

                        await loadListVerAnulacao("", slcLoja.value, slcFeito.value, pagina)
                    })
                }
            })

            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

async function addEncomendaList() {
    return new Promise((resolve, reject)=>{
        try {
            console.log(1)
            let tbodyEnviarListAnulacao = document.getElementById("tbodyEnviarListAnulacao")

            document.getElementById("tbodyViewAnulacao").querySelectorAll(".rowList").forEach(async item=>{
                if(item.cells[0].querySelector("input[type='checkbox']").checked == true){
                    let result = await verListTable(item.cells[2].textContent,"tableAnularFinal","rowList",2)
                    if(result){
                        msgAlert("alert-danger",`A <strong>${item.cells[2].textContent}</strong> já está na lista para ser finalizada`)
                    } else {

                        let containerFinalizarAnulacao = document.getElementById("containerFinalizarAnulacao")

                        if(containerFinalizarAnulacao.style.display == "none"){
                            containerFinalizarAnulacao.style.display = "block"
                        }

                        let x = new Date()
                        let dia = x.getDate().toString().padStart(2,"0")
                        let mes = (x.getMonth() + 1).toString().padStart(2, "0")
                        let ano = x.getFullYear()

                        let teste = document.createElement("tr")
                        teste.classList.add("rowList")
                        teste.innerHTML = `<td></td>
                                            <td>${item.cells[1].textContent}</td>
                                            <td data-id='${item.cells[0].getAttribute("data-id")}'>${item.cells[2].textContent}</td>
                                            <td>${dia}/${mes}/${ano}</td>
                                            <td><i class='bi bi-trash' onclick='excluirItemList(event,"rowList")'></i></td>`
            
                        tbodyEnviarListAnulacao.append(teste)
                    }
                } else {
                    //ver saida
                }
            })

            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

async function salvarFeitoAnulacao() {
    try {
        
        let dadosIr = {}
        let a = 1
        document.getElementById("tbodyEnviarListAnulacao").querySelectorAll(".rowList").forEach(rowCol1 => {
            
            if(rowCol1.cells[0].textContent == ""){
                dadosIr[a] = {
                    "idEncomenda" : rowCol1.cells[2].getAttribute("data-id"),
                }
                a++
            }
        })

        console.log(dadosIr)

        let dadosSend = {
            dados : dadosIr,
        }

        $.ajax({
            url: "././app/controller/function/funcCRUDFinalizarAnulacao.php",
            type : "POST",
            contentType : "application/json",
            data : JSON.stringify(dadosSend),
            success : function(result){
                console.log(result)
                try {
                    let response = JSON.parse(result)
                    if(response.status == "success"){
                        msgAlert("alert-success", "Anulacao finalizada com sucesso")

                        document.getElementById("tableAnularFinal").querySelectorAll(".rowList").forEach(item => {
                            item.cells[0].textContent = "Finalizada"
                            item.cells[4].textContent = ""
                        })

                    } else if (response.status === "error") {
                        msgAlert("alert-danger", response.message || "Houve um erro ao enviar a anulação")
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

    } catch (error) {
        //fazer erro
    }
}

function camposPage(){
    return {
        txtSearchUser : document.getElementById("txtSearchUser"),
        slcLoja : document.getElementById("slcLoja"),
        slcFeito : document.getElementById("slcFeito"),
        btnProcurar : document.getElementById("btnProcurar"),
        btnAddListAnulacao : document.getElementById("btnAddListAnulacao"),
        btnFinalizarEnviarList : document.getElementById("btnFinalizarEnviarList"),
        tbnFecharEnvio : document.getElementById("tbnFecharEnvio"),
    }
}


let btnFinalizarEnviarList = document.getElementById("btnFinalizarEnviarList")
if(btnFinalizarEnviarList){
    btnFinalizarEnviarList.addEventListener("click", async function(){
        salvarFeitoAnulacao()
    })
}



let btnAddListAnulacao = document.getElementById("btnAddListAnulacao")
if(btnAddListAnulacao){
    btnAddListAnulacao.addEventListener("click",async function(){
        let result = await checkMark("tbodyViewAnulacao", "rowList", 0)
        console.log(result)
        if(!result){
            await addEncomendaList()
        } else {
            msgAlert("alert-danger","Selecione ao menos uma encomenda para adicionar a lista")
        }
    })
}

let slcLoja = document.getElementById("slcLoja")
if(slcLoja){
    slcLoja.addEventListener("change",async function(){
        await loadListVerAnulacao("",this.value, slcFeito.value, "")
    })
}

let slcFeito = document.getElementById("slcFeito")
if(slcFeito){
    slcFeito.addEventListener("change", async function(){
        await loadListVerAnulacao("",slcFeito.value, this.value, "")
    })
}

let btnProcurar = document.getElementById("btnProcurar")
if(btnProcurar){
    btnProcurar.addEventListener("click",async function(){
        let txtSearchUser = document.getElementById("txtSearchUser")
        await loadListVerAnulacao(txtSearchUser.value,slcFeito.value, slcFeito.value,"")
    })
}