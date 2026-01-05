window.addEventListener("DOMContentLoaded",async function(){
    try {

    } catch (error) {
        
    }
})

//func da page fazer pedido para buscar o produto e trazer os detalhes
async function buscarProduto(x){
    try {

        document.querySelector("#containerProduto").innerHTML = ""

        let dados = {
            codPodutoSet : x,
        }

        let resultBuscaProduto = await $.post("././app/controller/function/funcViewProduto.php", dados)

        let teste = document.createElement("div")
        teste.classList.add("row1")
        teste.style.width = "100%"

        if(resultBuscaProduto != 0){
            teste.innerHTML = resultBuscaProduto
        } else {
            teste.innerHTML = "<div class='alert alert-danger' role='alert' style='width: 100%;'>Produto não encontrado</div>"
        }

        document.querySelector("#containerProduto").append(teste)

        document.querySelector("#btnAdicionarProduto").addEventListener("click", async function(){
            let checkVazio = valideVazio()
            if(checkVazio != 0){
                let verIgual = await verListIgual()
                if(!verIgual){
                    addProduto()
                }
            }
        })

    } catch (error) {
        
    }
}

//func para excluir o pedido enquando faz o pedido
function excluirProduto(event){
    
    let aqui = event.target.closest(".rowList")
    
    aqui.remove()
}

//func para add o produto a lista de pedido
function addProduto(){
    return new Promise((resolve, reject) => {
        try {
            let codProduto = document.querySelector("#titleProduto").getAttribute("data-codproduto")
            let nomeProduto = document.querySelector("#titleProduto").textContent
            let qtdProduto = document.querySelector("#txtQtdProduto").value
            let distrigal = document.querySelector("#titleProduto").getAttribute("data-distrigral")

            let tBody = document.querySelector("#tbodyPedido")

            let teste = document.createElement("tr")
            teste.classList.add("rowList")

            teste.innerHTML = `<td></td><td data-distrigal='${distrigal}'>${codProduto}</td><td>${nomeProduto}</td><td>${qtdProduto}</td><td><i class='bi bi-trash' onclick='excluirProduto(event)'></i></td>`

            tBody.appendChild(teste)

            resolve()

            msgAlert("alert-success",`Produto <strong>${codProduto}</strong> adionado a lista com sucesso.`,3000)

        } catch (error) {
            
        }
    })
}

//valida os campos antes de adicionar a lista
function valideVazio(){
    let txtProcurarProduto = document.querySelector("#txtProcurarProduto")
    let txtQtdProduto = document.querySelector("#txtQtdProduto")

    if(txtProcurarProduto && txtProcurarProduto.value == ""){
        msgAlert("alert-danger","Informe o código do produto para para adicionar um item.")
        return 0
    }

    if(txtQtdProduto && txtQtdProduto.value == ""){
        msgAlert("alert-danger","A quantidade está vazia, informe a quantidade.")
        return 0
    }
}

//func para ver se o produto a add sao iguais
async function verListIgual(){
    let existe = false
    let txtProcurarProduto = document.querySelector("#txtProcurarProduto")
    document.querySelectorAll(".rowList").forEach((row) => {
        if(row.cells[1].textContent == txtProcurarProduto.value.replace(/\s/g,"")){
            msgAlert("alert-danger","O produto já está na lista exclua primeiro e depois volte adicona-lo.")
            existe = true
        }
    })

    return existe
}

//func para ver se a lista está vazia antes de enviar o pedido
async function verListVazio(){
    let existe = false
    document.querySelectorAll(".rowList").forEach(row => {
        if(row != 0){
            existe = true      
        }
    })
    return existe
}

//func ao enviar ver se os produto ja foram enviado caso nao, pode enviar
async function verEnvio(){
    let existe = false
    document.querySelectorAll(".rowList").forEach(rowCol1 => {
        if(rowCol1.cells[0].textContent == ""){
            existe = true
        }
    })
    return existe
}

//func enviar lista de pedidos
async function enviarList(){
    if(verListVazio()){
        let resultVerEnviar = await verEnvio()
        if(resultVerEnviar){
            try {
    
                let dados = {}
                let a = 1
                document.querySelectorAll(".rowList").forEach(rowCol1 => {
                    console.log(rowCol1.cells[1].getAttribute("data-distrigal"))
                    if(rowCol1.cells[0].textContent == ""){
                        dados[a] = {
                            "produto" : rowCol1.cells[1].textContent,
                            "qtd" : rowCol1.cells[3].textContent,
                            "distrigal": rowCol1.cells[1].getAttribute("data-distrigal"),
                        }
                        a++
                    } else {
                        
                    }
                })
    
                let dadosSend = {
                    dados : dados,
                    textoEntra : "Aqui vai ter"
                }
    
                $.ajax({
                    url: "././app/controller/function/funcSalvarListPedido.php",
                    type : "POST",
                    contentType : "application/json",
                    data : JSON.stringify(dadosSend),
                    success : function(result){
                        try {
                            let response = JSON.parse(result)
                            if(response.status == "success"){
                                msgAlert("alert-success", "Pedido enviado com sucesso")
                                document.querySelectorAll(".rowList").forEach(rowMark => {
                                    rowMark.cells[0].textContent = "Enviado"
                                    rowMark.cells[4].textContent = ""
                                })
                            } else if (response.status === "error") {
                                msgAlert("alert-danger", response.message)
                            } else {
                                msgAlert("alert-danger","Sem resposta")
                            }
                        } catch (error) {
                            msgAlert("alert-danger","Erro ao processar a resposta do servidor")
                        }
                    },
    
                    erro : function(error){
                        console.log("fazer erro")
                    }
                })
    
            } catch (error) {
                console.log("fazer erro")
            }
        } else {
            msgAlert("alert-danger", "A lista já foi enviada,faça uma nova lista.")
        }
    } else {
        msgAlert("alert-danger","A lista está vazia, primeiro monte a sua lista e depois faça o envio.")
    }
}

let btnBuscarProduto = document.querySelector("#btnBuscarProduto")
if(btnBuscarProduto){
    btnBuscarProduto.addEventListener("click", function(){
        let txtProcurarProduto = document.querySelector("#txtProcurarProduto")
        if(txtProcurarProduto && txtProcurarProduto.value != ""){
            buscarProduto(txtProcurarProduto.value)
        } else {
            msgAlert("alert-warning", "Digite o código do produto primeiro")
        }
    })
}

let btnLimparLista = document.querySelector("#btnLimparLista")
if(btnLimparLista){
    btnLimparLista.addEventListener("click", function(){
        document.querySelectorAll(".rowList").forEach(row =>{
            row.remove()
        })
    })
}

let btnEnviarLista = document.querySelector("#btnEnviarLista")
if(btnEnviarLista){
    btnEnviarLista.addEventListener("click", async function(){
        await enviarList()
    })
}