<?php

namespace RiddleWebhook;

/**
 * RiddleLogger
 *
 * @author Reimar <reimar@riddle.com>
 */
class RiddleLogger
{
    private $file = '../var/logs/riddle.log';
    private $timeFormat = 'Y-m-d H:i:s';
    
    /**
     * 
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }
    
    /**
     * 
     * @param string $timeFormat
     */
    public function setTimeFormat($timeFormat)
    {
        $this->timeFormat = $timeFormat;
    }

    /**
     * 
     * @param mixed $data
     * @return boolean
     */
    public function log($data)
    {
        if (empty($data)) {
            return false;
        }
        
        echo $folder = dirname($this->file);
        
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        
        $message = date($this->timeFormat) . ' ' . print_r($data, true) . "\n";

        return file_put_contents($this->file, $message, FILE_APPEND);
    }
}