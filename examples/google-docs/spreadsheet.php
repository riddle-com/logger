<?php

// Your data
$authConfigFile = 'config/service-account-credentials.json';
$spreadsheetId = '';
$worksheatId = 0;
$impersonate = 'reimar@riddle.com';

// Or get from URL
if (isset($_GET['spreadsheetId'])) {
    $spreadsheetId = $_GET['spreadsheetId'];
}
if (isset($_GET['worksheetId'])) {
    $worksheatId = $_GET['worksheetId'];
}

require '../../vendor/autoload.php';

use RiddleWebhook\RiddleData;

$client = new Google_Client();
$client->addScope(Google_Service_Sheets::DRIVE);
$client->addScope(Google_Service_Sheets::SPREADSHEETS);

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $authConfigFile);
$client->useApplicationDefaultCredentials();

//$client->setAuthConfig($authConfigFile);
//$client->setSubject($impersonate);

if ($client->isAccessTokenExpired()) {
    $client->refreshTokenWithAssertion();
}

$riddleData = new RiddleData(file_get_contents('php://input'));
$riddleSpreadsheet = new RiddleGoogleSpreadsheet($client, $spreadsheetId, $worksheatId);
$riddleSpreadsheet->insertRiddleResponse($riddleData);