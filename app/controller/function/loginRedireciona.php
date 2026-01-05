<?php

include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $valorX = filter_input(INPUT_POST, "valorX");

    switch($valorX){
        case 1:
            echo "adm";
        break;
            
        case 2:
            echo "colaborador";
        break;

        case 5:
            echo "encomendas";
        break;

        case 4:
            echo "recursoHumano";
        break;

        default:
            echo "login";
        break;
    }

?>