<style>
    .accordion-button.sem-seta::after {
        display: none !important;
    }

    .groupInputFile {
            border: 2px dashed #db02db;
            padding: 7px;
            text-align: center;
            cursor: pointer;
            border-radius: 8px;
            /* margin-bottom: 20px; */
            transition: 0.3s;
            width: 100%;
        }

        #continerSubEscala{
            display: none;
        }

        @media print {

            @page {
                size: A4;
                margin: 3mm;
            }

            body {
                width: 100%;
                margin: 0;
                padding: 0;
                font-size: 10pt;
            }

            table{
                padding: 0 !important;
            }

            #continerSubEscala {
                display: block !important;
                visibility: visible !important;
            }

             .no-print {
                display: none !important;
            }

            .accordion-item[style*="border-left"] {
                border-left: none !important;
                border: none !important;
                box-shadow: none !important;
            }

            .table-responsive, 
            .table-responsive *,
            #bodyTable,
            #bodyTable * {
                visibility: visible;
            }

            .accordion-collapse.collapse {
                display: block !important;
                visibility: visible !important;
            }

            .accordion-item, .accordion-body {
                border: none !important;
                padding: 0 !important;
            }

            .quebra-pagina {
                break-before: page !important;
                -webkit-column-break-before: always !important;
            }

            .row-colaborador:first-child {
                break-before: auto !important;
            }

            .collapse {
                display: block !important;
                height: auto !important;
                visibility: visible !important;
            }
        }
       

