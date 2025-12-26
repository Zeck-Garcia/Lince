<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $txtPesquisarSet = filter_input(INPUT_POST, "codPodutoSet");
    $sltFeitoSet = filter_input(INPUT_POST, "sltFeitoSet");
    $sltLojaSet = filter_input(INPUT_POST, "sltLojaSet");
    $paginaSet = (filter_input(INPUT_POST, "paginaSet") == "" ? 1 : filter_input(INPUT_POST, "paginaSet"));
    $limite = 10;
    $inicio = ($paginaSet * $limite) - $limite;

        $selectListPedidoLoja = "WITH result AS (SELECT idPedido, codProdutoPedido, qtdPedido, feitoPedido, nomeProduto, dataFeitoPedido, dataCriadoPedido, tbLojas.nomeLoja, tbLojas.idLoja, distrigalPedido, feitoPorPedido, tbUser.nomeUser

        FROM tbPedido 
        
        LEFT JOIN tbProduto
        ON tbProduto.codProduto = tbPedido.codProdutoPedido
        
        LEFT JOIN tbLojas
        ON tbLojas.idLoja = tbPedido.lojaPedido
        
        LEFT JOIN tbUser
        ON tbUser.idUser = tbPedido.feitoPorPedido"

        .($sltFeitoSet == 3 ? "" : (" WHERE feitoPedido = {$sltFeitoSet}"))

        . ( $sltLojaSet == 0 ? "" : " AND idLoja = {$sltLojaSet}")
        
        .(" ORDER BY feitoPedido, dataFeitoPedido ASC) ")
        
        .( " SELECT *, (SELECT COUNT(*) FROM result ) AS totalRegistro FROM result ")
        
        .($txtPesquisarSet != "" ? "" : " LIMIT {$inicio},{$limite}");
    
        $qryListPedidoLoja = $operation->executarSQL($selectListPedidoLoja);
    
        $list =  $operation->listar($qryListPedidoLoja);

        $dadosSend = [
            "obj" => $list,
            "limite" => $limite,
        ];
        
        // if($list){
        //     $dadosSend = [
        //         "obj" => $list,
        //         "limite" => $limite,
        //         "totalRegistro" => $totalRegistro,
        //     ];
        // } else {
        //     $dadosSend = [
        //         "obj" => [],
        //         "limite" => $limite,
        //         "totalRegistro" => 0,
        //     ];
        // }

        echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>