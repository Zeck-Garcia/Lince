<?php
if (true) {
    include_once "../../app/models/manipulacaoDeDados.php";
    $operation = new manipulacaoDeDados();

    require_once "../controller/class/authClass.php";
    
    $logando = new logar($operation);

    $loginUser = str_replace(array("'", '"'), "", filter_input(INPUT_POST, "txtLogin", FILTER_SANITIZE_STRING));
    $passwordUser = str_replace(array("'", '"'), "", hash("sha256", filter_input(INPUT_POST, "txtSenha", FILTER_SANITIZE_STRING)));

    if ($logando->login($loginUser, $passwordUser) == true) {
        if (isset($_SESSION["idUser"])) {
            echo $_SESSION["classeAgente"];
        } else {
            header('Location: ../../index.php');
            exit;
        }
    } else {
        header('Location: ../../index.php');
    }
}

?>