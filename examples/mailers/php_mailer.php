<?php

/**
 * This example uses PHPMailer
 * 
 * Change _config.php with your own data
 * 
 * @see https://github.com/PHPMailer/PHPMailer
 * @see _config.php
 * 
 * @author Reimar <reimar@riddle.com>
 */
require '_config.php';
require '../../vendor/autoload.php';
require '../../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';

use RiddleWebhook\RiddleData;

$riddle = new RiddleData(file_get_contents('php://input'));

$mail = new PHPMailer;

// Feel free to enable use SMTP
//$mail->isSMTP();                      // Set mailer to use SMTP
//$mail->Host = $smtpHost;              // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;               // Enable SMTP authentication
//$mail->Username = $smtpUser;          // SMTP username
//$mail->Password = $smtpPassword;      // SMTP password
//$mail->SMTPSecure = $smtpSecure;      // Enable TLS encryption, `ssl` also accepted
//$mail->Port = $smtpPort;              // TCP port to connect to

$mail->setFrom($fromMail, $fromName);
$mail->addAddress($toMail, $toName);
$mail->isHTML(true);
$mail->Subject = getMailSubject($riddle);
$mail->Body = getMailBody($riddle);
$mail->send();