</style>
<div class="container-fluid mt-3">
    <div class="d-md-flex justify-content-between align-items-center mb-2 no-print">
        <div>
            <h3 class="fw-bold m-0">Calculo de Hora</h3>
            <p class="text-muted small">Gestão de Picagem</p>
        </div>
        <div>
            <button class="btn bg-secondary-subtle px-4 py-2 shadow-sm fw-bold" onclick="imprimir()">
                <i class="bi bi-printer me-2"></i> Imprimri
            </button>
            <button class="btn bg-info-subtle px-4 py-2 shadow-sm fw-bold" onclick="baixar()">
                <i class="bi bi-file-earmark-pdf me-2"></i> Baixar
            </button>
            <button class="btn btn-success px-4 py-2 shadow-sm fw-bold" onclick="getHorario()">
                <i class="bi bi-arrow-clockwise me-2"></i> Carregar
            </button>
        </div>
    </div>

    <div class="accordion mb-3 no-print" id="containerCSV">
        <div class="accordion-item" style="border-radius: 10px; border-left: 4px solid var(--bg-pink) !important;">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCSV" aria-expanded="false" aria-controls="collapseCSV">
                <i class="bi bi-filetype-csv me-1"></i> CSV
            </button>
            </h2>
            <div id="collapseCSV" class="accordion-collapse collapse" data-bs-parent="#containerCSV">
                <div class="accordion-body">
                    <div class="row gap-3">
                        <div class="col-md">
                            <div class="upload-card border-dashed rounded-3 p-2 text-center" onclick="document.getElementById('fileEscala').click()">
                                <div class="icon-circle mb-2">
                                    <i class="bi bi-calendar-event fs-3"></i>
                                </div>
                                <p class="mb-0">Carregar <strong>Escala de Trabalho</strong></p>
                                <small class="text-uppercase">Formato .CSV</small>
                                <input type="file" id="fileEscala" accept=".csv" hidden>
                            </div>
                        </div>

                        <div class="col-md d-none" id="containerPicagem">
                            <div class="upload-card border-dashed rounded-3 p-4 text-center" id="fileHorario" onclick="document.getElementById('fileCSV').click()">
                                <div class="icon-circle mb-2">
                                    <i class="bi bi-clock-history fs-3 text-pink"></i>
                                </div>
                                <p class="mb-0">Carregar ficheiro de <strong>Picagem</strong></p>
                                <small class="text-uppercase">Formato .CSV</small>
                                <input type="file" id="fileCSV" accept=".csv" hidden>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion mb-3 no-print" id="containerGroupRegras">
        <div class="accordion-item" style="border-radius: 10px; border-left: 4px solid var(--bg-pink) !important;">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRegras" aria-expanded="false" aria-controls="collapseRegras">
                <i class="bi bi-file-earmark-ruled me-1"></i> Regras
            </button>
            </h2>
            <div id="collapseRegras" class="accordion-collapse collapse" data-bs-parent="#containerGroupRegras">
                <div class="accordion-body">
                    <div class="row g-3" id="containerRegras">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion mb-3 no-print" id="containerGroupTempo">
        <div class="accordion-item" style="border-radius: 10px; border-left: 4px solid var(--bg-pink) !important;">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTempo" aria-expanded="false" aria-controls="collapseTempo">
                <i class="bi bi-stopwatch me-1"></i> Tempos
            </button>
            </h2>
            <div id="collapseTempo" class="accordion-collapse collapse" data-bs-parent="#containerGroupTempo">
                <div class="accordion-body">
                    <div class="row g-3" id="containerTempo">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="accordion mb-3 no-print" id="containerEscala">
        <div class="accordion-item" style="border-radius: 10px; border-left: 4px solid var(--bg-pink) !important;">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEscala" aria-expanded="false" aria-controls="collapseEscala">
                <i class="bi bi-journal-check me-1"></i> Escala
            </button>
            </h2>
            <div id="collapseEscala" class="accordion-collapse collapse" data-bs-parent="#containerEscala">
                <div class="accordion-body">
                    <div class="row g-3">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover text-center" id="tableCriarEscala">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="col-md-1">
                                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 36px !important; padding: 0 5px !important;">
                                                    <option>2025</option>
                                                    <option></option>
                                                    <option></option>
                                                </select>
                                                <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 36px !important; padding: 0 5px !important;">
                                                    <option>JAN</option>
                                                    <option></option>
                                                    <option></option>
                                                </select>
                                            </div>
                                        </th>
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
                                <tbody id="tbodyCriarEscala">
                                    <tr>
                                        <td class="text-center"><small>Henrique<br>458</small></td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control" style="font-size: 10px !important; height: 27px !important; width: 33px !important; padding: 0 5px !important;">
                                                <option>L1</option>
                                                <option>HGFG</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion mb-3" id="containerView">
        <div class="accordion-item" style="border-radius: 10px; border-left: 4px solid var(--bg-pink)">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseView">
                    <i class="bi bi-stopwatch me-1"></i> Ver Resultado
                </button>
            </h2>
            
            <div id="collapseView" class="accordion-collapse collapse" data-bs-parent="#containerView">
                <div class="accordion-body p-2">
                    
                    <div class="table-responsive">
                        <table class="table table-sm table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th><small>Nº</small></th>
                                    <th><small>Nome</small></th>
                                    <th><small>Qtd dias<br>Folga Tra</small></th>
                                    <th class="mouseHover"><small><abbr title="Saldo de horas positiva">Saldo<br>(+)</abbr></small></th>
                                    <th class="mouseHover"><small><abbr title="Saldo de horas negativa">Saldo<br>(-)</abbr></small></th>
                                    <th class="mouseHover"><small><abbr title="Diferença entre positivo e negativo">Saldo<br>(=)</abbr></small>
                                    </th>
                                    <th class="mouseHover"><small><abbr
                                            title="Quantidade de falta que o colaborador tem registada">Faltas</abbr></small></th>
                                    <th class="mouseHover"><small><abbr
                                            title="Quantidade de dias que começou atrasado. Caso conste hora em atraso, irá aparecer o tempo em hora de atraso">Atrasos</abbr></small>
                                    </th>
                                    <th class="mouseHover"><small><abbr
                                            title="Quantidade de dias que saiu mais cedo. Caso conste hora que saiu mais cedo, irá aparecer o tempo em hora de atraso">Saída<br>Antecip.</abbr></small>
                                    </th>
                                </tr>
                            </thead>

                            <tbody id="bodyTable"></tbody>

                            <tbody>
                                <!-- <tr class="row-colaborador" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#detalhe_22" 
                                    style="cursor: pointer;">
                                    <td><b>22</b></td>
                                    <td class="text-start">Henrique <br><small class="text-muted" style="font-size: 9px;">Fora da escala</small></td>
                                    <td><span class="badge bg-danger">1</span></td>
                                    <td><span class="text-success">2h</span></td>
                                    <td><span class="text-danger">3h</span></td>
                                    <td>4h</td>
                                    <td><span class="badge bg-danger">1</span></td>
                                    <td><span class="badge bg-danger">1</span></td>
                                    <td><span class="badge bg-danger">1</span></td>
                                    <td></td>
                                </tr> -->
                                
                                <!-- <tr>
                                    <td colspan="13" class="p-0 border-0">
                                        <div id="detalhe_22" class="collapse bg-light p-3">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered bg-white">
                                                    <thead class="small shadow-sm">
                                                        <tr>
                                                            <th>Data</th>
                                                            <th>E1</th>
                                                            <th>S1</th>
                                                            <th>E2</th>
                                                            <th>S2</th>
                                                            <th>Almoço</th>
                                                            <th>Total</th>
                                                            <th>Saldo</th>
                                                            <th>H<br>Compensado</th>
                                                            <th>T<br>Compensado</th>
                                                            <th>Motivo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="small">
                                                        <tr>
                                                            <td>12/03</td>
                                                            <td>08:00</td>
                                                            <td>12:00</td>
                                                            <td>13:00</td>
                                                            <td>17:00</td>
                                                            <td>17:00</td>
                                                            <td>17:00</td>
                                                            <td>17:00</td>
                                                            <td>01:00</td>
                                                            <td>08:00</td>
                                                            <td>-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr> -->

                                <!-- <tr class="row-colaborador" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#detalhe_21" 
                                    style="cursor: pointer;">
                                    <td><b>22</b></td>
                                    <td class="text-start">Henrique <br><small class="text-muted" style="font-size: 9px;">Fora da escala</small></td>
                                    <td><span class="badge bg-danger">1</span></td>
                                    <td><span class="text-success">2h</span></td>
                                    <td><span class="text-danger">3h</span></td>
                                    <td>4h</td>
                                    <td><span class="badge bg-danger">1</span></td>
                                    <td><span class="badge bg-danger">1</span></td>
                                    <td><span class="badge bg-danger">1</span></td>
                                    <td></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="13" class="p-0 border-0">
                                        <div id="detalhe_21" class="collapse bg-light p-3">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered bg-white">
                                                    <thead class="small shadow-sm">
                                                        <tr>
                                                            <th>Data</th>
                                                            <th>E1</th>
                                                            <th>S1</th>
                                                            <th>E2</th>
                                                            <th>S2</th>
                                                            <th>Almoço</th>
                                                            <th>Total</th>
                                                            <th>Saldo</th>
                                                            <th>H<br>Compensado</th>
                                                            <th>T<br>Compensado</th>
                                                            <th>Motivo</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="small">
                                                        <tr>
                                                            <td>12/03</td>
                                                            <td>08:00</td>
                                                            <td>12:00</td>
                                                            <td>13:00</td>
                                                            <td>17:00</td>
                                                            <td>17:00</td>
                                                            <td>17:00</td>
                                                            <td>17:00</td>
                                                            <td>01:00</td>
                                                            <td>08:00</td>
                                                            <td>-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<script src="public/assets/js/pgCalculoHora.js?v=<?= VERSION ?>"></script>

