<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $numberEncomendaSet = filter_input(INPUT_POST, "numberEncomendaSet");

    try {

        $selectDados = "SELECT encomendaAnulacao FROM tbAnulacao WHERE encomendaAnulacao = {$numberEncomendaSet}";

        $stmt = $operation->prepararSQL($selectDados);
        $operation->vincularParametros($stmt, "s", [$numberEncomendaSet]); 
        $result = $operation->executarStatement();
        $list = $operation->listar($result);

        $dadosSend = [
            "obj" => $list,
        ];

        header('Content-Type: application/json');
        echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode(["error" => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    } finally {
        $operation->fecharStatement();
    }
    

?>