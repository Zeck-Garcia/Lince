<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $idFormacaoSet = trim(filter_input(INPUT_POST, "idFormacaoSet"));
    $formacaoSet = trim(filter_input(INPUT_POST, "formacaoSet"));
    $actionSet = trim(filter_input(INPUT_POST, "actionSet"));

    if((intval($_SESSION["inicio_sessao"]) + intval($_SESSION["tempoExpira"])) >= time()){
        if($actionSet == "criar"){
            $select = "SELECT * FROM  tbLojas  WHERE nomeLoja = ?";
            $type = "s";
            $param = [$formacaoSet];
            
            $qry = $operation->executarSQL($select, $type, $param);
    
            if($qry->num_rows > 0){
                echo 4;
            } else {
        
                $operation->setTabela("tbLojas ");
                $operation->setCampos("nomeLoja");
            
                $operation->setTypes("s");
                $operation->setParams([$formacaoSet]);
            
                $operation->inserir();
                echo 1;
            }
    
        } else if ($actionSet == "excluir"){
    
            $resultSearch = searchRegistroSistema($operation, $idFormacaoSet);
            
            if($resultSearch == true){
                echo 3;
            } else {
                $operation->setTabela("tbLojas");
                $operation->setValorNaTabela("idLoja");
                $operation->setValorPesquisa($idFormacaoSet);
                $operation->setTipoValorPesquisa("i");
            
                $operation->excluir();
                echo 2;
            }
    
        } else if ($actionSet == "editar") {
    
            $operation->setTabela("tbLojas");
            $operation->setCampos("nomeLoja");
            $operation->setValorNaTabela("idLoja");
            
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

    function searchRegistroSistema($operation, $buscarRegistro){
      
        $select = "SELECT DISTINCT 1 AS resultado FROM tbFormacao WHERE codLocalFormacao = ?
                UNION ALL
                SELECT DISTINCT 1 AS resultado FROM tbUser WHERE lojaUser = ?
                UNION ALL
                SELECT DISTINCT 1 AS resultado FROM tbFuncionario WHERE lojaFuncionario = ?";

        $type = "sss";
        $param = [$buscarRegistro, $buscarRegistro, $buscarRegistro];

        $qry = $operation->executarSQL($select, $type, $param);

        $tem = false;

        if($qry->num_rows > 0){
            $tem = true;
        }
    
        return $tem;
    }

?>