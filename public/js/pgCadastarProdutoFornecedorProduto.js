window.addEventListener("DOMContentLoaded",async function(){
    try {
        //await loadListaOrderCompra("",3,0,"")

        //await loadListTipoProduto("slcTipoProduto")
        await loadListDepartamentoProduto("slcDepartamentoProduto")
    } catch (error) {
        //fazer erro
    }
})

let containerForm = document.getElementById("containerForm")
let containerButton = document.getElementById("containerButton")

let slcDepartamentoProduto = document.getElementById("slcDepartamentoProduto")
if(slcDepartamentoProduto){
    slcDepartamentoProduto.addEventListener("change", async ()=>{
        await loadListModuloNomeAbrevProduto("slcNomeAbrevProduto", slcDepartamentoProduto.value)
        containerForm.classList.add("hidder")
        containerButton.classList.add("hidder")
    })
}

let slcNomeAbrevProduto = document.getElementById("slcNomeAbrevProduto")
if(slcNomeAbrevProduto){
    slcNomeAbrevProduto.addEventListener("change", async ()=>{
        
        carregarModulo(slcNomeAbrevProduto.value)
    })
}

async function carregarModulo(idModulo) {
    try {
        //nao sei como monstar
        let dados = {
            idModuloSet : idModulo,
        }

        let containerViewQuestion = document.getElementById("containerViewQuestion")
        containerViewQuestion.innerHTML = ""

        let result = await $.post("././app/controller/function/funcShowModulo.php", dados)
        console.log(result)
        let teste = document.createElement("div")
            
        if(result != ""){
            containerForm.classList.remove("hidder")
            containerButton.classList.remove("hidder")

            teste.innerHTML = result
            containerViewQuestion.appendChild(teste)
        } else {
            containerForm.classList.add("hidder")
            containerButton.classList.add("hidder")
        }

        await campoInputLabelSuspenso()
        await campoInputEnviarAmostra()

        let x = (slcNomeAbrevProduto)

        let y = x.options[x.selectedIndex].getAttribute("data-submodulo")

        console.log(y.split(","))

        //submodulo
        y.split(",").forEach(async element => {
            switch(element){
                case "1": // porta
                    await subModuloPortaAction()
                break

                case "2": // pe
                    await loadPe("slcPe")
                break

                case "3": // revestimento

                break

                case "4": // assento sofa

                break

                case "5": // potencia

                break

                case "6": // capacidade

                break

                case "7": // giratorio

                break

                case "8": // gaveta
                    await subModuloGavetaAction()
                break

                case "9": // producao
                    await subModuloProducaoAction()
                break

                case "10": // volume
                    await subModuloVolumeAction()
                break

                case "11": // montagem
                    await subModuloRequerMontagemAction()
                break

                case "12": // estrutura
                    await loadEstruturaMovel("slcEstrutura")
                break

                case "13": // foto

                break

                case "15": // descricao

                break

                case "16": // assento cadeira

                break

                default:
                break
            }  
        })

        //modulo
        switch(idModulo){
            case "1": //sofa
                await moduloSofa()
                //await loadTipoAssentoSofa("slcTipoAssentoSofa")
                await loadTipoRevestimentoSofa("slcRevestimento")
            break

            case "2": // cama
                
            break

            case "3": // mesa de centro

            break

            case "4": // consola

            break

            case "5": // base tv

            break

            case "6": // cadeira
                await moduloCadeira()
            break

            case "7": // mesa de cabeceira

            break

            case "8": // comoda camiseiro

            break

            case "9": // roupeiro

            break

            case "10": // toucador

            break

            case "11": // tela

            break

            case "12": // relogio

            break

            case "13": // carpete

            break

            case "14": // colchao

            break

            case "15": // estrado

            break

            case "16": // maquina de lavar

            break

            case "17": // televisor

            break

            case "18": // microonda

            break

            case "19": // aspirador

            break

            case "20": // outro

            break

            case "21": // aparador vitrine

            break

            case "22": // frigorifico

            break

            case "23": // mesa jantar conzinha

            break
        }

    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao carregar o modulo solicitado " + error)
    }
}

