Riddle Webhook Response Logger
==============================

## Requirements
PHP > 5.4

## Usage
Riddle is a powerful engagement and lead generation platform - through the creation of quizzes, lists, polls, and other types of interactive content. We've creatd this collection of three PHP code snippets to allow you to send all the leads and user responses from your content created on Riddle.com to your CRM, data system, or even Google Docs. Automatically collect reponses, qualify each lead based on their results, then send out personalized follow up messages using your marketing software.

Option 1: Receive email alert any time a user completes a lead gen form in your Riddle content, so you can instantly follow up.<br>
Option 2: Seamlessly send all user information and responses from the Riddle lead gen form to a Google Document spreadsheet.<br>
Option 3: Write all user details and corresponding answers to any file. You can then write a script to send all details to your CRM or other data system.<br>

Upload files to your webserver and activate in your Riddle backend the custom
webhook. Type in the url of the logger script. Ready.

## Customization
```php
$logger->setFile('/path/to/your/logfile.log');
$logger->setTimeFormat('r');
```

## Recommendations
Please make sure that your logfile has no public access, and change the path of the logfile
or set the document root of your webserver to `/your/path/to/riddle/webhooks`. Any questions? Just let us know at hello@riddle.com. 
