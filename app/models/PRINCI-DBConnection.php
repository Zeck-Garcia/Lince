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
			$this->servidor 	="localhost";
			$this->usuario		="zeck"; //privado_protec_user
			$this->senha		="123456"; //xgUNJMou6ZMK
			$this->banco		="Lince"; //privado_protec
			$this->conectar();

		}
		function conectar()
		{
			$this->conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);

			$this->conexao->set_charset("utf8");
		}

		function executarSQL($sql)
		{

			$this->qry = mysqli_query($this->conexao, $sql);
			return $this->qry;
		}
		function listar($qr)
		{
			$this->dados= mysqli_fetch_assoc($qr);
			return $this->dados;
		}
		
		function contaDados($qry){
			$this->totalDados = mysqli_num_rows($qry);
			return $this->totalDados;
		}
}

?>