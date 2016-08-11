<?php

require '../lib/autoload.php';

$logIfNoLeadData = true; // true or false

$riddleResponse = new RiddleResponse(file_get_contents('php://input'));

if ($riddleResponse->getLead() === null && $logIfNoLeadData === false) {
    exit;
}

$logger = new RiddleLogger();

// Customize your logging
// $logger->setFile('/path/to/your/logfile.log');
// $logger->setTimeFormat('r');

$logger->log($riddleResponse->getData());