<?php

/**
 * RiddleResponse
 *
 * @author Riddle Developers
 */
class RiddleResponse
{

    private $data = null, $lead = array(), $createdAt = null;

    /**
     * 
     * @param json $json
     */
    public function __construct($json)
    {
        $this->data = json_decode($json);
        $this->createdAt = date('Y-m-d H:i:s');
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
     * 
     * @return string
     */
    public function getDataAsSimpleHtml()
    {
        $head = 'Riddle Webhook - ' . $this->getTitle() . ' (' . $this->getId() . ')';

        $html = '<p><strong>' . $head . '</strong></p>';

        if ($this->getLead()) {
            $html.= '<p><strong>Lead</strong></p>';
            foreach (get_object_vars($this->getLead()) as $_field => $_value) {
                $html.= $_field . ': ' . $_value . '<br />';
            }
        }

        if ($this->getAnswers()) {
            $numberAnswers = count($this->getAnswers());
            $html.= '<p><strong>Answers</strong></p>';
            foreach ($this->getAnswers() as $_k => $_answer) {
                $_count = ($_k + 1) . '/' . $numberAnswers;
                $html.= '<p>';
                $html.= 'Question ' . $_count . ': ' . $_answer->question . '<br/>';
                $html.= 'Answer: ' . $_answer->answer . '<br/>';
                $html.= 'Correct: ' . ($_answer->correct == 1 ? 'Yes' : 'No');
                $html.= '</p>';
            }
        }

        if ($this->getResult()) {
            $html.= '<p><strong>Result</strong></p>';
            $html.= $this->getResult();
        }

        return $html;
    }

}
