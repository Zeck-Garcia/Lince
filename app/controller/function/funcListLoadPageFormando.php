<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $txtBuscaSet = filter_input(INPUT_POST, "txtBuscaSet");
    $tipoBuscaSet = filter_input(INPUT_POST, "tipoBuscaSet");
    $txtDeSet = filter_input(INPUT_POST, "txtDeSet");
    $txtAteSet = filter_input(INPUT_POST, "txtAteSet");

    $dataDe = DateTime::createFromFormat("d/m/Y", $txtDeSet);
    $dataAte = DateTime::createFromFormat("d/m/Y", $txtAteSet);

    

    $select = "";
    $type = "";
    $param = [];

    $paginaSet = (filter_input(INPUT_POST, "paginaSet") == 0 ? 1 : filter_input(INPUT_POST, "paginaSet"));

    $limite = 7;

    $inicio = ($paginaSet * $limite) - $limite;

    
    $select .= "WITH result AS (SELECT * 

                FROM tbFormacao 

                LEFT JOIN tbFuncionario 
                ON tbFuncionario.codFuncionarioFuncionario = tbFormacao.codFuncionarioFormacao

                LEFT JOIN tbLojas
                ON tbLojas.idLoja = tbFormacao.codLocalFormacao

                LEFT JOIN tbFormacaoNome
                ON tbFormacaoNome.idFormacaoNome = tbFormacao.codFormacaoNomeFormacao";

    if($txtBuscaSet != ""){
        switch($tipoBuscaSet){
            case 1:
                $select .= " WHERE codFuncionarioFormacao = ?";
                $type .= "i";
                $param[] = $txtBuscaSet; 
                break;
    
            case 2:
                $select .= " WHERE nomeFuncionario LIKE ?";
                $type .= "s";
                $param[] = "%{$txtBuscaSet}%"; 
                break;
    
            case 3:
                $select .= " WHERE nomeLoja LIKE ?";
                $type .= "s";
                $param[] = "%{$txtBuscaSet}%";
                break;
    
            case 4:
                $select .= " WHERE nomeFormacaoNome LIKE ?";
                $type .= "s";
                $param[] = "%{$txtBuscaSet}%";
                break;
    
            default:
            break;
        }
    }

    if($txtBuscaSet == ""){
        $where = "WHERE";
    } else {
        $where = "AND";
    }

    if($txtDeSet != "" && $txtAteSet != ""){
        $select .= " {$where} dataFormacao >= ? AND dataFormacao <= ?";
        $type .= "ss";
        $param[] = $dataDe->format("Y-m-d");
        $param[] = $dataAte->format("Y-m-d");
    }

    $selectFinal = " GROUP BY tbFormacao.idFormacao)
    SELECT *, (SELECT COUNT(*) FROM result) AS totalRegistro FROM result LIMIT ?, ?";
    $type .= "ii";
    $param[] = $inicio;
    $param[] = $limite;

    $selectCompleta = $select . $selectFinal;

    $qry = $operation->executarSQL($selectCompleta, $type, $param);

    $list = $operation->listar($qry);

    // $dadosSend["obj"] = $list;

    $dadosSend = [
        "obj" => $list,
        "limite" => $limite,
    ];

    echo json_encode($dadosSend, JSON_UNESCAPED_UNICODE);

?>