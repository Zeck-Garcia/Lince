<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $json = file_get_contents("php://input");

    $dadosGet = json_decode($json, true);

    $dados = $dadosGet["dados"];

    $text = $dadosGet["textoEntra"];

    $dataAtual = date("Y-m-d");
    
    $operation->setTabela("tbPedido");
    $operation->setCampos("lojaPedido, codProdutoPedido, qtdPedido, dataCriadoPedido, distrigalPedido");

    foreach ($dados as $value) {
        $operation->setTypes("isisi");
        $operation->setParams([1,$value['produto'],$value['qtd'],$dataAtual,$value["distrigal"]]);

        try {
            if ($operation->inserir()) {
                $mensagem = "Inserido com sucesso!";
            } else {
                $mensagem = "Erro ao inserir: " . $operation->getMsg();
            }
            $mensagem;
        } catch (Exception $e) {
            "Erro: " . $e->getMessage() . "<br>";
        } finally {
            $operation->fecharStatement();
        }
    }

    $response = array('status' => 'success', 'message' => 'Dados processados');
    echo json_encode($response);
?>