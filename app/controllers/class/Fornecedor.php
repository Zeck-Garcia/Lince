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
            $where = " AND (nomeFornecedor LIKE ? OR idFornecedor = ?) ";
            $param[] = "%".$dadosT["buscarPor"]."%";
            $param[] = $dadosT["buscarPor"];
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
}