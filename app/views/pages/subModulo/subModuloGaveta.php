<style>
    #txtQTDGaveta{
        width: 50px !important;
    }
</style>

<div class="groupSizeSmallInfo dp-grid grid-2 mt-3" id="subModuloGaveta">
    <div class="CampoGroup">
        <select class="form-select" id="slcGaveta">
            <option value=""></option>
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select>
        <label>Gaveta</label>
    </div>

    <div class="hidder" id="containerQTDGaveta">
        <div class="row1">
            <input type="button" class="btn btn-sm btn-outline-info" id="btnGavetaMenos" value="-">
            <input type="text" class="form-control text-center" id="txtQTDGaveta" value="1" min="1" max="50" onclick="noSpace(this), onlyNumber(this)" >
            <input type="button" class="btn btn-sm btn-outline-info" id="btnGavetaMais" value="+">
        </div>
    </div>
</div>