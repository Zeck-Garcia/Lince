window.addEventListener("DOMContentLoaded",async function(){
    try {

    } catch (error) {
        
    }
})

async function openModalAddEmpresa(){
    try {
        let resultOpenModalAddEmpresa = await $.post("././app/views/pages/modal/modalCrudFornecedor.php")
            if(resultOpenModalAddEmpresa != ""){
                let teste = document.createElement("div")
                teste.id = "divModal"
                teste.innerHTML = resultOpenModalAddEmpresa

                document.body.append(teste)

                campoInputLabelSuspenso()
                closeModal()

                let txtAddNomeEmpresa = document.querySelector("#txtAddNomeEmpresa")
                let txtAddSiteEmpresa = document.querySelector("#txtAddSiteEmpresa")
                let txtAddtEmailEmpresa = document.querySelector("#txtAddEmailEmpresa")

                let btnSalvarUsar = document.querySelector("#btnSalvarUsar")
                if(btnSalvarUsar){
                    btnSalvarUsar.addEventListener("click",async function(){
                        if(txtAddNomeEmpresa.value == ""){
                            txtAddNomeEmpresa.classList.add("textObrigatorio")
                            txtAddNomeEmpresa.focus()
                            msgAlert("alert-danger","Informe o nome da empresa")
                            return
                        } else {
                           txtAddNomeEmpresa.classList.remove("textObrigatorio") 
                        }
        
                        if(txtAddtEmailEmpresa.value == ""){
                            txtAddtEmailEmpresa.classList.add("textObrigatorio")
                            txtAddtEmailEmpresa.focus()
                            msgAlert("alert-danger","Deixe um email para seguir, usaremos esse email para notificar a empresa quando o orçamento for aprovado")
                            return
                        } else {
                            txtAddtEmailEmpresa.classList.remove("textObrigatorio")
                        }

                        await CrudEmpresa("", txtAddNomeEmpresa.value, txtAddSiteEmpresa.value, txtAddtEmailEmpresa.value,"criar")
                    })
                }

                let btnSalvar = document.querySelector("#btnSalvar")
                if(btnSalvar){
                    btnSalvar.addEventListener("click", async function(){
                        if(txtAddNomeEmpresa.value == ""){
                            txtAddNomeEmpresa.classList.add("textObrigatorio")
                            txtAddNomeEmpresa.focus()
                            msgAlert("alert-danger","Informe o nome da empresa")
                            return
                        } else {
                           txtAddNomeEmpresa.classList.remove("textObrigatorio") 
                        }
        
                        if(txtAddtEmailEmpresa.value == ""){
                            txtAddtEmailEmpresa.classList.add("textObrigatorio")
                            txtAddtEmailEmpresa.focus()
                            msgAlert("alert-danger","Deixe um email para seguir, usaremos esse email para notificar a empresa quando o orçamento for aprovado")
                            return
                        } else {
                            txtAddtEmailEmpresa.classList.remove("textObrigatorio")
                        }

                        let valueBtnSalvar = "criar"
                        let id = ""

                        if(btnSalvar.value == "Editar"){
                            id = txtAddNomeEmpresa.getAttribute("data-id-fornecedor")
                            valueBtnSalvar = "editar"
                        }

                        await CrudEmpresa(id, txtAddNomeEmpresa.value, txtAddSiteEmpresa.value, txtAddtEmailEmpresa.value, valueBtnSalvar)
                    })
                }
            }
    } catch (error) {
        
    }
}



