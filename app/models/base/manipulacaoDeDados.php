<?php

require_once 'DBConnection.php';

class manipulacaoDeDados extends DBConnection
{
    protected $sql;
    protected $tabela;
    protected $campos;
    protected $dados;
    protected $msg;
    protected $valorNaTabela;
    protected $valorPesquisa;
    protected $urlPageAtual;
    protected $txtManipula;

    public function getSql()
    {
        return $this->sql;
    }

    public function setTabela($tbl)
    {
        $this->tabela = $tbl;
    }

    public function setCampos($campo)
    {
        $this->campos = $campo;
    }

    public function setDados($dado)
    {
        $this->dados = $dado;
    }

    public function getMsg()
    {
        return $this->msg;
    }

    public function setValorNaTabela($val)
    {
        $this->valorNaTabela = $val;
    }

    public function setValorPesquisa($pesq)
    {
        $this->valorPesquisa = $pesq;
    }

    public function setValorManipula($text)
    {
        $this->txtManipula = $text;
    }

    public function inserir()
    {
        $this->sql = "INSERT INTO $this->tabela ($this->campos) VALUES (?)";
        try {
            $stmt = $this->executarSQL($this->sql, str_repeat('s', count(explode(',', $this->dados))), explode(',', $this->dados));
            $this->msg = "";
        } catch (Exception $e) {
            $this->msg = "Erro ao inserir: " . $e->getMessage();
        }
    }

    public function excluir()
    {
        $this->sql = "DELETE FROM $this->tabela WHERE $this->valorNaTabela = ?";
        try {
            $stmt = $this->executarSQL($this->sql, "s", [$this->valorPesquisa]);
            $this->msg = "";
        } catch (Exception $e) {
            $this->msg = "Erro ao excluir: " . $e->getMessage();
        }
    }

    public function alterar()
    {
        $this->sql = "UPDATE $this->tabela SET $this->campos WHERE $this->valorNaTabela = ?";
        try {
            $stmt = $this->executarSQL($this->sql, "s", [$this->valorPesquisa]);
            $this->msg = "";
        } catch (Exception $e) {
            $this->msg = "Erro ao alterar: " . $e->getMessage();
        }
    }

    public function ultimoRegistro($campo, $tabela)
    {
        $sql = "SELECT $campo FROM $tabela ORDER BY $campo DESC LIMIT 1";
        try {
            $stmt = $this->executarSQL($sql);
            $linha = $this->listar($stmt);
            return $linha["$campo"];
        } catch (Exception $e) {
            $this->msg = "Erro ao obter o último registro: " . $e->getMessage();
            return null;
        }
    }

    public function manipula()
    {
        $this->sql = $this->txtManipula;
        try {
            $stmt = $this->executarSQL($this->sql);
            $this->msg = "";
        } catch (Exception $e) {
            $this->msg = "Erro ao manipular: " . $e->getMessage();
        }
    }
}
?>