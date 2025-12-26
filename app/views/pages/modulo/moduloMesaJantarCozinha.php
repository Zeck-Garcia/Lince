<style>
    #txtQTDCadeira{
        width: 50px !important;
    }
</style>
<div id="moduloMesaJantarCozinha" class="">
    <div class="dp-grid grid-3">
        <div class="CampoGroup">
            <select class="form-select" id="slcConjuntoMesa">
                <option value=""></option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            <label>Conjunto</label>
        </div>

        <div class="hidder" id="containerQTDCadeiraMesaConjunto">
            <div class="row1" id="">
                <label>QTD de <br>cadeira</label>
                <div class="row1">
                    <input type="button" class="btn btn-outline-info" id="btnQTDCadeiraMesaMenos" value="-">
                    <input type="text" class="form-control text-center" id="txtQTDCadeiraMesa" value="1" min="1" max="50">
                    <input type="button" class="btn btn-outline-info" id="btnQTDCadeiraMesaMais" value="+">
                </div>
            </div>
        </div>
    
        <div class="CampoGroup">
            <select class="form-select" id="slcExtensicelMesa">
                <option value=""></option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            <label>Extensivel</label>
        </div>
    </div>

    <div class="dp-grid grid-2 mt-3">
        <div class="CampoGroup">
            <select class="form-select" id="slcTampoMesa">
                <option value=""></option>
                <option value="1">Madeira</option>
                <option value="2">Vidro</option>
            </select>
            <label>Tampo</label>
        </div>
    
        <div class="CampoGroup">
            <select class="form-select" id="slcBasePeMesa">
                <option value=""></option>
                <option value="1">Madeira</option>
                <option value="2">Ferro / Aço</option>
                <option value="3">Plastico</option>
            </select>
            <label>Base / Pé</label>
        </div>
    </div>
</div>