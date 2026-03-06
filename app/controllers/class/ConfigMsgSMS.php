<?php
class ConfigMsgSMS
{
    private $apiKey;
    private $apiUrl = 'https://api.closum.com/v2/sms/send/';

    public function __construct()
    {
        $this->apiKey = "key";
    }

    /**
     * Envia um SMS através da API Closum.
     *
     * @param string $message O conteúdo da mensagem.
     * @param string $recipient O número de telemóvel do destinatário (com código do país).
     * @param string $sender O nome do remetente ou número de telefone.
     * @param string|null $sendTime Opcional. Data/hora para agendar o envio (formato ISO 8601).
     * @return array Um array contendo o 'status' (código HTTP) e a 'body' (resposta descodificada da API).
     */
    public function sendSMS($message, $recipient, $sender, $sendTime = null)
    {
        $data = [
            'message' => $message,
            'recipient' => $recipient,
            'sender' => $sender,
        ];

        if ($sendTime !== null) {
            $data['send_time'] = $sendTime;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->apiUrl . '?api-key=' . $this->apiKey,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            return [
                'sucesso' => false,
                'msg' => "Erro de cURL: " . $error,
            ];
        }

        curl_close($curl);

        $decodedResponse = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
             $decodedResponse = "raw_response \n {$response}, decoding_error \n Failed to decode JSON";
        }

        return [
            'sucesso' => $httpCode,
            'msg' => $decodedResponse,
        ];
    }
}

