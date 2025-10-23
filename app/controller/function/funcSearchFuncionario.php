<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $idFormandoSet = filter_input(INPUT_POST, "idFormandoSet");

    $select = "SELECT * FROM tbFuncionario WHERE codFuncionarioFuncionario = ?";
    $type = "s";
    $param = [$idFormandoSet];
                        
    $qry = $operation->executarSQL($select, $type, $param);

    $list = $operation->listar($qry);

    $dadosSend["obj"] = $list;

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>