<div class="mt-3" id="subModuloDescricao">
    <div class="groupSizeSmallInfo">
        <div class="groupSizeSmallInfoItem">
            <!-- <div class="groupSizeSmallInfoItemTitle">Descrição</div> -->
            <div class="groupSizeSmallInfoText mt-1">
                
                <div class="dp-grid grid-4">
                    <div class="CampoGroup">
                        <input type="text" class="form-control" id="txtNomeProduto">
                        <label>Nome do produto</label>
                    </div>

                    <div class="CampoGroup">
                        <input type="text" class="form-control" id="txtPreco">
                        <label>Preço</label>
                    </div>

                    <div class="CampoGroup">
                        <input type="text" class="form-control" id="txtCor">
                        <label>Cor <small>(opcional)</small></label>
                    </div>
                
                    <div class="CampoGroup">
                        <input type="text" class="form-control" id="txtEAN" onclick="noSpace(this)">
                        <label>EAN-13</label>
                    </div>
                </div>
                
                <div class="CampoGroup mt-3">
                    <textarea class="form-control" id="txtAreaDescricao" style="height: 100px"></textarea>
                    <label>Descrição</label>
                </div>

            </div>
        </div>
    </div>
</div>