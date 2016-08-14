Riddle Webhook Libs
===================
## Description
Riddle is a powerful engagement and lead generation platform - through the 
creation of quizzes, lists, polls, and other types of interactive content. 
We've created this collection or PHP scripts to allow you to send all the 
leads and user responses from your content created on Riddle.com to your CRM, 
data system, or even Google Docs. Automatically collect responses, qualify each 
lead based on their results, then send out personalized follow up messages using 
your marketing software.

## Requirements
PHP > 5.4

## Usage
Upload files to your webserver and activate in your Riddle backend the custom
webhook. Type in the url of the logger script. Ready.

### Receiving emails
Receive email alert any time a user completes a lead gen form in your Riddle 
content, so you can instantly follow up.

### Save to a Google Document spreadsheet
Seamlessly send all user information and responses from the Riddle lead gen form 
to a Google Document spreadsheet.

### Simple logging
Write all user details and corresponding answers to any file. You can then write 
a script to send all details to your CRM or other data system.

#### Customization
```php
$logger->setFile('/path/to/your/logfile.log');
$logger->setTimeFormat('r');
```

#### Recommendations
Please make sure that your logfile has no public access, and change the path of 
the logfile or set the document root of your webserver to 
`/your/path/to/riddle/webhooks`. 

## Upcoming scripts
MySQL, CSV ...
Feel free to let us know your ideas. 

## Todo
- .travis.yml
- Documentation

## Any questions? 
Just let us know at hello@riddle.com. 
