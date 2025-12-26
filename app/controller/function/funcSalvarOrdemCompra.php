<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $txtPrioridade = filter_input(INPUT_POST, "txtPrioridadeSet");
    $idFornecedor = filter_input(INPUT_POST, "idFornecedorSet");
    $valorNota = str_replace("'", "", trim(filter_input(INPUT_POST, "valorNotaSet")));
    $descricaoItem = filter_input(INPUT_POST, "descricaoItemSet");
    $descricaoOrder = str_replace("'", "", filter_input(INPUT_POST, "descricaoOrderSet"));
    $enviarEmail = str_replace("'", ".", filter_input(INPUT_POST, "enviarEmailSet"));

    $txtNumberOrcamento = str_replace("'", ".", filter_input(INPUT_POST, "txtNumberOrcamento"));

    $dataAtual = date("Y-m-d");
    $mes = date("m");
    $ano = date("y");
    $type = "";
    $param = [];

    $selectUltimoOrder = "SELECT codOrderCompra FROM tbOrderCompra WHERE substr(codOrderCompra, 1, 4) = ? ORDER BY codOrderCompra DESC LIMIT 1";
    $type .= "s";
    $param[] = $ano . $mes;

    $qryUltimoOrder = $operation->executarSQL($selectUltimoOrder, $type, $param);

    $dadosUltimaOrder = "";
    $x = [];
    if(mysqli_num_rows($qryUltimoOrder) > 0){
        $x = $operation->listar($qryUltimoOrder);
        $dadosUltimaOrder = floatval($x[0]["codOrderCompra"]) + 1;
    } else {
        $dadosUltimaOrder = $ano.$mes."0001";
    }

    //$_SESSION['idAgente']

   if($dadosUltimaOrder != ""){
        $cod = $dadosUltimaOrder;

        $operation->setTabela("tbOrderCompra");
        $operation->setCampos("codOrderCompra, numeroOrcamentoOrderCompra, destinoOrderCompra, dataCriacaoOrderCompra, prioridadeOrderCompra, idSolicitanteOrderCompra, idFornecedorOrderCompra, valorNotaOrderCompra, descricaoItemOrderCompra, descricaoOrderOrderCompra, enviarEmailOrderCompra");

        $operation->setTypes("ssisiiisssi");
        $operation->setParams([$cod, $txtNumberOrcamento, 1, $dataAtual, $txtPrioridade, $_SESSION["idUser"], $idFornecedor, $valorNota, $descricaoItem, $descricaoOrder, $enviarEmail]);

        $operation->inserir();

        $operation->fecharStatement();

        for($i = 0 ; $i < (count($_FILES["flAnexoOrder"]["name"])) ; $i++){
            $Ext = strtolower(pathinfo($_FILES["flAnexoOrder"]["name"][$i], PATHINFO_EXTENSION));

            if(!move_uploaded_file($_FILES["flAnexoOrder"]["tmp_name"][$i], "../../views/pages/anexoOrderCompra/". $cod . "_file-" . ($i + 1 ) . "." . $Ext)){
                echo 0;
                exit;
            }
        }

        if($_FILES["flOrcamento"]["name"]){
            for($a = 0 ; $a < (count($_FILES["flOrcamento"]["name"])) ; $a++){
                $ExtAnexo = strtolower(pathinfo($_FILES["flOrcamento"]["name"][$a], PATHINFO_EXTENSION));
    
                if(!move_uploaded_file($_FILES["flOrcamento"]["tmp_name"][$a], "../../views/pages/anexoOrderCompraEmail/". $cod . "_file-" . ($a + 1 ) . "." . $ExtAnexo)){
                    echo 0;
                    exit;
                }
            }
        }

        echo 1;
    }


?>