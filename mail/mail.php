<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once "vendor/autoload.php";

    class Mail 
    {
        public $subject = "";
        public $body = "";
        public $altbody = "";
		public $args = "";
		public $from = "";
        public $to = array();
        public $html = true;
        public $replyTo = array();
        public $cc = "";
        public $bcc = "";
        public $files = array();

        public function send()
        {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'bhaswanth.nexevo@gmail.com';                     // SMTP username
                $mail->Password   = 'Basu@1997';                               // SMTP password
                $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('bhaswanth.nexevo@gmail.com', 'Mailer');

                if(isset($this->to))
                {
                    $mail->addAddress('bhaswanthkumar6@gmail.com', 'Joe User');     // Add a recipient
                }

                if(isset($this->replyTo) && count($this->replyTo) > 0)
                {
                    $mail->addReplyTo('info@example.com', 'Information');
                }

                if(isset($this->cc) && !empty($this->cc))
                {
                    $mail->addCC('cc@example.com');
                }

                if(isset($this->bcc) && !empty($this->bcc))
                {
                    $mail->addBCC('bcc@example.com');
                }

                // Attachments
                if(isset($this->files) && count($this->files))
                {
                    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                }

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

                if(isset($this->altbody) && !empty($this->altbody))
                {
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                }

                if($mail->send())
                {
                    return true;
                }

                return false;
                
            } catch (Exception $e) {
                return false;
                // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }