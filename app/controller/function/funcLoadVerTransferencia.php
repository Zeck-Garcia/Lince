<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

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
        $whereParts[] = "encomedaTransferencia = ?";
        $types .= "s";
        $params[] = $txtSearchSet;
    } else {
        if ($lojaSet != "0") {
            $whereParts[] = "criadoPorTransferencia = ?";
            $types .= "i";
            $params[] = $lojaSet;
            if ($feitoSet != "3") {
                $whereParts[] = "estadoTransferencia = ?";
                $types .= "i";
                $params[] = $feitoSet;
            }
        } else {
            if ($feitoSet != "3") {
                $whereParts[] = "estadoTransferencia = ?";
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
                                SELECT idTransferencia, tipoTransferencia, numeroTransferenciaTransferencia, encomedaTransferencia, lojaTransferencia, artigoTransferencia, criadoEmTransferencia, criadoPorTransferencia, estadoTransferencia, feitoPorTransferencia, finalizadoEmTransferencia, tbLojas.nomeLoja, tbUser.nomeUser

                                FROM tbTransferencia

                                LEFT JOIN tbUser
                                ON tbUser.idUser = feitoPorTransferencia

                                LEFT JOIN tbLojas
                                ON tbLojas.idLoja = criadoPorTransferencia
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
        "totalRegistro" => $totalRegistros
    ];

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>