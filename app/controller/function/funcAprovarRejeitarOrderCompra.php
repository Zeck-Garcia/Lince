<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $numberOrderCompraSet = filter_input(INPUT_POST, "numberOrderCompraSet");
    $txtAreaAprovaSet = filter_input(INPUT_POST, "txtAreaAprovaSet");
    
    $aprovaRejeitaSet = filter_input(INPUT_POST, "aprovaRejeitaSet");
    $aprovaRejeitaSetValue = ($aprovaRejeitaSet == "aprovar" ? 1 : 0 );
    
    $dataAtual = date("Y-m-d");

    $operation->setTabela("tbOrderCompra");
    $operation->setCampos("dataAprovacaoOrderCompra, idAprovadorOrderCompra, aprovadoRejeitadoOrderCompra, textoAprovadorOrderCompra");
    $operation->setValorNaTabela("codOrderCompra");
    
    $operation->setValorPesquisa($numberOrderCompraSet);
    $operation->setTipoValorPesquisa("s");

    $operation->setTypes("siis");
    $operation->setParams([$dataAtual, 1, $aprovaRejeitaSetValue, $txtAreaAprovaSet]);

    $operation->alterar();
    $param = [];

    $select = "SELECT enviarEmailOrderCompra FROM tbOrderCompra WHERE codOrderCompra = ? LIMIT 1";

    $type = "s";
    $param[] = $numberOrderCompraSet;

    $list = [];
    $qryDadosOrder = $operation->executarSQL($select, $type, $param);

    if(mysqli_num_rows($qryDadosOrder) > 0){
        while($dadosOrder = $operation->listar($qryDadosOrder)){
            $list[] = [
                "msg" => "success",
                "email" => $dadosOrder[0]["enviarEmailOrderCompra"]
            ];
        }
    } else {
        $list[] = [
            "msg" => "reject",
            "email" => 0,
        ];
    }

    $dadosSend["obj"] = $list;

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);
    // echo 1;
?>