<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $json = file_get_contents("php://input");

    $dadosGet = json_decode($json, true);

    $dados = $dadosGet["dados"];
    $actionSet = $dadosGet["action"];

    $dataAtual = date("Y-m-d");
    $response = array();

    switch($actionSet){
        case "Salvar":
            $operation->setTabela("tbRemoverArtigo");
            $operation->setCampos("encomendaRemoverArtigo, criadoPorRemoverArtigo, artigoRemoverArtigo, motivoRemoverArtigo, dataCriacaoRemoverArtigo");
            $operation->setTypes("sisss");
        
            echo $dados['artigo'];
            //foreach ($dados as $value){
                $operation->setParams([$dados['idEncomenda'],1,str_replace('"',"",str_replace("]","",str_replace("[","",$dados['artigo']))),$dados['motivo'],$dataAtual]);
        
                try {
                    $operation->inserir();
                    $response['status'] = 'success';
                    $response['message'] = "Salvo com sucesso";
                } catch (Exception $e) {
                    $response['status'] = 'error';
                    $response['message'] = "Erro: " . $e->getMessage();
                } finally {
                    $operation->fecharStatement();
                    // echo json_encode($response);
                    // exit;
                }
            //}
        break;

        case "Finalizar":
            $userId = 2; 
            $feitoPor = 1;

            $operation->setTabela("tbRemoverArtigo");
            $operation->setCampos("estadoRemoverArtigo, dataFeitoRemoverArtigo, feitoPorRemoverArtigo");
            $operation->setValorNaTabela("idRemoverArtigo");
            $operation->setValorPesquisa($userId);
            $operation->setTypes("isi");
            $operation->setParams([1,$dataAtual,$feitoPor]);
            
            $operation->setTipoValorPesquisa("i");

            try {
                $operation->alterar();
                $response['status'] = 'success';
                $response['message'] = "Editado com sucesso";
            } catch (Exception $e) {
                $response['status'] = 'error';
                $response['message'] = "Erro: " . $e->getMessage();
            } finally {
                $operation->fecharStatement();
                // echo json_encode($response);
                // exit;
            }
        break;

        case "Excluir":
            $operation->setTabela("tbRemoverArtigo");
            $operation->setValorNaTabela("idRemoverArtigo");
            $operation->setValorPesquisa($dadosGet["dados"]["idEncomenda"]);

            $operation->setTipoValorPesquisa("i");

            try {
                $operation->excluir();
                $response['status'] = 'success';
                $response['message'] = "Encomenda {$dadosGet["dados"]["idEncomenda"]} excluído com sucesso!";
            } catch (Exception $e) {
                $response['status'] = 'error';
                $response['message'] = "Erro: " . $e->getMessage();
            } finally {
                $operation->fecharStatement();
            }
        break;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();

?>