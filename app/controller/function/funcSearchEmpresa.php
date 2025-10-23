<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $codEmpresaSet = str_replace(" ", "", trim(filter_input(INPUT_POST, "codEmpresaSet")));
    $nomeEmpresaSet = trim(filter_input(INPUT_POST, "nomeEmpresaSet"));

    $campoBusca = ($codEmpresaSet == "" ? "nomeFornecedor" : "idFornecedor");
    $valorCampo = ($codEmpresaSet == "" ? $nomeEmpresaSet : $codEmpresaSet);
    
    $whereSql = "";
    $type = "";
    $param = [];
    
    $selectSearchEmpresa = "SELECT idFornecedor, nomeFornecedor, emailFornecedor, siteFornecedor FROM tbFornecedor";
    
    if($codEmpresaSet == ""){
        $whereSql .= " WHERE nomeFornecedor = ? LIMIT 1";
        $type .= "s";
        $param[] = $nomeEmpresaSet;
    } else {
        $whereSql .= " WHERE idFornecedor = ? LIMIT 1";
        $type .= "i";
        $param[] = $codEmpresaSet;
    }

    $sqlCompleta = $selectSearchEmpresa . $whereSql;

    $qrySearchEmpresa = $operation->executarSQL($sqlCompleta, $type, $param);

    $list = [];
    if(mysqli_num_rows($qrySearchEmpresa) > 0){
        while($dadosSearchEmpresa = $operation->listar($qrySearchEmpresa)){
            $list[] = $dadosSearchEmpresa;
        }
    } else {
        $list = [];
    }

    $dadosSend["obj"] = $list;

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);
?>