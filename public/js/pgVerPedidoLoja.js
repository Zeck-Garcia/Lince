window.addEventListener("DOMContentLoaded",async function(){
    try {
        await buscarProdutoLoja("",3,"")
    } catch (error) {
        
    }
})

//func para buscar produto depois de feito
async function buscarProdutoLoja(codPodutoGet,sltFeitoGet,paginaGet){
    try {
        let tbodyPedido = document.querySelector("#tbodyPedido")
        tbodyPedido.innerHTML = ""

        let dados = {
            codPodutoSet : codPodutoGet,
            sltFeitoSet : sltFeitoGet,
            paginaSet : paginaGet,
        }
        
        let resultLista = await $.post("././app/controller/function/funcLoadTableProdutos.php", dados)

        let JSONResultList = JSON.parse(resultLista)

        if(JSONResultList && Array.isArray(JSONResultList.obj)){
            JSONResultList.obj.forEach(element => {

                let data = (element.dataFeitoPedido == null ? "" : element.dataFeitoPedido )
                
                let dataCriacao = (element.dataCriadoPedido)

                let feito = element.feitoPedido
                let textFeito = (feito == 0 ? "" : "Já solicitado")
                let btnExcluir = (feito == 0 ? "<i class='bi bi-trash' onclick='excluirProdutoFeito(event)'></i>" : "")
                let z = (feito == 1 ? "rowSuccess" : "''")

                let row = document.createElement("tr")

                row.classList.add("rowList")
                row.classList.add(z)
                row.setAttribute("data-id-row", element.idPedido)

                row.innerHTML = `<td>${textFeito}</td>
                                <td>${dataIso(data)}</td>
                                <td>${dataIso(dataCriacao)}</td>
                                <td>${element.codProdutoPedido}</td>
                                <td>${element.nomeProduto}</td>
                                <td>${element.qtdPedido}</td>
                                <td>${btnExcluir}</td>`

                tbodyPedido.append(row)
            })
        }

        let qtdRegistro = JSONResultList.obj[0].totalRegistro
        let qtdPagina = Math.ceil(qtdRegistro / JSONResultList.limite)
        let limite = JSONResultList.limite

        await pagination("paginationHome",qtdPagina, paginaGet, limite)

        document.querySelectorAll(".btnPgane").forEach(item => {
            if(item){
                item.addEventListener("click",async function(){
                    let txtProcurar = document.getElementById("txtProcurar") ?.value || ""
                    let sltFeito = document.querySelector("#sltFeito") ?.value || ""
                    let pagina = item.getAttribute("data-pagina")

                    await buscarProdutoLoja(txtProcurar,sltFeito,pagina)
                })
            }
        })

    } catch (error) {
        //fazer erro
    }
}

//func para excluir o produto depois de feito o pedido 
async function excluirProdutoFeito(event){
    try {
        await openConfirmar("Excluir produto do pedido?", "Deseja realmente excluir o produto atual da lista de pedido?")

        let btnConfirmar = document.querySelector("#btnConfirmar")
        if(btnConfirmar){
            btnConfirmar.addEventListener("click",async function(){
                let dados = {
                    idExcluirProdutoFeiroSet : event.target.closest(".rowList").getAttribute("data-id-row"),
                }
        
                let resultExcluir = await $.post("././app/controller/function/funcExcluirProdutoFeito.php", dados)
                if(resultExcluir == 1){
                    event.target.closest(".rowList").remove()
                }

                $("#divModalConfirmar").remove()
            })
        }

    } catch (error) {
        msgAlert("alert-danger", "Erro ao excluir produto, consulte se o mesmo foi excluido." + error)
    }
}

let btnBuscarProduto = document.querySelector("#btnBuscarProduto")
if(btnBuscarProduto){
    btnBuscarProduto.addEventListener("click", function(){
        let txtProcurar = document.querySelector ?.value || ""
        buscarProdutoLoja(txtProcurar,"","")
    })
}

let sltFeito = document.getElementById("sltFeito")
if(sltFeito){
    sltFeito.addEventListener("change", function(){
        buscarProdutoLoja("",this.value,"")
    })
}