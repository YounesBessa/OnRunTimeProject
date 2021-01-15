<?php
session_start();

include('../inc/pdo.php');
include('../inc/function.php');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require('../vendor/autoload.php');

$errors = array();
$success = false;
$mail  = CleanXss($_POST['emailverif']);
$errors = checkEmail($errors, $mail, 'email');
$user = select($pdo, 'ort_users', '*', 'email', $mail);
if (empty($user)) $errors['email'] = 'Email introuvable';
else {
    if (count($errors) == 0) {
        $currentLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $recoveryLink = str_replace(basename(__FILE__), 'recovery.php', str_replace('/ajax','',$currentLink));
        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        try {
            //Server settings
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'onruntimenfactory@gmail.com';                     // SMTP username
            $mail->Password   = 'Nfactory2020';                               // SMTP password
            $mail->SMTPSecure = "ssl";
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('onruntimenfactory@gmail.com', 'OnRunTime');
            $mail->addAddress($user['email'], $user['pseudo']);     // Add a recipient


            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Récupération de mot de passe';
            $mail->Body    = '<div style="text-align: center;"><h3 style="color:#000;" >Récupération de mot de passe</h3><a href="' . $recoveryLink . '?email=' . $user["email"] . '&token=' . $user["token"] . '" style="color: #000EFF;">Cliquez ici pour changez votre mot de passe</a></div>';
            $mail->AltBody = 'Cliquez sur le lien pour récupérer votre mot de passe: ' . $recoveryLink . '?email=' . $user["email"] . '&token=' . $user["token"];

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $success = true;
    }
}

$data = array(
    'errors' => $errors,
    'success' => $success
);
showJson($data);