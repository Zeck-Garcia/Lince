<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $paginaSet = (filter_input(INPUT_POST, "paginaSet") == 0 ? 1 : filter_input(INPUT_POST, "paginaSet"));

    $limite = 7;

    $inicio = ($paginaSet * $limite) - $limite;

    $select = "WITH result AS (SELECT * 
                    FROM tbFuncionario 
                    
                    LEFT JOIN tbLojas
                    ON tbLojas.idLoja = tbFuncionario.lojaFuncionario)
                    
                    SELECT *, (SELECT COUNT(*) FROM result) AS totalRegistro FROM result ORDER BY codFuncionarioFuncionario ASC LIMIT ?, ?";
    $type = "ii";
    $param = [$inicio, $limite];

    $qry = $operation->executarSQL($select, $type, $param);

    $list = $operation->listar($qry);

    $dadosSend = [
        "obj" => $list,
        "limite" => $limite,
    ];

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>