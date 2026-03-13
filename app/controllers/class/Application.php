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

        $select = "WITH result AS (SELECT ud.*, dp.nomeDepartamento, ca.nomeCargo, cl.nomeClasse 
                    FROM tbFuncionario ud

                    LEFT JOIN tbDepartamento dp
                    ON dp.idDepartamento = ud.departamentoFuncionario

                    LEFT JOIN tbCargo ca
                    ON ca.idCargo = ud.cargoFuncionario

                    LEFT JOIN tbClasse cl
                    ON cl.idClasse = ud.classeFuncionario WHERE 1=1 ";

        $param = [];
        $where = '';
        if($dadosT["nomeUser"] != ''){
            $where = " AND ud.nomeFuncionario=? ";
            $param[] = "";
        }

        if($dadosT["departamentoUser"] != 0){
            $where = " AND ud.departamentoFuncionario=? ";
            $param[] = "";
        }

        if($dadosT["cargoUser"] != 0){
            $where = " AND ud.cargoFuncionario=? ";
            $param[] = "";
        }

        if(isset($dadosT["codColaboradorUser"]) ? $dadosT["codColaboradorUser"] != 0: false){
            $where = " AND codFuncionarioFuncionario=? ";
            $param[] = "";
        }

        $selectFim = " ORDER BY ud.idFuncionario ASC)
                            SELECT *, (SELECT COUNT(*) FROM result ) AS totalRegistro FROM result ORDER BY nomeFuncionario ASC LIMIT " . $inicio . "," . $limite;

        $selectCompleta = $select . $where . $selectFim;

        $qry = $this->db->buscar($selectCompleta);
        if($where != ''){
            $qry = $this->db->buscar($selectCompleta, $param);
        }

        $list = [];
        if(count($qry) > 0){
            foreach($qry as $value){
                $list[] = [
                    "idUser" => $value["idFuncionario"],
                    "codColaborador" => $value["codFuncionarioFuncionario"],
                    "idLogin" => $value["idLidLoginFuncionarioogin"],
                    "nomeUser" => $value["nomeFuncionario"],
                    "idDepartamentoUser" => $value["dp.idDepartamento"],
                    "nomeDepartamentoUser" => $value["nomeDepartamento"],
                    "idCargoUser" => $value["ca.idCargo"],
                    "nomeCargoUser" => $value["nomeCargo"],
                    "idClasseUser" => $value["cl.idClasse"],
                    "nomeClasseUser" => $value["nomeClasse"],
                    "emailUser" => $value["emailFuncionario"],
                    "dataCriacaoUser" => $value["dataCadastroFuncionario"],
                    "receberEmail" => $value["receberEmailFuncinonario"],
                    "ativo" => $value["ativo"],
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
}
