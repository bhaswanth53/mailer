<?php
    require_once "mail/mail.php";

    $mail = new Mail();
    $mail->subject = "This is test subject";
    echo $mail->send();
?>
