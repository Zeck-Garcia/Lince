<?php
    class Auth {
        private $db;

        public function __construct() {
            $this->db = new manipulacaoDeDados();
        }

        public function validar($usuario, $senhaPlana) {
            $senhaHash = hash("sha256", $senhaPlana);
            
            $sql = "SELECT us.*, cl.slugClasse, cl.nomeClasse, si.idLogin
                    FROM tbUser us
                    
                    LEFT JOIN tbClasse cl
                    ON cl.idClasse = us.classeUser 

                    LEFT JOIN tbUserSistema si
                    ON si.idLogin = us.idUser

                    WHERE us.loginUser = ? 
                    AND us.passUser = ? 
                    AND us.ativoUser = 1
                    LIMIT 1";

            $stmt = $this->db->executarSQL($sql, [$usuario, $senhaHash]);
            $dados = $this->db->listar($stmt);

            return $dados;
        }
    }
