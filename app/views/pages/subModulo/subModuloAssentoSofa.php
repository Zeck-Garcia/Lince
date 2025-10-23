<style>
    #txtQTDRelax{
        width: 50px;
    }
</style>

<div class="groupSizeSmallInfo mt-3" id="subModuloAssentoSofa">
    <div class="groupSizeSmallInfoItem">
        <!-- <div class="groupSizeSmallInfoItemTitle">Assento</div> -->
        <div class="groupSizeSmallInfoText">
        
        

            <div class="dp-grid grid-2">
                <div class="dp-grid grid-2">
                    <div class="CampoGroup">
                        <select class="form-select" id="slcEstruturaAssentoSofa">
                            <option value=""></option>
                            <option value="1">Espuma</option>
                            <option value="2">Mola</option>
                        </select>
                        <label>Estrutura assento</label>
                    </div>
    
                    <div class="CampoGroup">
                        <input type="text" class="form-control" id="txtDensidadeEspuma" value="" onclick="noSpace(this), onlyNumber(this)">
                        <label>Densidade</label>
                    </div>
                </div>

                <div class="dp-grid grid-2">
                    <div class="CampoGroup">
                        <select class="form-select" id="slcTipoAssentoSofa">
                            <option value=""></option>
                            <option value="1">Normal</option>
                            <option value="2">Extensível</option>
                            <option value="3">Relax</option>
                        </select>
                        <label>Tipo de assento</label>
                    </div>
    
                    <div class="hidder" id="containerModeloAssento">
                        <div class="dp-grid grid-2">
                            <div class="CampoGroup">
                                <select class="form-select" id="slcModeloAssentoSofa">
                                    <option value=""></option>
                                    <option value="1">Eletrico</option>
                                    <option value="2">Manual</option>
                                </select>
                                <label>Modelo</label>
                            </div>
                        
                            <div class="hidder" id="containerQTDRelax">
                                <div class="row1">
                                    <input type="button" class="btn btn-sm btn-outline-info" id="btnQTDRelaxMenos" value="-">
                                    <input type="text" class="form-control text-center" id="txtQTDRelax" value="1" min="1" max="50" onclick="noSpace(this), onlyNumber(this)">
                                    <input type="button" class="btn btn-sm btn-outline-info" id="btnQTDRelaxMais" value="+">
                                    <label>QTD <br> relax</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        
        </div>
    </div>
</div>


