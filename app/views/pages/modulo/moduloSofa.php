<style>
    #slcQTDLugar{
        /* max-width: 150px; */
    }

    #containerNLugar{
        position: relative;
    }

    #containerQTDLugar{
        position: absolute;
        width: 150px;
        right: 0;
        top: 0;
    }

    #containerQTDLugar > input{
        width: 150px;
        z-index: 9;
    }
</style>

<div id="moduloSofa">
    <div class="dp-grid grid-3 mt-1">
        <div class="CampoGroup">
            <select class="form-select" id="slcTipoSofa">
                <option value=""></option>
                <option value="1">Canto</option>
                <option value="2">Em linha</option>
            </select>
            <label>Tipo</label>
        </div>

        <div class="CampoGroup" id="containerNLugar">
            <select class="form-select" id="slcQTDLugar">
                <option value=""></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="99">Outros</option>
            </select>
            <label>Nº de lugar</label>
            <div class="hidder" id="containerQTDLugar">
                <div class="CampoGroup">
                    <input class="form-control" id="txtQTDLugar" type="text" onclick="noSpace(this), onlyNumber(this)">
                    <label>QTD</label>
                </div>
            </div>
        </div>

        <div class="CampoGroup">
            <input type="text" class="form-control" id="txtDesidadeEspuma" onclick="noSpace(this), onlyNumber(this)">
            <label>Encosto densidade da espuma</label>
        </div>
    </div>
    
    <div class="groupSizeSmallInfo mt-3">
        <div class="dp-grid grid-5">
            <div class="" id="">
                <div class="CampoGroup">
                    <select class="form-select" id="slcChaiseLong">
                        <option value=""></option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <label>Chaise long</label>
                </div>
            </div>
            <!-- inicio chaise long -->
            <div class="hidder" id="containerQTDChaiseLong">
                <div class="CampoGroup">
                    <select class="form-select" id="slcChaiseLongQTD">
                        <option value=""></option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <label>QTD</label>
                </div>
            </div>
            
            <div class="hidder" id="containerFixaChaiseLong">
                <div class="CampoGroup">
                    <select class="form-select" id="slcChaiseLongFixa">
                        <option value=""></option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <label>Fixa</label>
                </div>
            </div>
            
            <div class="hidder" id="containerArrumacaoChaiseLong">
                <div class="CampoGroup">
                    <select class="form-select" id="slcChaiseLongArrume">
                        <option value=""></option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <label>Arrumação</label>
                </div>
            </div>

            <div class="hidder" id="containerReversivelChaiseLong">
                <div class="CampoGroup">
                    <select class="form-select" id="slcChaiseLongRevesivel">
                        <option value=""></option>
                        <option value="1">Sim</option>
                        <option value="0">Não</option>
                    </select>
                    <label>Reversivel</label>
                </div>
            </div>
        </div>
        <!-- fim chaise long -->
    </div>

    <div class="groupSizeSmallInfo dp-grid grid-2 mt-4">
        <div class="CampoGroup ">
            <select class="form-select" id="slcFazCama">
                <option value=""></option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            <label>Faz cama</label>
        </div>

        <div class="hidder" id="containerSofaCamaColchao">
            <div class="CampoGroup ">
                <select class="form-select" id="slcColcaoInterno">
                    <option value=""></option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
                <label>Com colchão interno</label>
            </div>
        </div>
    </div>
    
    <div class="dp-grid grid-3 mt-4">
        <div class="CampoGroup ">
            <select class="form-select" id="slcBaloico">
                <option value=""></option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            <label>Baloiço</label>
        </div>

        <div class="CampoGroup ">
            <select class="form-select" id="slcFazMassagem">
                <option value=""></option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
            </select>
            <label>Faz massagem</label>
        </div>

        <div class="dp-grid grid-2">
            <div class="CampoGroup">
                <select class="form-select" id="PuffBraco">
                    <option value=""></option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
                <label>Puff no braço</label>
            </div>
    
            <div class="hidder" id="containerQTDPuffBraco">
                <div class="row1">
                    <input type="button" class="btn btn-sm btn-outline-info" id="btnPuffBracoMenos" value="-">
                    <input type="text" class="form-control text-center" id="txtQTDPuffBraco" value="1" min="1" max="50" onclick="noSpace(this), onlyNumber(this)">
                    <input type="button" class="btn btn-sm btn-outline-info" id="btnPuffBracoMais" value="+">
                </div>
            </div>
        </div>
    </div>
</div>