async function searchEmpresa(codEmpresaGet, nomeEmpresaGet){
    return new Promise(async (resolve, reject) => {
        try {
            let dados = {
                codEmpresaSet : codEmpresaGet,
                nomeEmpresaSet : nomeEmpresaGet,
            }

            let resultSearchEmpresa = await $.post("././app/controller/function/funcSearchEmpresa.php", dados)
            let jsonresultSearchEmpresa = JSON.parse(resultSearchEmpresa)

            let campos = camposFormOrder()

            if(jsonresultSearchEmpresa && Array.isArray(jsonresultSearchEmpresa.obj) && jsonresultSearchEmpresa.obj.length  > 0){

                campos.txtCodEmpresa.value = jsonresultSearchEmpresa.obj[0][0].idFornecedor
                campos.txtNomeEmpresa.value = jsonresultSearchEmpresa.obj[0][0].nomeFornecedor
                campos.txtNomeEmpresa.setAttribute("data-id", jsonresultSearchEmpresa.obj[0][0].idFornecedor)
                campos.txtSiteEmpresa.value = jsonresultSearchEmpresa.obj[0][0].siteFornecedor
                campos.txtEmailEmpresa.value = jsonresultSearchEmpresa.obj[0][0].emailFornecedor

                campos.txtCodEmpresa.parentNode.classList.add("active")
                campos.txtNomeEmpresa.parentNode.classList.add("active")
                campos.txtSiteEmpresa.parentNode.classList.add("active")
                campos.txtEmailEmpresa.parentNode.classList.add("active")

            } else {
                msgAlert("alert-danger", "Empresa não encontrada, tente localizar em <strong>'listar'</strong>, para listar as empresar que estão cadastrada.")
                campos.txtCodEmpresa.value = ""
                campos.txtNomeEmpresa.setAttribute("data-id","")
                campos.txtNomeEmpresa.value = ""
                campos.txtSiteEmpresa.value = ""
                campos.txtEmailEmpresa.value = ""
            }

            resolve()

        } catch (error) {
            
        }
    })
}

// async function enviarFoto() {
//     try {
//         let fileInput = document.getElementById('fileAddImg')
//         let files = fileInput.files
    
//         let form_data = new FormData()

//         let compressImageBlod = await compressImages(files, 1350, 1080, 1)
    
//         compressImageBlod.forEach((blob, index) => {
//             form_data.append('fileAddImg[]', blob, files[index])
//         })

//         let numberOrder = document.getElementById("numberOrderSend").value
//         form_data.append('numberOrderSend', numberOrder)

//         let sendImg = await fetch("./././app/controller/function/funcSalveFotos.php", {
//             method: "POST",
//             body: form_data,
//         })

//         if (!sendImg.ok) {
//             throw new Error("Erro HTTP " + sendImg.status)
//         }

//         let resultSalveImg = await sendImg.text()
//         if(resultSalveImg == "996"){
//             alert("Erro ao salvar imagem verifique se foi salva, ou tente novamente. \n NÃO DESABILITE ESSA JANELA")
//             preLoad("none")//atualizado

//         } else if(resultSalveImg == "995"){
//             alert("O numero da encomenda para qual está adicionando não tem cliente cadastrado ou o número da encomenda está errado, primeiro salve o cliente para poder adicionar foto. \n NÃO DESABILITE ESSA JANELA")
//             preLoad("none")//atualizado
//         }else {
//             //atualizado
//             preLoad("none")
//             alert("Imagem salvo com sucesso. \n NÃO DESABILITE ESSA JANELA")
//             document.querySelector("#divModal").remove()
//         }

//     } catch (error) {
//         alert("Erro ao enviar foto: " + error.message + " \n NÃO DESABILITE ESSA JANELA")
//         console.error("Erro ao enviar foto:", error)
//     }
// }

