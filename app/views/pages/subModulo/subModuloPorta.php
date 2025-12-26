<style>
    #txtQTDPorta{
        width: 50px !important;
    }
</style>

<div id="subModuloPorta" class="mt-3">
    <div class="dp-grid grid-2">
        <div class="CampoGroup">
            <select class="form-select" id="slcPorta">
                <option value=""></option>
                <option value="0">Sem porta</option>
                <option value="Vidro">Vidro</option>
                <option value="Madeira">Madeira</option>
                <option value="Ambos">Ambos</option>
            </select>
            <label>Porta</label>
        </div>

        <div class="hidder" id="containerQTDPorta">
            <div class="row1">
                <input type="button" class="btn btn-sm btn-outline-info" id="btnPortaMenos" value="-">
                <input type="text" class="form-control text-center" id="txtQTDPorta" value="1" min="1" max="50" onclick="noSpace(this), onlyNumber(this)">
                <input type="button" class="btn btn-sm btn-outline-info" id="btnPortaMais" value="+">
            </div>
        </div>
    </div>
</div>