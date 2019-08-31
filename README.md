# SMTP MAILER

SMTP Mailer is developed using [PHP Mailer](https://github.com/PHPMailer/PHPMailer) package. Additionally I've Re-structured the data and added template based email content to the mailer. Please refer the below code to use the framework.

```php
    require_once "mail/mail.php";

    $mail = new Mail()  // Initiate Mailer;
    $mail->addSender('bhaswanth22@gmail.com', 'Bhaswanth Class') // Add sender email and name;
    $mail->addReceiver('bhaswanth22@gmail.com', 'Bhaswanth Receiver') // Add one receiver;
    $mail->addReceiver('bhaswanthkumar6@gmail.com', 'Receiver Bhaswanth') // Add another receiver. You can add n number of receivers;
    $mail->subject = "Class Subject" // Add subject of the mail;
    $mail->body = "welcome" // Define the template name of the email body. This will be pointing to views/welcome.php;

    $mail->args = array(
        "name" => "Bhaswanth"
    ); // Add the dynamic strings to the template. You can retrieve them in template as $args['string_name]
    if($mail->send())
    {
        echo "Mail has been sent successfully"; // Display if mail has been sent successfully.
    }
    else {
        echo "Error"; // Display if mail not sent
    }
```

## Utility Functions

```php
    $mail->addSender('email', 'name');  // To add Sender

    $mail->addReceiver('email', 'name') // To add Receiver

    $mail->addReply('name', 'name') // Add reply to email address

    $mail->addFile('file', 'file_name') // To add attachment, you can add any number of attachments.

    $mail->config() // To get the config
```

Thank you for using my package. Please rate my work at ***bhaswanthkumar6@gmail.com***