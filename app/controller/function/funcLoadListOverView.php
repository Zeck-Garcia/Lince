<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

$assuntoDepartamentoSet = filter_input(INPUT_POST, "assuntoDepartamentoSet");

    $selectDados = "SELECT * 
                    FROM tbAssunto
                    WHERE tbAssunto.ativoAssunto = 1 AND idAssuntoDepartamento = ?";

    $type = "i";
    $param = [$assuntoDepartamentoSet];

    $qryDados = $operation->executarSQL($selectDados, $type, $param);
    $list = $operation->listar($qryDados);

    $dadosSend["obj"] = $list;

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>