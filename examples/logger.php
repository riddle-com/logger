<?php

/**
 * A simple logger - no more :-)
 * 
 * @author Reimar <reimar@riddle.com>
 */
require '../vendor/autoload.php';

use RiddleWebhook\RiddleLogger;
use RiddleWebhook\RiddleData;

$logIfNoLeadData = true; // true or false

$riddleData = new RiddleData(file_get_contents('php://input'));

if ($riddleData->getLead() === null && $logIfNoLeadData === false) {
    exit;
}

$logger = new RiddleLogger();

// Customize your logging
// $logger->setFile('/path/to/your/logfile.log');
// $logger->setTimeFormat('r');

$logger->log($riddleData->getData());
