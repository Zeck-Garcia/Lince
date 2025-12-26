<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $EmpresaSet = filter_input(INPUT_POST, "EmpresaSet");

    $whereSql = "";
    $type = "";
    $param = [];

    if($EmpresaSet != ""){
        $whereSql .= " AND (nomeFornecedor LIKE ? OR idFornecedor = ?)";
        $type .= "si";
        $param[] = $EmpresaSet;
        $param[] = $EmpresaSet;
    }

    $selectListEmpresa = "SELECT * FROM tbFornecedor WHERE ativoFornecedor = 1";

    $sqlCompleta = $selectListEmpresa . $whereSql;

    $qryListEmpresa = $operation->executarSQL($sqlCompleta, $type, $param);

    $list = [];
    if(mysqli_num_rows($qryListEmpresa) > 0){
        while($dadosListEmpresa = $operation->listar($qryListEmpresa)){
            $list[] = $dadosListEmpresa;
        }
    } else {
        $list = [];
    }

    $dadosSend["obj"] = $list;
    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>