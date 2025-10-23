<?php

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
        $this->banco = "Lince";
        $this->conectar();
    }

    function conectar()
    {
        $this->conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);

        if (!$this->conexao) {
            die("Erro de conexão: " . mysqli_connect_error());
        }

        $this->conexao->set_charset("utf8");
    }

    function executarSQL($sql, $tipos = null, $params = null)
    {
        $stmt = mysqli_prepare($this->conexao, $sql);

        if (!$stmt) {
            throw new Exception("Erro na preparação da consulta: " . mysqli_error($this->conexao));
        }

        if ($tipos && $params) {
            mysqli_stmt_bind_param($stmt, $tipos, ...$params);
        }

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Erro na execução da consulta: " . mysqli_stmt_error($stmt));
        }

        $this->qry = $stmt;
        return $stmt;
    }

    function listar($stmt)
    {
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, ...$row);
        if (mysqli_stmt_fetch($stmt)) {
            return $row;
        }
        return null;
    }

    function contaDados($stmt)
    {
        mysqli_stmt_store_result($stmt);
        return mysqli_stmt_num_rows($stmt);
    }

    public function __destruct()
    {
        if ($this->conexao) {
            mysqli_close($this->conexao);
        }
    }
}
?>