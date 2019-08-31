<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once "vendor/autoload.php";

    class Mail 
    {
        public $subject = "";
        public $body = "";
        public $altbody = "";
		public $args = array();
        public $from_email = "";
        public $from_name = "";
        public $to = array();
        public $html = true;
        public $replyTo = array();
        public $cc = "";
        public $bcc = "";
        public $files = array();

        public function send()
        {
            $credentials = $this->config();
            $body = $this->render_file("views/" . $this->body . ".php", $this->args);

            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                                       // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host       = $credentials['MAIL_HOST'];  // Specify main and backup SMTP servers
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = $credentials['MAIL_USERNAME'];                     // SMTP username
                $mail->Password   = $credentials['MAIL_PASSWORD'];                               // SMTP password
                $mail->SMTPSecure = $credentials['MAIL_ENCRYPTION'];                                  // Enable TLS encryption, `ssl` also accepted
                $mail->Port       = $credentials['MAIL_PORT'];                                    // TCP port to connect to

                //Recipients
                $mail->setFrom($this->from_email, $this->from_email);

                if(isset($this->to))
                {
                    foreach($this->to as $item)
                    {
                        $mail->addAddress($item['email'], $item['name']);     // Add a recipient
                    }
                }

                if(isset($this->replyTo) && count($this->replyTo) > 0)
                {
                    $mail->addReplyTo('info@example.com', 'Information');
                }

                if(isset($this->cc) && !empty($this->cc))
                {
                    $mail->addCC($this->cc);
                }

                if(isset($this->bcc) && !empty($this->bcc))
                {
                    $mail->addBCC($this->bcc);
                }

                if(isset($this->replyTo) && count($this->replyTo) > 0)
                {
                    $mail->addReplyTo($this->replyTo['email'], $this->replyTo['name']);
                }

                // Attachments
                if(isset($this->files) && count($this->files))
                {
                    foreach($this->files as $item)
                    {
                        $mail->addAttachment($item['file'], $item['name']);    // Optional name
                    }
                }

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $this->subject;
                $mail->Body    = $body;

                if(isset($this->altbody) && !empty($this->altbody))
                {
                    $mail->AltBody = $this->altbody;
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

        public function addReceiver($email, $name)
        {
            $data = array(
                "email" => $email,
                "name" => $name
            );
            array_push($this->to, $data);
            return true;
        }

        public function addSender($email, $name)
        {
            $this->from_email = $email;
            $this->from_name = $name;
            return true;
        }

        public function addReply($email, $name)
        {
            $data = array(
                "email" => $email,
                "name" => $name
            );
            array_push($this->replyTo, $data);
            return true;
        }

        public function addFile($file, $name)
        {
            $data = array(
                "file" => $file,
                "name" => $name
            );
            array_push($this->files, $data);
            return true;
        }

        public function render_file($path, array $args)
		{
			ob_start();
			include($path);
			$var=ob_get_contents(); 
			ob_end_clean();
			return $var;
        }
        
        public function config()
		{
			/* ob_start();
			include('./credentials.php');
			$var=ob_get_contents(); 
			ob_end_clean();
            return $var; */
            $config = include("credentials.php");
            return $config;
		}
    }