<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Display errors properly

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Load configuration
$config = require '../workspace/smtp.php';


if(isset($_POST['submit'])){
// Access the user values securely
$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$subject = htmlspecialchars($_POST['subject'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
    $mail->isSMTP();                       // Send using SMTP
    $mail->Host       = $config['smtp_host']; // Set the SMTP server to send through
    $mail->SMTPAuth   = true;              // Enable SMTP authentication
    $mail->Username   = $config['smtp_user']; // SMTP username
    $mail->Password   = $config['smtp_pass']; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
    $mail->Port       = $config['smtp_port']; // TCP port to connect to

    // Recipients
    $mail->setFrom('info@gocosys.com', 'Mailer');
    $mail->addAddress('rsuriya119@gmail.com', $name); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'New Enquiry - Gocourse Pvt Ltd';
    $mail->Body    = '<h2>Hello, you got a new enquiry</h2>
                      <h4>Name: ' . $name . '</h4>
                      <h4>Email: ' . $email . '</h4>
                      <h4>Subject: ' . $subject . '</h4>
                      <h4>Message: ' . $message . '</h4>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}else{
    header('location:form.php');
    exit(0);
}
