<?php


include_once "DBConnection.php";

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
    protected $stmt; // Para prepared statements
    protected $types; // Tipos dos parâmetros para prepared statements
    protected $params = []; // Valores dos parâmetros para prepared statements

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

    public function setTypes($types)
    {
        $this->types = $types;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }

    public function setTipoValorPesquisa($type)
    {
        $this->tipoValorPesquisa = $type;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function prepararSQL($sql)
    {
        $this->stmt = $this->conexao->prepare($sql);
        if (!$this->stmt) {
            throw new Exception("Erro ao preparar a query: " . $this->conexao->error);
        }
        return $this->stmt;
    }

    public function vincularParametros()
    {
        if ($this->stmt && $this->types && !empty($this->params)) {
            if (!mysqli_stmt_bind_param($this->stmt, $this->types, ...$this->params)) {
                throw new Exception("Erro ao vincular parâmetros: " . $this->stmt->error);
            }
        } elseif ($this->stmt) {
            // Não há parâmetros para vincular
        }
    }

    public function executarStatement()
    {
        if ($this->stmt) {
            if (!mysqli_stmt_execute($this->stmt)) {
                throw new Exception("Erro ao executar a statement: " . $this->stmt->error);
            }
            $this->qry = mysqli_stmt_get_result($this->stmt);
            return $this->qry;
        }
        return false;
    }

    public function fecharStatement()
    {
        if ($this->stmt) {
            mysqli_stmt_close($this->stmt);
            $this->stmt = null;
            $this->types = null;
            $this->params = [];
        }
    }

    public function inserir()
    {
        $placeholders = implode(', ', array_fill(0, count(explode(', ', $this->campos)), '?'));
        $this->sql = "INSERT INTO $this->tabela ($this->campos) VALUES ($placeholders)";
        $this->prepararSQL($this->sql);
        $this->vincularParametros();
        if ($this->executarStatement()) {
            $this->msg = "";
            $this->fecharStatement();
            return true;
        } else {
            $this->msg = "Erro ao inserir: " . (isset($this->stmt->error) ? $this->stmt->error : $this->conexao->error);
            $this->fecharStatement();
            return false;
        }
    }

    public function excluir()
    {
        $this->sql = "DELETE FROM $this->tabela WHERE $this->valorNaTabela = ?";
        $this->prepararSQL($this->sql);
        if (isset($this->tipoValorPesquisa)) {
            $this->types .= $this->tipoValorPesquisa;
        } else {
            $this->types .= "s";
        }
        $this->params = [$this->valorPesquisa];
        $this->vincularParametros();
        if ($this->executarStatement()) {
            $this->msg = "";
            $this->fecharStatement();
            return true;
        } else {
            $this->msg = "Erro ao excluir: " . (isset($this->stmt->error) ? $this->stmt->error : $this->conexao->error);
            $this->fecharStatement();
            return false;
        }
    }

    public function alterar()
    {
        $setClauses = array_map(function($field) {
            return "$field = ?";
        }, explode(', ', $this->campos));
        $this->sql = "UPDATE $this->tabela SET " . implode(', ', $setClauses) . " WHERE $this->valorNaTabela = ?";
        $this->prepararSQL($this->sql);
        if (!empty($this->types) && !empty($this->params) && isset($this->valorPesquisa)) {
            if (isset($this->tipoValorPesquisa)) {
                $this->types .= $this->tipoValorPesquisa;
            } else {
                $this->types .= "s";
            }
            $this->params[] = $this->valorPesquisa;
            $this->vincularParametros();
            if ($this->executarStatement()) {
                $this->msg = "";
                $this->fecharStatement();
                return true;
            } else {
                $this->msg = "Erro ao alterar: " . (isset($this->stmt->error) ? $this->stmt->error : $this->conexao->error);
                $this->fecharStatement();
                return false;
            }
        } else {
            $this->msg = "Tipos, parâmetros ou valor de pesquisa não definidos para alterar.";
            $this->fecharStatement();
            return false;
        }
    }

    public function ultimoRegistro($campo, $tabela)
    {
        $sql = "SELECT $campo FROM $tabela ORDER BY $campo DESC LIMIT 1";
        $qry = $this->executarSQL($sql);
        $linha = $this->listar($qry);
        return $linha ? $linha[0]["$campo"] : null;
    }

    public function manipula()
    {
        $this->sql = "$this->txtManipula";
        if ($this->executarSQL($this->sql)) {
            $this->msg = "";
        } //$operacao->setValorManipula($sqlPersonalizado);
    }
}


?>
