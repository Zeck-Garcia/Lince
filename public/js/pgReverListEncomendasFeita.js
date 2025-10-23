window.addEventListener("DOMContentLoaded",async function(){
    try {
        await loadListLoja("slcLoja",0)
        await loadListEncomendasFeita(0,1,"")
    } catch (error) {
        
    }
})

async function loadListEncomendasFeita(sltLojaGet,sltFeitoGet,paginaGet) {
    return new Promise(async (resolve, reject)=> {
        try {

                let tbodyPedido = document.getElementById("tbodyPedido")
                tbodyPedido.innerHTML = ""

                let dados = {
                    sltLojaSet : sltLojaGet,
                    sltFeitoSet : sltFeitoGet,
                    paginaSet : paginaGet,
                }
                
                let result = await $.post("././app/controller/function/funcLoadTableProdutos.php", dados)
                console.log(result)
                let JSONResultList = JSON.parse(result)

                if(JSONResultList && Array.isArray(JSONResultList.obj)){
                    JSONResultList.obj.forEach(element => {

                        let teste = document.createElement("tr")
                        teste.classList.add("rowList")
                        teste.innerHTML = `<td>${element.nomeUser == null ? "" : element.nomeUser}</td>
                                            <td>${element.dataFeitoPedido == null ? "" : dataIso(element.dataFeitoPedido)}</td>
                                            <td data-idpedido='${element.idPedido}' data-idloja='${element.idLoja}' data-distrigal='${element.distrigalPedido}'>${element.nomeLoja}</td>
                                            <td>${dataIso(element.dataCriadoPedido)}</td>
                                            <td>${element.codProdutoPedido}</td>
                                            <td>${element.qtdPedido}</td>`
        
                        tbodyPedido.appendChild(teste)
                    })
                }

                let qtdRegistro = JSONResultList.obj[0].totalRegistro
                let qtdPagina = Math.ceil(qtdRegistro / JSONResultList.limite)
                let limite = JSONResultList.limite

                console.log(qtdRegistro)
                console.log(qtdPagina)
                console.log(limite)
    
                await pagination("paginationHome",qtdPagina,paginaGet, limite)
    
                document.querySelectorAll(".btnPgane").forEach(item => {
                    if(item){
                        item.addEventListener("click",async function(){
                            let pagina = item.getAttribute("data-pagina")
                            let slcLoja = document.getElementById("slcLoja") ?.value || ""

                            await loadListEncomendasFeita(slcLoja,sltFeitoGet,pagina)
                        })
                    }
                })

                resolve()

        } catch (error) {
            //fazer erro
        }
    })
}

let slcLoja = document.getElementById("slcLoja")
if(slcLoja){
    slcLoja.addEventListener("change", async function(){
        await loadListEncomendasFeita(this.value,1,"")
    })
}