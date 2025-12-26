<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();


    $select = "select * from  tbFormacaoLocal ";
    $qry = $operation->executarSQL($select);
    if(mysqli_num_rows($qry) > 0){
        //$list = [];
        while($dados = $operation->listar($qry)){
            $list[] = $dados;

        }
        
        var_dump($list);
    } else {
        echo "Sem dados";    
    }
    
?>