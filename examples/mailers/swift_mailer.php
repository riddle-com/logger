<?php

/**
 * This example uses Swift Mailer
 * 
 * Change _config.php with your own data
 * 
 * @see http://swiftmailer.org/
 * @see _config.php
 * 
 * @author Reimar <reimar@riddle.com>
 */
require '_config.php';
require '../../vendor/autoload.php';

use RiddleWebhook\RiddleData;

$riddle = new RiddleData(file_get_contents('php://input'));

$message = Swift_Message::newInstance()
        ->setSubject(getMailSubject($riddle))
        ->setFrom(array($fromMail => $fromName))
        ->setTo(array($toMail => $toName))
        ->addPart(getMailBody($riddle), 'text/html');

/**
 * Defining transport option for sending emails
 * 
 * This example uses the native php mailer,
 * see the swift mailer docs how to use smtp or sendmail.
 * 
 * Feel free to change your transport option.
 * 
 * @see http://swiftmailer.org/docs/sending.html#transport-types
 */
$transport = Swift_MailTransport::newInstance();

//$transport = Swift_SmtpTransport::newInstance()
//        ->setHost($smtpHost)
//        ->setPort($smtpPort)
//        ->setEncryption($smtpSecure)
//        ->setUsername($smtpUser)
//        ->setPassword($smtpPassword)
//;

//$transport = Swift_SendmailTransport::newInstance($sendmailPath);

$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);
