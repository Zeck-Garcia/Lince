<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $json = file_get_contents("php://input");

    $dadosGet = json_decode($json, true);

    $dados = $dadosGet["dados"];

    $dataAtual = date("Y-m-d");

    $response = array();

    $operation->setTabela("tbAnulacao");
    $operation->setCampos("encomendaAnulacao, guiaFaturaAnulacao, motivoAnulacao, dataCriadoAnulacao, criadoPorAnulacao");

    foreach ($dados as $value) {
        $remessaValue = ($value['remessa'] == "" ? null : $value['remessa']);

        $operation->setTypes("sssss");
        $operation->setParams([$value['encomenda'],$remessaValue,$value['observacao'],$dataAtual,1]);

        try {
            $operation->inserir();
            $response['status'] = 'success';
            $response['message'] = "Salvo com sucesso";
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = "Erro: " . $e->getMessage();
        } finally {
            $operation->fecharStatement();
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
?>