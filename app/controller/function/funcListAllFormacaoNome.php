<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();


    $select = "SELECT * FROM tbFormacaoNome WHERE ativoFormacaoNome = 1 ORDER BY nomeFormacaoNome ASC";

    $qry = $operation->executarSQL($select);

    $list = $operation->listar($qry);

    $dadosSend["obj"] = $list;

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>