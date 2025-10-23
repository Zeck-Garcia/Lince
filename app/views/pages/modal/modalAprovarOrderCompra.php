
<?php
    $numberOrderCompraSet = filter_input(INPUT_POST, "numberOrderCompraSet");
    $aprovaRejeitaSet = filter_input(INPUT_POST, "aprovaRejeitaSet");

    switch($aprovaRejeitaSet){
        case "aprovar":
            $title = "Você irá aprovar essa ordem de compra";
            $color = " style='background: green; color: #fff'";
            $subTile = "aprovação";
        break;

        case "rejeitar":
            $title = "Você irá rejeitar essa ordem de compra";
            $color = " style='background: red; color: #0'";
            $subTile = "rejeição";
        break;
    }

?>

<div class='modal show' tabindex='-1' style='display: block;' aria-modal='true' role='dialog'> 
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-fluid">
                <div class="modal-header modal-header-second" <?= $color; ?>>
                    <h5 class="modal-title"><?= $title ;?></h5>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="">
                            <div class="borderDash">
                                <span>Nº da ordem de compra</span>
                                <h3><?= $numberOrderCompraSet ;?></h3>
                            </div>

                            <div class="mt-3">
                                <label>Escreva aqui</label>
                                <textarea type="text" id="txtAreaAprova" class="form-control" style="height: 70px"></textarea>
                                <small>Faça um breve descrição da <?= $subTile; ?></small>
                            </div>

                            <div class="modal-group-btn d-flex justify-content-end gap-3">
                                <input type="button" id="btnCloseModal" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                                <input type="button" id="btnConfirmar" class="btn btn-success" value="Confirmar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal-backdrop show '></div>
