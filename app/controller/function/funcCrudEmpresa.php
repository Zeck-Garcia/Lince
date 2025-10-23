<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $codEmpresaSet = trim(filter_input(INPUT_POST, "codEmpresaSet"));
    $nomeEmpresaSet = trim(filter_input(INPUT_POST, "nomeEmpresaSet"));
    $siteEmpresaSet = trim(filter_input(INPUT_POST, "siteEmpresaSet"));
    $emailEmpresa = trim(filter_input(INPUT_POST, "emailEmpresa"));
    $actionSet = trim(filter_input(INPUT_POST, "actionSet"));

    $dataAtual = date("Y-m-d");

    switch($actionSet){
        case "criarUsar":
        case "criar":

            $operation->setTabela("tbFornecedor");
            $operation->setCampos("nomeFornecedor, siteFornecedor, emailFornecedor, idCriadorFornecedor, dataCriacaoFornecedor");

            //$_SESSION['idAgente']
            
            $operation->setTypes("sssis");
            $operation->setParams([$nomeEmpresaSet, $siteEmpresaSet, $emailEmpresa, 1, $dataAtual]);

            $operation->inserir();

            $operation->fecharStatement();

            if($actionSet == "criar"){
                echo "criar";
            } else {
                echo "criarUsar";
            }
        break;

        case "editar":

            $selectEmpresa = "SELECT * FROM tbUser";

            $qryEmpresa = $operation->executarSQL($selectEmpresa);

            if(mysqli_num_rows($qryEmpresa) > 0){
                $dadosEmpresa = $operation->listar($qryEmpresa);
            }

            $alterNomeEmpresa = ($nomeEmpresaSet == "" ? $dadosEmpresa["nomeFornecedor"] : $nomeEmpresaSet );
            $alterSiteEmpresa = ($siteEmpresaSet == "" ? $dadosEmpresa["siteFornecedor"] : $siteEmpresaSet );
            $alterEmailEmpresa = ($emailEmpresa == "" ? $dadosEmpresa["emailFornecedor"] : $emailEmpresa );
            
            $operation->setTabela("tbFornecedor");
            $operation->setCampos("nomeFornecedor, siteFornecedor, emailFornecedor");
            $operation->setValorNaTabela("idFornecedor");
            
            $operation->setValorPesquisa($codEmpresaSet);
            $operation->setTipoValorPesquisa("i");

            $operation->setTypes("sss");
            $operation->setParams([$alterNomeEmpresa, $alterSiteEmpresa, $alterEmailEmpresa]);

            $operation->alterar();

            echo "alterado";
        break;

        case "excluir":

            $param = [];
            $selecExcluir = "SELECT idOrderCompra FROM tbOrderCompra WHERE idFornecedorOrderCompra = ? LIMIT 1";
            $type = "i";
            $param[] = $codEmpresaSet;
            $qryExcluir = $operation->executarSQL($selecExcluir, $type, $param);
            
            if(mysqli_num_rows($qryExcluir) > 0){
                echo "naoExclui";
            } else {
                $operation->setTabela("tbFornecedor");
                            
                $operation->setValorNaTabela("idFornecedor");
            
                $operation->setValorPesquisa($codEmpresaSet); 
                $operation->setTipoValorPesquisa("i");       
    
                $operation->excluir();
                echo "excluido";
            }
        break;
    }

?>