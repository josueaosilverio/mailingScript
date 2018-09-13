<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';


$contacts = Array();

print_r($contacts);


foreach ($contacts as $mMail => $mName) {

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.office365.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '';       						  // SMTP e-mail
        $mail->Password = '';                  				  // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to


        $mail->smtpConnect(
            array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            )
        );

        //Recipients
        $mail->setFrom('email', 'Name');
        $mail->addAddress((string)$mMail, (string)$mName);     // Add a recipient
        //$mail->addCC('');


        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = '';
        $mail->Body = '';

        $mail->send();
        echo 'Message has been sent to ' . $mName . " - " . $mMail;
    } catch (Exception $e) {
        echo 'Message could not be sent to ' . $mName . " - " . $mMail . '. Mailer Error: ', $mail->ErrorInfo;
    }
}