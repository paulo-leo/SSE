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
 //$sse->response();

 $file = @file_get_contents('https://github.com/paulo-leo/SSE/archive/main.zip');

 if($file)
 {

     $z = new ZipArchive();

    // Abrindo o arquivo para leitura/escrita
     $abriu = $z->open($file);
    if ($abriu === true) {
    
        // Obtendo o conteudo de um arquivo pelo nome
        $conteudo_txt = $z->getFromName('SSE.php');
    
        // Obtendo o conteudo de um arquivo pelo indice
        $conteudo_php = $z->getFromIndex(2);
    
        // Salvando o arquivo
        $z->close();
    
    } else {
        echo 'Erro: '.$abriu;
    }
 }



?>