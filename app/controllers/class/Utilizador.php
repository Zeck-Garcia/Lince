<?php

class Utilizador{
    private $db;

    public function __construct()
    {
        $this->db = new manipulacaoDeDados();
    }

    public function getUtilizadorById(int $id){
        $select = "SELECT * FROM tbUserSistema WHERE idUserDados = ?";
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
                    "dataCriacao" => $value["dataCriadoUserDados"],
                    "recebeEmail" => $value["receberEmailUserDados"],
                    "ativo" => $value["ativoUserDados"],
                ];
            }
        }
        return $list;
    }
}