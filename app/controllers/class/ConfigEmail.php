<?php
// ini_set("display_errors", 1);
// ini_set("display_startup_errors", 1);
// error_reporting(E_ALL);
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once __DIR__ . '../../../../public/assets/lib/PHPMailer-master/src/Exception.php';
    require_once __DIR__ . '../../../../public/assets/lib/PHPMailer-master/src/PHPMailer.php';
    require_once __DIR__ . '../../../../public/assets/lib/PHPMailer-master/src/SMTP.php';

    class ConfigEmail {
        private $mailer;
    
        // Construtor da classe
        public function __construct() {
            $this->mailer = new PHPMailer(true);
            $this->mailer->CharSet = 'UTF-8';

            // Configurações do servidor SMTP
            $this->mailer->isSMTP();
            $this->mailer->Host       = 'mail.sevirdor smtp'; // Servidor SMTP
            $this->mailer->SMTPAuth   = true;
            $this->mailer->Username   = 'email@email.com'; // E-mail fixo do remetente
            $this->mailer->Password   = 'senha';            // Senha do e-mail fixo
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port       = 587;
    
            // Configurações do remetente
            $this->mailer->setFrom('email@email.com', 'Nome da empresa');
        }
    
        public function enviar($destinatario, $nomeDestinatario, $assunto, $mensagemHTML, $mensagemTexto = '', $anexos = []) {
            try {

                $this->mailer->clearAllRecipients();
                $this->mailer->clearAttachments();

                if (is_array($destinatario)) {
                    foreach ($destinatario as $destinatario) {
                        $this->mailer->addAddress($destinatario);
                    }
                } else {
                    $this->mailer->addAddress($destinatario, $nomeDestinatario);
                }

                if (!empty($anexos) && is_array($anexos)) {
                    foreach ($anexos as $caminhoArquivo) {
                        if (file_exists($caminhoArquivo)) {
                            $this->mailer->addAttachment($caminhoArquivo);
                        }
                    }
                }

                $this->mailer->Subject = $assunto;
                $this->mailer->isHTML(true); 
                $this->mailer->Body    = $mensagemHTML;
                $this->mailer->AltBody = $mensagemTexto;
    
                $this->mailer->send();
                return [
                        "sucesso" => true, 
                        "mensagem" => "Email enviado com sucesso"
                    ];
            } catch (Exception $e) {
                return [
                        "sucesso" => false,
                        "mensagem" => "Erro ao enviar e-mail: {$this->mailer->ErrorInfo}"
                    ];
            }
        }
    }
    