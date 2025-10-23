<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $numberEncomendaSet = filter_input(INPUT_POST, "numberEncomendaSet") ?? "";
    $tableSet = filter_input(INPUT_POST, "tableSet") ?? "";
    $campotableSet = filter_input(INPUT_POST, "campotableSet") ?? "";

    $types = "";
    $params = [];

    $selectDados = "SELECT * FROM {$tableSet} WHERE {$campotableSet} = ?";

    $types = "s";
    $params[] = $numberEncomendaSet;

    $qryDados = $operation->executarSQL($selectDados, $types, $params);
    $list = $operation->listar($qryDados);
    $totalRegistros = $operation->contaDados($qryDados);

    $dadosSend = [
        "obj" => $list,
    ];

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);


?>