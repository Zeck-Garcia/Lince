<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();


    $selectDados = "SELECT * 
                    FROM tbAssuntoDepartamento
                    WHERE tbAssuntoDepartamento.ativoAssuntoDepartamento = 1";


    $qryDados = $operation->executarSQL($selectDados);
    $list = $operation->listar($qryDados);

    $dadosSend["obj"] = $list;

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>