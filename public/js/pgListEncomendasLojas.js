window.addEventListener("DOMContentLoaded",async function(){
    try {
        await loadListLoja("slcLoja",0)
        await loadListEncomendas(0,0)
    } catch (error) {
        //fazer erro
    }
})

async function loadListEncomendas(sltLojaGet,sltFeitoGet) {
    return new Promise(async (resolve, reject)=> {
        try {

                let tbodyPedido = document.getElementById("tbodyPedido")
                tbodyPedido.innerHTML = ""

                let dados = {
                    sltLojaSet : sltLojaGet,
                    sltFeitoSet : sltFeitoGet,
                }
                
                let result = await $.post("././app/controller/function/funcLoadTableProdutos.php", dados)

                let jsonResult = JSON.parse(result)

                if(jsonResult && Array.isArray(jsonResult.obj)){
                    jsonResult.obj.forEach(element => {

                        let teste = document.createElement("tr")
                        teste.classList.add("rowList")
                        teste.innerHTML = `<td><input type='checkbox' class=''></td>
                                            <td data-idpedido='${element.idPedido}' data-idloja='${element.idLoja}' data-distrigal='${element.distrigalPedido}'>${element.nomeLoja}</td>
                                            <td>${dataIso(element.dataCriadoPedido)}</td>
                                            <td>${element.codProdutoPedido}</td>
                                            <td>${element.qtdPedido}</td>`
        
                        tbodyPedido.appendChild(teste)
                    })
                }

                await chkAll("chkAll","rowList")

                resolve()
        } catch (error) {
            //fazer erro
        }
    })
}

async function baixaListEncomendas(){
    const rows = document.querySelectorAll('.rowList')
    const produtoMark = []

    let seqValue = 1
    rows.forEach(row => {
        const checkbox = row.cells[0].querySelector('input[type="checkbox"]')
        if (checkbox.checked) {
            
            let lojaValue = row.cells[1].getAttribute("data-idloja")
            let dataAtual = new Date()
            let dataAtualValue = `${dataAtual.getFullYear()}-${String(dataAtual.getMonth()).padStart(2, '0')}-${String(dataAtual.getDay()).padStart(2, '0')}`

            let empresaValue = 1
            let tiendaValue = (row.cells[1].getAttribute("data-distrigal") == 1 ? lojaValue : "17")
            let pedidoValue = "1024"
            let clienteValue = 0
            let lineaValue = seqValue
            let articuloValue = row.cells[3].textContent
            let cantidadValue = row.cells[4].textContent
            let confirmadoValue = "S"
            let almacenValue = lojaValue

            produtoMark.push({
                    "Empresa" : empresaValue,
                    "Tienda" : tiendaValue,
                    "Ref. Pedido" : "",
                    "Pedido" : pedidoValue,
                    "Fecha" : dataAtualValue,
                    "FechaServ" : dataAtualValue,
                    "Observación" : "",
                    "Cliente" : clienteValue,
                    "Nombre Cli" : "",
                    "Dirección" : "",
                    "Cod. Postal" : "",
                    "Población" : "",
                    "Cod. País" : "",
                    "Teléfono" : "",
                    "Email" : "",
                    "Línea" : lineaValue,
                    "Artículo" : articuloValue,
                    "Descripción" : "",
                    "Descripción2" : "",
                    "Descripción3" : "",
                    "Cantidad" : cantidadValue,
                    "Dto1" : "",
                    "Dto2" : "",
                    "Dto3" : "",
                    "Dto4" : "",
                    "Precio" : "",
                    "Fecha Alta" : "",
                    "Serie Pedido" : "",
                    "Dirección Envío" : "",
                    "Confirmado" : confirmadoValue,
                    "Usuario" : "",
                    "Dni/Cif" : "",
                    "Forma Pago" : "",
                    "Direnv Nombre" : "",
                    "Direnv Dirección" : "",
                    "Direnv Cpostal" : "",
                    "Direnv Población" : "",
                    "Direnv Cpais" : "",
                    "Direnv Telefono" : "",
                    "Direnv Email" : "",
                    "Tipo Entrega" : "",
                    "Tipo Entrega Linea" : "",
                    "Importe cobro" : "",
                    "Tipo Pago" : "",
                    "Precio Coste" : "",
                    "Vendedor" : "",
                    "Cant. Pedido Prov" : "",
                    "RefPed Prov" : "",
                    "Fecha PedProv" : "",
                    "Recibir" : "",
                    "Fecha Recepción" : "",
                    "Entregar" : "",
                    "Fecha Entrega" : "",
                    "Almacén" : almacenValue,
                    "Pedido Web" : "",
                    "Situación Pedido" : "",
                    "Refped Lin" : "",
                    "Proveedor" : "",
                    "Descripción Proveedor" : "",
                    "Descripcion 2 Proveedor" : "",
                    "Fecha Cobro" : "",
            })
            seqValue++
        }
    })

    if (produtoMark.length === 0) {
        msgAlert("alert-danger","Nenhum produto selecionado. Selecione um produto ao menos")
        return
    }

    const ws = XLSX.utils.json_to_sheet(produtoMark)
    const wb = XLSX.utils.book_new()
    XLSX.utils.book_append_sheet(wb, ws, "Criar")
    
    XLSX.writeFile(wb, "produtos_selecionados.xlsx")
    
   await salvarListBaixada()
}

async function reverLinhachecked(){
    document.querySelectorAll(".rowList").forEach(item => {
        let check = item.cells[0].querySelector('input[type="checkbox"]')
        if(check.checked){
            item.remove()
        }
    })
}

async function salvarListBaixada(){
    return new Promise(async (resolve, reject)=> {
        try {

            let dadosValue = []
            document.querySelectorAll(".rowList").forEach(item => {
                let inputCheked = item.cells[0].querySelector('input[type="checkbox"]')
                if(inputCheked.checked){
                    dadosValue.push(item.cells[1].getAttribute("data-idpedido"))
                }
            })

            let dados = {
                dadosValueSet : JSON.stringify(dadosValue),
            }

            let result = await $.post("././app/controller/function/funcSalvarListBaixadaEncomendas.php", dados)
            console.log(result)
            try {
                let response = JSON.parse(result)
                console.log(response.status)
                if(response.status == "success"){
                    msgAlert("alert-success", "Pedido finalizdo com sucesso")
                    await reverLinhachecked()
                } else if (response.status === "error") {
                    msgAlert("alert-danger", response.message)
                } else {
                    msgAlert("alert-danger","Sem resposta")
                }
            } catch (error) {
                msgAlert("alert-danger","Erro ao processar a resposta do servidor")
            }

            resolve()
        } catch (error) {
            //fazer erro
        }
    })
} 



let slcLoja = document.getElementById("slcLoja")
if(slcLoja){
    slcLoja.addEventListener("change", async function(){
        document.getElementById("chkAll").checked = false
        await loadListEncomendas(this.value,0)
    })
}

let btnBaixarEncomendas = document.getElementById("btnBaixarEncomendas")
if(btnBaixarEncomendas){
    btnBaixarEncomendas.addEventListener("click",async function(){
        //chamar func
        await baixaListEncomendas()
    })
}