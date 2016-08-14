<?php

/**
 * The config file for your mailer
 */

$fromMail = 'mike@riddle.com';
$fromName = 'Mike';
$toMail = 'reimar@riddle.com';
$toName = 'Reimar';

// Or get from URL
if (isset($_GET['fromMail'])) {
    $fromMail = $_GET['fromMail'];
}
if (isset($_GET['fromName'])) {
    $fromName = $_GET['fromName'];
}
if (isset($_GET['toMail'])) {
    $toMail = $_GET['toMail'];
}
if (isset($_GET['toName'])) {
    $toName = $_GET['toName'];
}

// Option for sending mails via SMTP
$smtpHost = '';
$smtpUser = '';
$smtpPassword = '';
$smtpSecure = 'tls';
$smtpPort = 587;

// sendmail
$sendmailPath = '/usr/sbin/exim -bs';

/**
 * Get mail subject
 * 
 * @param object $riddle
 * @return string
 */
function getMailSubject($riddle)
{
    return 'Riddle Webhook: ' . $riddle->getTitle();
}

/**
 * Get mail body from file
 * 
 * @param object $riddle
 * @return string
 */
function getMailBody($riddle)
{
    ob_start();
    include 'message_body.php';
    return ob_get_clean(); 
}