async function openModalListEmpresa(){
    return new Promise( async (resolve, reject)=>{
        try {
            let resultOpenModalListEmpresa = await $.post("././app/views/pages/modal/modalListFornecedor.php")

            if(resultOpenModalListEmpresa != ""){
                let teste = document.createElement("div")
                teste.id = "divModal"
                teste.innerHTML = resultOpenModalListEmpresa

                document.body.append(teste)

                closeModal()
                campoInputLabelSuspenso()

                let btnSearchListEmpresa = document.querySelector("#btnSearchListEmpresa")
                if(btnSearchListEmpresa){
                    btnSearchListEmpresa.addEventListener("click", function(){
                        let txtListCodEmpresa = document.querySelector("#txtListCodEmpresa")
                        listEmpresa(txtListCodEmpresa.value)
                    })
                }

                let btnListUsar = document.querySelector("#btnListUsar")
                if(btnListUsar){
                    btnListUsar.addEventListener("click", function(){
                        document.querySelectorAll(".rowListEmpresa").forEach(rowListEmpresa => {

                            if(rowListEmpresa.querySelector(".inputRadio").checked){
                                
                                let campos = camposFormOrder()

                                let codEmpresa = rowListEmpresa.querySelector(".inputRadio").getAttribute("data-id")
                                let nomeEmpresa = rowListEmpresa.cells[2].textContent
                                let siteEmpresa = rowListEmpresa.querySelector(".inputRadio").getAttribute("data-site")
                                let emailEmpresa = rowListEmpresa.querySelector(".inputRadio").getAttribute("data-email")

                                campos.txtCodEmpresa.value = codEmpresa
                                campos.txtNomeEmpresa.value = nomeEmpresa
                                campos.txtNomeEmpresa.setAttribute("data-id", codEmpresa)
                                campos.txtSiteEmpresa.value = siteEmpresa
                                campos.txtEmailEmpresa.value = emailEmpresa

                                campos.txtCodEmpresa.parentNode.classList.add("active")
                                campos.txtNomeEmpresa.parentNode.classList.add("active")
                                campos.txtSiteEmpresa.parentNode.classList.add("active")
                                campos.txtEmailEmpresa.parentNode.classList.add("active")

                                $("#divModal").remove()
                            }
                        })

                    })
                }

                await listEmpresa("")
            }

            resolve()
        } catch (error) {
            //fazer erro
        }
    })
}



function salvarOrdemCompra(){
    return new Promise(async (resolve, reject) => {
        try {
            
            let form_data = new FormData()

            let campos = camposFormOrder()
            
            let fileAnexoOrcamento = campos.flOrcamento.files
            let fileInput = campos.flAnexoOrder.files
            //###

            if(fileAnexoOrcamento){
                for (let i = 0; i < fileAnexoOrcamento.length; i++) {
                    let file = fileAnexoOrcamento[i]
                    let fileType = await tipoArquivo(file.name)
            
                    if (fileType.startsWith("imagem/")) {
                        let compressedBlobArray = await compressImages([file], 1350, 1080, 1)
                            form_data.append('flOrcamento[]', compressedBlobArray[0], file.name)
                    } else {
                        form_data.append('flOrcamento[]', file, file.name)
                    }
                }
            }

            if(fileInput){
                for (let i = 0; i < fileInput.length; i++) {
                    let file = fileInput[i]
                    let fileType = await tipoArquivo(file.name)
            
                    if (fileType.startsWith("imagem/")) {
                        let compressedBlobArray = await compressImages([file], 1350, 1080, 1)
                            form_data.append('flAnexoOrder[]', compressedBlobArray[0], file.name)
                    } else {
                        form_data.append('flAnexoOrder[]', file, file.name)
                    }
                }
            }

            //##
            let sltPrioridade = campos.sltPrioridade.value
            let txtIdEmpresa = campos.txtNomeEmpresa.getAttribute("data-id")
            let txtValorNota = campos.txtValorNota.value
            let txtTextoItem = campos.txtTextoItem.value
            let txtTextoDescricao = campos.txtTextoDescricao.value

            let txtNOrcamento = campos.txtNumberOrcamento.value

            let chkEnviarEmail = (document.getElementById("chkEnviarEmail").checked == true ? 1 : 0)

            let btnEnviarOrder = document.querySelector("#btnEnviarOrder")

            let divEnviarOrder = document.querySelector(".divEnviarOrder")

            form_data.append('txtPrioridadeSet', sltPrioridade)
            form_data.append('idFornecedorSet', txtIdEmpresa)
            form_data.append('valorNotaSet', txtValorNota.replace(",","."))
            form_data.append('descricaoItemSet', txtTextoItem)
            form_data.append('descricaoOrderSet', txtTextoDescricao)
            form_data.append('enviarEmailSet', chkEnviarEmail)
            
            form_data.append('txtNumberOrcamento', txtNOrcamento)

            await $.ajax({
                url: '././app/controller/function/funcSalvarOrdemCompra.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: async function (result) {
                    console.log(result)
                    if(result == 1){
                        msgAlert("alert-success", "Ordem de compra salva com sucesso.")

                        let teste = document.querySelector("input")
                        teste.setAttribute("type","button")
                        teste.classList.add("btn")
                        teste.classList.add("btn-warning")
                        teste.id = "btnNovaOrdemCompra"
                        teste.value = "Nova ordem de compra"


                        divEnviarOrder.append(teste)

                        btnEnviarOrder.value = "Fechar"
                        btnEnviarOrder.classList.remove("btn-success")
                        btnEnviarOrder.classList.add("btn-outline-danger")

                        let btnNovaOrdemCompra = document.querySelector("#btnNovaOrdemCompra")
                        if(btnNovaOrdemCompra){
                            btnNovaOrdemCompra.addEventListener("click", function(){
                                //limpar campos 
                                window.location.reload(true)
                            })
                        }

                    } else if(result == 0){
                        msgAlert("alert-warning","Sua ordem foi salva com sucesso, mas houve um erro ao salvar os anexo, consulte o administrador da plataforma.")

                        btnEnviarOrder.value = "Tentar novamente"
                    } else {
                        msgAlert("alert-danger", "Houve um erro ao salvar ordem de compra, consulte a lista para ver se a mesma foi finalizada.")

                        btnEnviarOrder.value = "Tentar novamente"
                    }
            
                },
                
                error: function (jqXHR, textStatus, errorThrown){
                    msgAlert("alert-danger","Desculpe, Houve um erro ao processar sua ordem de compra, por favor tente novamente " + errorThrown)
                }
            })

            resolve()

        } catch (error) {
            //fazer erro
        }
    })
}

