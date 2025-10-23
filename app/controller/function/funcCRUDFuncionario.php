<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $codSet = trim(filter_input(INPUT_POST, "codSet"));
    $nomeSet = trim(filter_input(INPUT_POST, "nomeSet"));
    $localTrabalhoSet = trim(filter_input(INPUT_POST, "localTrabalhoSet"));
    $actionSet = trim(filter_input(INPUT_POST, "actionSet"));

    if((intval($_SESSION["inicio_sessao"]) + intval($_SESSION["tempoExpira"])) >= time()){
        if($actionSet == "Salvar"){
            $select = "SELECT * FROM  tbFuncionario  WHERE codFuncionarioFuncionario = ?";
            $type = "s";
            $param = [$codSet];
            
            $qry = $operation->executarSQL($select, $type, $param);
    
            if($qry->num_rows > 0){
                echo 4;
            } else {
        
                $operation->setTabela("tbFuncionario");
                $operation->setCampos("codFuncionarioFuncionario, nomeFuncionario, lojaFuncionario");
            
                $localTrabalhoSetFinal = ($localTrabalhoSet == "" ? null : $localTrabalhoSet);
    
                $operation->setTypes("sss");
                $operation->setParams([$codSet, $nomeSet, $localTrabalhoSetFinal]);
            
                $operation->inserir();
                echo 1;
            }
    
        } else if ($actionSet == "excluir"){
            $select = "SELECT * FROM  tbFormacao WHERE codFuncionarioFormacao = ?";
            $type = "s";
            $param = [$codSet];
    
            $qry = $operation->executarSQL($select, $type, $param);
    
            if($qry->num_rows > 0){
                echo 3;
            } else {
                $operation->setTabela("tbFuncionario");
                $operation->setValorNaTabela("codFuncionarioFuncionario");
                $operation->setValorPesquisa($codSet);
                $operation->setTipoValorPesquisa("s");
            
                $operation->excluir();
                echo 2;
            }
        }  else if ($actionSet == "Editar"){
    
            $localTrabalhoSetFinal = ($localTrabalhoSet == "" ? null : $localTrabalhoSet);
    
            $operation->setTabela("tbFuncionario");
            $operation->setCampos("nomeFuncionario, lojaFuncionario");
            $operation->setValorNaTabela("codFuncionarioFuncionario");
            
            $operation->setValorPesquisa($codSet);
            $operation->setTipoValorPesquisa("i");
    
            $operation->setTypes("ss");
            $operation->setParams([$nomeSet, $localTrabalhoSetFinal]);
    
            $operation->alterar();
            echo 3;
        }
    } else {
        echo "sessionExpira";
    }
    

?>