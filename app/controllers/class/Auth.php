<?php
    class Auth {
        private $db;

        public function __construct() {
            $this->db = new manipulacaoDeDados();
        }

        public function validar($usuario, $senhaPlana) {
            $senhaHash = hash("sha256", $senhaPlana);
            
            $sql = "SELECT * FROM tbUser 
                    WHERE loginUser = ? 
                    AND passUser = ? 
                    AND ativoUser = 1
                    LIMIT 1";

            $stmt = $this->db->executarSQL($sql, [$usuario, $senhaHash]);
            $dados = $this->db->listar($stmt);

            return $dados;
        }
    }
