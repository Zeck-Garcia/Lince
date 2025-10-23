<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $searchUserSet = filter_input(INPUT_POST, "searchUserSet");

    $paginaSet = (filter_input(INPUT_POST, "paginaSet") == 0 ? 1 : filter_input(INPUT_POST, "paginaSet"));

    $limite = 5;
    
    $where = "";
    $type = "";
    $param = [];

    $inicio = ($paginaSet * $limite) - $limite;

        $selectLista = "WITH result AS (SELECT tbUser.idUser, tbUser.nomeUser, tbUser.departamentoUser, tbUser.lojaUser, tbUser.emailUser, tbUser.ativoUser, tbDepartamento.nomeDepartamento, tbCargo.nomeCargo, tbClasse.nomeClasse
        
                        FROM tbUser 

                        LEFT JOIN tbDepartamento
                        ON tbDepartamento.idDepartamento = tbUser.departamentoUser

                        LEFT JOIN tbCargo
                        ON tbCargo.idCargo = tbUser.departamentoUser
                        
                        LEFT JOIN tbClasse
                        ON tbClasse.idClasse = tbUser.classeUser";

    if($searchUserSet != ""){
        $where .= " WHERE nomeUser LIKE ?";
        $type .= "s";
        $param[] = "%" . $searchUserSet . "%";
    }

    $sqlFim = ")
                ( SELECT *, (SELECT COUNT(*) FROM result) AS totalRegistro FROM result) ORDER BY nomeUser ASC LIMIT ?, ?";

    $type .= "ii";
    $param[] = $inicio;
    $param[] = $limite;

    $selectFinal = $selectLista . $where . $sqlFim;

    $qryLista = $operation->executarSQL($selectFinal, $type, $param);

    $list = $operation->listar($qryLista);

    $dadosSend = [
        "obj" => $list,
        "limite" => $limite,
    ];

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>