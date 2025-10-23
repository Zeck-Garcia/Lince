
<?php
if (session_status() === PHP_SESSION_NONE){
    session_start();
}
include_once "../../../app/models/manipulacaoDeDados.php";
$operation = new manipulacaoDeDados();

    $userSet = trim(filter_input(INPUT_POST, "userSet"));

    $selectUser = "SELECT tbUser.idUser, tbUser.nomeUser, tbUser.departamentoUser, tbUser.lojaUser, tbUser.classeUser, tbUser.emailUser, tbUser.ativoUser, tbUser.loginUser, tbDepartamento.nomeDepartamento, tbCargo.nomeCargo, tbCargo.idCargo, tbUser.cargoUser, tbLojas.nomeLoja, tbClasse.nomeClasse, receberEmailUser

                    FROM tbUser

                    LEFT JOIN tbDepartamento
                    ON tbDepartamento.idDepartamento = tbUser.departamentoUser

                    LEFT JOIN tbCargo
                    ON tbCargo.idCargo = tbUser.departamentoUser
                    
                    LEFT JOIN tbLojas
                    ON tbLojas.idLoja = tbUser.lojaUser
                    
                    LEFT JOIN tbClasse
                    ON tbClasse.codClasse = tbUser.classeUser";
    
    $where = "";
    $param = [];
    
    if($userSet != ""){
        $where .= " WHERE tbUser.idUser = ? LIMIT 1 ";
        $type .= "s";
        $param[] = $userSet;
    }
    
    $sqlCompleta = $selectUser . $where;
    
    $qryUser = $operation->executarSQL($sqlCompleta, $type, $param);

        $dadosuser = $operation->listar($qryUser);

        echo "<div class='quadroAleatorioTitle'>
                <i class='bi bi-person'></i>
                <p>Utilizador</p>
                <span></span>
            </div>";

            echo session_id();
            echo "<div id='' >";
                echo "<div class='quadroAleatorioCorpo'>";
                    // echo "<div class='CampoGroup mt-3 active'>";

                    //     $selectDepartamento = "SELECT idDepartamento, nomeDepartamento, ativoDepartamento FROM tbDepartamento";

                    //     $qryDepartamento = $operation->executarSQL($selectDepartamento);

                    //     $listDp = [];
                    //     while($dadosDepartamento = $operation->listar($qryDepartamento)){
                    //         $listDp[] = $dadosDepartamento;
                    //     }

                    //     echo "<select id='slcDepartamentox' class='hidder'>";
                    //         for($i = 0 ; $i < count($listDp[0]) ; $i++){
                    //             echo "<option value='{$listDp[0][$i]['idDepartamento']}' data-ativo='{$listDp[0][$i]['ativoDepartamento']}'" . ($listDp[0][$i]['idDepartamento'] == $dadosuser[0]['departamentoUser'] ? "selected" : "") . ">" . ucfirst($listDp[0][$i]["nomeDepartamento"]) . "</option>";
                    //         }
                    //     echo "</select>";
                    //     echo "<input type='text' id='txtDepartamento' class='form-control' value='" . ucfirst($dadosuser[0]["nomeDepartamento"]) . "' readonly>";


                    //     echo "<label>Departamento</label>
                    // </div>";

                    // echo "<div class='CampoGroup mt-3 active'>
                    //     <!-- <input type='text' id='' class='form-control'> -->";
                        
                    //     $selectCargo = "SELECT tbCargo.nomeCargo, tbCargo.idCargo, tbCargo.departamentoCargo, tbCargo.ativoCargo 
                    //                     FROM tbCargo 
                    //                     WHERE tbCargo.departamentoCargo = ?";

                    //     $typeCargo = "s";
                    //     $paramCargo = [];

                    //     $paramCargo[] = $dadosuser[0]['departamentoUser'];

                    //     $qryCargo = $operation->executarSQL($selectCargo, $typeCargo, $paramCargo);

                    //     $listCargo = [];
                    //     while($dadosCargo = $operation->listar($qryCargo)){
                    //         $listCargo[] = $dadosCargo;
                    //     }

                    //     echo "<select id='slcCargox' class='hidder'>";
                    //         for($i = 0 ; $i < count($listCargo[0]) ; $i++){
                    //             echo "<option value='{$listCargo[0][$i]['idCargo']}' data-ativo='{$listCargo[0][$i]['ativoCargo']}'" . ($listCargo[0][$i]['idCargo'] == $dadosuser[0]['cargoUser'] ? " selected" : "") . ">" . ucfirst($listCargo[0][$i]['nomeCargo']) . "</option>";
                    //         }
                    //     echo "</select>";
                    //     echo "<input type='text' id='txtCargo' class='form-control' value='" . ucfirst($dadosuser[0]["nomeCargo"]) . "' readonly>";
                    //     echo "<label>Cargo</label>
                    // </div>";

                    echo "<div class='CampoGroup mt-4 active'>
                        <input type='text' id='txtNome' data-id='{$dadosuser[0]['idUser']}' class='form-control' value='{$dadosuser[0]['nomeUser']}' readonly>
                        <label>Nome completo</label>
                    </div>";

                    echo "<div class='CampoGroup mt-4 active'>
                        <input type='text' id='txtLogin' class='form-control' value='" .$dadosuser[0]['loginUser'] . "' onclick='noSpace(this)' readonly>
                        <label>Login</label>
                    </div>";

                    echo "<div class='CampoGroup mt-4'>
                        <input type='text' id='txtSenha' class='form-control' onclick='noSpace(this)' readonly>
                        <label>Senha</label>
                    </div>";

                    echo "<div class='CampoGroup mt-4 active'>";
                        $selecLoja = "SELECT * FROM tbClasse WHERE ativo = 1";

                        $qryLoja = $operation->executarSQL($selecLoja);

                        while($dadosLoja = $operation->listar($qryLoja)){
                            $listLojas = $dadosLoja;
                        }

                        echo "<select id='slcLojax' class='hidder'>";
                            for($i = 0 ; $i < count($listLojas) ; $i++){
                                echo $listLojas[$i]['codClasse'];
                                echo "<option value='{$listLojas[$i]['codClasse']}' data-ativo='{$listLojas[$i]['ativo']}'" . ($listLojas[$i]['codClasse'] == $dadosuser[0]['classeUser'] ? " selected" : "") . ">" . ucfirst($listLojas[$i]['nomeClasse']) . "</option>";
                            }
                        echo "</select>";
                        echo "<input type='text' id='txtLoja' class='form-control' value='" . ucfirst($dadosuser[0]["nomeClasse"]) . "' readonly>";
                        echo "<label>Categoria</label>
                    </div>";

                    $classEmail = ($dadosuser[0]['emailUser'] != "" ? "active" : "");

                    echo "<div class='CampoGroup mt-4 {$classEmail}'>
                        <input type='text' id='txtEmail' class='form-control' value='" . $dadosuser[0]['emailUser'] . "' readonly>
                        <label>Email</label>
                    </div>";

                    $cima = "";
                    if($dadosuser[0]['idUser'] != $_SESSION["idUser"]){
                        $cima = "readonly";
                    } else {
                        $cima = "disabled";
                    }

                    echo "<div class='CampoGroup mt-4 active'>
                        <select id='slcAtivox' class='hidder'>
                            <option value='1' " . ($dadosuser[0]['ativoUser'] == 1 ? "selected" : "") . " >Sim</option>
                            <option value='0' " . ($dadosuser[0]['ativoUser'] == 0 ? "selected" : "") . " >Não</option>
                        </select>";
                        echo "<input type='text' id='txtAtivo' class='form-control' value='" .  ($dadosuser[0]['ativoUser'] == 0 ? "Não" : "Sim") . "' {$cima}>";
                        echo "<label>Ativo</label>
                    </div>";

                    $checked = ($dadosuser[0]['receberEmailUser'] == 1 ? "checked" : "");
                    echo "<div class='CampoGroup mt-4 row1'>
                            <input type='checkbox' id='chkReceberEmail' {$checked}>
                            <label>Receber email diário sobre ordem de compra por aprovar?</label>
                    </div>";

                    echo "<div class='mt-5'><span>Dê um duplo click no campo para habilitar edição</span></div>";
                echo "</div>";

                echo $dadosuser[0]['idUser'];
                echo "<div class='quadroAleatorioCorpo groupBtn mt-3 row1'>";
                    if($dadosuser[0]['idUser'] != $_SESSION["idUser"]){
                        echo "<input type='button' id='btnExcluirUltilizador' class='btn btn-outline-danger' value='Excluir' data-id='{$dadosuser[0]['idUser']}'>";
                    }
                    echo "<input type='button' id='btnAlterarUltilizador' class='btn btn-warning' value='Alterar'>";
                echo "</div>";
            echo "</div>";
        

?>

