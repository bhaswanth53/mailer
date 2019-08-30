<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once "vendor/autoload.php";

    class Mail 
    {
        public $subject;
        public $body;
        public $altBody;
		public $args;
		public $from;
        public $to = array();
        public $html = true;
    }