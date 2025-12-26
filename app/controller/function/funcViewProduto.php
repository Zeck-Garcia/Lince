<?php
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();


    $codPodutoSet = str_replace(" ", "", trim(filter_input(INPUT_POST, "codPodutoSet")));

    // {$codPodutoSet}
    $selectProduto = "SELECT imgProduto, descricaoProduto, nomeProduto, codProduto, distrigalProduto FROM tbProduto WHERE codProduto = '{$codPodutoSet}' LIMIT 1";

    $qryProduto = $operation->executarSQL($selectProduto);

    $dadosProduto = $operation->listar($qryProduto);

    echo "<div class='imgGroupProduto'>
            <img class='imgProduto' src='" . $dadosProduto[0]["imgProduto"] . "' id=''>
    </div>";

    echo "<div class='column1'>
        <h2 id='titleProduto' class='titleProduto' data-codproduto='{$dadosProduto[0]['codProduto']}' data-distrigral='{$dadosProduto[0]['distrigalProduto']}'>" . strtoupper($dadosProduto[0]["nomeProduto"])  . "</h2>

        <div class=''>
            <div class='groupSizeSmallInfo borderDashed'>
                <div class='groupSizeSmallInfoIcon'><i class='bi bi-info-circle'></i></div>
                <div class='groupSizeSmallInfoItem'>
                    <div class='groupSizeSmallInfoItemTitle'>Artigo</div>
                    <div class='groupSizeSmallInfoText'>" . $dadosProduto[0]["descricaoProduto"] . "</div>
                </div>
            </div>

            <div class='mt-3 CampoGroup'>
                <input type='text' id='txtQtdProduto' class='form-control' onclick='focusInput()' onblur='focusInput()' onfocus='focusInput()'>
                <label>Quantidade</label>
            </div>

            <div class='mt-3'>
                <button id='btnAdicionarProduto' class='btn btn-success'>Adicionar<i class='bi bi-card-checklist'></i></button>
            </div>
        </div>
    </div>";


?>

