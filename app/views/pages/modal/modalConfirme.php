<?php

$title = filter_input(INPUT_POST, "titleSet");
$msg = filter_input(INPUT_POST, "msgSet");

?>

<div class='modal show' tabindex='-1' style='display: block;' aria-modal='true' role='dialog'> 
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-fluid">
                <div class="modal-header modal-header-second" style="background: ">
                    <h5 class="modal-title"><?= $title ;?></h5>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="">
                            <div class="row p-3">
                                <span><?= $msg;?></span>
                            </div>

                            <div class="modal-group-btn d-flex justify-content-end gap-3">
                                <input type="button" id="btnCloseModalConfirmar" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
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
