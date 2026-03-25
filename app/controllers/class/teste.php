<?php
class Postmark
{
    private $api_token = "274308ba-dfe9-4655-8ef2-47b3e5fb85ee";
    private $ch;
    private $response;
    private $http_code;
    private $error;
    private $debug = true; // Modo debug ativado

    public function call($data, $method = "email")
    {
        $this->ch = curl_init();

        if ($this->debug) {
            // error_log("[Postmark] Iniciando chamada para: email");
            // error_log("[Postmark] Dados enviados: " . json_encode($data));
        }

        curl_setopt($this->ch, CURLOPT_URL, "https://api.postmarkapp.com/" . $method);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
            "Accept: application/json",
            "Content-Type: application/json",
            "X-Postmark-Server-Token: " . $this->api_token
        ));

        // Segurança para PHP antigo (garante que valida o SSL)
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, true);

        $this->response = curl_exec($this->ch);
        $this->http_code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        if ($this->debug) {
            // error_log("[Postmark] HTTP Code: " . $this->http_code);
            // error_log("[Postmark] Response: " . $this->response);
        }

        if (curl_errno($this->ch)) {
            $this->error =  'Erro cURL: ' . curl_error($this->ch);
            // if ($this->debug) {
            //     error_log("[Postmark] " . $this->error);
            // }
        }

        curl_close($this->ch);
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

    private function getMimeType($filePath)
    {
        // Prioridade: finfo > mime_content_type > extensão

        if (function_exists('finfo_file')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $type = finfo_file($finfo, $filePath);
            finfo_close($finfo);
            if ($type && $type !== 'application/octet-stream') {
                return $type;
            }
        }

        if (function_exists('mime_content_type')) {
            $type = mime_content_type($filePath);
            if ($type) {
                return $type;
            }
        }

        // Fallback baseado em extensão
        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'zip' => 'application/zip',
            'txt' => 'text/plain',
            'mp4' => 'video/mp4',
            'avi' => 'video/x-msvideo',
            'mov' => 'video/quicktime'
        ];

        return $mimeTypes[$ext] ?? 'application/octet-stream';
    }

    private function anexos($anexos)
    {
        $a = [];

        if (!is_array($anexos)) {
            $anexos = array_filter(explode(";", $anexos)); // Remove elementos vazios
        }

        if (!empty($anexos)) {
            foreach ($anexos as $anexo) {
                $anexo = trim($anexo);

                // Verificar se o anexo contém o nome original (formato: filepath|original_name)
                $nomeOriginal = null;
                if (strpos($anexo, "|") !== false) {
                    list($anexo, $nomeOriginal) = explode("|", $anexo, 2);
                    $anexo = trim($anexo);
                    $nomeOriginal = trim($nomeOriginal);
                }

                if (empty($anexo) || !file_exists($anexo)) {
                    if ($this->debug) {
                        // error_log("[Postmark] Arquivo não encontrado: " . $anexo);
                    }
                    continue;
                }

                $type = $this->getMimeType($anexo);
                $displayName = !empty($nomeOriginal) ? $nomeOriginal : basename($anexo);

                if ($this->debug) {
                    // error_log("[Postmark] Anexo: " . $displayName . " | Type: " . $type);
                }

                $a[] = [
                    "ContentID" => $displayName,
                    "Name" => $displayName,
                    "ContentType" => $type,
                    "Content" => base64_encode(file_get_contents($anexo))
                ];
            }
        }

        return $a;
    }

    public function send($ob)
    {
        $data = array(
            "From" => empty($ob['remetente']) ? "noreply@feiradossofas.com" : $ob['remetente'],
            "To" => $ob['destinatario'],
            "Cc" => empty($ob['cc']) ? null : $ob['cc'],
            "Bcc" => empty($ob['bcc']) ? null : $ob['bcc'],
            "Subject" => $ob['subject'],
            "HtmlBody" => $ob['body'],
            "MessageStream" => "outbound",
            "Attachments" => $this->anexos($ob['anexos'] ?? [])
        );

        if ($this->debug) {
            // error_log("[Postmark Send] Attachments count: " . count($data['Attachments']));
            // foreach ($data['Attachments'] as $i => $att) {
            //     error_log("[Postmark Send] Attachment[$i]: " . $att['Name'] . " | ContentType: " . $att['ContentType']);
            // }
        }

        $this->call($data, "email");

        // Debug info
        // error_log("[Postmark Send] Destinatário: " . $ob['destinatario']);
        // error_log("[Postmark Send] Assunto: " . $ob['subject']);
        // error_log("[Postmark Send] HTTP Status: " . $this->http_code);

        return $this->isSuccess();
    }
}