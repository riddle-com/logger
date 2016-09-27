<?php

namespace RiddleWebhook;

/**
 * RiddleData
 *
 * @author Reimar <reimar@riddle.com>
 */
class RiddleData
{

    private $data = null, $lead = array(), $createdAt = null;

    /**
     * 
     * @param json $json
     */
    public function __construct($json)
    {
//        $this->_checkRequest();     
        
        $this->data = json_decode($json);
        $this->createdAt = new \DateTime();
    }

    /**
     * 
     * @return int
     */
    public function getId()
    {
        return (int) $this->data->riddle->id;
    }

    /**
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->data->riddle->title;
    }

    /**
     * 
     * @return obj
     */
    public function getLead()
    {
        return isset($this->data->lead) ? $this->data->lead : null;
    }

    /**
     * 
     * @return array
     */
    public function getLeadFields()
    {
        $fields = array();

        foreach (get_object_vars($this->data->lead) as $_field => $_value) {
            $fields[] = $_field;
        }

        return $fields;
    }

    /**
     * 
     * @return array
     */
    public function getAnswers()
    {
        return isset($this->data->answers) ? $this->data->answers : null;
    }

    /**
     * 
     * @return array
     */
    public function getResult()
    {
        return isset($this->data->result) ? $this->data->result : null;
    }
    
    /**
     * 
     * @return array
     */
    public function getResultData()
    {
        return isset($this->data->resultData) ? $this->data->resultData : null;
    }

    /**
     * 
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * 
     * @return object
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * Check if request from riddle
     */
    private function _checkRequest()
    {
        if ($_SERVER['HTTP_ORIGIN'] !== 'https://www.riddle.com') {
            header("HTTP/1.0 404 Not Found");
            exit;
        }
    }

}
