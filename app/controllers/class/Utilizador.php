<?php

class Utilizador{
    private $db;
    private $app;

    public function __construct()
    {
        $this->db = new manipulacaoDeDados();
        $this->app = new Application();
    }

    public function getUtilizadorById(int $id){
        $select = "SELECT * FROM tbUserSistema WHERE idUserDados = ? ORDER BY tbUserSistema.nomeUserDados";
        $qry = $this->db->buscar($select, [$id]);
        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idUserDados"],
                    "codLaborador" => $value["codColaboradorUserDados"],
                    "idLogin" => $value["idLogin"],
                    "nome" => $value["nomeUserDados"],
                    "departamento" => $value["departamentoUserDados"],
                    "cargo" => $value["cargoUserDados"],
                    "classe" => $value["classeUserDados"],
                    "email" => $value["emailUserDados"],
                    "contacto" => $value["contactoUserDados"],
                    "dataCriacao" => $value["dataCriadoUserDados"],
                    "recebeEmail" => $value["receberEmailUserDados"],
                    "ativo" => $value["ativoUserDados"],
                ];
            }
        }
        return $list;
    }

    public function listDadosUser(array $dados){
        $jsonDados = json_decode($dados["dados"], true);

        $dadosT = $this->app->limparInputs($jsonDados);

        $paginaSet = ($dadosT["paginaSet"] == 0 ? 1 : $dadosT["paginaSet"]);
        $limite = 7;
        $inicio = ($paginaSet * $limite) - $limite;

        $select = "WITH result AS (SELECT si.*, dp.idDepartamento, dp.nomeDepartamento, ca.idCargo, ca.nomeCargo, cl.nomeClasse, us.loginUser 
                FROM tbUserSistema si

                LEFT JOIN tbDepartamento dp
                ON dp.idDepartamento = si.departamentoUserDados

                LEFT JOIN tbCargo ca
                ON ca.idCargo = si.cargoUserDados

                LEFT JOIN tbClasse cl
                ON cl.idClasse = si.classeUserDados

                LEFT JOIN tbUser us
                ON us.idUser = si.idLogin
                
                WHERE 1=1 ";

        $param = [];
        $where = '';
        if(isset($dadosT["nomeUser"]) && $dadosT["nomeUser"] != ''){
            $where = " AND si.nomeUserDados LIKE ? OR emailUserDados = ? OR ativoUserDados=?";
            $param[] = "%".$dadosT["nomeUser"]."%";
            $param[] = $dadosT["nomeUser"];
            $param[] = strtolower($dadosT["nomeUser"]) == "ativo" ? 1 : 0;
        }

        if(isset($dadosT["departamentoUser"]) && $dadosT["departamentoUser"] != 0){
            $where .= " AND si.departamentoUserDados=? ";
            $param[] = $dadosT["departamentoUser"];
        }

        if(isset($dadosT["cargoUser"]) && $dadosT["cargoUser"] != 0){
            $where .= " AND si.cargoUserDados=? ";
            $param[] = $dadosT["cargoUser"];
        }

        if(isset($dadosT["codColaboradorUser"]) ? $dadosT["codColaboradorUser"] != 0: false){
            $where = " AND codFuncionarioFuncionario=? ";
            $param[] = $dadosT["codColaboradorUser"];
        }

        if(isset($dadosT["id"]) && $dadosT["id"] != 0){
            $where = " AND si.idUserDados=? ";
            $param[] = $dadosT["id"];
        }

        $selectFim = " ORDER BY si.idUserDados ASC)
                            SELECT *, (SELECT COUNT(*) FROM result ) AS totalRegistro FROM result ORDER BY nomeUserDados ASC LIMIT " . $inicio . "," . $limite;

        $selectCompleta = $select . $where . $selectFim;

        $qry = $this->db->buscar($selectCompleta, $param);

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idUserDados"],
                    "codColaborador" => $value["codColaboradorUserDados"],
                    "idLogin" => $value["idLogin"],
                    "login" => $value["loginUser"],
                    "nome" => $value["nomeUserDados"],
                    "idDepartamento" => $value["idDepartamento"],
                    "nomeDepartamento" => $value["nomeDepartamento"],
                    "idCargo" => $value["idCargo"],
                    "nomeCargo" => $value["nomeCargo"],
                    "idClasse" => $value["classeUserDados"],
                    "nomeClasse" => $value["nomeClasse"],
                    "contacto" => $value["contactoUserDados"],
                    "email" => $value["emailUserDados"],
                    "dataCriacao" => $value["dataCriadoUserDados"],
                    "receberEmail" => $value["receberEmailUserDados"],
                    "receberOrderCompra" => $value["aceitarOrderCompra"],
                    "ativo" => $value["ativoUserDados"],
                    "limite" => $limite,
                    "totalRegistro" => $value["totalRegistro"],
                ];
            }
        }
        return $list;
    }

    public function crudUtilizador(array $dados){
            
        $jsonDados = json_decode($dados["dados"], true);
        $dadosT = $this->app->limparInputs($jsonDados);

        switch($dadosT["action"]){
            case "salvar":
                $resultSalve = $this->salvarUtilizadorTBUserSistema($dadosT);
                return ["sucesso" => $resultSalve["sucesso"], "msg" => $resultSalve["msg"]];
                break;

            case "editar":
                $dadosSend1 = [
                    "nome" => $dadosT["nome"],
                    "departamento" => $dadosT["departamento"],
                    "cargo" => $dadosT["cargo"],
                    "classe" => $dadosT["classe"],
                    "email" => $dadosT["email"],
                    "contacto" => $dadosT["contacto"],
                    "ativo" => $dadosT["ativo"],
                    "id" => $dadosT["id"],
                    "idLogin" => $dadosT["idLogin"],
                    "chkReceberOrder" => $dadosT["chkReceberOrder"],
                ];
                $op1 = $this->alterarUtilizador($dadosSend1);

                $dadosSend2 = [
                    "senha" => $dadosT["senha"],
                    "ativo" => $dadosT["ativo"],
                    "id" => $dadosT["id"],
                    "idLogin" => $dadosT["idLogin"]
                ];
                $op2 = $this->alterarUtilizadorLogin($dadosSend2);

                if($op1["sucesso"] && $op2["sucesso"]){
                    return ["sucesso" => true, "msg" => $op1["msg"] . "\n" . $op2["msg"]];
                } else {
                    return ["sucesso" => false, "msg" => $op1["msg"] . "\n" . $op2["msg"]];
                }
                break;
            case "excluir":
                $op3 = $this->excluirUtilizador($dadosT["id"]);
                $op4 = $this->excluirUtilizadorLogin($dadosT["idLogin"]);
                
                if($op3["sucesso"] && $op4["sucesso"]){
                    return ["sucesso" => true, "msg" => $op3["msg"] . "\n" . $op4["msg"]];
                }
                return ["sucesso" => false, "msg" => "Houve um erro ao excluir o utilizador, consulte a lista para ver se a ação foi finalizada, caso não, contacte o suporte"];
                break;
        }
    }

    private function salvarUtilizadorTBUserSistema(array $dados){
        $resultLogin = $this->salvarLogin($dados);

        if($resultLogin["sucesso"]){
            $searchDadosLogin = $this->searchDadosLogin($dados);

            if(count($searchDadosLogin) > 0){
                $select = "INSERT INTO tbUserSistema 
                                    (codColaboradorUserDados, idLogin, nomeUserDados, departamentoUserDados, cargoUserDados, classeUserDados, emailUserDados, aceitarOrderCompra, contactoUserDados)
                                VALUES (?,?,?,?,?,?,?,?,?)";
                $qry = $this->db->executarSQL($select, [
                    isset($dados["codColaborador"]) && $dados["codColaborador"] == '' ? $dados["codColaborador"] : null,
                    $searchDadosLogin[0]["id"],
                    $dados["nome"],
                    $dados["departamento"],
                    $dados["cargo"],
                    $dados["classe"],
                    $dados["email"],
                    $dados["chkReceberOrder"],
                    $dados["contacto"],
                ]);
    
                if($qry->rowCount() >= 0){
                    return ["sucesso" => true, "msg" => "Utilizador cadastrado com sucesso"];
                }
                $resultLimpar = $this->limparDadosLoginCadastro($resultLogin["result"]["idUser"]);
                return ["sucesso" => false, "msg" => "Houve um erro ao cadastrar utilizador", "result" => $resultLimpar];
            } else {
                return ["sucesso" => false, "msg" => "Houve um erro, contacto o suporte do sistema"];
            }
        } else {
            return ["sucesso" => $resultLogin["sucesso"], "msg" => $resultLogin["msg"]];
        }
    }

    private function salvarLogin(array $dados){
        $select = "INSERT INTO tbUser
                        (passUser, loginUser, dataCriacaoUser)

                    VALUES (?,?,?)";
        $qry = $this->db->executarSQL($select, [
            hash("sha256",$dados["senha"]),
            $dados["login"],
            date("Y-m-d"),
        ]);
        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Login cadastrado com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Houve um erro ao cadastar o login", "result" => []];
    }

    private function searchDadosLogin(array $dados){
        $select = "SELECT us.idUser, us.loginUser, si.nomeUserDados, us.dataCriacaoUser

                    FROM tbUser us
                    LEFT JOIN tbUserSistema si
                    ON si.idLogin = us.idUser

                    WHERE 1=1 ";

        $where = "";
        $param = [];

        if($dados["login"]){
            $where .= " AND loginUser=? ";
            $param[] = $dados["login"];
        }

        $where .= " LIMIT 1 ";

        $selectCompleta = $select . $where;
        $list = [];
        $qry = $this->db->buscar($selectCompleta, $param);
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idUser"],
                    "nome" => $value["nomeUser"],
                    "login" => $value["loginUser"],
                    "data" => $value["dataCriacaoUser"]
                ];
            }
        }
        return $list;
    }

    private function limparDadosLoginCadastro(int $id){
        $select = "DELETE FROM tbUser WHERE idUser=?";
        $qry = $this->db->executarSQL($select, [$id]);
        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Se tentou cadastar um utiizador e está vendo essa mensagem houve um erro e os dados de login foram limpara."];
        }
        return ["sucesso" => false, "msg" => "Se tentou cadastar um utiizador e está vendo essa mensagem houve um erro que não conseguimos limpar os dados de cadastro do utilizador, contacte o suporte da plataforma."];
    }

    private function excluirUtilizador(int $id){
        $select = "DELETE FROM tbUserSistema WHERE idUserDados=?";
        $qry = $this->db->executarSQL($select,[$id]);

        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Dados do utilizador excluido com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Dados do utilizador excluido com sucesso"];
    }

    private function excluirUtilizadorLogin(int $id){
        $select = "DELETE FROM `tbUser` WHERE idUser=?";
        $qry = $this->db->executarSQL($select,[$id]);

        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Dados de login excluido com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Dados do utilizador excluido com sucesso"];
    }

    private function alterarUtilizador(array $dados){
        $select = "UPDATE tbUserSistema 
                    SET codColaboradorUserDados=?,nomeUserDados=?,departamentoUserDados=?,cargoUserDados=?,classeUserDados=?,emailUserDados=?,ativoUserDados=?,aceitarOrderCompra=?,contactoUserDados=? WHERE idUserDados=?";
        $qry = $this->db->executarSQL($select,[
            isset($dados["codColaborador"]) && $dados["codColaborador"] != '' ? $dados["codColaborador"] : null,
            $dados["nome"],
            $dados["departamento"],
            $dados["cargo"],
            $dados["classe"],
            $dados["email"],
            $dados["ativo"],
            $dados["chkReceberOrder"],
            $dados["contacto"],
            $dados["id"],
        ]);
        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Dados alterado com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Houve um erro ao alterar os dados, consulte o cadastro do utilizador"];
    }

    private function alterarUtilizadorLogin(array $dados){
        //buscar a id do login em tbusersistema

        $select = "UPDATE tbUser 
                    SET ativoUser=? 
                    WHERE idUser=?";
        $qry = $this->db->executarSQL($select,[
            $dados["ativo"],
            $dados["id"],
        ]);
        if($qry->rowCount() >= 0){
                if(isset($dados["senha"]) && $dados["senha"] != ''){
                    $dadosSenha = [
                        $dados["senha"],
                        $dados["nome"],
                        $dados["idLogin"]
                    ];
        
                    $resultAlterSenha = $this->alterSenha($dadosSenha);
                    if($resultAlterSenha["sucesso"]){
                        return ["sucesso" => true, "msg" => $resultAlterSenha["msg"]];
                    } else {
                        return ["sucesso" => false, "msg" => "Os dados do utilizador foi alterado, mas houve um erro ao alterar a senha"];
                    }
                } else {
                    return ["sucesso" => true, "msg" => "Dados alterado com sucesso"];
                }

        }
        return ["sucesso" => false, "msg" => "Houve um erro ao alterar os dados, consulte o cadastro do utilizador"];
    }

    private function alterSenha(array $dados){
        $select = "UPDATE tbUser SET passUser=?, nomeUser=? WHERE idUser=?";
        $qry = $this->db->executarSQL($select, [
            $dados["senha"],
            $dados["nome"],
            $dados["idLogin"]
        ]);
        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Senha Alterada com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Houve um erro ao alterar a senha"];
    }
}