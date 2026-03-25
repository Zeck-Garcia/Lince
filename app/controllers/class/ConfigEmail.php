<?php
// ini_set("display_errors", 1);
// ini_set("display_startup_errors", 1);
// error_reporting(E_ALL);

class ConfigEmail {
    private $api_token = "274308ba-dfe9-4655-8ef2-47b3e5fb85ee";
    private $ch;
    private $response;
    private $http_code;
    private $error;

    public function call($data, $method = "email"){
            
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_URL, "https://api.postmarkapp.com/" . $method);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json",
            "Content-Type: application/json",
            "X-Postmark-Server-Token: " . $this->api_token
        ));

        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, true);

        $this->response = curl_exec($this->ch);
        $this->http_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        if (curl_errno($this->ch)) {
            $this->error =  'Erro cURL: ' . curl_error($this->ch);
        }

        curl_close($this->ch);

        return ($this->http_code == 200 && !$this->error);
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getHttpCode()
    {
        return $this->http_code;
    }

    public function getError()
    {
        return $this->error;
    }

    public function isSuccess()
    {
        return $this->http_code == 200;
    }

    public function enviar(array $ob){
        $data = array(
            "From" => empty($ob['remetente']) ? "noreply@feiradossofas.com" : $ob['remetente'],
            "To" => $ob['destinatario'],
            "Cc" => empty($ob['cc']) ? null : $ob['cc'],
            "Bcc" => empty($ob['bcc']) ? null : $ob['bcc'],
            "Subject" => $ob['subject'],
            "HtmlBody" => $ob['body'],
            "MessageStream" => "outbound",
            "Attachments" => isset($ob['anexos']) && count($ob['anexos']) > 0 ? $ob['anexos'] : [],
        );

        $result = $this->call($data, "email");

        if($result){
            return ["sucesso" => true, "msg" => "Email enviado com sucesso"];
        }

        $apimsg = '';
        if(!$this->error && $this->response){
            $res = json_decode($this->response, true);
            $apimsg = $res["Message"] ?? "";
        }
        return ["sucesso" => false, "msg" => $apimsg ?: "Erro na API (status: " . $this->http_code . ")"];
    }
}
