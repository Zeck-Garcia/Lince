<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $idModuloSet = filter_input(INPUT_POST, "idModuloSet");

    $selectLista = "SELECT * FROM tbModulo WHERE ativoModulo = 1 AND idModulo = ?";
    
    $type = "i";
    $param = [$idModuloSet];

    $qryLista = $operation->executarSQL($selectLista, $type, $param);

    $list = $operation->listar($qryLista);

    if($qryLista->num_rows > 0){
        foreach($list as $value){
            include_once "../../views/pages/modulo/{$value['nomeModulo']}";
            $subModulo = $value['idSubModuloModulo'];
        }

        $finalArray = explode(",", $subModulo);

        foreach($finalArray as $valueSubModulo){
            $selectSubModulo = "SELECT * FROM tbSubModulo WHERE ativoSubModulo = 1 AND idSubModulo = ?";
            $typeSubModulo = "i";
            $paramSubModulo = [$valueSubModulo];

            $qrySubModulo = $operation->executarSQL($selectSubModulo, $typeSubModulo, $paramSubModulo);

            if($qrySubModulo->num_rows > 0){
                $dadosSubModulo = $operation->listar($qrySubModulo);

                foreach($dadosSubModulo as $dadosValueSubModulo){
                    include_once "../../views/pages/subModulo/{$dadosValueSubModulo['nomeSubModulo']}";
                }
            }
        }
    }
?>