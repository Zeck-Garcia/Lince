<?php
// if($_SESSION["loginUser"] == false){
//     header('Location: login');
// } else {
//     if($_SESSION["loginUser"] != true or $_SESSION["classeAgente"] != 4){
//         header('Location: login');
//     }
// }

?>
<style>
    .manha, .legendManha{
    background-color: blue !important;
    }

    .tarde, .legendTarde{
        background-color: red !important;
    }

    .intermedio, .legendIntermedio{
        background-color: yellow !important;
    }

    .folga, .legendFolga{
        background-color: green !important;
    }

    .ferias, .legendFerias{
        background-color: rgb(232, 67, 147) !important;
    }

    .feriado, .legendFeriado{
        background-color: rgb(253, 203, 110) !important;
    }

    .inputTableEscala{
        width: 30px !important;
        height: 10px !important;
        /* padding: 5px !important; */
        text-align: center !important;
        border: none;
        border: solid 0.6px #ccc;
        box-shadow: 2px 1px 2px #ccc;
        border-radius: 3px;
    }

    tbody > tr > td{
        padding: 5px 0 !important;
    }

    .slcEscalaColaborador{
        min-width: 140px !important;
        font-size: 1rem !important;
    }

    #tableCriarEscala{
    }

    #tbodyCriarEscala > tr > td{
        padding: 5px 1px !important;
    }

    .diaSemana{
        /* rotate: -90deg; */
    }

    .legend{
        padding: 5px 5px;
        font-size: 1.2rem !important;
        border-radius: 4px;
        box-shadow: 1px 2px 1px #ccc;

    }

    .slcMesNovaEscala, .slcAnoNovaEscala{
        width: 50px !important;
    }

    .slcEsclherDia{
        -webkit-appearance: none !important;
        -webkit-border-radius: 0px;
        width: 27px;
        height: 27px !important;
        font-size: 0.8rem !important;
        border: none;
        border-radius: 4px;
        border: solid 0.8px #ccc;
        box-shadow: 1px 1px 2px #ccc;
        text-align: center;
        background-color: #fff;
    }

    tfoot > tr > td > p{
        margin-bottom: 0 !important;
    }

    tfoot > tr > td{
        font-size: 0.7rem !important;
    }

    .pintar{
        background-color: #d1ccc0 !important;
    }

    .bgRed{
        background-color: red !important;
    }

    .responsavel{
        font-weight: 700 !important;
    }


</style>

<div class="menuLateral">
    <?php include_once "app/views/pages/filterLateral.php";?>
</div>

