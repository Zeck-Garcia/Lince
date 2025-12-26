<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $selectLista = "SELECT * FROM tbMostrarTampoMesa WHERE ativoMostrarTampoMesa = 1";
                        
    $qryLista = $operation->executarSQL($selectLista);

    $list = $operation->listar($qryLista);

    $dadosSend["obj"] = $list;

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>