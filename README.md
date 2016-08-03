Riddle Webhook Response Logger
==============================

## Requirements
PHP > 5.4

## Usage
Upload files to your webserver and activate in your Riddle backend the custom
webhook. Type in the url of the logger script. Ready.

## Customization
```php
$logger->setFile('/path/to/your/logfile.log');
$logger->setTimeFormat('r');
```

## Recommendations
Be sure that your logfile has no public access. Change the path of the logfile
or set the document root of your webserver to `/your/path/to/riddle/webhooks`.