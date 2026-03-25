document.addEventListener("DOMContentLoaded", () => {
    let btnLogin = document.getElementById("btnLogin")
    let txtLogin = document.getElementById("txtLogin")
    let txtSenha = document.getElementById("txtSenha")

    document.addEventListener("keypress", (e) => {
        if (e.key === "Enter") btnLogin.click()
    })

    btnLogin.addEventListener("click", async () => {
        let user = txtLogin.value.trim()
        let pass = txtSenha.value.trim()

        if (!user || !pass) {
            msgAlert("alert-warning", "Preencha todos os campos.")
            return
        }

        let dados = new FormData()
        dados.append('txtLogin', user)
        dados.append('txtSenha', pass)

        try {
            let response = await fetch("api/login-process", { 
                method: "POST",
                body: dados
            })

            let result = await response.text()
            if (result.trim() !== "erro") {
                window.location.href = result.trim()
            } else {
                msgAlert("alert-danger", "Utilizador ou senha incorretos.")
            }
        } catch (error) {
            console.error("Erro no login:", error)
            msgAlert("alert-danger", "Erro na ligação ao servidor.")
        }
    })

    let showPass = document.getElementById("showPass")
    if(showPass){
        showPass.addEventListener("mousedown", ()=>{
            txtSenha.setAttribute("type", "text")
        })

        showPass.addEventListener("click", ()=>{
            txtSenha.setAttribute("type", "text")
        })

        showPass.addEventListener("mouseout", ()=>{
            txtSenha.setAttribute("type", "password")
        })
    }
})
