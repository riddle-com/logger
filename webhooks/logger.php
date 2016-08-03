<?php

require '../riddle/autoload.php';

$riddleResponse = new RiddleResponse(file_get_contents('php://input'));

$logger = new RiddleLogger();

// Customize your logging
// $logger->setFile('/path/to/your/logfile.log');
// $logger->setTimeFormat('r');

$logger->log($riddleResponse->getData());