<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $idFormacaoSet = trim(filter_input(INPUT_POST, "idFormacaoSet"));
    $formacaoSet = trim(filter_input(INPUT_POST, "formacaoSet"));
    $actionSet = trim(filter_input(INPUT_POST, "actionSet"));

    if((intval($_SESSION["inicio_sessao"]) + intval($_SESSION["tempoExpira"])) >= time()){
        if($actionSet == "criar"){
            $select = "SELECT * FROM  tbFormacaoNome  WHERE nomeFormacaoNome = ?";
            $type = "s";
            $param = [$formacaoSet];
            
            $qry = $operation->executarSQL($select, $type, $param);
    
            if($qry->num_rows > 0){
                echo 4;
            } else {
        
                $operation->setTabela("tbFormacaoNome ");
                $operation->setCampos("nomeFormacaoNome");
            
                $operation->setTypes("s");
                $operation->setParams([$formacaoSet]);
            
                $operation->inserir();
                echo 1;
            }
    
        } else if ($actionSet == "excluir"){
            $select = "SELECT * FROM tbFormacao WHERE codFormacaoNomeFormacao = ?";
            $type = "i";
            $param = [$idFormacaoSet];
    
            $qry = $operation->executarSQL($select, $type, $param);
    
            if($qry->num_rows > 0){
                echo 3;
            } else {
                $operation->setTabela("tbFormacaoNome");
                $operation->setValorNaTabela("idFormacaoNome");
                $operation->setValorPesquisa($idFormacaoSet);
                $operation->setTipoValorPesquisa("i");
            
                $operation->excluir();
                echo 2;
            }
        } else if ($actionSet == "editar") {
    
            $operation->setTabela("tbFormacaoNome");
            $operation->setCampos("nomeFormacaoNome");
            $operation->setValorNaTabela("idFormacaoNome");
            
            $operation->setValorPesquisa($idFormacaoSet);
            $operation->setTipoValorPesquisa("i");
    
            $operation->setTypes("s");
            $operation->setParams([$formacaoSet]);
    
            $operation->alterar();
            echo 5;
        }
    } else {
        echo "sessionExpira";
    }


    

?>