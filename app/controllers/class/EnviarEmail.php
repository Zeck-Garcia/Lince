<?php
    require_once __DIR__ . '/ConfigEmail.php';

class EnviarEmail {
    private $configEmail;
    private $app;
    private $anoY;

    public function __construct()
    {
        $this->app = new Application();
        $this->configEmail = new configEmail();
        $this->anoY = date("Y");
    }

    /**
     * faz o gerenciamento para onde vai o email
     */
    public function gerirEnvio(array $dados){
        $dadosJson = json_decode($dados["dados"], true);
        $dadosT = $this->app->limparInputs($dadosJson);
        $action = $dadosT["action"];
        
        switch($action){
            case "externo":
                $this->enviarEmailExterno($dadosT);
                break;
            case "interno":
                //interno
                $this->enviarEmailInterno($dadosT);
                break;
        }
    }

    private function enviarEmailInterno(array $dados){
        switch($dados["action"]){
            case "resetarSenha":
                $dadosSendResetSenha = [
                    "email" => $dados["email"],
                    "senha" => $dados["senha"],
                ];
                //$this->resetSenha($dadosSendResetSenha);
                break;
        }
    }

    private function enviarEmailExterno(array $dados){
        $action = $dados["action"];
         if($action == "pin"){
            $dadosSend = [
                "nome" => $dados["nome"],
                "pinNumber" => $dados["pinNumber"],
                "email" => $dados["email"],
            ];
            $result = $this->inicio($dadosSend);

            return [
                    "sucesso" => $result["sucesso"],
                    "msg" => $result["msg"],
                ];
        }
    }

    private function inicio(array $dados){
        $email = $dados["email"];
        $nome = $dados["nome"];

        $assunto = "Recuperação de Acesso - Guepardo Entregas";
        $mensagem = "Texto do email";
        $mensagemAlt = "Mensagem em texto simples";

        $result = $this->configEmail->enviar(
            $email,
            $nome, 
            $assunto,  
            $mensagem,
            $mensagemAlt
        );

        if ($result) {
            return [
                "sucesso" => true,
                "msg" => "Email enviado com sucesso"];
        } else {
            return [
                "sucesso" => false,
                "msg" => $result["msg"],
            ];
        }
    }
}
