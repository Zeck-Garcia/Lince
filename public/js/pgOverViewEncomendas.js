window.addEventListener("DOMContentLoaded",async function(){
    try {
        await loadAssuntoDepartamento("slcAssuntoDepartamento")
    } catch (error) {
        //fazer erro
    }
})

let slcAssuntoDepartamento = document.getElementById("slcAssuntoDepartamento")
if(slcAssuntoDepartamento){
    slcAssuntoDepartamento.addEventListener("change",async function(){
        await loadAssunto("slcAssunto", this.value)
    })
}

// async function loadOverViewEncomendas(txtSearchUserGet, slcFeitoGet, lojasGet, assuntoDepartamentoGet, paginaGet){
//     return new Promise(async (resolve, reject)=>{
//         try {
//             let dados = {
//                 txtSearchUserSet : txtSearchUserGet,
//                 slcFeitoSet : slcFeitoGet,
//                 lojasSet : lojasGet,
//                 assuntoDepartamentoSet : assuntoDepartamentoGet,
//                 paginaSet : paginaGet,
//             }
            
//             let result = await $.post("././app/controller/function/funcLoadListOverView.php", dados)
//             let jsonResult = JSON.parse(result)
//             let tbodyOverView = document.getElementById("tbodyOverView")
//             try {
//                 if(jsonResult && Array.isArray(jsonResult.obj)){
//                     jsonResult.obj.forEach(element => {
//                         let teste = document.createElement("tr")
//                         teste.classList.add("rowList")

//                         teste.innerHTML = `<td>${element.}</td>
//                                             <td>${element.}</td>
//                                             <td>${element.}</td>
//                                             <td>${element.}</td>
//                                             <td>${element.}</td>
//                                             `

//                         tbodyOverView.append(teste)
//                     })
//                 } else {
//                     //nao é array erro
//                 }

//                 resolve()
//             } catch (error) {
//                 //fazer erro
//             }

//         } catch (error) {
//             //fazer erro
//         }
//     })
// }