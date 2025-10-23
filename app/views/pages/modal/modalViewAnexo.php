<?php
    include_once "../../../models/manipulacaoDeDados.php";
    $operation = new manipulacaoDeDados();

    $idAnexoSet = filter_input(INPUT_POST, "idAnexoSet");
    $localSet = filter_input(INPUT_POST, "localSet");
    // $idAnexoSet = "25040011";

?>

<style>

    .containerQuadro{
        padding: 10px;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        gap: 5px;
        align-items: center;

        border-radius: 6px;
        border: solid 1px #ccc;

        box-shadow: 2px 2px 1px #ccc;

    }
    
    .containerQuadro > i{
        font-size: 2.5rem !important;
    }

    #containerViewObj{
        padding: 10px;
    }

    #containerViewObj > img{
        width: 100% !important;
    }

    #containerViewObj > iframe{
        width: 100% !important;
        height: 100vh !important;
    }

</style>

<div class='modal show' tabindex='-1' style='display: block;' aria-modal='true' role='dialog'> 
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-fluid">
                <div class="modal-header">
                    <h5 class="modal-title">Visualizar anexo</h5>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="">
                            <div class="col1">
                                <div class="row1">
                                    <?php
                                        // str_replace(array("'", '"'),"", "Olá 'mundo");

                                        if($localSet == "" || $localSet == 0){
                                            $pastaImgAnexo = "../anexoOrderCompra/";
                                        } else {
                                            $pastaImgAnexo = "../anexoOrderCompraEmail/";
                                        }

                                        if(is_dir($pastaImgAnexo)){
                                            $files = scandir($pastaImgAnexo);
                                            $files = array_diff($files, array(".",".."));
                                            
                                            foreach($files as $key => $value){
                                                if (preg_match("/^" . preg_quote($idAnexoSet, '/') . "(\.|_|-|\s|$)/", $value)) {
                                                    echo "<div class='containerQuadro'>
                                                        <i class='bi bi-file-pdf'></i>
                                                        <h2 class='title-file'>{$value}</h2>
                                                    </div>";
                                                }
                                            }
                                        }
                                    ?>
                                </div>

                                <div class="col1">
                                    <div id="containerViewObj" class="col1">
                                    </div>
                                </div>
                            </div>



                            <div id="containerViewAnexo" class="modal-group-btn d-flex justify-content-end gap-3">
                                <input type="button" id="btnCloseModal" class="btnCloseModal btn btn-primary mr-3" data-dismiss="modal" value="Fechar">
                                <!-- <input type="button" id="btnActionExcluir" class="btn btn-primary" value="Sim"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='modal-backdrop show'></div>

