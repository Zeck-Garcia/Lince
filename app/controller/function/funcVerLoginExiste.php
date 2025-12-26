<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $loginSet = trim(filter_input(INPUT_POST, "loginSet"));
    
    $selectLogin = "SELECT * FROM tbUser WHERE loginUser = ?";
    $type = "s";
    $param = [];
    $param[] = $loginSet;

    $qrySearchLogin = $operation->executarSQL($selectLogin, $type, $param);

    if(mysqli_num_rows($qrySearchLogin) > 0){
        echo 1;
    }


?>