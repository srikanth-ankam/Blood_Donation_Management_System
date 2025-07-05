<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

function sendMail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Config
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // e.g., smtp.yourhost.com
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ankam319@gmail.com'; // ✅ Your email
        $mail->Password   = 'xcyk xsbu zffq kcac';    // ✅ App Password (NOT Gmail password)
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender & Recipient
        $mail->setFrom('your_email@gmail.com', 'LifeSaver App');
        $mail->addAddress($to);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