async function validarCampos(){
    let campos = camposFormOrder()

    if(campos.sltPrioridade.value == ""){
        campos.sltPrioridade.classList.add("textObrigatorio")
        campos.sltPrioridade.focus()
        msgAlert("alert-danger","Informe uma prioridade")
        return 0
    } else {
        campos.sltPrioridade.classList.remove("textObrigatorio")
    }

    if(campos.txtCodEmpresa.value == ""){
        campos.txtCodEmpresa.classList.add("textObrigatorio")
        campos.txtCodEmpresa.focus()
        msgAlert("alert-danger","Informe um fornecedor para poder seguir")
        return 0
    } else {
        campos.txtCodEmpresa.classList.remove("textObrigatorio")
    }

    if(campos.txtNomeEmpresa.value == ""){
        campos.txtNomeEmpresa.classList.add("textObrigatorio")
        campos.txtNomeEmpresa.focus()
        msgAlert("alert-danger","Informe um fornecedor para poder seguir")
        return 0
    } else {
        campos.txtNomeEmpresa.classList.remove("textObrigatorio")
    }

    if(campos.txtValorNota.value == ""){
        campos.txtValorNota.classList.add("textObrigatorio")
        campos.txtValorNota.focus()
        msgAlert("alert-danger","Informe o valor total da sua nota")
        return 0
    } else {
        campos.txtValorNota.classList.remove("textObrigatorio")
    }

    if(campos.txtTextoItem.value.length < 10){
        campos.txtTextoItem.classList.add("textObrigatorio")
        campos.txtTextoItem.focus()
        msgAlert("alert-danger","Fale qual item será comprado")
        return 0
    } else {
        campos.txtTextoItem.classList.remove("textObrigatorio")
    }

    if(campos.txtTextoDescricao.value.length < 20){
        campos.txtTextoDescricao.classList.add("textObrigatorio")
        campos.txtTextoDescricao.focus()
        msgAlert("alert-danger","Faça uma descrição do que será feito com o item comprado")
        return 0
    } else {
        campos.txtTextoDescricao.classList.remove("textObrigatorio")
    }

    if(campos.flAnexoOrder.files.length == 0){
        campos.flAnexoOrder.classList.add("textObrigatorio")
        campos.flAnexoOrder.focus()
        msgAlert("alert-danger","Anexo ao menos um arquivo para seguir")
        return 0
    } else {
        campos.flAnexoOrder.classList.remove("textObrigatorio")
    }

}

