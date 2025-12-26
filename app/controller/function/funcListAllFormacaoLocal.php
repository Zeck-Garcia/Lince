<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();


    $select = "SELECT * FROM tbFormacaoLocal WHERE ativoFormacaoLocal = 1 ORDER BY nomeFormacaoLocal ASC";

    $qry = $operation->executarSQL($select);

    $list = $operation->listar($qry);

    $dadosSend["obj"] = $list;

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>