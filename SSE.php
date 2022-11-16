<?php
/*
 *Versão:0.0.1 (beta)
*Autor: Paulo Leonardo da Silva Cassimiro
*Descrição: Classe PHP para implementação de SSE. Referencia: https://developer.mozilla.org/pt-BR/docs/Web/API/Server-sent_events
*/
class SSE
{
    private $id = null;
    private $data;
    private $time = 1000;
    private $event;

    /*
      Inicializa as propriedades automaticamente
    */
    public function __construct()
    {
        $this->data = array(); 
        $this->data['event_trigger_date'] = date("Y-m-d h:m:s");
        $this->event = 'pl_sse_php';
    }

    public function setEvent($name) : void
    {
      $this->event = $name;
      $this->setData('event_name',$name);
    }

    public function setAction($name) : void
    {
      $this->setData('event_action',$name);
    }
    
     /*
       Coloca um valor no campo data
     */
    public function setData($key,$value) : void
    {
        $this->data[$key] = $value;   
    }

    /*
       Cria um ID para o evento
     */
    public function setID($id) : void
    {
        $this->id = $id;
    }

    /*
       Define um tempo em segundos da atualização do servidor
     */
    public function setTime($time) : void
    {
        $this->time = $time <= 0 ? 100 : $time * 1000;
    }
    /*
     Faz  a junção do array data e outro array parametrizado
    */
    public function setArray($array) : void
    {
        $this->data = array_merge($this->data, $array);
    }

    /*
      Retorna todos os campos definido no array data
    */

    public function getData() : array
    {
        return $this->data;
    }

     /*
       Deleta um campo da data
     */
     public function delete($key) : bool
     {
        if(isset($this->data[$key]))
        {
            unset($this->data[$key]);
            return true;
        }else return false;
     }

     /*
      Atualiza um campo da data
     */
     public function update($key,$value) : bool
     {
        if(isset($this->data[$key]))
        {
             $this->data[$key] = $value;
            return true;
        }else return false;
     }

  

    public function setHeader() : void
    {
      header('Content-Type: text/event-stream');
      header('Cache-Cotrol: no-cache');
    }
    /*
      Imprime a resposta do servidor
     */
    public function response($cond=false,$h=true) : void
    {
        $content = "";
        $value = json_encode($this->data);
        $this->id =  $this->id ? $this->id : uniqid(); 
        
        $content .= "event: {$this->event}\n\n";
        $content .= "data:{$value}\n";        
        $content .= "id: {$this->id}\n";
        $content .= "retry: {$this->time}\n";

        if($h) $this->setHeader();

        if($cond)
        {
          echo $content;
          echo PHP_EOL;
          ob_flush();
          flush();
       }
    }
}
