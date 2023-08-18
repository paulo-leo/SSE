# SSE - Classe PHP para Envio de Eventos do Servidor

A classe SSE (Server-Sent Events) oferece uma maneira simples e eficaz de enviar eventos do servidor para os clientes através de conexões HTTP unidirecionais. Isso é especialmente útil para notificações em tempo real e atualizações assíncronas em aplicações web.

## Como Funciona

O Server-Sent Events é uma tecnologia que permite ao servidor enviar eventos para o cliente por meio de uma conexão HTTP duradoura. Isso é especialmente útil quando você deseja atualizar os clientes com informações em tempo real, como atualizações de feeds, notificações e muito mais.

## Recursos

- Simplicidade: A classe SSE oferece uma interface simples para iniciar e gerenciar conexões SSE.
- Compatibilidade: A maioria dos navegadores modernos suporta a tecnologia SSE, permitindo que você alcance um amplo público.
- Personalização: Você pode personalizar os tipos de eventos e os dados que são enviados aos clientes.

## Exemplo de Uso

Aqui está um exemplo de como você pode usar a classe SSE para enviar eventos do servidor:

```php
<?php

require 'SSE.php';

$sse = new SSE();

// Defina o tipo de conteúdo como "text/event-stream"
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

// Envie um evento para o cliente a cada 5 segundos
while (true) {
    $data = ['message' => 'Novo evento gerado em ' . date('H:i:s')];
    $sse->sendEvent(json_encode($data));

    // Espere por 5 segundos
    sleep(5);
}
