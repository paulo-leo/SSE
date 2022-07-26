<?php
/**/
class SSE
{
    private $data;
    private $time = 1000;

    private function __construct()
    {
        $this->data[] = "";
    }

    public function setMessage($message)
    {
        $this->data[] =  $message;   
    }

    public function setTime($time)
    {
        $this->time = $time;
    }


}