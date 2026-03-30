<?php
class Fornecedor{
    private $db;
    private $app;

    public function __construct()
    {
        $this->db = new manipulacaoDeDados();
        $this->app = new Application();
    }

    public function getLoadListFornecedor(array $dados){
        $jsonDados = json_decode($dados["dados"], true);
        $dadosT = $this->app->limparInputs($jsonDados);

        $paginaSet = ($dadosT["paginaSet"] == 0 ? 1 : $dadosT["paginaSet"]);
        $limite = 7;
        $inicio = ($paginaSet * $limite) - $limite;

        $select = "WITH result AS (SELECT * FROM tbFornecedor WHERE 1=1";
        
        $selectWhere = " ORDER BY idFornecedor ASC)
        SELECT *, (SELECT COUNT(*) FROM result ) AS totalRegistro FROM result ORDER BY idFornecedor ASC LIMIT " . $inicio . "," . $limite;
        
        $where = '';
        $param = [];

        if(isset($dadosT["buscarPor"]) && $dadosT["buscarPor"] != ''){
            $where .= " AND (nomeFornecedor LIKE ? OR CAST(idFornecedor AS CHAR) = ?) ";
            $param[] = "%".$dadosT["buscarPor"]."%";
            $param[] = $dadosT["buscarPor"];
        }

        if(isset($dadosT["slcSituacao"]) && $dadosT["slcSituacao"] != 2 && $dadosT["slcSituacao"] != "" && $dadosT["buscarPor"] == ''){
            $where .= " AND ativoFornecedor = ? ";
            $param[] = $dadosT["slcSituacao"];
        }

        $selectCompleta = $select . $where . $selectWhere;
        
        $qry = $this->db->buscar($selectCompleta,$param);

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idFornecedor"],
                    "nome" => $value["nomeFornecedor"],
                    "site" => $value["siteFornecedor"],
                    "email" => $value["emailFornecedor"],
                    "idCriador" => $value["idCriadorFornecedor"],
                    "classeCriador" => $value["classeCriadorFornecedor"],
                    "dataCriacao" => $value["dataCriacaoFornecedor"],
                    "ativo" => $value["ativoFornecedor"],
                    "morada" => $value["moradaFornecedor"],
                    "contacto" => $value["contactoFornecedor"],
                    "telefone" => $value["telefoneFornecedor"],
                    "responsavel" => $value["responsavelFornecedor"],
                    "concelho" => $value["concelhoFornecedor"],
                    "distrito" => $value["distritoFornecedor"],
                    "codPostal" => $value["codPostalFornecedor"],
                    "limite" => $limite,
                    "totalRegistro" => $value["totalRegistro"],
                ];
            }
        }
        return $list;
        //return $dados;
    }

    public function getDadosFornecedorById(int $id){
        $select = "SELECT * FROM tbFornecedor WHERE idFornecedor=?";
        $qry = $this->db->buscar($select, [$id]);
        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "id" => $value["idFornecedor"],
                    "nome" => $value["nomeFornecedor"],
                    "site" => $value["siteFornecedor"],
                    "email" => $value["emailFornecedor"],
                    "idCriador" => $value["idCriadorFornecedor"],
                    "classeCriador" => $value["classeCriadorFornecedor"],
                    "dataCriacao" => $value["dataCriacaoFornecedor"],
                    "ativo" => $value["ativoFornecedor"],
                    "morada" => $value["moradaFornecedor"],
                    "contacto" => $value["contactoFornecedor"],
                    "telefone" => $value["telefoneFornecedor"],
                    "responsavel" => $value["responsavelFornecedor"]
                ];
            }
        }

        return $list;
    }

    public function SearchDadosFornecedor(string $id){
        $busca = str_replace(array("'", '"'), '', trim(strip_tags($id)));
        $select = "SELECT * FROM tbFornecedor WHERE idFornecedor = ? OR nomeFornecedor LIKE ? ORDER BY tbFornecedor.nomeFornecedor LIMIT 1";
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

    public function CRUDFornecedor(array $dados){
        $dadosJson = json_decode($dados["dados"], true);
        $dadosT = $this->app->limparInputs($dadosJson);

        switch($dadosT["action"]){
            case "salvar":
                $result = $this->salvar($dadosT);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
            case "editar":
                $result = $this->editar($dadosT);
                return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                break;
            case "excluir":
                $result = $this->existeRegistro($dadosT["id"]);

                if($result["sucesso"]){
                    return ["sucesso" => false, "msg" => $result["msg"]];
                } else {
                    $result = $this->excluir($dadosT["id"]);
                    return ["sucesso" => $result["sucesso"], "msg" => $result["msg"]];
                    break;
                }
        }
    }
        
    private function salvar(array $dados){
        $select = "INSERT INTO tbFornecedor
                    (nomeFornecedor, siteFornecedor, emailFornecedor, idCriadorFornecedor, classeCriadorFornecedor, dataCriacaoFornecedor, ativoFornecedor, moradaFornecedor, contactoFornecedor, telefoneFornecedor, concelhoFornecedor, distritoFornecedor, codPostalFornecedor) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $qry = $this->db->executarSQL($select,[
                $dados["nome"],
                $dados["site"],
                $dados["email"],
                $_SESSION["idAgente"],
                $_SESSION["classeAgente"],
                date("Y-m-d"),
                1,
                $dados["morada"],
                $dados["contacto"],
                $dados["telefone"],
                $dados["concelho"],
                $dados["distrito"],
                $dados["codPostal"]
        ]);

        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Dados salvo com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Houve um erro ao salvar os dados, consulte a lista de fornecedor"];
    }

    private function editar(array $dados){
        $select = "UPDATE tbFornecedor 
                    SET nomeFornecedor=?,
                    siteFornecedor=?,
                    emailFornecedor=?,
                    ativoFornecedor=?,
                    moradaFornecedor=?,
                    contactoFornecedor=?,
                    telefoneFornecedor=?,
                    concelhoFornecedor=?,
                    distritoFornecedor=?,
                    codPostalFornecedor=? WHERE idFornecedor=?";

        $qry = $this->db->executarSQL($select,[
                $dados["nome"],
                $dados["site"],
                $dados["email"],
                $dados["ativo"],
                $dados["morada"],
                $dados["contacto"],
                $dados["telefone"],
                $dados["concelho"],
                $dados["distrito"],
                $dados["codPostal"],
                $dados["id"]
        ]);

        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Dados salvo com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Houve um erro ao salvar os dados, consulte a lista de fornecedor"];
    }

    private function excluir(int $id){
        $select = "DELETE FROM tbFornecedor WHERE idFornecedor=?";

        $qry = $this->db->executarSQL($select,[$id]);

        if($qry->rowCount() >= 0){
            return ["sucesso" => true, "msg" => "Dados excluido com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Houve um erro ao salvar os dados, consulte a lista de fornecedor"];
    }

    private function existeRegistro(int $id){
        $select = "SELECT 
                    CASE 
                        WHEN 
                            EXISTS (SELECT 1 FROM tbOrderCompra WHERE idFornecedorOrderCompra=?)
                        THEN 1 
                        ELSE 0
                    END AS ExisteRegisto";
        $qry = $this->db->buscar($select,[$id]);

        if($qry[0]["ExisteRegisto"] == 0){
            return ["sucesso" => false, "msg" => "Pode seguir para exluir o registro"];
        }
        return ["sucesso" => true, "msg" => "Este fornecedor já tem registro e não pode ser excluido"];
    }
}