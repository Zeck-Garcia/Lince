<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $paginaSet = (filter_input(INPUT_POST, "paginaSet") == 0 ? 1 : filter_input(INPUT_POST, "paginaSet"));

    $limite = 7;

    $inicio = ($paginaSet * $limite) - $limite;

    $select = "WITH result AS (SELECT * FROM tbLojas ORDER BY nomeLoja ASC)
    SELECT *, (SELECT COUNT(*) FROM result) AS totalRegistro FROM result ORDER BY nomeLoja ASC LIMIT ?, ?";
    $type = "ii";
    $param = [$inicio, $limite];

    $qry = $operation->executarSQL($select, $type, $param);

    $list = $operation->listar($qry);

    //$dadosSend["obj"] = $list;

    $dadosSend = [
        "obj" => $list,
        "limite" => $limite,
    ];

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>