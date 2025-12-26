<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $idUserSet = trim(filter_input(INPUT_POST, "idUserSet"));
    //$slcDepartamentoSet = trim(filter_input(INPUT_POST, "slcDepartamentoSet"));
    //$slcCargoSet = trim(filter_input(INPUT_POST, "slcCargoSet"));
    $txtNomeSet = (filter_input(INPUT_POST, "txtNomeSet"));
    $txtLoginSet = trim(filter_input(INPUT_POST, "txtLoginSet"));
    $txtSenhaSet = trim(filter_input(INPUT_POST, "txtSenhaSet"));
    //$slcLojaSet = trim(filter_input(INPUT_POST, "slcLojaSet"));
    $txtEmailSet = trim(filter_input(INPUT_POST, "txtEmailSet"));
    $slcAtivoSet = trim(filter_input(INPUT_POST, "slcAtivoSet"));
    $actionSet = trim(filter_input(INPUT_POST, "actionSet"));

    $classeSet = filter_input(INPUT_POST, "txtClasseSet");

    $receberEmail = filter_input(INPUT_POST, "txtReceberEmail");

    $dataAtual = date("Y-m-d");

    switch($actionSet){
        case "criar":
            $txtSenhaValue = hash("sha256", $txtSenhaSet);

            $operation->setTabela("tbUser");
            $operation->setCampos("nomeUser, classeUser, passUser, loginUser, dataCriacaoUser, emailUser");

            $operation->setTypes("sissss");
            $operation->setParams([$txtNomeSet, $classeSet, $txtSenhaValue, $txtLoginSet, $dataAtual, $txtEmailSet]);

            $operation->inserir();

            $operation->fecharStatement();

            echo "criar";
        break;

        case "editar":
            $operation->setTabela("tbUser");
            
            $operation->setValorNaTabela("idUser");
            $operation->setValorPesquisa($idUserSet);
            $operation->setTipoValorPesquisa("i");

            if($txtSenhaSet == "" && $txtEmailSet == ""){
                $operation->setTypes("siii");
                $operation->setCampos("nomeUser, classeUser, ativoUser, receberEmailUser");
                $operation->setParams([$txtNomeSet, $classeSet, $slcAtivoSet, $receberEmail]);
            } else if($txtEmailSet != "" && $txtSenhaSet == ""){
                $operation->setTypes("ssssi");
                $operation->setCampos("nomeUser, classeUser, ativoUser, emailUser, receberEmailUser");
                $operation->setParams([$txtNomeSet, $classeSet, $slcAtivoSet, $txtEmailSet, $receberEmail]);
            } else if($txtEmailSet == "" && $txtSenhaSet != ""){
                $operation->setTypes("siisi");
                $operation->setCampos("nomeUser, classeUser, ativoUser, passUser, receberEmailUser");
                $operation->setParams([$txtNomeSet, $classeSet, $slcAtivoSet,  hash("sha256", $txtSenhaSet), $receberEmail]);

            } else if($txtEmailSet != "" && $txtSenhaSet != ""){
                $operation->setTypes("siissi");
                $operation->setCampos("nomeUser, classeUser, ativoUser, emailUser, passUser, receberEmailUser");
                $operation->setParams([$txtNomeSet, $classeSet, $slcAtivoSet, $txtEmailSet,  hash("sha256", $txtSenhaSet), $receberEmail]);
            }

            $operation->alterar();

            echo "alterada";
        break;

        case "excluir":
            $param = [];
            $selecExcluir = "SELECT * FROM tbOrderCompra WHERE idSolicitanteOrderCompra = ? LIMIT 1";
            $type = "i";
            $param[] = $idUserSet;
            $qryExcluir = $operation->executarSQL($selecExcluir, $type, $param);
            
            if(mysqli_num_rows($qryExcluir) > 0){
                echo "naoExclui";
            } else {
                $operation->setTabela("tbUser");
                $operation->setValorNaTabela("idUser");
                $operation->setValorPesquisa($idUserSet);
                $operation->setTipoValorPesquisa("i");

                $operation->excluir();
                echo "excluida";
            }
        break;

    }

?>