//sem uso
async function campoInputEnviarAmostra() {
    return  {
        slcNivelMontagem : document.getElementById("slcNivelMontagem"),
        slcMontagem : document.getElementById("slcMontagem"),
        flFotoAmostraProduto : document.getElementById("flFotoAmostraProduto"),
        slcRevestimento : document.getElementById("slcRevestimento"),
        slcGiratorio : document.getElementById("slcGiratorio"),
        slcEstrutura : document.getElementById("slcEstrutura"),
        slcPe : document.getElementById("slcPe"),
        slcPorta : document.getElementById("slcPorta"),
        btnPortaMenos : document.getElementById("btnPortaMenos"),
        txtPorta : document.getElementById("txtPorta"),
        btnPortaMais : document.getElementById("btnPortaMais"),

        // modulo sofa
        slcEstruturaAssentoSofa : document.getElementById("slcEstruturaAssentoSofa"),
        slcTipoAssentoSofa : document.getElementById("slcTipoAssentoSofa"),
        slcModeloAssentoSofa : document.getElementById("slcModeloAssentoSofa"),
        btnQTDRelaxMenos : document.getElementById("btnQTDRelaxMenos"),
        txtQTDRelax : document.getElementById("txtQTDRelax"),
        btnQTDRelaxMais : document.getElementById("btnQTDRelaxMais"),
        slcQTDVolume : document.getElementById("slcQTDVolume"),
        txtComprimento : document.getElementById("txtComprimento"),
        txtLargura : document.getElementById("txtLargura"),
        txtAltura : document.getElementById("txtAltura"),
        slcUnidadeMedidaTamanho : document.getElementById("slcUnidadeMedidaTamanho"),
        txtPeso : document.getElementById("txtPeso"),
        slcUnidadeMedidaPeso : document.getElementById("slcUnidadeMedidaPeso"),
        btnAddVolume : document.getElementById("btnAddVolume"),
        tableVolume : document.getElementById("tableVolume"),
        tbodyVolume : document.getElementById("tbodyVolume"),
        // modulo sofa

        // descricao
        txtNomeProduto : document.getElementById("txtNomeProduto"),
        txtPreco : document.getElementById("txtPreco"),
        txtCor : document.getElementById("txtCor"),
        txtEAN : document.getElementById("txtEAN"),
        txtAreaDescricao : document.getElementById("txtAreaDescricao"),
        // descricao

        txtPotencia : document.getElementById("txtPotencia"), //potencia
        
        // tipo assento
        slcTipoAssento : document.getElementById("slcTipoAssento"),
        slcTipoForro : document.getElementById("slcTipoForro"),
        // tipo assento
        
        //capacidade
        txtCapacidade : document.getElementById("txtCapacidade"),
        slcCapacidadeUnidadeMedida : document.getElementById("slcCapacidadeUnidadeMedida"),
        //capacidade

        //producao
        slcProducao : document.getElementById("slcProducao"),
        slcOutraMedida : document.getElementById("slcOutraMedida"),
        //producao
        
        //gaveta
        slcGaveta : document.getElementById("slcGaveta"),
        btnGavetaMenos : document.getElementById("btnGavetaMenos"),
        txtQTDGaveta : document.getElementById("txtQTDGaveta"),
        btnGavetaMais : document.getElementById("btnGavetaMais"),
        //gaveta

        slcBaloico : document.getElementById("slcBaloico"),

        //modulo sofa
        slcTipoSofa : document.getElementById("slcTipoSofa"),
        slcQTDLugar : document.getElementById("slcQTDLugar"),
        txtDesidadeEspuma : document.getElementById("txtDesidadeEspuma"),
        slcChaiseLong : document.getElementById("slcChaiseLong"),
        slcChaiseLongQTD : document.getElementById("slcChaiseLongQTD"),
        txtQTDChaiseLong : document.getElementById("txtQTDChaiseLong"),
        slcChaiseLongFixa : document.getElementById("slcChaiseLongFixa"),
        slcChaiseLongArrume : document.getElementById("slcChaiseLongArrume"),
        slcFazCama : document.getElementById("slcFazCama"),
        slcColcaoInterno : document.getElementById("slcColcaoInterno"),
        slcBaloico : document.getElementById("slcBaloico"),
        slcFazMassagem : document.getElementById("slcFazMassagem"),
        PuffBraso : document.getElementById("PuffBraso"),
        //modulo sofa
        
        //modulo colchao
        slcTipografiaColchao : document.getElementById("slcTipografiaColchao"),
        txtAlturaColchao : document.getElementById("txtAlturaColchao"),
        slcTipoNucleoColchao : document.getElementById("slcTipoNucleoColchao"),
        slcAdaptabilidade : document.getElementById("slcAdaptabilidade"),
        slcFirmeza : document.getElementById("slcFirmeza"),
        slcFrescura : document.getElementById("slcFrescura"),
        slcRepirabilidade : document.getElementById("slcRepirabilidade"),
        //modulo colchao

        //modulo cama
        slcArrumacaoCama : document.getElementById("slcArrumacaoCama"),
        slcEstradoElevatorioCama : document.getElementById("slcEstradoElevatorioCama"),
        slcEstradoConjuntoCama : document.getElementById("slcEstradoConjuntoCama"),
        //modulo cama

        //modulo mesa jantar cozinha
        slcConjuntoMesa : document.getElementById("slcConjuntoMesa"),
        btnQTDCadeiraMesaMenos : document.getElementById("btnQTDCadeiraMesaMenos"),
        txtQTDCadeiraMesa : document.getElementById("txtQTDCadeiraMesa"),
        slcExtensicelMesa : document.getElementById("slcExtensicelMesa"),
        slcTampoMesa : document.getElementById("slcTampoMesa"),
        slcBasePeMesa : document.getElementById("slcBasePeMesa"),
        //modulo mesa jantar cozinha
    }
}

