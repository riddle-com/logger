<?php

/**
 * This example uses the native php mail() function
 * 
 * Change _config.php with your own data
 * 
 * @see http://php.net/manual/de/function.mail.php
 * @see _config.php
 * 
 * @author Reimar <reimar@riddle.com>
 */
require '_config.php';
require '../../vendor/autoload.php';

use RiddleWebhook\RiddleData;

$riddle = new RiddleData(file_get_contents('php://input'));

$header = 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$header .= 'To: ' . $toName . ' <' . $toMail . '>' . "\r\n";
$header .= 'From: ' . $fromName . ' <' . $fromMail . '>' . "\r\n";

mail($toMail, getMailSubject($riddle), getMailBody($riddle), $header);
