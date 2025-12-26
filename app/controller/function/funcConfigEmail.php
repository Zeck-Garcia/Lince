<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once '../../../app/lib/PHPMailer-master/src/Exception.php';
    require_once '../../../app/lib/PHPMailer-master/src/PHPMailer.php';
    require_once '../../../app/lib/PHPMailer-master/src/SMTP.php';

    class EmailSender {
        private $mailer;

        public function __construct() {
            $this->mailer = new PHPMailer(true);
    

            $this->mailer->isSMTP();
            $this->mailer->Host       = 'mail.guepardoentregas.pt';
            $this->mailer->SMTPAuth   = true;
            $this->mailer->Username   = 'contacto@guepardoentregas.pt';
            $this->mailer->Password   = 'o4G$kdF@y$';
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port       = 587;
    
            $this->mailer->setFrom('contacto@guepardoentregas.pt', 'Guepardo Entregas');
        }
    
        public function enviar($destinatario, $nomeDestinatario, $assunto, $mensagemHTML, $mensagemTexto = '', $caminhoAnexo = null, $nomeAnexo = null) {
            try {
                $this->mailer->clearAddresses();
                $this->mailer->clearAttachments();

                $this->mailer->addAddress($destinatario, $nomeDestinatario);
                $this->mailer->Subject = $assunto;
                $this->mailer->isHTML(true); 
                $this->mailer->Body    = $mensagemHTML;
                $this->mailer->AltBody = $mensagemTexto;
    

                if ($caminhoAnexo !== null && file_exists($caminhoAnexo) && is_readable($caminhoAnexo)) {
                    $this->mailer->addAttachment($caminhoAnexo, $nomeAnexo);
                }

                $this->mailer->send();
                return true;
            } catch (Exception $e) {
                return "Erro ao enviar e-mail: {$this->mailer->ErrorInfo}";
            }
        }
    }
    

?>