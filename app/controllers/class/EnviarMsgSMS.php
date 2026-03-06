<?php

class EnviarMsgSMS{
    private $app;
    private $configSms;

    public function __construct()
    {
        $this->configSms = new ConfigMsgSMS();
        $this->app = new Application();
    }

    public function gerirEnvio(array $dados){
        $jsonDados = json_decode($dados["dados"], true);

        $dadosT = $this->app->limparInputs($jsonDados);
        $dadosSend = [
            "send" => 'GUEPARDO', // Max 11 letras
        ];
        $result = $this->inicio($dadosSend);
        if ($result) {
            return [
                "sucesso" => true,
                "msg" => "SMS enviado com sucesso"
            ];
        } else {
            return [
                "sucesso" => false,
                "msg" => $result["msg"],
            ];
        }
    }

    private function inicio(array $dados){
        $send = $dados['send'];
        $contacto = '99999999999';
        $msgText = "A data de entrega da sua encomenda da foi alterada. Agora sera entregue dia ";
        $result = $this->configSms->sendSMS($msgText, $contacto, $send);
        if ($result) {
            return [
                "sucesso" => true,
                "msg" => "SMS enviado com sucesso"];
        } else {
            return [
                "sucesso" => false,
                "msg" => $result["msg"],
            ];
        }
    }
}
