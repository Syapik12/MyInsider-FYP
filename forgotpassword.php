<?php

include('dbconn.php');
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['Email'];

    $stmt1 = $conn->prepare('SELECT * FROM user WHERE Email = ?');
    $stmt1->execute([$email]);
    $user = $stmt1->fetch();
    $stmt1->close();

    if ($user) {
        $token = bin2hex(random_bytes(50));

        $stmt2 = $conn->prepare('INSERT INTO password_reset (email, token) VALUES (?, ?)');
        $stmt2->execute([$email, $token]);
        $stmt2->close();

        $resetLink = "http://localhost/MyInsider-FYP/resetpassword.php?token=$token";
        $message = "Click here to reset your password: $resetLink";

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'muhammadsyafiq545@gmail.com';
            $mail->Password = 'kobazjybqoywxkno';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('MyInsider@gmail.com', 'MyInsider');
            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject = 'Reset your password';
            $mail->Body = $message;

            $mail->send();

            echo 'An email has been sent to reset your password';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'No user found with that email';
    }
}
?>
    
