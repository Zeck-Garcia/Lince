<?php

include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $actionSet = trim(filter_input(INPUT_POST, "actionSet"));
    $idFormacaoSet = trim(filter_input(INPUT_POST, "idFormacaoSet"));
    $codFuncSet = trim(filter_input(INPUT_POST, "codFuncSet"));
    $nomeFuncSet = trim(filter_input(INPUT_POST, "nomeFuncSet"));
    $tipoFormSet = trim(filter_input(INPUT_POST, "tipoFormSet"));
    $dataFormSet = filter_input(INPUT_POST, "dataFormSet");
    $horaFormSet = trim(filter_input(INPUT_POST, "horaFormSet"));
    $minutoFormSet = trim(filter_input(INPUT_POST, "minutoFormSet"));
    $localFormSet = trim(filter_input(INPUT_POST, "localFormSet"));

    if((intval($_SESSION["inicio_sessao"]) + intval($_SESSION["tempoExpira"])) >= time()){
        if($actionSet == "criar"){
        
            $tempo = $horaFormSet . ":" . $minutoFormSet . ":00";
        
            $operation->setTabela("tbFormacao");
            $operation->setCampos("codFuncionarioFormacao, codFormacaoNomeFormacao, dataFormacao, tempoFormacao, codLocalFormacao");
        
            $operation->setTypes("iissi");
            $operation->setParams([$codFuncSet, $tipoFormSet, $dataFormSet, $tempo, $localFormSet]);
        
            $operation->inserir();
    
            $select = "SELECT * FROM tbFuncionario WHERE codFuncionarioFuncionario = ?";
            $type = "i";
            $param = [$codFuncSet];
    
            $qry = $operation->executarSQL($select, $type, $param);
    
            if($qry->num_rows == 0){
                $operation->setTabela("tbFuncionario");
                $operation->setCampos("codFuncionarioFuncionario, nomeFuncionario");
            
                $operation->setTypes("is");
                $operation->setParams([$codFuncSet, $nomeFuncSet]);
            
                $operation->inserir();
            }
    
            echo 1;
        } else if ($actionSet == "excluir"){
            $operation->setTabela("tbFormacao");
            $operation->setValorNaTabela("idFormacao");
            $operation->setValorPesquisa($idFormacaoSet);
            $operation->setTipoValorPesquisa("i");
        
            $operation->excluir();
            echo 2;
        }
    } else {
        echo "sessionExpira";
    }
    


?>