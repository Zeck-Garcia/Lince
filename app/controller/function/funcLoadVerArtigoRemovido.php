<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $txtSearchSet = filter_input(INPUT_POST, "txtSearchSet");
    $lojaSet = filter_input(INPUT_POST, "lojaSet");
    $feitoSet = filter_input(INPUT_POST, "feitoSet");

    $paginaSet = (filter_input(INPUT_POST, "paginaSet") == "" ? 1 : filter_input(INPUT_POST, "paginaSet"));

    $limite = 3;

    $inicio = ($paginaSet * $limite) - $limite;

    $txtSearchSet = filter_input(INPUT_POST, "txtSearchSet") ?? "";
    $lojaSet = filter_input(INPUT_POST, "lojaSet") ?? "0";
    $feitoSet = filter_input(INPUT_POST, "feitoSet") ?? "3";
    // $inicio = $_GET['inicio'] ?? 0;

    $whereParts = [];
    $types = "";
    $params = [];

    if ($txtSearchSet != "") {
        $whereParts[] = "encomendaRemoverArtigo = ?";
        $types .= "s";
        $params[] = $txtSearchSet;
    } else {
        if ($lojaSet != "0") {
            $whereParts[] = "criadoPorRemoverArtigo = ?";
            $types .= "i";
            $params[] = $lojaSet;
            if ($feitoSet != "3") {
                $whereParts[] = "estadoRemoverArtigo = ?";
                $types .= "i";
                $params[] = $feitoSet;
            }
        } else {
            if ($feitoSet != "3") {
                $whereParts[] = "estadoRemoverArtigo = ?";
                $types .= "i";
                $params[] = $feitoSet;
            }
        }
    }

    $whereClause = "";
    if (!empty($whereParts)) {
        $whereClause = " WHERE " . implode(" AND ", $whereParts);
    }

    $selectDados = "WITH result AS (
                        SELECT tbRemoverArtigo.idRemoverArtigo, tbRemoverArtigo.motivoRemoverArtigo, tbRemoverArtigo.encomendaRemoverArtigo, tbRemoverArtigo.artigoRemoverArtigo, tbRemoverArtigo.dataCriacaoRemoverArtigo, tbRemoverArtigo.estadoRemoverArtigo, tbRemoverArtigo.dataFeitoRemoverArtigo, tbRemoverArtigo.feitoPorRemoverArtigo, tbRemoverArtigo.criadoPorRemoverArtigo, tbLojas.nomeLoja
                        
                        FROM tbRemoverArtigo
                        LEFT JOIN tbLojas 
                        ON tbLojas.idLoja = tbRemoverArtigo.criadoPorRemoverArtigo
                        {$whereClause})

                    SELECT *, (SELECT COUNT(*) FROM result) AS totalRegistro
                    FROM result
                    LIMIT ?, ?";

    $types .= "ii";
    $params[] = $inicio;
    $params[] = $limite;

    $qryDados = $operation->executarSQL($selectDados, $types, $params);
    $list = $operation->listar($qryDados);
    $totalRegistros = $operation->contaDados($qryDados);

    $dadosSend = [
        "obj" => $list,
        "limite" => $limite,
        "total" => $totalRegistros
    ];

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

    // if($txtSearchSet == ""){
    //     if($lojaSet != "0"){
    //         if($feitoSet != 3){
    //             $where = " WHERE criadoPorRemoverArtigo = {$lojaSet} ";
    //         } else {
    //             $where = " WHERE criadoPorRemoverArtigo = {$lojaSet} AND estadoRemoverArtigo = {$feitoSet}";
    //         }
    //     } else {
    //         if($feitoSet != 3){
    //             $where = " WHERE estadoRemoverArtigo = {$feitoSet} ";
    //         } else {
    //             $where = "";
    //         }
    //     }
    // } else {
    //     $where = " WHERE encomendaRemoverArtigo = ?";
    // }

    // $selectDados = "WITH result AS (SELECT tbRemoverArtigo.idRemoverArtigo, tbRemoverArtigo.motivoRemoverArtigo, tbRemoverArtigo.encomendaRemoverArtigo, tbRemoverArtigo.artigoRemoverArtigo, tbRemoverArtigo.dataCriacaoRemoverArtigo, tbRemoverArtigo.estadoRemoverArtigo, tbRemoverArtigo.dataFeitoRemoverArtigo, tbRemoverArtigo.feitoPorRemoverArtigo, tbRemoverArtigo.criadoPorRemoverArtigo, tbLojas.nomeLoja

    //                         FROM tbRemoverArtigo

    //                         LEFT JOIN tbLojas
    //                         ON tbLojas.idLoja = tbRemoverArtigo.criadoPorRemoverArtigo 
    //                         {$where})"
    
    // .( " SELECT *, (SELECT COUNT(*) FROM result) AS totalRegistro FROM result ")

    // ." LIMIT {$inicio},{$limite}";

    // $qryDados = $operation->executarSQL($selectDados, "s", [$where]);
    // $list = $operation->listar($qryDados);

    // $dadosSend = [
    //     "obj" => $list,
    //     "limite" => $limite,
    // ];

    // echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>