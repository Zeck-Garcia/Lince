<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $slcFeitoSet = filter_input(INPUT_POST, "slcFeitoSet");
    $txtSearchUserSet = filter_input(INPUT_POST, "txtSearchUserSet");
    
    if($txtSearchUserSet == ""){
        if($slcFeitoSet != 3){
            $secondWhere = " AND estadoAnulacao = {$slcFeitoSet} ";
        } else {
            $secondWhere = "";
        }
    } else {
        $secondWhere = " AND encomendaAnulacao = {$txtSearchUserSet} ";
    }

    $paginaSet = (filter_input(INPUT_POST, "paginaSet") == "" ? 1 : filter_input(INPUT_POST, "paginaSet"));

    $limite = 10;

    $inicio = ($paginaSet * $limite) - $limite;

    $selectDadosAnulacao = "WITH result AS (SELECT * FROM tbAnulacao WHERE criadoPorAnulacao = 1 {$secondWhere})"
    
    .( " SELECT *, (SELECT COUNT(*) FROM result) AS totalRegistro FROM result ")

    .($txtSearchUserSet != "" ? "" : " LIMIT {$inicio},{$limite}");

    $qryDadosAnulacao = $operation->executarSQL($selectDadosAnulacao);
    $list = $operation->listar($qryDadosAnulacao);

    $dadosSend = [
        "obj" => $list,
        "limite" => $limite,
    ];

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>