//submodulo se requer montagem e qual o nivel de montagem
async function subModuloRequerMontagemAction(){
    try {
       let containerNivelMotnagem = document.getElementById("containerNivelMotnagem")
       let slcNivelMontagem = document.getElementById("slcNivelMontagem")
        let slcMontagem = document.getElementById("slcMontagem")
        if(slcMontagem){
            slcMontagem.addEventListener("change", ()=>{
                if(slcMontagem.value == 1){
                    containerNivelMotnagem.classList.remove("hidder")
                    slcNivelMontagem.focus()
                } else {
                    containerNivelMotnagem.classList.add("hidder")
                    slcNivelMontagem.value = ""
                }
            })
        } 
    } catch (error) {
        msgAlert("alert-danger", "Elemento HTML não encontrado no submodulo montagem " + error)
    }
}

//submodulo de se permite producao
async function subModuloProducaoAction() {
    try {
        let slcProducao = document.getElementById("slcProducao")
        let containerOutraMedida = document.getElementById("containerOutraMedida")
        let slcOutraMedida = document.getElementById("slcOutraMedida")

        if(slcProducao){
            slcProducao.addEventListener("change", ()=>{
                if(slcProducao.value == 1){
                    containerOutraMedida.classList.remove("hidder")
                    slcOutraMedida.focus()
                } else {
                    containerOutraMedida.classList.add("hidder")
                    slcOutraMedida.value = ""
                }
            })
        }
    } catch (error) {
        msgAlert("alert-danger", "Elemento HTML não encontrado no submodulo producao " + error)
    }
}

