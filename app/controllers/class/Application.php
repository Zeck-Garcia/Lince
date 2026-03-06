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
            $limpos[$key] = str_replace(array("'", '"'), '', trim(strip_tags($val)));
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

        $select = "WITH result AS (SELECT ud.*, dp.nomeDepartamento, ca.nomeCargo, cl.nomeClasse FROM tbUserDados ud

                    LEFT JOIN tbDepartamento dp
                    ON dp.idDepartamento = ud.departamentoUserDados

                    LEFT JOIN tbCargo ca
                    ON ca.idCargo = ud.cargoUserDados

                    LEFT JOIN tbClasse cl
                    ON cl.idClasse = ud.classeUserDados WHERE 1=1 ";

        $param = [];
        $where = '';
        if($dadosT["nomeUser"] != ''){
            $where = " AND nomeUserDados=? ";
            $param[] = "";
        }

        if($dadosT["departamentoUser"] != 0){
            $where = " AND departamentoUserDados=? ";
            $param[] = "";
        }

        if($dadosT["cargoUser"] != 0){
            $where = " AND cargoUserDados=? ";
            $param[] = "";
        }

        if($dadosT["codColaboradorUser"] != 0){
            $where = " AND codColaboradorUserDados=? ";
            $param[] = "";
        }

        $selectFim = " ORDER BY ud.idUserDados ASC)
                            SELECT *, (SELECT COUNT(*) FROM result ) AS totalRegistro FROM result ORDER BY nomeUserDados ASC LIMIT " . $inicio . "," . $limite;

        $selectCompleta = $select . $where . $selectFim;

        $qry = $this->db->buscar($selectCompleta);
        if($where != ''){
            $qry = $this->db->buscar($selectCompleta, $param);
        }

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "idUser" => $value["idUserDados"],
                    "codColaborador" => $value["codColaboradorUserDados"],
                    "idLogin" => $value["idLogin"],
                    "nomeUser" => $value["nomeUserDados"],
                    "idDepartamentoUser" => $value["departamentoUserDados"],
                    "nomeDepartamentoUser" => $value["nomeDepartamento"],
                    "idCargoUser" => $value["cargoUserDados"],
                    "nomeCargoUser" => $value["nomeCargo"],
                    "idClasseUser" => $value["classeUserDados"],
                    "nomeClasseUser" => $value["nomeClasse"],
                    "emailUser" => $value["emailUserDados"],
                    "dataCriacaoUser" => $value["dataCriadoUserDados"],
                    "receberEmail" => $value["receberEmailUserDados"],
                    "ativo" => $value["ativoUserDados"],
                    "limite" => $limite,
                    "totalRegistro" => $value["totalRegistro"],
                ];
            }
        }
        return $list;
    }

    
}
