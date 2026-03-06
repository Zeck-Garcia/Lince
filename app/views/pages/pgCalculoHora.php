<?php 
    require_once "app/views/pages/pgFilterLateral.php";
?>

<div class="bodyPage">
    <div class="quadroAleatorio mt-3">
        <div class="quadroAleatorioTitle">
            <i class="bi bi-newspaper"></i>
            <p>Ficheiro</p>
            <div>
            </div>
        </div>

        <div class="quadroAleatorioCorpo">
            <div class="d-flex justify-content-between ">
                <div class="d-flex justify-content-center w-100" style="gap: 20px;">
                    <div class=" input-group-text cursorPointer w-100" onclick="document.getElementById('fileEscala').click()">
                        <p>Clique para carregar a escala de trabalho</p>
                        <input type="file" class="form-control" id="fileEscala" accept=".csv" style="display:none">
                    </div>
                    <div class=" input-group-text cursorPointer w-100" onclick="document.getElementById('fileEscala').click()">
                        <p>Clique para carregar a escala de trabalho</p>
                        <input type="file" class="form-control" id="fileEscala" accept=".csv" style="display:none">
                    </div>
                </div>
                
                <div class="d-flex justify-content-center g-2">
                    <button class="btn btn-outline-success btn-sm ms-2" title="Atualizar os dados"><i class="bi bi-arrow-clockwise"></i></button>
                    <button class="btn btn-outline-primary btn-sm ms-2" title="Download do ficheiro em CSV"><i class="bi bi-download"></i></button>
                    <button class="btn btn-outline-info btn-sm ms-2" title="Imprimir O resultado"><i class="bi bi-printer"></i></button>
                </div>
            </div>

        </div>
    </div>

    <div class="quadroAleatorio mt-3">
        <div class="quadroAleatorioTitle">
            <i class="bi bi-newspaper"></i>
            <p>Regras</p>
            <div><span class="btn btn-outline-success">Ocultar</span></div>
        </div>

        <div class="quadroAleatorioCorpo d-none">
            <div class="d-flex justify-content-between">

                    <div class="groupSizeSmallInfo">
                        <div class="groupSizeSmallInfoItem">
                            <div class="groupSizeSmallInfoItemTitle">Contar 2 Picagem</div>
                            <div class="groupSizeSmallInfoText">
                                <select class="select shadow">
                                    <option value="99">Selecione</option>
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="groupSizeSmallInfo">
                        <div class="groupSizeSmallInfoItem">
                            <div class="groupSizeSmallInfoItemTitle">Ocultar Indefinido</div>
                            <div class="groupSizeSmallInfoText">
                                <select class="select shadow">
                                    <option value="99">Selecione</option>
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="groupSizeSmallInfo">
                        <div class="groupSizeSmallInfoItem">
                            <div class="groupSizeSmallInfoItemTitle">Calc Int. Auto.</div>
                            <div class="groupSizeSmallInfoText">
                                <select class="select shadow">
                                    <option value="99">Selecione</option>
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="groupSizeSmallInfo">
                        <div class="groupSizeSmallInfoItem">
                            <div class="groupSizeSmallInfoItemTitle">Compensar Hora</div>
                            <div class="groupSizeSmallInfoText">
                                <select class="select shadow">
                                    <option value="99">Selecione</option>
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
            </div>

            <div class="d-flex justify-content-between mt-3">
                    <div class="groupSizeSmallInfo">
                        <div class="groupSizeSmallInfoItem">
                            <div class="groupSizeSmallInfoItemTitle">L1</div>
                            <div class="groupSizeSmallInfoText">
                                <div class="d-flex">
                                    <select class="select shadow">
                                        <option value="99"></option>
                                        <option value="0">10:00</option>
                                        <option value="1">10:00</option>
                                    </select>
                                    <select class="select shadow">
                                        <option value="99"></option>
                                        <option value="0">10:00</option>
                                        <option value="1">10:00</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="groupSizeSmallInfo">
                        <div class="groupSizeSmallInfoItem">
                            <div class="groupSizeSmallInfoItemTitle">L2</div>
                            <div class="groupSizeSmallInfoText">
                                <div class="d-flex">
                                    <select class="select shadow">
                                        <option value="99"></option>
                                        <option value="0">10:00</option>
                                        <option value="1">10:00</option>
                                    </select>
                                    <select class="select shadow">
                                        <option value="99"></option>
                                        <option value="0">10:00</option>
                                        <option value="1">10:00</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="groupSizeSmallInfo">
                        <div class="groupSizeSmallInfoItem">
                            <div class="groupSizeSmallInfoItemTitle">L3</div>
                            <div class="groupSizeSmallInfoText">
                                <div class="d-flex">
                                    <select class="select shadow">
                                        <option value="99"></option>
                                        <option value="0">10:00</option>
                                        <option value="1">10:00</option>
                                    </select>
                                    <select class="select shadow">
                                        <option value="99"></option>
                                        <option value="0">10:00</option>
                                        <option value="1">10:00</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="groupSizeSmallInfo">
                        <div class="groupSizeSmallInfoItem">
                            <div class="groupSizeSmallInfoItemTitle">L4</div>
                            <div class="groupSizeSmallInfoText">
                                <div class="d-flex">
                                    <select class="select shadow">
                                        <option value="99"></option>
                                        <option value="0">10:00</option>
                                        <option value="1">10:00</option>
                                    </select>
                                    <select class="select shadow">
                                        <option value="99"></option>
                                        <option value="0">10:00</option>
                                        <option value="1">10:00</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <div class="groupSizeSmallInfo">
                    <div class="groupSizeSmallInfoItem">
                        <div class="groupSizeSmallInfoItemTitle">L5</div>
                        <div class="groupSizeSmallInfoText">
                            <div class="d-flex">
                                <select class="select shadow">
                                    <option value="99"></option>
                                    <option value="0">10:00</option>
                                    <option value="1">10:00</option>
                                </select>
                                <select class="select shadow">
                                    <option value="99"></option>
                                    <option value="0">10:00</option>
                                    <option value="1">10:00</option>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="groupSizeSmallInfo">
                    <div class="groupSizeSmallInfoItem">
                        <div class="groupSizeSmallInfoItemTitle">L6</div>
                        <div class="groupSizeSmallInfoText">
                            <div class="d-flex">
                                <select class="select shadow">
                                    <option value="99"></option>
                                    <option value="0">10:00</option>
                                    <option value="1">10:00</option>
                                </select>
                                <select class="select shadow">
                                    <option value="99"></option>
                                    <option value="0">10:00</option>
                                    <option value="1">10:00</option>
                                </select>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="groupSizeSmallInfo">
                    <div class="groupSizeSmallInfoItem">
                        <div class="groupSizeSmallInfoItemTitle">Tempo Almoço(Min)</div>
                        <div class="groupSizeSmallInfoText">
                            <select class="select shadow">
                                <option value="99">Selecione</option>
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="groupSizeSmallInfo">
                    <div class="groupSizeSmallInfoItem">
                        <div class="groupSizeSmallInfoItemTitle">Nº H Trabalho dia</div>
                        <div class="groupSizeSmallInfoText">
                            <select class="select shadow">
                                <option value="99">Selecione</option>
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="groupSizeSmallInfo">
                    <div class="groupSizeSmallInfoItem">
                        <div class="groupSizeSmallInfoItemTitle">Tempo Almoço(Min)</div>
                        <div class="groupSizeSmallInfoText">
                            <select class="select shadow">
                                <option value="99">Selecione</option>
                                <option value="0">Não</option>
                                <option value="1">Sim</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="quadroAleatorio mt-3">
        <div class="quadroAleatorioTitle">
            <i class="bi bi-newspaper"></i>
            <p>Escala</p>
            <div><span class="btn btn-outline-success">Ocultar</span></div>
        </div>

        <div class="quadroAleatorioCorpo">
            <div class="d-flex justify-content-between " style="overflow-x: auto;">
                <table class="w-100">
                    <thead>
                        <tr>
                            <th><select class="form-select" style="font-size: 10px !important; height: 27px !important;"><option>2026</option></select><select class="form-select" style="font-size: 10px !important; height: 27px !important;"><option>janeiro</option></select></th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>9</th>
                            <th>10</th>
                            <th>11</th>
                            <th>12</th>
                            <th>13</th>
                            <th>14</th>
                            <th>15</th>
                            <th>16</th>
                            <th>17</th>
                            <th>18</th>
                            <th>19</th>
                            <th>20</th>
                            <th>21</th>
                            <th>22</th>
                            <th>23</th>
                            <th>24</th>
                            <th>25</th>
                            <th>26</th>
                            <th>27</th>
                            <th>28</th>
                            <th>29</th>
                            <th>30</th>
                            <th>31</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span>Eu mesmo</span></td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                    <option>HGFG</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><span>Eu mesmo</span></td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                    <option>HGFG</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><span>Eu mesmo</span></td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                    <option>HGFG</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                    <option>L1</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="quadroAleatorio mt-3">
        <div class="quadroAleatorioTitle">
            <i class="bi bi-newspaper"></i>
            <p>Resultado</p>
            <div><span class="btn btn-outline-success">Ocultar</span></div>
        </div>

        <div class="quadroAleatorioCorpo">
            <div class="d-flex justify-content-center ">
                <table class="w-100 p-2 table table-striped table-hover text-center table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Nº Colab.</th>
                            <th>Colaborador</th>
                            <th>Folga<br>Trab.</th>
                            <th>Qtd<br>Falta</th>
                            <th>Saldo +</th>
                            <th>Saldo -</th>
                            <th>Saldo =</th>
                            <th>Qtd<br>Entrada</th>
                            <th>QTD<br>Almoço</th>
                            <th>QTD<br>Saída</th>
                            <th>QTD<br>Horas<br>Inco.</th>
                            <th>Inicio<br>Atras.</th>
                            <th>Saída<br>+Cedo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td class="text-center">954</td>
                            <td>Henrique Garcia</td>
                            <td class="text-center"><span class="badge bg-secondary">0</span></td>
                            <td class="text-center"><span class="badge bg-danger">0</span></td>
                            <td class="text-center">00:00</td>
                            <td class="text-center">00:00</td>
                            <td class="text-center"><span class="fw-bold text-danger">-00:00</span></td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">
                                <span class="badge bg-secondary">0</span>
                                <small>00:00</small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary">0</span>
                                <small>00:00</small>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="text-center">954</td>
                            <td>Henrique Garcia</td>
                            <td class="text-center"><span class="badge bg-secondary">0</span></td>
                            <td class="text-center"><span class="badge bg-danger">0</span></td>
                            <td class="text-center">00:00</td>
                            <td class="text-center">00:00</td>
                            <td class="text-center"><span class="fw-bold text-success">00:00</span></td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">
                                <span class="badge bg-secondary">0</span>
                                <small>00:00</small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary">0</span>
                                <small>00:00</small>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="text-center">954</td>
                            <td>Henrique Garcia</td>
                            <td class="text-center">---</td>
                            <td class="text-center">---</td>
                            <td class="text-center">00:00</td>
                            <td class="text-center">00:00</td>
                            <td class="text-center"><span class="fw-bold text-success">00:00</span></td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="text-center">---</td>
                            <td class="text-center">
                                ---
                            </td>
                            <td class="text-center">
                                ---
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>