//submodulo de volume
async function subModuloVolumeAction() {
    try {
        let btnAddVolume = document.getElementById("btnAddVolume")

        let txtComprimento = document.getElementById("txtComprimento")
        let txtLargura = document.getElementById("txtLargura")
        let txtAltura = document.getElementById("txtAltura")
        let slcUnidadeMedidaTamanho = document.getElementById("slcUnidadeMedidaTamanho")
        let txtPeso = document.getElementById("txtPeso")
        
        let slcUnidadeMedidaPeso = document.getElementById("slcUnidadeMedidaPeso")
        let tbodyVolume = document.getElementById("tbodyVolume")

        let slcQTDVolume = document.getElementById("slcQTDVolume")

        let txtComprimentoConv = ""
        let txtLarguraConv = ""
        let txtAlturaConv = ""
        let txtPesoConv = ""

        slcQTDVolume.addEventListener("change", ()=>{
            if(slcQTDVolume.value < tbodyVolume.querySelectorAll(".rowList").length || slcQTDVolume.value == ""){
                tbodyVolume.innerHTML = ""
            }
        })

        btnAddVolume.addEventListener("click", ()=>{
            if(slcQTDVolume.value == ""){
                slcQTDVolume.classList.add("textObrigatorio")
                slcQTDVolume.focus()
                msgAlert("alert-warning", "Primeiro informe o número de volume.")
            } else {
                slcQTDVolume.classList.remove("textObrigatorio")
                console.log(tbodyVolume.querySelectorAll(".rowList").length)
                console.log(Number(slcQTDVolume.value))
                if(tbodyVolume.querySelectorAll(".rowList").length < Number(slcQTDVolume.value) || slcQTDVolume.value == 99){
                    switch(slcUnidadeMedidaTamanho.value){
                        case "mm":
                            txtComprimentoConv = (Number(txtComprimento.value) / 100)
                            txtLarguraConv = (Number(txtLargura.value) / 100)
                            txtAlturaConv = (Number(txtAltura.value) / 100)
                        break
            
                        case "cm":
                            txtComprimentoConv = (Number(txtComprimento.value))
                            txtLarguraConv = (Number(txtLargura.value))
                            txtAlturaConv = (Number(txtAltura.value))
                        break
            
                        case "m":
                            txtComprimentoConv = (Number(txtComprimento.value) * 100)
                            txtLarguraConv = (Number(txtLargura.value) * 100)
                            txtAlturaConv = (Number(txtAltura.value) * 100)
                        break
                    }
                        
                    switch(slcUnidadeMedidaPeso.value){
                        case "g":
                            txtPesoConv = (Number(txtPeso.value) / 1000)
                        break
                            
                        case "kg":
                            txtPesoConv = (Number(txtPeso.value))
                        break
                    }
                    
                    if(txtComprimento.value == ""){
                        txtComprimento.classList.add("textObrigatorio")
                        txtComprimento.focus()
                        return msgAlert("alert-danger", "Informe o comprimento do volume")
                    } else {
                        txtComprimento.classList.remove("textObrigatorio")
                    }
            
                    if(txtLargura.value == ""){
                        txtLargura.classList.add("textObrigatorio")
                        txtLargura.focus()
                        return msgAlert("alert-danger", "Informe a largura do volume")
                    } else {
                        txtLargura.classList.remove("textObrigatorio")
                    }
            
                    if(txtAltura.value == ""){
                        txtAltura.classList.add("textObrigatorio")
                        txtAltura.focus()
                        return msgAlert("alert-danger", "Informe a altura do volume")
                    } else {
                        txtAltura.classList.remove("textObrigatorio")
                    }
            
                    if(slcUnidadeMedidaTamanho.value == ""){
                        slcUnidadeMedidaTamanho.classList.add("textObrigatorio")
                        slcUnidadeMedidaTamanho.focus()
                        return msgAlert("alert-danger", "Informe a unidade de medida da volume")
                    } else {
                        slcUnidadeMedidaTamanho.classList.remove("textObrigatorio")
                    }
            
                    if(txtPeso.value == ""){
                        txtPeso.classList.add("textObrigatorio")
                        txtPeso.focus()
                        return msgAlert("alert-danger", "Informe o peso do volume")
                    } else {
                        txtPeso.classList.remove("textObrigatorio")
                    }
            
                    if(slcUnidadeMedidaPeso.value == ""){
                        slcUnidadeMedidaPeso.classList.add("textObrigatorio")
                        slcUnidadeMedidaPeso.focus()
                        return msgAlert("alert-danger", "Informe a unidade de medida do peso")
                    } else {
                        slcUnidadeMedidaPeso.classList.remove("textObrigatorio")
                    }
        
                    let teste = document.createElement("tr")
                    teste.classList.add("rowList")
                    teste.innerHTML = `<td>${txtComprimentoConv}</td>
                                        <td>${txtLarguraConv}</td>
                                        <td>${txtAlturaConv}</td>
                                        <td>${txtPesoConv}</td>
                                        <td><i class='bi bi-trash btn btn-outline-info btn-sm' onclick='excluirItemList(event,"rowList")'></i></td>`

                    tbodyVolume.appendChild(teste)
    
                } else {
                    msgAlert("alert-warning", "Você já atingiu o limite máximo de volume informado por você.")
                }
            }
        })
        

    } catch (error) {
        msgAlert("alert-danger", "Elemento HTML não encontrado no submodulo volume " + error)
    }
}

