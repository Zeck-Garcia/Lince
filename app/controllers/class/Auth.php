<?php
    class Auth {
        private $db;

        public function __construct() {
            $this->db = new manipulacaoDeDados();
        }

        public function validar($usuario, $senhaPlana) {
            $senhaHash = hash("sha256", $senhaPlana);
            
            $sql = "SELECT us.*, cl.slugClasse, cl.nomeClasse, si.idUserDados, si.classeUserDados, si.nomeUserDados
                    FROM tbUser us
                    
                    LEFT JOIN tbUserSistema si
                    ON si.idLogin = us.idUser

                    LEFT JOIN tbClasse cl
                    ON cl.idClasse = si.classeUserDados 

                    WHERE us.ativoUser = 1
                    AND us.loginUser = ? 
                    AND us.passUser = ? 
                    LIMIT 1";

            $stmt = $this->db->executarSQL($sql, [$usuario, $senhaHash]);
            $dados = $this->db->listar($stmt);

            return $dados;
        }
    }
