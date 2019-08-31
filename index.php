<?php
    require_once "mail/mail.php";

    $mail = new Mail();
    $mail->addSender('bhaswanth.nexevo@gmail.com', 'Bhaswanth Class');
    $mail->addReceiver('bhaswanth.nexevo@gmail.com', 'Bhaswanth Receiver');
    $mail->addReceiver('bhaswanthkumar6@gmail.com', 'Receiver Bhaswanth');
    $mail->subject = "Class Subject";
    $mail->body = "welcome";
    $mail->args = array(
        "name" => "Bhaswanth"
    );
    if($mail->send())
    {
        echo "Mail has been sent successfully";
    }
    else {
        echo "Error";
    }
?>
