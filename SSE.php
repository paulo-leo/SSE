<?php
/**/
class SSE
{
    private $data;
    private $time = 1000;

    public function __construct()
    {
        $this->data = array(); 
        $this->data[] = date("r");
    }

    public function setData($message)
    {

        $this->data[] =  $message;   
    }

    public function setTime($time)
    {
        $this->time = $time * 1000;
    }

    public function getEvent()
    {
        
        $content = null;

        $content .= "retry: {$this->time}\n";
        foreach($this->data as $key=>$value)
        {
             
             $content .= "data:{$value}\n\n";

         
        }

      return $content;

    }

    public function getData()
    {
        
        return $this->data;
    }


}

$x = new SSE;
$x->setTime(2);
$x->setData('Dado 1');
$x->setData('Dado 2');



header('Content-Type: text/event-stream');
header('Cache-Cotrol: no-cache');



echo $x->getEvent();
flush();