//submodulo de gaveta 
async function subModuloGavetaAction() {
    try {
        let slcGaveta = document.getElementById("slcGaveta")
        let btnGavetaMenos = document.getElementById("btnGavetaMenos")
        let txtQTDGaveta = document.getElementById("txtQTDGaveta")
        let btnGavetaMais = document.getElementById("btnGavetaMais")
        let containerQTDGaveta = document.getElementById("containerQTDGaveta")

        slcGaveta.addEventListener("change", ()=>{
            if(slcGaveta.value == 1){
                containerQTDGaveta.classList.remove("hidder")
                txtQTDGaveta.focus()
            } else {
                txtQTDGaveta.value = 1
                containerQTDGaveta.classList.add("hidder")
            }
        })

        btnGavetaMenos.addEventListener("click", ()=>{
            if(txtQTDGaveta.value > 0){
                txtQTDGaveta.value = Number(txtQTDGaveta.value) - 1
            }
        })
        
        btnGavetaMais.addEventListener("click", ()=>{
            if(txtQTDGaveta.value < 50){
                txtQTDGaveta.value = Number(txtQTDGaveta.value) + 1
            }
        })

    } catch (error) {
        msgAlert("alert-danger", "Houve um erro 98 " + error)
    }
}

//submodulo da porta de movel
async function subModuloPortaAction() {
    try {
        let slcPorta = document.getElementById("slcPorta")
        let btnPortaMenos = document.getElementById("btnPortaMenos")
        let txtQTDPorta = document.getElementById("txtQTDPorta")
        let btnPortaMais = document.getElementById("btnPortaMais")
        let containerQTDPorta = document.getElementById("containerQTDPorta")


        slcPorta.addEventListener("change", ()=>{
            if(slcPorta.value != 0){
                containerQTDPorta.classList.remove("hidder")
                txtQTDPorta.focus()
            } else {
                txtQTDPorta.value = 1
                containerQTDPorta.classList.add("hidder")
            }
        })

        btnPortaMenos.addEventListener("click", ()=>{
            if(txtQTDPorta.value > 0){
                txtQTDPorta.value = Number(txtQTDPorta.value) - 1
            }
        })
        
        btnPortaMais.addEventListener("click", ()=>{
            if(txtQTDPorta.value < 50){
                txtQTDPorta.value = Number(txtQTDPorta.value) + 1
            }
        })

    } catch (error) {
        msgAlert("alert-danger", "Houve um erro 99 " + error)
    }
}

