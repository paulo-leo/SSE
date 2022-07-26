<?php
 include('SSE.php');

 $sse = new SSE;

 /*Define o tempo de conexão em segundos*/
 $sse->setTime(10);

 /*Define os dados*/
 $sse->setData('nome','Paulo Leonardo');
 $sse->setData('email','plxxxxxxxxxxx@xxxxxxxxxgmail.com');
 $sse->setData('amigos',array('Pedro','Maria','Debora'));
 $sse->setArray(['k1'=>'KKKK','k2'=>'KK22']);

 $sse->delete('email');

/*Imprime a resposta do servidor*/
 $sse->response();



?>