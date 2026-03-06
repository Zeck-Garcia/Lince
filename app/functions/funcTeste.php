<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();


    $select = "select * from tbUser";
    //$select = "SHOW TABLES from dbLince";
    $qry = $operation->executarSQL($select);
    if(mysqli_num_rows($qry) > 0){
        //$list = [];
        while($dados = $operation->listar($qry)){
            $list[] = $dados;

        }
        
        print_r($list);
    } else {
        echo "Sem dados";    
    }

    // ini_set("display_errors", 1);
    // ini_set("display_startup_errors", 1);
    // error_reporting(E_ALL);
    // include_once "../../../app/models/manipulacaoDeDados.php";
    // $operation = new manipulacaoDeDados();
    
    // $select = "RENAME TABLE tbUser to tbLogin";

    // $operation->setValorManipula($select);

    // $operation->manipula();
    