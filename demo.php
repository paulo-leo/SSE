<?php
 include('SSE.php');

 $sse = new SSE;


    $sse->setTime(3);
    $sse->setAction('b');
    $sse->setData('id','10');
    $sse->setData('name','Notificação');
    $sse->setData('email','paulo@gmail.com');
    $sse->setData('telefone','2198904458');
    $sse->setData('amigos',array('Pedro','Maria','Debora'));
    $sse->setArray(['k1'=>'KKKK','k2'=>'KK22']);
    

    $sse->response(10 > 5);



?>