//modulo do sofa
async function moduloSofa() {
    try {
        let slcTipoSofa = document.getElementById("slcTipoSofa")
        let slcQTDLugar = document.getElementById("slcQTDLugar")
        let txtQTDLugar= document.getElementById("txtQTDLugar")
        let txtDesidadeEspuma = document.getElementById("txtDesidadeEspuma")
        let slcChaiseLong = document.getElementById("slcChaiseLong")
        let slcChaiseLongQTD = document.getElementById("slcChaiseLongQTD")
        let slcChaiseLongFixa = document.getElementById("slcChaiseLongFixa")
        let slcChaiseLongArrume = document.getElementById("slcChaiseLongArrume")
        let slcFazCama = document.getElementById("slcFazCama")
        let slcColcaoInterno = document.getElementById("slcColcaoInterno")
        let slcBaloico = document.getElementById("slcBaloico")
        let slcFazMassagem = document.getElementById("slcFazMassagem")
        let PuffBraco = document.getElementById("PuffBraco")

        let slcChaiseLongRevesivel = document.getElementById("slcChaiseLongRevesivel")
        let containerReversivelChaiseLong = document.getElementById("containerReversivelChaiseLong")

        let containerQTDChaiseLong = document.getElementById("containerQTDChaiseLong")
        let containerFixaChaiseLong = document.getElementById("containerFixaChaiseLong")
        let containerArrumacaoChaiseLong = document.getElementById("containerArrumacaoChaiseLong")

        let containerSofaCamaColchao = document.getElementById("containerSofaCamaColchao")
        let containerQTDLugar = document.getElementById("containerQTDLugar")
        let containerModeloAssento = document.getElementById("containerModeloAssento")
        let containerQTDRelax = document.getElementById("containerQTDRelax")

        let slcTipoAssentoSofa = document.getElementById("slcTipoAssentoSofa")
        let slcModeloAssentoSofa = document.getElementById("slcModeloAssentoSofa")

        let containerQTDPuffBraco = document.getElementById("containerQTDPuffBraco")

        let btnPuffBracoMenos = document.getElementById("btnPuffBracoMenos")
        let txtQTDPuffBraco = document.getElementById("txtQTDPuffBraco")
        let btnPuffBracoMais = document.getElementById("btnPuffBracoMais")

        
        slcTipoAssentoSofa.addEventListener("change", ()=>{
            if(slcTipoAssentoSofa.value == 3){
                containerModeloAssento.classList.remove("hidder")
                slcModeloAssentoSofa.focus()
            } else {
                containerModeloAssento.classList.add("hidder")
            }
        })

        slcModeloAssentoSofa.addEventListener("change", ()=>{
            if(slcModeloAssentoSofa.value == 1){
                containerQTDRelax.classList.remove("hidder")
                txtQTDRelax.focus()
            } else {
                containerQTDRelax.classList.add("hidder")
            }
        })

        let btnQTDRelaxMenos = document.getElementById("btnQTDRelaxMenos")
        let txtQTDRelax = document.getElementById("txtQTDRelax")
        let btnQTDRelaxMais = document.getElementById("btnQTDRelaxMais")

        btnQTDRelaxMenos.addEventListener("click", ()=>{
            if(txtQTDRelax.value > 0){
                txtQTDRelax.value = Number(txtQTDRelax.value) - 1
            }
        })
        
        btnQTDRelaxMais.addEventListener("click", ()=>{
            if(txtQTDRelax.value < 50){
                txtQTDRelax.value = Number(txtQTDRelax.value) + 1
            }
        })

        slcChaiseLong.addEventListener("change", ()=>{
            if(slcChaiseLong.value == 1){
                containerQTDChaiseLong.classList.remove("hidder")
                containerFixaChaiseLong.classList.remove("hidder")
                containerArrumacaoChaiseLong.classList.remove("hidder")
                containerReversivelChaiseLong.classList.remove("hidder")
            } else {
                containerQTDChaiseLong.classList.add("hidder")
                containerFixaChaiseLong.classList.add("hidder")
                containerArrumacaoChaiseLong.classList.add("hidder")
                containerReversivelChaiseLong.classList.add("hidder")
            }
        })

        PuffBraco.addEventListener("change", ()=>{
            if(PuffBraco.value == 1){
                containerQTDPuffBraco.classList.remove("hidder")
                txtQTDPuffBraco.focus()
            } else {
                txtQTDPuffBraco.value = 1
                containerQTDPuffBraco.classList.add("hidder")
            }
        })

        btnPuffBracoMenos.addEventListener("click", ()=>{
            if(txtQTDPuffBraco.value > 0){
                txtQTDPuffBraco.value = Number(txtQTDPuffBraco.value) - 1
            }
        })
        
        btnPuffBracoMais.addEventListener("click", ()=>{
            if(txtQTDPuffBraco.value < 50){
                txtQTDPuffBraco.value = Number(txtQTDPuffBraco.value) + 1
            }
        })

        slcQTDLugar.addEventListener("change", ()=>{
            if(slcQTDLugar.value == 99){
                containerQTDLugar.classList.remove("hidder")
                txtQTDLugar.focus()
                txtQTDLugar.classList.add("textObrigatorio")
            } else {
                containerQTDLugar.classList.add("hidder")
                txtQTDLugar.classList.add("textObrigatorio")
                txtQTDLugar.value = 1
            }
        })

        if(txtQTDLugar || txtQTDLugar.value != ""){
            txtQTDLugar.addEventListener("focusout", ()=>{
                txtQTDLugar.classList.remove("textObrigatorio")
            })
        }

        slcFazCama.addEventListener("change", ()=>{
            if(slcFazCama.value == 1){
                containerSofaCamaColchao.classList.remove("hidder")
                slcColcaoInterno.focus()
            } else {
                containerSofaCamaColchao.classList.add("hidder")
            }
        })


    } catch (error) {
        msgAlert("alert-danger", "Houve um erro 55 " + error)
    }
}

//modulo cadeira
async function moduloCadeira() {
    try {
        let slcTipoAssentoCadeira = document.getElementById("slcTipoAssentoCadeira")
        let txtOutrosTipoAssentoCadeira = document.getElementById("txtOutrosTipoAssentoCadeira")

        let containerOutroTipoAssendoCadeira = document.getElementById("containerOutroTipoAssendoCadeira")

        slcTipoAssentoCadeira.addEventListener("change", ()=>{
            console.log(slcTipoAssentoCadeira.value)
            if(slcTipoAssentoCadeira.value == "outros"){
                containerOutroTipoAssendoCadeira.classList.remove("hidder")
                txtOutrosTipoAssentoCadeira.focus()
            } else {
                containerOutroTipoAssendoCadeira.classList.add("hidder")
                txtOutrosTipoAssentoCadeira.text = ""
            }
        })

    } catch (error) {
        msgAlert("alert-danger", "Houve um erro 91 " + error)
    }
}

