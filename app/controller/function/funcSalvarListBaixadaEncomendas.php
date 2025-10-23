<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();


    $json = file_get_contents("php://input");
    $dadosValueSet =  json_decode(strip_tags($_POST["dadosValueSet"]));
    // $dadosRecebidos = json_decode($json, true);
    // $dadosValueSet = $dadosRecebidos['dados'];

    $dataAtual = date("Y-m-d");
    // foreach($dadosValueSet as $value){
    //     $value;


    //     $operation->setTabela("tbPedido");
                    
    //     $operation->setCampos("dataFeitoPedido = '{$dataAtual}',
    //                             feitoPedido = '1',
    //                             feitoPorPedido = '1'
    //                             ");//$_SESSION['idAgente'];

    //     $operation->setValorNaTabela("idPedido");
    
    //     $operation->setValorPesquisa("'{$value}'");        
        
    //     $operation->alterar();
    // }

    // echo 1;

        // $json = file_get_contents("php://input");
        // $dadosRecebidos = json_decode($json, true);

        foreach ($dadosValueSet as $item) {

            $operation->setTabela("tbPedido");
            $operation->setCampos("dataFeitoPedido = ?");
            $operation->setValorNaTabela("idPedido");
            $operation->setValorPesquisa($item);
            $operation->setTypes("s");
            $operation->setParams([$dataAtual]);

            try {
                if ($operation->alterar()) {
                    $mensagem = "Inserido com sucesso!";
                } else {
                    $mensagem = "Erro ao inserir: " . $operation->getMsg();
                }
            } catch (Exception $e) {
                $mensagem = "Erro ao alterar a encomenda de código " . $e->getMsg();
            } finally {
                $operation->fecharStatement();
            }
        }

        $response = array('status' => 'success', 'message' => 'Dados processados');
        echo json_encode($response);
    //

?>