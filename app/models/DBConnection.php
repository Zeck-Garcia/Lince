<?php
session_start();

class DBConnection
{
    protected $servidor;
    protected $usuario;
    protected $senha;
    protected $banco;
    protected $conexao;
    protected $qry;
    protected $dados;
    protected $totalDados;
    protected $sql;

    public function __construct()
    {
        $this->servidor = "localhost";
        $this->usuario = "zeck";
        $this->senha = "123456";
        $this->banco = "dbLince";
        $this->conectar();
    }

    function conectar()
    {
        $this->conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);
        $this->conexao->set_charset("utf8");
    }

    function executarSQL($sql, $types = null, $params = null)
    {
        $stmt = mysqli_prepare($this->conexao, $sql);
        if ($stmt) {
            if ($types && $params) {
                mysqli_stmt_bind_param($stmt, $types, ...$params);
            }
            mysqli_stmt_execute($stmt);
            $this->qry = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $this->qry;
        } else {
            return false;
        }
    }

    function listar($qr)
    {
        $this->dados = mysqli_fetch_all($qr, MYSQLI_ASSOC);
        return $this->dados;
    }

    function contaDados($qry)
    {
        $this->totalDados = mysqli_num_rows($qry);
        return $this->totalDados;
    }
}
?>