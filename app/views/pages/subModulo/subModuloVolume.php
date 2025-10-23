<div class="groupSizeSmallInfo mt-3" id="subModuloVolume">
    <div class="groupSizeSmallInfoItem">
        <!-- <div class="groupSizeSmallInfoItemTitle">Volume</div> -->
    
        <div class="groupSizeSmallInfoText mt-1">
        
            <div class="CampoGroup">
                <select class="form-select" id="slcQTDVolume">
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
                    <option value="99">+ 10</option>
                </select>
                <label>Nº de volume</label>
            </div>

            <div id="containerInfoVolume">
                <div class="dp-grid grid-6 mt-3">
                    <div class="CampoGroup">
                        <input type="text" class="form-control" id="txtComprimento">
                        <label>Comprimento</label>
                    </div>
            
                    <div class="CampoGroup">
                        <input type="text" class="form-control" id="txtLargura">
                        <label>Largura</label>
                    </div>
            
                    <div class="CampoGroup">
                        <input type="text" class="form-control" id="txtAltura">
                        <label>Altura</label>
                    </div>

                    <div class="CampoGroup">
                        <select class="form-select" id="slcUnidadeMedidaTamanho">
                            <option value=""></option>
                            <option value="mm">mm - Milimetro</option>
                            <option value="cm">cm - Centimentro</option>
                            <option value="m">m - Metro</option>
                        </select>
                        <label>Unidade</label>
                    </div>
                    
                    <div class="CampoGroup">
                        <input type="text" class="form-control" id="txtPeso">
                        <label>Peso</label>
                    </div>
                    
                    <div class="CampoGroup">
                        <select class="form-select" id="slcUnidadeMedidaPeso">
                            <option value=""></option>
                            <option value="g">g - Quilograma</option>
                            <option value="kg">Kg - Quilo</option>
                        </select>
                        <label>Unidade</label>
                    </div>
                </div>
                <small>Informe o volume do produto sem a caixa, Caso saiba as medidas.</small>

                <div class="mt-3">
                    <input type="button" class="btn btn-outline-success w-100" id="btnAddVolume" value="Adicionar volume">
                </div>
            </div>

            <div class="mt-3">
                <table class="table" id="tableVolume">
                    <thead>
                        <tr>
                            <th>Comprimento</th>
                            <th>Largura</th>
                            <th>Altura</th>
                            <th>Peso</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody id="tbodyVolume"></tbody>
                </table>
                <small>A unidade padrão usada no nosso sistema é "cm" e "Kg".</small><br>
                <small>Pode usar a unidade que você preferir, mas iremos converter para a unidade do nosso sistema.</small>
            </div>
        </div>
    </div>
</div>
