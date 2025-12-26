<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $todosSet = filter_input(INPUT_POST, "todosSet");

    $todosSetValue = ($todosSet == 1 ? "" : " AND estabelecimentoLoja = '{$todosSet}'");

    $selectLista = "SELECT * FROM tbLojas WHERE ativoLoja = '1' {$todosSetValue} ORDER BY nomeLoja ASC";
                        
    $qryLista = $operation->executarSQL($selectLista);

    $list = $operation->listar($qryLista);

    $dadosSend["obj"] = $list;

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>