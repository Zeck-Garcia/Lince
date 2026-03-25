function onlyLetra(input) {
    input.value = input.value.replace(/[0-9!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g, '')
}

function noSpace(input){
    input.value = input.value.replace(/\s/g,"")
}

function onlyCaracter(input){
    input.value = input.value.replace(/[^a-zA-Z0-9]/g,"-")
}

function upperCase(input){
    input.value = input.value.toUpperCase()
}

function lowerCaser(input){
    $(input).val($(input).val().toLowerCase())
}

function onlyNumber(input){
    $(input).val($(input).val().replace(/[^0-9,]/g, ''))
}

function onlyMoney(input) {
    let value = $(input).val().replace(/[^0-9.,]/g, '')

    let parts = value.split(/[.,]/)
    if (parts.length > 2) {
        value = parts[0] + '.' + parts.slice(1).join('')
    }

    $(input).val(value)
}
