<?php

use Illuminate\Support\Js;
use Symfony\Component\Translation\Dumper\IniFileDumper;

class Formacao{
    private $db;
    private $app;

    public function __construct()
    {
        $this->db = new manipulacaoDeDados();
        $this->app = new Application();
    }

    public function getLoadListTableFormando(array $dados){
        $jsonDados = json_decode($dados["dados"], true);

        $dadosT = $this->app->limparInputs($jsonDados);

        $paginaSet = ($dadosT["paginaSet"] == 0 ? 1 : $dadosT["paginaSet"]);
        $limite = 7;
        $inicio = ($paginaSet * $limite) - $limite;
        $where = "";
        if($dadosT["dataDe"] != '' && $dadosT["dataAte"]){
            $where = ' WHERE dataFormacao >= ? AND dataFormacao <= ? ';
        } else {
            switch((int)($dadosT["action"])){
                case 1: //cod colaborador
                    $where = " WHERE fa.codFuncionarioFormacao = ? ";
                    break;
                case 2: //nome
                    $where = " WHERE fo.nomeFuncionario LIKE ? ";
                    break;
                case 3: //local
                    $where = " WHERE lo.nomeLoja LIKE ? ";
                    break;
                case 4: //formacao
                    $where = " WHERE nomeFormacaoNome LIKE ? ";
                    break;
            }
        }

        $select = "WITH result AS (SELECT * FROM tbFormacao fa
                    LEFT JOIN tbFuncionario fo
                    ON fo.codFuncionarioFuncionario = fa.codFuncionarioFormacao

                    LEFT JOIN tbFormacaoNome fn
                    ON fn.idFormacaoNome = fa.codFormacaoNomeFormacao

                    LEFT JOIN tbLojas lo
                    ON lo.idLoja = fa.codLocalFormacao ";

        $selectFim = " ORDER BY fa.idFormacao DESC)
                        SELECT *, (SELECT COUNT(*) FROM result ) AS totalRegistro FROM result ORDER BY idFormacao DESC LIMIT " . $inicio . "," . $limite;
        $sqlFInal = $select . $where . $selectFim;
        
        $busca = [$dadosT["buscar"]];
        if($dadosT["dataDe"] != ''){
            $busca =  [$dadosT["dataDe"] , $dadosT["dataAte"]];
        } else if (in_array((int)($dadosT["action"]),[2,3,4])){
            $busca = ["%" . $dadosT["buscar"] . "%"];
        }

        if($where != ''){
            $qry = $this->db->buscar($sqlFInal, $busca);
        } else {
            $qry = $this->db->buscar($sqlFInal);
        }

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "idFormacao" => $value["idFormacao"],
                    "codColaborador" => $value["codFuncionarioFormacao"],
                    "codNomeFormacao" => $value["codFormacaoNomeFormacao"],
                    "dataFormacao" => $value["dataFormacao"],
                    "tempoFormacao" => $value["tempoFormacao"],
                    "codLocalFormacao" => $value["codLocalFormacao"],
                    "nomeColaborador" => $value["nomeFuncionario"],
                    "lojaFuncionario" => $value["lojaFuncionario"],
                    "ativoFuncionario" => $value["ativoFuncionario"],
                    "nomeFormacao" => $value["nomeFormacaoNome"],
                    "ativoFormacaoNome" => $value["ativoFormacaoNome"],
                    "nomeLocal" => $value["nomeLoja"],
                    "ativoFormacaoLocal" => $value["ativoLoja"],
                    "totalRegistro" => $value["totalRegistro"],
                    "limite" => $limite,
                ];
            }
        }
        return $list;
    }

    public function CRUDFormando(array $dados){
        $jsonDados = json_decode($dados["dados"], true);

        $dadosT = $this->app->limparInputs($jsonDados);

        switch($dadosT["action"]){
            case 'excluir':
                $result = $this-> excluirFormando($dadosT["id"]);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
            case 'salvar':
                $resultSearchExisteFormacao = $this->searchCusroAoSalvar($dadosT);

                if(!$resultSearchExisteFormacao["sucesso"]){
                    return ["sucesso" => $resultSearchExisteFormacao["sucesso"], "msg" => $resultSearchExisteFormacao["msg"]];
                } else {
                    $result = $this->salvarFormando($dadosT);
                    return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];    
                }
                break;
            case "editar":
                $resultSearchExisteFormacao = $this->searchCusroAoSalvar($dadosT);
                if(!$resultSearchExisteFormacao["sucesso"]){
                    return ["sucesso" => $resultSearchExisteFormacao["sucesso"], "msg" => $resultSearchExisteFormacao["msg"]];
                } else {
                    $resultEditar = $this->editarFormando($dadosT);
    
                    return ["sucesso" => $resultEditar["sucesso"], "msg" => $resultEditar["msg"]]; 
                    break;
                }
        }
    }

    private function excluirFormando(int $id){
        $select = "DELETE FROM `tbFormacao` WHERE idFormacao = ?";
        $qry = $this->db->executarSQL($select, [$id]);

        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Formação excluida com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Erro ao excluida formação"];
    }

    private function searchCusroAoSalvar($dados){
        $select = "SELECT * FROM tbFormacao
                    WHERE codFuncionarioFormacao =?
                    AND codFormacaoNomeFormacao = ? 
                    AND dataFormacao = ?
                    AND tempoFormacao = ?
                    AND codLocalFormacao = ?";
        $tempo = $dados["hora"] . ":" . $dados["minuto"] . ":00";
        $qry = $this->db->buscar($select, [
            $dados["codColaborador"],
            $dados["curso"],
            $dados["data"],
            $tempo,
            $dados["loja"]
        ]);
        if(count($qry) > 0){
            return ["sucesso" => false, "msg" => "Já tem uma formação registrada neste mesmo dia para o colaborador em questão"];
        }
        return ["sucesso" => true, "msg" => "Pode salvar"];
    }

    private function salvarFormando(array $dados){
            $select = "INSERT INTO tbFormacao
                    (codFuncionarioFormacao,codFormacaoNomeFormacao,dataFormacao,tempoFormacao,codLocalFormacao) 
                    VALUES (?,?,?,?,?)";

            $tempo = $dados["hora"] . ':' . $dados["minuto"] . ":00";
            $qry = $this->db->executarSQL($select,[
                $dados["codColaborador"],
                $dados["curso"],
                $dados["data"],
                $tempo,
                $dados["loja"],
            ]);

            $resultColaborador = $this->SearchExisteFuncionario($dados);

            if(!$resultColaborador["sucesso"]){
                //criar funcionario
                $this->salvarFuncionario($dados);
            }

            if($qry->rowCount() >= 0){
                return ["sucesso" => true, "msg" => "Formação salva com sucesso."];
            } else {
                return ["sucesso" => false, "msg" => "Erro ao salvar a formação."];
            }
    }

    private function editarFormando(array $dados){
        $select = "UPDATE tbFormacao
                    SET codFormacaoNomeFormacao=?,dataFormacao=?,tempoFormacao=?,codLocalFormacao=? 
                    WHERE idFormacao = ?";
        $tempo = $dados["hora"] . ':' . $dados["minuto"] . ":00";
        $qry = $this->db->executarSQL($select, [
            $dados["curso"],
            $dados["data"],
            $tempo,
            $dados["loja"],
            $dados["idFormando"]
        ]);
        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Formação editada com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Houve um erro ao editar essa formação"];
    }

    ///curso
    //1
    public function getLoadListTableCurso(array $dados){
        $jsonDados = json_decode($dados["dados"], true);

        $dadosT = $this->app->limparInputs($jsonDados);

        $paginaSet = ($dadosT["paginaSet"] == 0 ? 1 : $dadosT["paginaSet"]);
        $limite = 7;
        $inicio = ($paginaSet * $limite) - $limite;
        
        $select = "WITH result AS (SELECT * FROM tbFormacaoNome fo ";

        $selectFim = " ORDER BY fo.idFormacaoNome ASC)
                        SELECT *, (SELECT COUNT(*) FROM result ) AS totalRegistro FROM result LIMIT " . $inicio . "," . $limite;
        $sqlFInal = $select . $selectFim;
        $qry = $this->db->buscar($sqlFInal);

        if($dadosT["nomeCurso"] != ''){
            $where = " WHERE fo.nomeFormacaoNome LIKE ? ";
            $sqlFInal = $select . $where . $selectFim;
            $busca = "%" . $dadosT["nomeCurso"] . "%";
            $qry = $this->db->buscar($sqlFInal,[$busca]);
        }
        
        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idFormacaoNome"],
                    "nome" => $value["nomeFormacaoNome"],
                    "ativo" => $value["ativoFormacaoNome"],
                    "totalRegistro" => $value["totalRegistro"],
                    "limite" => $limite,
                ];
            }
        }
        return $list;
    }

    //2
    public function CRUDCurso(array $dados){
        $jsonDados = json_decode($dados["dados"], true);

        $dadosT = $this->app->limparInputs($jsonDados);

        switch($dadosT["action"]){
            case 'excluir':
                $result = $this-> excluirCurso($dadosT["id"]);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
            case 'editar':
                $resultSearch = $this->SearchExisteCurso($dadosT["nome"]);
                if($resultSearch["sucesso"]){
                    return ["sucesso" => false, "msg" => $resultSearch["msg"]];
                } else {
                    $result = $this->editarCurso($dadosT);
                    return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                }
                break;
            case 'salvar':
                $resultSearch = $this->SearchExisteCurso($dadosT["nome"]);
                if($resultSearch["sucesso"]){
                    return ["sucesso" => false, "msg" => $resultSearch["msg"]];
                } else {
                    $result = $this->salvarCurso($dadosT);
                    return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                }
                break;
        }

    }

    //3
    private function excluirCurso(int $id){
        //fazer uma busca se tem registro salvo
        $dados = [
            "action" => "curso",
            "buscar" => $id
        ];
        $result = $this->checkExisteRegistro($dados);
        if($result["sucesso"]){
                return ["sucesso" => false, "msg" => "Este curso não pode ser excluido porque já tem registro"];
        } else {
            $select = "DELETE FROM tbFormacaoNome WHERE idFormacaoNome = ?";
            $qry = $this->db->executarSQL($select, [$id]);
    
            if($qry->rowCount() >= 0){
                return ["sucesso" => true, "msg" => "Curso excluida com sucesso"];
            }
            return ["sucesso" => false, "msg" => "Erro ao excluida cruso"];
        }
    }

    //4
    private function editarCurso(array $dados){
        $select = "UPDATE tbFormacaoNome 
                    SET nomeFormacaoNome=?,ativoFormacaoNome=? 
                    WHERE idFormacaoNome = ?";
        $qry = $this->db->executarSQL($select, [
                $dados["nome"],
                $dados["ativo"],
                $dados["id"]
        ]);

        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Curso alterado com sucesso"];
            }
        return ["sucesso" => true, "msg" => "Erro ao altera curso" . $qry];
    }

    //5
    private function SearchExisteCurso(string $str){
        $busca = str_replace(" ", "", trim($str));
        $select = "SELECT * FROM tbFormacaoNome WHERE REPLACE(nomeFormacaoNome, ' ', '')=?";
        $qry = $this->db->buscar($select, [$busca]);
        if(count($qry) > 0){
            return ["sucesso" => true, "msg" => "Já existe um resgitro com esse nome"];
        }
        return ["sucesso" => false, "msg" => "Erro"];
    }

    //6
    private function salvarCurso(array $dados){
        $select = "INSERT INTO tbFormacaoNome
                            (nomeFormacaoNome,ativoFormacaoNome) 
                            VALUES (?,?)";
        $qry = $this->db->executarSQL($select, [$dados["nome"], $dados["ativo"]]);
        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Registro salvo com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Erro ao salvar o registro"];
    }

    ///local
    //1
    public function getLoadListTableLocal(array $dados){
        $jsonDados = json_decode($dados["dados"], true);

        $dadosT = $this->app->limparInputs($jsonDados);

        $paginaSet = ($dadosT["paginaSet"] == 0 ? 1 : $dadosT["paginaSet"]);
        $limite = 7;
        $inicio = ($paginaSet * $limite) - $limite;
        
        $select = "WITH result AS (SELECT * FROM tbLojas lo ";

        $selectFim = "ORDER BY lo.idLoja ASC)
        SELECT *, (SELECT COUNT(*) FROM result ) AS totalRegistro FROM result LIMIT " . $inicio . "," . $limite;

        $sqlFInal = $select . $selectFim;
        $qry = $this->db->buscar($sqlFInal);

        if($dadosT["nomeLoja"] != ''){
            $where = " WHERE lo.nomeLoja LIKE ? ";
            $sqlFInal = $select . $where . $selectFim;
            $busca = "%" . $dadosT["nomeLoja"] . "%";
            $qry = $this->db->buscar($sqlFInal,[$busca]);
        }
        
        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idLoja"],
                    "nome" => $value["nomeLoja"],
                    "ativo" => $value["ativoLoja"],
                    "totalRegistro" => $value["totalRegistro"],
                    "limite" => $limite,
                ];
            }
        }
        return $list;
    }

    //2
    public function CRUDLocal(array $dados){
        $jsonDados = json_decode($dados["dados"], true);
        $dadosT = $this->app->limparInputs($jsonDados);
        switch($dadosT["action"]){
            case 'excluir':
                $dadosSend = [
                    "action" => "local",
                    "buscar" => $dadosT["id"] ?? ''
                ];
                $resultSearchExisteRegistro = $this->checkExisteRegistro($dadosSend);
                if($resultSearchExisteRegistro["sucesso"]){
                    return ["sucesso" => false, "msg" => "O local não pode ser excluido, poque já existe registro."];
                } else {
                    $result = $this-> excluirLocal($dadosT["id"]);
                    return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                }
                break;
            case 'editar':
                $resultSearch = $this->SearchExisteLocal($dadosT["nome"]);
                if($resultSearch["sucesso"]){
                    return ["sucesso" => false, "msg" => $resultSearch["msg"]];
                } else {
                    $result = $this->editarLocal($dadosT);
                    return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                }
                break;
            case 'salvar':
                $resultSearch = $this->SearchExisteLocal($dadosT["nome"]);
                if($resultSearch["sucesso"]){
                    return ["sucesso" => false, "msg" => $resultSearch["msg"]];
                } else {
                    $result = $this->salvarLocal($dadosT);
                    return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                }
                break;
        }
    }

    //3
    private function excluirLocal(int $id){
        $select = "DELETE FROM tbLojas WHERE idLoja = ?";
        $qry = $this->db->executarSQL($select, [$id]);

        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Local excluida com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Erro ao excluida cruso" . $qry];
    }

    //4
    private function editarLocal(array $dados){
        $select = "UPDATE tbLojas 
                    SET nomeLoja=?,ativoLoja=? 
                    WHERE idLoja = ?";
        $qry = $this->db->executarSQL($select, [
                $dados["nome"],
                $dados["ativo"],
                $dados["id"]
        ]);

        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Local alterado com sucesso"];
            }
        return ["sucesso" => true, "msg" => "Erro ao altera local" . $qry];
    }

    //5
    private function SearchExisteLocal(string $str){
        $busca = str_replace(" ", "", trim($str));
        $select = "SELECT * FROM tbLojas 
                    WHERE (
                            idLoja IS NULL
                            AND REPLACE(nomeLoja, ' ', '')LIKE ?
                        AND idLoja = ?
                        )";
        $qry = $this->db->buscar($select, [$busca,$busca]);

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idLoja"],
                    "nome" => $value["nomeLoja"],
                    "ativo" => $value["ativoLoja"],
                ]; 
            }
            return ["sucesso" => true, "msg" => "Já existe um resgitro com esse nome", "result" => $list];
        }
        return ["sucesso" => false, "msg" => "Erro"];
    }

    //6
    private function salvarLocal(array $dados){
        $select = "INSERT INTO tbLojas
                            (nomeLoja,ativoLoja) 
                            VALUES (?,?)";
        $qry = $this->db->executarSQL($select, [$dados["nome"], $dados["ativo"]]);
        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Registro salvo com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Erro ao salvar o registro"];
    }

    ///funcionario
    //1
    public function getLoadListTableFuncionario(array $dados){
        $jsonDados = json_decode($dados["dados"], true);

        $dadosT = $this->app->limparInputs($jsonDados);

        $paginaSet = ($dadosT["paginaSet"] == 0 ? 1 : $dadosT["paginaSet"]);
        $limite = 7;
        $inicio = ($paginaSet * $limite) - $limite;
        
        $select = "WITH result AS (SELECT fu.*, lo.nomeLoja 
                                    FROM tbFuncionario fu 
                                    LEFT JOIN tbLojas lo
                                    ON lo.idLoja = fu.lojaFuncionario ";

        $selectFim = "ORDER BY fu.idFuncionario ASC)
                        SELECT *, (SELECT COUNT(*) FROM result ) AS totalRegistro FROM result LIMIT " . $inicio . "," . $limite;
        $sqlFInal = $select . $selectFim;
        $qry = $this->db->buscar($sqlFInal);

        if($dadosT["nomeColaborador"] != '' || $dadosT["codColaborador"] != ''){
            $busca = "%" . (($dadosT["nomeColaborador"]) == '' ? '*****************' : $dadosT["nomeColaborador"]) . "%";
            $where = " WHERE (fu.codFuncionarioFuncionario IS NULL
                                    OR fu.nomeFuncionario LIKE ?
                                    OR fu.codFuncionarioFuncionario = ? )";
            $sqlFInal = $select . $where . $selectFim;
            $qry = $this->db->buscar($sqlFInal,[$busca,$dadosT["codColaborador"]]);
        }

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idFuncionario"],
                    "codColaborador" => $value["codFuncionarioFuncionario"],
                    "nome" => $value["nomeFuncionario"],
                    "loja" => $value["lojaFuncionario"],
                    "nomeLoja" => $value["nomeLoja"],
                    "totalRegistro" => $value["totalRegistro"],
                    "ativo" => $value["ativoFuncionario"],
                    "limite" => $limite,
                ];
            }
        }
        return $list;
    }

    //2
    public function CRUDFuncionario(array $dados){
        $jsonDados = json_decode($dados["dados"], true);
        $dadosT = $this->app->limparInputs($jsonDados);
        switch($dadosT["action"]){
            case 'excluir':
                $result = $this-> excluirFuncionario($dadosT["id"]);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
            case 'editar':
                $resultSearch = $this->SearchExisteFuncionario($dadosT);
                if($resultSearch["sucesso"]){
                    return ["sucesso" => false, "msg" => $resultSearch["msg"]];
                } else {
                    $result = $this->editarFuncionario($dadosT);
                    return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                }
                break;
            case 'salvar':
                $resultSearch = $this->SearchExisteFuncionario($dadosT);
                if($resultSearch["sucesso"]){
                    return ["sucesso" => false, "msg" => $resultSearch["msg"]];
                } else {
                    $result = $this->salvarFuncionario($dadosT);
                    return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                }
                break;
        }
    }

    //3
    private function excluirFuncionario(int $id){
        $dados = [
            "action" => "colaborador",
            "buscar" => $id
        ];
        $result  = $this->checkExisteRegistro($dados);
        if($result["sucesso"]){
            return ["sucesso" => false, "msg" => "O colaborador não pode ser excluido, pois já tem registro."];
        } else {
            $select = "DELETE FROM tbFuncionario WHERE codFuncionarioFuncionario = ?";
            $qry = $this->db->executarSQL($select, [$id]);
    
            if($qry->rowCount() >= 0){
                return ["sucesso" => true, "msg" => "Colaborador excluido com sucesso"];
            }
            return ["sucesso" => false, "msg" => "Erro ao excluida cruso" . $qry];
        }
    }

    //4
    private function editarFuncionario(array $dados){
        $select = "UPDATE tbFuncionario 
                    SET nomeFuncionario=?,lojaFuncionario=?,ativoFuncionario=?
                    WHERE codFuncionarioFuncionario = ?";
        $qry = $this->db->executarSQL($select, [
                $dados["nomeColaborador"],
                $dados["loja"] != '' ? $dados["loja"] : null,
                $dados["ativo"] != '' ? $dados["ativo"] : 1,
                $dados["codColaborador"]
        ]);

        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Colaborador alterado com sucesso"];
            }
        return ["sucesso" => true, "msg" => "Erro ao altera local" . $qry];
    }

    //5
    private function SearchExisteFuncionario(array $dados){
        $buscaNome = str_replace(" ", "", trim($dados["nomeColaborador"]));
        $select = "SELECT * 
                    FROM tbFuncionario fu 
                    WHERE (fu.codFuncionarioFuncionario IS NULL
                            OR fu.codFuncionarioFuncionario = ?
                            OR REPLACE(fu.nomeFuncionario, ' ', '') LIKE ?);";
        $qry = $this->db->buscar($select, [$dados["codColaborador"], $buscaNome]);
        if(count($qry) > 0){
            if($dados["action"] == "editar"){
                return ["sucesso" => false, "msg" => "Está em edição pode passar"];
            } else {
                return ["sucesso" => true, "msg" => "Já existe um resgitro com esse código"];
            }
        }
        return ["sucesso" => false, "msg" => "Erro"];
    }

    public function SearchDadosFuncionario(array $dados){
        $jsonDados = json_decode($dados["dados"]);

        $dadosT = $this->app->limparInputs($jsonDados);

        $select = "SELECT fu.*, lo.nomeLoja
                    FROM tbFuncionario fu 

                    LEFT JOIN tbLojas lo
                    ON lo.idLoja = fu.lojaFuncionario
                    WHERE fu.codFuncionarioFuncionario = ?";
        $qry = $this->db->buscar($select, [$dadosT["codColaborador"]]);
        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idFuncionario"],
                    "codColaborador" => $value["codFuncionarioFuncionario"],
                    "nomeColaborador" => $value["nomeFuncionario"],
                    "local" => $value["nomeLoja"],
                ];
            }
        }
        return $list;
    }

    //6
    private function salvarFuncionario(array $dados){
        $loja = $dados["loja"] == 0 ? null : $dados["loja"];
        $select = "INSERT INTO tbFuncionario
                            (codFuncionarioFuncionario,nomeFuncionario,lojaFuncionario,ativoFuncionario) 
                            VALUES (?,?,?,?)";
        $qry = $this->db->executarSQL($select, [$dados["codColaborador"],$dados["nomeColaborador"],$loja, $dados["ativo"] ?? 1]);
        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Registro salvo com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Erro ao salvar o registro"];
    }

    /////**
    private function checkExisteRegistro(array $dados){
        $action = $dados["action"];
        $busca = $dados["buscar"];
        switch($action){
            case "colaborador":
                $where = " where fo.codFuncionarioFormacao=? ";
                break;
            case "local":
                $where = " where fo.codLocalFormacao=? ";
                break;
            case "curso":
                $where = " where fo.codFormacaoNomeFormacao=? ";
                break;
        }
        $select = "SELECT * FROM tbFormacao fo 
                     {$where} LIMIT 1";
        $qry = $this->db->buscar($select,[$busca]);
        if(count($qry) > 0){
            return ["sucesso" => true, "msg" => "Registro encontrado"];
            }
        return ["sucesso" => false, "msg" => "Nenhum registro encontrado"];
    }

    public function loadListLoja(){
        $select = "SELECT * FROM tbLojas ORDER BY nomeLoja ASC";
        $qry = $this->db->buscar($select);

        $list = [];
        if(count($qry) > 0){
                foreach($qry as $value){
                    $list[] = [
                        "id" => $value["idLoja"],
                        "nome" => $value["nomeLoja"],
                        "ativo" => $value["ativoLoja"],
                    ];
                }
        }
        return $list;
    }

    public function loadListCurso(){
        $select = "SELECT * FROM  tbFormacaoNome  ORDER BY nomeFormacaoNome ASC";
        $qry = $this->db->buscar($select);

        $list = [];
        if(count($qry) > 0){
                foreach($qry as $value){
                    $list[] = [
                        "id" => $value["idFormacaoNome"],
                        "nome" => $value["nomeFormacaoNome"],
                        "ativo" => $value["ativoFormacaoNome"],
                    ];
                }
        }
        return $list;
    }
}
