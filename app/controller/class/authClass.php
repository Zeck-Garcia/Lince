<?php

class logar{
    protected $operation;
    protected $loginUser;
    protected $passwordUser;
    
    public function __construct($operation) {
        $this->operation = $operation;
    }

    public function login($loginUser, $passwordUser) {
        if ($this->logado($loginUser, $passwordUser)) {
            return true;
        }

        $this->clearSession();
        return false;
    }

    private function logado($loginUser, $passwordUser) {
        
        $sql = "SELECT * FROM tbUser WHERE loginUser = ? AND passUser = ? AND ativoUser = 1";

        $stmt = $this->operation->prepararSQL($sql);
        $types = "ss";
        $params = [$loginUser, $passwordUser];
        $this->operation->setTypes($types);
        $this->operation->setParams($params);
        $this->operation->vincularParametros();
        $qry = $this->operation->executarStatement();

        if ($qry && $qry->num_rows > 0) {
            $dados = $qry->fetch_assoc();

            if ($dados["loginUser"] === $loginUser && $dados["passUser"] === $passwordUser) {
                session_start(); 
                $_SESSION["idUser"] = $dados["idUser"];
                $_SESSION["nomeAgente"] = $dados["nomeUser"];
                $_SESSION["classeAgente"] = $dados["classeUser"];
                $_SESSION["sessionTime"] = date("H:i:s");

                session_regenerate_id(true);
                $this->operation->fecharStatement();
                return true;
            }
        }

        $this->operation->fecharStatement();
        return false;
    }

    private function clearSession() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = array();

            if (isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 42000, '/');
            }
            session_unset();
            session_destroy();
        }
    }
    
}
?>