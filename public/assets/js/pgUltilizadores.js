$(document).ready(async()=>{
    await montetableListUtilizador(0) 
    await loadListDepartamentoSLC("slcDepartamento")
})

let slcDepartamento = document.getElementById("slcDepartamento")
if(slcDepartamento){
    slcDepartamento.addEventListener("change",async ()=>{
        if(slcDepartamento.value != 0){
            await loadListCargoSLC("slcCargo",slcDepartamento.value)

        }
    })
}

let btnProcurar = document.getElementById("btnProcurar")
if(btnProcurar){
    btnProcurar.addEventListener("click", async()=>{
        await montetableListUtilizador(0)
    })
}

let btnNovo = document.getElementById("btnNovo")
if(btnNovo){
    btnNovo.addEventListener("click", async()=>{
        let modalEl = await openModal("modal-utilizador", "Adicionar novo utilizador")
    })
}
async function montetableListUtilizador(pagina) {
    try {
        let txtSearchUser = document.getElementById("txtSearchUser")
        let slcDepartamento = document.getElementById("slcDepartamento")
        let slcCargo = document.getElementById("slcCargo")
        let dados = {
        paginaSet : pagina,
        nomeUser : txtSearchUser ?.value || '',
        departamentoUser : slcDepartamento ?.value || '',
        cargoUser : slcCargo ?.value || ''
    }
    let result = await loadListUtilizador(JSON.stringify(dados))
    let tbodyList = document.getElementById("tbodyList")
    tbodyList.textContent = ''

    if(result && Array.isArray(result.obj) && result.obj.length > 0){
        result.obj.forEach(element => {
            let newTr = document.createElement("tr")
            newTr.classList.add("rowList")
            newTr.innerHTML = `<td data-cod-colaborador='${element.codColaborador}'>${capitalizar(element.nomeUser)}</td>
                                <td>${element.emailUser}</td>
                                <td data-id-departamento='${element.idDepartamentoUser}'>${element.nomeDepartamentoUser}</td>
                                <td data-id-cargo='${element.idCargoUser}'>${element.nomeCargoUser}</td>
                                <td>${element.ativo == 1 ? 'Ativo' : 'Desativado'}</td>
                                <td>
                                    <i class='bi bi-pen btn btn-outline-warning' onclick='editarRegistroUtilizador(this)'></i>
                                    <i class='bi bi-trash btn btn-outline-danger ms-2' onclick='excluirRegistroUtilizador(${element.idUser})'></i>
                                </td>`
            tbodyList.append(newTr)
        })
    } else {
        let newTr = document.createElement("tr")
        newTr.innerHTML = `<p>Não foi encontrado nenhuma dados</p>`
        tbodyList.append(newTr)
    }

    let limite = result.obj.length > 0 ? result.obj[0]['limite'] : 0
    let totalRegisto = result.obj.length > 0 ? result.obj[0]['totalRegistro'] : 0
    pagination(totalRegisto, limite, pagina, 'paginador', 'passarPagina')

    } catch (error) {
        
    }
}

function passarPagina(novaPagina) {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' 
    })
    montetableListUtilizador(novaPagina)
}

async function editarRegistroUtilizador(btn){
    try {
        let {modalEl, container, routeNome} = await openModal("modal-utilizador", "Adicionar novo utilizador")

        let rowList = btn.closest(".rowList")

        let txtCodColaboradorModal = modalEl.querySelector("#txtCodColaboradorModal")
        let txtNomeColaboradorModal = modalEl.querySelector("#txtNomeColaboradorModal")
        let txtemailModal = modalEl.querySelector("#txtemailModal")
        let slcDepartamentoModal = modalEl.querySelector("#slcDepartamentoModal")
        let slcCargoModal = modalEl.querySelector("#slcCargoModal")
        let slcLojaModal = modalEl.querySelector("#slcLojaModal")
        let slcAtivoModal = modalEl.querySelector("#slcAtivoModal")

        let codColaborador = rowList.cells[0].getAttribute("data-cod-colaborador")
        let nomeColaborador = rowList.cells[0].textContent
        let emailColaborador = rowList.cells[1].textContent
        let idDepartamento = rowList.cells[2].getAttribute("data-cod-colaborador")
        let idCargo = rowList.cells[3].getAttribute("data-cod-colaborador")
        let ativo = rowList.cells[4].textContent == 'Ativo' ? 1 : 0

        txtCodColaboradorModal.parentNode.classList.add("active")
        txtNomeColaboradorModal.parentNode.classList.add("active")
        txtemailModal.parentNode.classList.add("active")
        slcDepartamentoModal.parentNode.classList.add("active")
        slcCargoModal.parentNode.classList.add("active")
        slcAtivoModal.parentNode.classList.add("active")

        txtCodColaboradorModal.value = codColaborador || ''
        txtNomeColaboradorModal.value = nomeColaborador
        txtemailModal.value = emailColaborador
        slcDepartamentoModal.value = idDepartamento
        slcCargoModal.value = idCargo
        slcAtivoModal.value = ativo

        modalEl.addEventListener("shown.bs.modal", async()=>{
            await loadListLojaSLC("slcLojaModal")
            await loadListDepartamentoSLC("slcDepartamentoModal")

            let slcDepartamentoModal = document.getElementById("slcDepartamentoModal")
            if(slcDepartamentoModal){
                slcDepartamentoModal.addEventListener("change",async ()=>{
                    if(slcDepartamentoModal.value != 0){
                        await loadListCargoSLC("slcCargoModal",slcDepartamentoModal.value)

                    }
                })
            }
        })

    } catch (error) {
        console.log(error)
    }
}