function camposFormOrder(){
    return {
        sltPrioridade : document.querySelector("#sltPrioridade"),

        txtNomeEmpresa : document.querySelector("#txtNomeEmpresa"),
        txtSiteEmpresa : document.querySelector("#txtSiteEmpresa"),
        txtEmailEmpresa : document.querySelector("#txtEmailEmpresa"),
        txtNumberOrcamento : document.querySelector("#txtNumberOrcamento"),

        txtCodEmpresa : document.querySelector("#txtCodEmpresa"),
        chkEnviarEmail : document.querySelector("#chkEnviarEmail"),
        txtValorNota : document.querySelector("#txtValorNota"),
        txtTextoItem : document.querySelector("#txtTextoItem"),
        txtTextoDescricao : document.querySelector("#txtTextoDescricao"),
        flAnexoOrder : document.querySelector("#flAnexoOrder"),
        flOrcamento : document.querySelector("#flOrcamento"),
    }
}

let btnAddEmpresa = document.querySelector("#btnAddEmpresa")
if(btnAddEmpresa){
    btnAddEmpresa.addEventListener("click", function(){
        openModalAddEmpresa()
    })
}

let txtCodEmpresa = document.querySelector("#txtCodEmpresa")
if(txtCodEmpresa){
    txtCodEmpresa.addEventListener("change", function(){
        if(txtCodEmpresa.value == ""){
            let campos = camposFormOrder()

            campos.txtNomeEmpresa.value = ""
            campos.txtSiteEmpresa.value = ""
            campos.txtEmailEmpresa.value = ""

            campos.txtNomeEmpresa.parentNode.classList.remove("active")
            campos.txtSiteEmpresa.parentNode.classList.remove("active")
            campos.txtEmailEmpresa.parentNode.classList.remove("active")

        }
    })
}

let btnSearchEmpresa = document.querySelector("#btnSearchEmpresa")
if(btnSearchEmpresa){
    btnSearchEmpresa.addEventListener("click", function(){
        let txtCodEmpresa = document.querySelector("#txtCodEmpresa")
        if(txtCodEmpresa && txtCodEmpresa.value != ""){
            searchEmpresa(txtCodEmpresa.value, "")
        } else {
            msgAlert("alert-danger","Primeiro informe o código do fornecedor para localizar ou uso o botão <strong>Listar</strong> para listar todos os fornecedores")
        }
    })
}

let btnListEmpresa = document.querySelector("#btnListEmpresa")
if(btnListEmpresa){
    btnListEmpresa.addEventListener("click", function(){
        openModalListEmpresa()
    })
}

let btnEnviarOrder = document.querySelector("#btnEnviarOrder")
if(btnEnviarOrder){

    btnEnviarOrder.addEventListener("click",async function(e){
        e.preventDefault()
        let campos = camposFormOrder()

        if(btnEnviarOrder.value == "Enviar"){
            let aqui = await validarCampos()
            if(aqui != 0){
                if(campos.txtNomeEmpresa.getAttribute("data-id") != campos.txtCodEmpresa.value){
                    await openConfirmar("Aviso", "O código do fornecedor não é o mesmo que o fornecedo listado.  <br>Deseja seguir mesmo assim?")
            
                    let btnConfirmar = document.querySelector("#btnConfirmar")
                    if(btnConfirmar){
                        btnConfirmar.addEventListener("click",async function(){
                            await salvarOrdemCompra()

                            $("#divModalConfirmar").remove()
                        })
                    }
                } else {
                    await salvarOrdemCompra()
                }
            }
        } else if ("Fechar"){
            window.location.href = pegarParteURL() + "?param=home"
        }
    })
}


