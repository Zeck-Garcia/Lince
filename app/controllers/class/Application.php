<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

class Application{
    private $db;

    public function __construct()
    {
        $this->db = new manipulacaoDeDados();
    }

    public function limparInputs($dados) {
        $limpos = [];
        foreach ($dados as $key => $val) {
            if(is_string($val) || is_numeric($val)){
                $limpos[$key] = str_replace(array("'", '"'), '', trim(strip_tags($val)));
            } else {
                $limpos[$key] = $val;
            }
        }
        return $limpos;
    }

    public function loadListDepartamento(){
        $select = "SELECT * FROM tbDepartamento";
        $qry = $this->db->buscar($select);
        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idDepartamento"],
                    "nome" => $value["nomeDepartamento"],
                    "ativo" => $value["ativoDepartamento"],
                ];
            }
        }
        return $list;
    }

    public function loadListNivel(){
        $select = "SELECT * FROM tbClasse";
        $qry = $this->db->buscar($select);
        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idClasse"],
                    "codClass" => $value["codClasse"],
                    "slug" => $value["slugClasse"],
                    "nome" => $value["nomeClasse"],
                    "ativo" => $value["ativoClasse"],
                ];
            }
        }
        return $list;
    }

    public function loadListCargo(int $id){
        $select = "SELECT * FROM `tbCargo` WHERE departamentoCargo = ?";
        $qry = $this->db->buscar($select, [$id]);

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idCargo"],
                    "nome" => $value["nomeCargo"],
                    "ativo" => $value["ativoCargo"],
                ];
            }
        }
        return $list;
    }

    public function listDadosUser(array $dados){
        $jsonDados = json_decode($dados["dados"], true);

        $dadosT = $this->limparInputs($jsonDados);

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
            $where = " AND si.nomeUserDados=? ";
            $param[] = $dadosT["nomeUser"];
        }

        if(isset($dadosT["departamentoUser"]) && $dadosT["departamentoUser"] != 0){
            $where = " AND si.departamentoUserDados=? ";
            $param[] = $dadosT["departamentoUser"];
        }

        if(isset($dadosT["cargoUser"]) && $dadosT["cargoUser"] != 0){
            $where = " AND si.cargoUserDados=? ";
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
                    "email" => $value["emailUserDados"],
                    "dataCriacao" => $value["dataCriacaoUserDados"],
                    "receberEmail" => $value["receberEmailUserDados"],
                    "ativo" => $value["ativoUserDados"],
                    "limite" => $limite,
                    "totalRegistro" => $value["totalRegistro"],
                ];
            }
        }
        return $list;
    }

    public function SearchDadosFornecedor(string $id){
        $busca = str_replace(array("'", '"'), '', trim(strip_tags($id)));
        $select = "SELECT * FROM tbFornecedor WHERE idFornecedor = ? OR nomeFornecedor LIKE ? LIMIT 1";
        $buscaLike = "%" . $busca  . "%";
        $qry = $this->db->buscar($select, [$busca,$buscaLike]);

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "idFornecedor" => $value["idFornecedor"],
                    "nomeFornecedor" => $value["nomeFornecedor"],
                    "siteFornecedor" => $value["siteFornecedor"],
                    "emailFornecedor" => $value["emailFornecedor"],
                    "dataCriacaoFornecedor" => $value["dataCriacaoFornecedor"],
                    "ativoFornecedor" => $value["ativoFornecedor"],
                    "moradaFornecedor" => $value["moradaFornecedor"],
                    "contactoFornecedor" => $value["contactoFornecedor"],
                    "telefoneFornecedor" => $value["telefoneFornecedor"],
                    "responsavelFornecedor" => $value["responsavelFornecedor"],
                ]; 
            }
        }
        return $list;
    }

    public function crudUtilizador(array $dados){
            
        $jsonDados = json_decode($dados["dados"], true);
        $dadosT = $this->limparInputs($jsonDados);

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
                    "ativo" => $dadosT["ativo"],
                    "id" => $dadosT["id"],
                    "idLogin" => $dadosT["idLogin"]
                ];
                $op1 = $this->alterarUtilizador($dadosSend1);

                $dadosSend2 = [
                    "classe" => $dadosT["classe"],
                    "departamento" => $dadosT["departamento"],
                    "cargo" => $dadosT["cargo"],
                    "loja" => isset($dadosT["loja"]) && $dadosT["loja"] != '' ? $dadosT["loja"] : null,
                    "senha" => $dadosT["senha"],
                    "email" => $dadosT["email"],
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
                    SET codColaboradorUserDados=?,nomeUserDados=?,departamentoUserDados=?,cargoUserDados=?,classeUserDados=?,emailUserDados=?,ativoUserDados=? WHERE idUserDados=?";
        $qry = $this->db->executarSQL($select,[
            isset($dados["codColaborador"]) && $dados["codColaborador"] == '' ? $dados["codColaborador"] : null,
            $dados["nome"],
            $dados["departamento"],
            $dados["cargo"],
            $dados["classe"],
            $dados["email"],
            $dados["ativo"],
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
                    SET classeUser=?,departamentoUser=?,cargoUser=?,lojaUser=?,emailUser=?,ativoUser=? WHERE idUser=?";
        $qry = $this->db->executarSQL($select,[
            $dados["classe"],
            $dados["departamento"],
            $dados["cargo"],
            isset($dados["loja"]) && $dados["loja"] == '' ? $dados["loja"] : null,
            $dados["email"],
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

    private function salvarUtilizadorTBUserSistema(array $dados){
        $resultLogin = $this->salvarLogin($dados);

        if($resultLogin["sucesso"]){
            $searchDadosLogin = $this->searchDadosLogin($dados);

            if(count($searchDadosLogin) > 0){
                $select = "INSERT INTO tbUserSistema 
                                    (codColaboradorUserDados, idLogin, nomeUserDados, departamentoUserDados, cargoUserDados, classeUserDados, emailUserDados)
                                VALUES (?,?,?,?,?,?,?)";
                $qry = $this->db->executarSQL($select, [
                    isset($dados["codColaborador"]) && $dados["codColaborador"] == '' ? $dados["codColaborador"] : null,
                    $searchDadosLogin[0]["id"],
                    $dados["nome"],
                    $dados["departamento"],
                    $dados["cargo"],
                    $dados["classe"],
                    $dados["email"]
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
                        (nomeUser, classeUser, departamentoUser, cargoUser, lojaUser, passUser, loginUser, dataCriacaoUser, emailUser)

                    VALUES (?,?,?,?,?,?,?,?,?)";
        $qry = $this->db->executarSQL($select, [
            $dados["nome"],
            $dados["classe"],
            $dados["departamento"] == '' ? $dados["departamento"] : null,
            $dados["cargo"] == '' ? $dados["cargo"] : null,
            isset($dados["loja"]) && $dados["loja"] == '' ? $dados["loja"] : null,
            $dados["senha"],
            $dados["login"],
            date("Y-m-d"),
            $dados["email"] == '' ? $dados["email"] : null
        ]);
        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Login cadastrado com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Houve um erro ao cadastar o login", "result" => []];
    }

    private function searchDadosLogin(array $dados){
        $select = "SELECT * FROM tbUser WHERE 1=1 ";

        $where = "";
        $param = [];

        if($dados["nome"] != ''){
            $where .= " AND nomeUser=? ";
            $param[] = $dados["nome"];
        }

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

    public function searchLoginExiste(array $dados){
        $jsonDados = json_decode($dados["dados"], true);
        $dadosT = $this->limparInputs($jsonDados);

        $select = "SELECT * FROM tbUser WHERE loginUser = ?";
        $qry = $this->db->buscar($select, [
            $dadosT["login"]
        ]);

        if(count($qry) > 0){
            return ["sucesso" => false, "msg" => "O login já existe, tente outro nome"];
        }
        return ["sucesso" => true, "msg" => "O login ainda não foi usado pode usar"];
        
    }

    public function searchListArquivo(int $int){
        $select = "SELECT * FROM tbArquivos WHERE numeroOrdemArquivo = ?";
        $qry = $this->db->buscar($select, [$int]);
        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idArquivo"],
                    "numeroOrder" => $value["numeroOrdemArquivo"],
                    "nomeOriginal" => $value["nomeOriginalArquivo"],
                    "nomeHash" => $value["nomeHashArquivo"],
                    "tipo" => $value["tipoArquivo"],
                    "data" => $value["dataArquivo"],
                ];
            }
        }
        return $list;
    }
    
}
