<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $idExcluirProdutoFeiroSet = filter_input(INPUT_POST, "idExcluirProdutoFeiroSet");




    $operation->setTabela("tbPedido");
                
    // $operation->setCampos("usadoCodLiberacaoServico  = '{$ValorNovo}' {$valueAtiva}");

    $operation->setValorNaTabela("idPedido");

    $operation->setValorPesquisa("'$idExcluirProdutoFeiroSet'");        
    
    $operation->excluir();
    echo 1;

?>