<?php
class ConfigMsgSMS {
    private $send = 'GFeira'; //11 caract
    private $key = "FSsd2016";
    private $account = "FeiradosSofas";

    public function sendSMS(array $dados){
        if($dados["contacto"] == '') return ["sucesso" => false, "msg" => "O contacto está vazio, e não pode ser enviado a mensagem"]; 
        $dadosSend = [
                "account" => $this->account,
                "licensekey" => $this->key,
                "phoneNumber" => $dados["contacto"],
                "messageText" => $dados["mensagem"],
                "alfaSender" => $this->send
            ];

        $url = "http://sms.ez4uteam.com/ez4usms/API/sendSMS.php?" . http_build_query($dadosSend);

        $result = @file_get_contents($url);
        $json = json_decode($result, true);
        if($json["Result"] == "OK"){
            return ["sucesso" => true, "msg" => "SMS enviado com sucesso"];
        }
        return ["sucesso" => false, "msg" => "Erro ao enviar SMS erro: " . $json["ErrorDesc"]];
    }
}

