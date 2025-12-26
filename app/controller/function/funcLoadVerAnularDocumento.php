<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $lojaSet = filter_input(INPUT_POST, "lojaSet");
    $feitoSet = filter_input(INPUT_POST, "feitoSet");
    $txtSearchSet = filter_input(INPUT_POST, "txtSearchSet");

    $paginaSet = (filter_input(INPUT_POST, "paginaSet") == "" ? 1 : filter_input(INPUT_POST, "paginaSet"));

    $limite = 20;

    $inicio = ($paginaSet * $limite) - $limite;

    if($txtSearchSet == ""){
        if($lojaSet != "0"){
            if($feitoSet != 3){
                $where = " WHERE criadoPorAnulacao = {$lojaSet} ";
    
            } else {
                $where = " WHERE criadoPorAnulacao = {$lojaSet} AND estadoAnulacao = {$feitoSet}";
            }
        } else {
            $where = "";
        }
    } else {
        $where = " WHERE encomendaAnulacao = {$txtSearchSet}";
    }

    $selectDados = "WITH result AS (SELECT tbAnulacao.idAnulacao, tbAnulacao.encomendaAnulacao, tbAnulacao.dataCriadoAnulacao, tbAnulacao.criadoPorAnulacao, tbAnulacao.ativoAnulacao, tbAnulacao.pedidoFornecedotAnulacao, tbAnulacao.emitidofaturaAnulacao, tbAnulacao.estadoAnulacao, tbLojas.nomeLoja 
                            FROM tbAnulacao 
                            LEFT JOIN tbLojas
                            ON tbLojas.idLoja = tbAnulacao.criadoPorAnulacao 
                            {$where})"
    
    .( " SELECT *, (SELECT COUNT(*) FROM result) AS totalRegistro FROM result ")

    ." LIMIT {$inicio},{$limite}";

    $qryDados = $operation->executarSQL($selectDados);
    $list = $operation->listar($qryDados);

    $dadosSend = [
        "obj" => $list,
        "limite" => $limite,
    ];

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>