<div class="bodyPage">
    <div class="groupBody">
    <!--  -->

        <div class="quadroAleatorioNoTitle col1">
            <div class="row1">

                <div class="CampoGroup">
                    <select id="slcFilterLoja" class="form-select">
                        <option value=""></option>
                        <option value="1">funcionario 1</option>
                        <option value="2">funcionario 2</option>
                    </select>
                    <label>Loja</label>
                </div>
                
                <div class="CampoGroup active">
                    <select id="slcFilterAno" class="form-select">
                        <option value=""></option>
                        <option value="1">funcionario 1</option>
                        <option value="2">funcionario 2</option>
                    </select>
                    <label>Ano</label>
                </div>

                <div class="CampoGroup active">
                    <select id="slcFilterMes" class="form-select">
                        <option value=""></option>
                        <option value="1">funcionario 1</option>
                        <option value="2">funcionario 2</option>
                    </select>
                    <label>Mês</label>
                </div>
            </div>

            <div class="mt-3">
                <table class="table table-striped table-hover text-center table-bordered ">
                    <thead>
                        <tr>
                            <th>Colaborador</th>
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
                            <td></td>
                            <td>seg</td>
                            <td>ter</td>
                            <td>qua</td>
                            <td>qui</td>
                            <td>sex</td>
                            <td>sab</td>
                            <td>dom</td>
                            <td>seg</td>
                            <td>ter</td>
                            <td>qua</td>
                            <td>qui</td>
                            <td>sex</td>
                            <td>sab</td>
                            <td>dom</td>
                            <td>seg</td>
                            <td>ter</td>
                            <td>qua</td>
                            <td>qui</td>
                            <td>sex</td>
                            <td>sab</td>
                            <td>dom</td>
                            <td>seg</td>
                            <td>ter</td>
                            <td>qua</td>
                            <td>qui</td>
                            <td>sex</td>
                            <td>sab</td>
                            <td>dom</td>
                            <td>seg</td>
                            <td>ter</td>
                            <td>qua</td>
                        </tr>
                        <tr>
                            <td>henrique</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="tarde">T</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="folga">FG</td>
                            <td class="folga">FG</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="tarde">T</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="manha">M</td>
                            <td class="folga">FG</td>
                            <td class="folga">FG</td>
                            <td class="tarde">T</td>
                            <td class="tarde">T</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                        </tr>
                        <tr>
                            <td>henrique</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="tarde">T</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="folga">FG</td>
                            <td class="folga">FG</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="tarde">T</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="manha">M</td>
                            <td class="folga">FG</td>
                            <td class="folga">FG</td>
                            <td class="tarde">T</td>
                            <td class="ferias">FR</td>
                            <td class="ferias">FR</td>
                            <td class="ferias">FR</td>
                            <td class="ferias">FR</td>
                            <td class="ferias">FR</td>
                            <td class="intermedio">I</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                        </tr>

                        <tr>
                            <td>henrique</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="tarde">T</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="folga">FG</td>
                            <td class="folga">FG</td>
                            <td class="manha">M</td>
                            <td class="feriado">FD</td>
                            <td class="tarde">T</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="manha">M</td>
                            <td class="folga">FG</td>
                            <td class="folga">FG</td>
                            <td class="tarde">T</td>
                            <td class="tarde">T</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                        </tr>

                        <tr>
                            <td>henrique</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="tarde">T</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="folga">FG</td>
                            <td class="folga">FG</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="tarde">T</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="manha">M</td>
                            <td class="folga">FG</td>
                            <td class="folga">FG</td>
                            <td class="tarde">T</td>
                            <td class="tarde">T</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="intermedio">I</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="manha">M</td>
                            <td class="tarde">T</td>
                        </tr>
                    </tbody>
                </table>

                <div>
                    <i id="" class="btn btn-outline-warning btn-sm">Continuar à editar</i>
                    <span>Essa escala não foi finalizada, gostaria de continuar a edição.</span>
                </div>
            </div>


        </div>

        <div class="row1 mt-3">
            <button id="btnCriarEscala" class="w-100 btn btn-success">Criar escala</button>
        </div>

    
        <div class="mt-3 hidder" id="containerNovaEscala">
            <div class="quadroAleatorio">
                <div class="quadroAleatorioTitle">
                    <i class="bi bi-0-circle"></i>
                    <p>Nova escala</p>
                    <span></span>
                </div>
    
                <div class="quadroAleatorioCorpo">
                    <div>
                        <table id="tableCriarEscala" class="table table-sm table-striped table-hover text-center table-bordered">
                            <thead>
                                <tr>
                                    <th class="row1">
                                        <select id="slcAnoNovaEscala" class="form-select">
                                            <option value="">2025</option>
                                        </select>

                                        <select id="slcMesNovaEscala" class="form-select">
                                            <option value="">JAN</option>
                                        </select>
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

                                <!-- <tr class="">
                                    <td>Colaborador</td>
                                    <td><p class="diaSemana">SEG</p></td>
                                    <td><p class="diaSemana">TER</p></td>
                                    <td><p class="diaSemana">QUA</p></td>
                                    <td><p class="diaSemana">QUI</p></td>
                                    <td><p class="diaSemana">SEX</p></td>
                                    <td><p class="diaSemana">SAB</p></td>
                                    <td><p class="diaSemana">DOM</p></td>
                                    <td><p class="diaSemana">SEG</p></td>
                                    <td><p class="diaSemana">TER</p></td>
                                    <td><p class="diaSemana">QUA</p></td>
                                    <td><p class="diaSemana">QUI</p></td>
                                    <td><p class="diaSemana">SEX</p></td>
                                    <td><p class="diaSemana">SAB</p></td>
                                    <td><p class="diaSemana">DOM</p></td>
                                    <td><p class="diaSemana">SEG</p></td>
                                    <td><p class="diaSemana">TER</p></td>
                                    <td><p class="diaSemana">QUA</p></td>
                                    <td><p class="diaSemana">QUI</p></td>
                                    <td><p class="diaSemana">SEX</p></td>
                                    <td><p class="diaSemana">SAB</p></td>
                                    <td><p class="diaSemana">DOM</p></td>
                                    <td><p class="diaSemana">SEG</p></td>
                                    <td><p class="diaSemana">TER</p></td>
                                    <td><p class="diaSemana">QUA</p></td>
                                    <td><p class="diaSemana">QUI</p></td>
                                    <td><p class="diaSemana">SEX</p></td>
                                    <td><p class="diaSemana">SAB</p></td>
                                    <td><p class="diaSemana">DOM</p></td>
                                    <td><p class="diaSemana">SEG</p></td>
                                    <td><p class="diaSemana">TER</p></td>
                                    <td><p class="diaSemana">QUA</p></td>
                                </tr>

                                <tr class="rowList">
                                    <td>
                                        <select class="slcEscalaColaborador">
                                            <option value="">Selecione</option>
                                            <option value="1" data-responsavel="1">colaborador 1</option>
                                            <option value="2" data-responsavel="1">colaborador 2</option>
                                            <option value="3" data-responsavel="0">colaborador 3</option>
                                            <option value="4" data-responsavel="0">colaborador 4</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="1">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="2">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="3">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="4">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="5">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="6">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="7">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="8">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="9">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="10">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="11">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="12">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="13">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="14">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="15">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="16">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="17">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="18">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="19">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="20">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="21">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="22">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="23">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="24">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="25">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="26">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="27">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="28">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="29">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="30">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="31">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr class="rowList">
                                    <td>
                                        <select class="slcEscalaColaborador">
                                            <option value="">Selecione</option>
                                            <option value="1" data-responsavel="1">colaborador 1</option>
                                            <option value="2" data-responsavel="1">colaborador 2</option>
                                            <option value="3" data-responsavel="0">colaborador 3</option>
                                            <option value="4" data-responsavel="0">colaborador 4</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="1">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="2">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="3">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="4">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="5">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="6">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="7">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="8">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="9">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="10">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="11">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="12">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="13">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="14">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="15">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="16">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="17">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="18">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="19">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="20">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="21">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="22">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="23">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="24">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="25">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="26">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="27">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="28">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="29">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="30">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="31">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr class="rowList">
                                    <td>
                                        <select class="slcEscalaColaborador">
                                            <option value="">Selecione</option>
                                            <option value="1" data-responsavel="1">colaborador 1</option>
                                            <option value="2" data-responsavel="1">colaborador 2</option>
                                            <option value="3" data-responsavel="0">colaborador 3</option>
                                            <option value="4" data-responsavel="0">colaborador 4</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="1">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="2">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="3">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="4">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="5">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="6">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="7">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="8">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="9">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="10">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="11">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="12">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="13">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="14">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="15">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="16">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="17">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="18">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="19">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="20">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="21">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="22">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="23">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="24">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="25">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="26">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="27">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="28">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="29">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="30">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="31">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr class="rowList">
                                    <td>
                                        <select class="slcEscalaColaborador">
                                            <option value="">Selecione</option>
                                            <option value="1" data-responsavel="1">colaborador 1</option>
                                            <option value="2" data-responsavel="1">colaborador 2</option>
                                            <option value="3" data-responsavel="0">colaborador 3</option>
                                            <option value="4" data-responsavel="0">colaborador 4</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="1">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="2">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="3">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="4">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="5">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="6">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="7">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="8">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="9">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="10">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="11">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="12">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="13">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="14">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="15">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="16">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="17">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="18">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="19">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="20">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="21">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="22">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="23">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="24">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="25">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="26">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="27">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="28">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="29">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="30">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>

                                    <td>
                                        <select id="" class="slcEsclherDia" data-row-dia="31">
                                            <option value=""></option>
                                            <option value="M">M</option>
                                            <option value="I">I</option>
                                            <option value="T">T</option>
                                            <option value="FG">FG</option>
                                            <option value="FR">FR</option>
                                            <option value="FD">FD</option>
                                        </select>
                                    </td>
                                </tr> -->


                            </tbody>
                            <tfoot>
                                <tr class="rowListFoot">
                                    <td></td>
                                    <td class="col1">
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>
                                    
                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>
                                    
                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>
                                    
                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>

                                    <td>
                                        <p class="spanQTDManha hidder">M-<span class="qtdManha"></span></p>
                                        <p class="spanQTDIntermedio hidder">I-<span class="qtdIntermedio"></span></p>
                                        <p class="spanQTDtarde hidder">T-<span class="qtdTarde"></span></p>
                                        <p class="spanQTDFolga hidder">FG-<span class="qtdFolga"></span></p>
                                        <p class="spanQTDFerias hidder">FR-<span class="qtdFerias"></span></p>
                                        <p class="spanQTDFeriado hidder">FD-<span class="qtdFeriado"></span></p>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>

                        <div class="row1 mt-3">
                            <div>
                                <p><span class="legend legendManha">M</span> Manhã | Início às 10h</p>
                                <p><span class="legend legendIntermedio">I</span> Intermédio | Início às 11h</p>
                                <p><span class="legend legendTarde">T</span> Tarde | Início às 13h</p>
                            </div>

                            <div>
                                <p><span class="legend legendFolga">FG</span> Folga</p>
                                <p><span class="legend legendFerias">FR</span> Ferias</p>
                                <p><span class="legend legendFeriado">FD</span> Feriado</p>
                            </div>
                        </div>

                        <div class="row1 mt-3">
                            <button id="btnCancelarEscala" class="w-100 btn btn-outline-danger">Cancelar</button>
                            <button id="btnSalvarEscala" class="w-100 btn btn-outline-primary">Salvar</button>
                            <button id="btnEnviarEscala" class="w-100 btn btn-success">Enviar</button>
                        </div>
                        <small>Você pode salvar a escala para finalizar depois.</small>
                    </div>
                </div>
            </div>
        </div>
    <!--  -->
    </div>

    <footer class="footerPage">
        <p>Roda pe</p>
    </footer>
</div>

<script src="public/js/pgCriarEscala.js"></script>
