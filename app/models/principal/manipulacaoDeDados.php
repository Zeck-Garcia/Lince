<?php
	include_once("DBConnection.php");
	
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

			//global $urlPageAtual;

			$this->sql = "INSERT INTO $this->tabela ($this->campos) VALUES ($this->dados)";
			if($this->executarSQL($this->sql))
			{
				$this->msg = "";
			}
		}
		public function excluir()
		{

			//global $urlPageAtual;

			$this->sql = "DELETE FROM $this->tabela WHERE $this->valorNaTabela = $this->valorPesquisa";
			if($this->executarSQL($this->sql))
			{
				$this->msg = "";
			}		
		}

		public function alterar()
		{
			//global $urlPageAtual;

			$this->sql = "UPDATE $this->tabela SET $this->campos WHERE $this->valorNaTabela = $this->valorPesquisa";
			if($this->executarSQL($this->sql))
			{
				$this->msg = "";
			}		
		
		}
		
		public function ultimoRegistro($campo, $tabela){
			$sql 	= "SELECT $campo FROM $tabela ORDER BY $campo DESC LIMIT 1";
			$qry 	= self::executarSQL($sql);
			$linha 	= self::listar($qry);
			
			return $linha["$campo"];
		}

		public function manipula()
		{
			//global $urlPageAtual;

			$this->sql = "$this->txtManipula";
			if($this->executarSQL($this->sql))
			{
				$this->msg = "";
			}		
		
		}
		
	
	}
?>