//sem uso
//nao sei se tera uso 
async function loadTipoAssentoSofa(select) {
    try {
        let valueInput = document.getElementById(select)

        let result = await $.post("././app/controller/function/funcListTipoAssentoSofa.php")
        let jsonResult = JSON.parse(result)
        
        let vazio = document.createElement("option")
        valueInput.appendChild(vazio)

        if(jsonResult && Array.isArray(jsonResult.obj) && jsonResult.obj.length > 0){
            jsonResult.obj.forEach(item => {
                let teste = document.createElement("option")
                
                teste.innerHTML = capitalizar(item.nomeMostrarTipoAssentoSofa)
                teste.value = item.idMostrarTipoAssentoSofa
    
                valueInput.appendChild(teste)
            })
        }
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao carregar lista de tipo de assento do sofá, atualize a página." + error)
    }
}

//carrega o select com a info do bd
async function loadTipoRevestimentoSofa(select) {
    try {
        let valueInput = document.getElementById(select)

        let result = await $.post("././app/controller/function/funcListRevestimentoSofa.php")
        let jsonResult = JSON.parse(result)
        
        let vazio = document.createElement("option")
        valueInput.appendChild(vazio)

        if(jsonResult && Array.isArray(jsonResult.obj) && jsonResult.obj.length > 0){
            jsonResult.obj.forEach(item => {
                let teste = document.createElement("option")
                
                teste.innerHTML = capitalizar(item.nomeMostrarRevestimentoSofa)
                teste.value = item.idMostrarRevestimentoSofa
    
                valueInput.appendChild(teste)
            })
        }
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao carregar lista de tipo de assento do sofá, atualize a página." + error)
    }
}

//carrega o select com a info do bd
async function loadPe(select) {
    try {
        let valueInput = document.getElementById(select)
        let containerOutroPe = document.getElementById("containerOutroPe")
        let txtOutroPe = document.getElementById("txtOutroPe")

        let result = await $.post("././app/controller/function/funcListPe.php")
        let jsonResult = JSON.parse(result)
        
        let vazio = document.createElement("option")
        valueInput.appendChild(vazio)

        if(jsonResult && Array.isArray(jsonResult.obj) && jsonResult.obj.length > 0){
            jsonResult.obj.forEach(item => {
                let teste = document.createElement("option")
                
                teste.innerHTML = capitalizar(item.nomeMostrarPe)
                teste.value = item.idMostrarPe
    
                valueInput.appendChild(teste)


                valueInput.addEventListener("change", ()=>{
                    let x = valueInput.options[valueInput.selectedIndex]
                    if(x.text == "Outros"){
                        containerOutroPe.classList.remove("hidder")
                        txtOutroPe.focus()
                    } else {
                        containerOutroPe.classList.add("hidder")
                    }
                })
            })
        }
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao carregar lista de tipo de assento do sofá, atualize a página." + error)
    }
}

//carrega o select com a info do bd
async function loadEstruturaMovel(select) {
    try {
        let valueInput = document.getElementById(select)
        let containerOutraEstruturaMovel = document.getElementById("containerOutraEstruturaMovel")
        let txtOutraEstruturaMovel = document.getElementById("txtOutraEstruturaMovel")

        let result = await $.post("././app/controller/function/funcListEstruturaMovel.php")
        let jsonResult = JSON.parse(result)
        
        let vazio = document.createElement("option")
        valueInput.appendChild(vazio)

        if(jsonResult && Array.isArray(jsonResult.obj) && jsonResult.obj.length > 0){
            jsonResult.obj.forEach(item => {
                let teste = document.createElement("option")
                
                teste.innerHTML = capitalizar(item.nomeMostrarEstruturaMovel)
                teste.value = item.idMostrarEstruturaMovel
    
                valueInput.appendChild(teste)

                valueInput.addEventListener("change", ()=>{
                    let x = valueInput.options[valueInput.selectedIndex]
                    if(x.text == "Outros"){
                        containerOutraEstruturaMovel.classList.remove("hidder")
                        txtOutraEstruturaMovel.focus()
                    } else {
                        containerOutraEstruturaMovel.classList.add("hidder")
                        txtOutraEstruturaMovel.value = ""
                    }
                })

            })
        }
    } catch (error) {
        msgAlert("alert-danger", "Houve um erro ao carregar lista de tipo de assento do sofá, atualize a página." + error)
    }
}