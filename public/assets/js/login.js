document.addEventListener("DOMContentLoaded", () => {
    let btnLogin = document.querySelector("#btnLogin")
    let txtLogin = document.querySelector("#txtLogin")
    let txtSenha = document.querySelector("#txtSenha")

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
})
