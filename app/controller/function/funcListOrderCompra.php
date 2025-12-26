<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $feitoSet = filter_input(INPUT_POST, "feitoSet");
    
    $numberOrderCompraSet = filter_input(INPUT_POST, "numberOrderCompraSet");

    $aprovadoSet = filter_input(INPUT_POST, "aprovadoSet");
    $paginaSet = (filter_input(INPUT_POST, "paginaSet") == 0 ? 1 : filter_input(INPUT_POST, "paginaSet"));

    $limite = 5;

    $inicio = ($paginaSet * $limite) - $limite;

    $whereSql = "";
    $type = "";
    $param = [];

    if($numberOrderCompraSet == ""){
        switch($aprovadoSet){
            case 0:
            case 1:
                $whereSql .= " WHERE aprovadoRejeitadoOrderCompra = ?";
                $type .= "i";
                $param[] = $aprovadoSet;
            break;

            case 2:
                $whereSql = "";
            break;

            default:
                $whereSql .= " WHERE aprovadoRejeitadoOrderCompra IS NULL";
            break;
        }
    } else {
        $whereSql .= " WHERE codOrderCompra = ?";
        $type .= "s";
        $param[] = $numberOrderCompraSet;
    }

    $select= "WITH result AS (
        SELECT codOrderCompra, dataCriacaoOrderCompra, aprovadoRejeitadoOrderCompra, emailEnviadoAoFornecedorOrderCompra, tbUser.nomeUser
        FROM tbOrderCompra
        LEFT JOIN tbUser ON tbUser.idUser = tbOrderCompra.idSolicitanteOrderCompra";

    if($_SESSION["classeAgente"] != 1){
        if($aprovadoSet == 2){
            if($numberOrderCompraSet == ""){
                $whereSql .= " WHERE idSolicitanteOrderCompra = ?";
                $type .= "i";
                $param[] = $_SESSION["idUser"];
            } else {
                $whereSql .= " AND idSolicitanteOrderCompra = ?";
                $type .= "i";
                $param[] = $_SESSION["idUser"];
            }
        } else {
            $whereSql .= " AND idSolicitanteOrderCompra = ?";
            $type .= "i";
            $param[] = $_SESSION["idUser"];
        }
    } else {
        if($feitoSet != 0){
            $whereSql .= " AND idSolicitanteOrderCompra = ?";
            $type .= "i";
            $param[] = $feitoSet;
        }
    }


    $sqlFinal = " ORDER BY codOrderCompra, dataCriacaoOrderCompra ASC)
    SELECT *, (SELECT COUNT(*) FROM result) AS totalRegistro FROM result LIMIT ?, ?";
    $type .= "ii";
    $param[] = $inicio;
    $param[] = $limite;

    $sqlCompleta = $select . $whereSql . $sqlFinal;
    
    //echo $type;

    //var_dump($param);
    $qryOrderLista = $operation->executarSQL($sqlCompleta, $type, $param);

    $list = $operation->listar($qryOrderLista);

    $dadosSend = [
        "obj" => $list,
        "limite" => $limite,
    ];

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);


?>