<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $idDpSet = filter_input(INPUT_POST, "idDpSet");

    $selectLista = "SELECT * FROM tbModulo WHERE ativoModulo = 1 AND departamentoModulo = ?";
                        
    $type = "i";
    $param = [$idDpSet];

    $qryLista = $operation->executarSQL($selectLista, $type, $param);

    $list = $operation->listar($qryLista);

    $dadosSend["obj"] = $list;

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>