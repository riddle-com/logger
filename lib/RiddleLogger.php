<?php

/**
 * RiddleLogger
 *
 * @author Riddle Developers
 */
class RiddleLogger
{
    private $file = '../logs/riddle.log';
    private $timeFormat = 'Y-m-d H:i:s';
    
    public function setFile($file)
    {
        $this->file = $file;
    }
    
    public function setTimeFormat($timeFormat)
    {
        $this->timeFormat = $timeFormat;
    }

    public function log($data)
    {
        if (empty($data)) {
            return false;
        }
        
        $this->_checkLogFile();
        $message = date($this->timeFormat) . ' ' . print_r($data, true) . "\n";

        return file_put_contents($this->file, $message, FILE_APPEND);
    }
    
    private function _checkLogFile()
    {
        $folder = dirname($this->file);
        
        if (!file_exists($folder)) {
            mkdir($folder);
        }
    }
}