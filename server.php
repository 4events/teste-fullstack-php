<?php

    require_once('analisys.php'); 

    $server = new Swoole\HTTP\Server("127.0.0.1", 9502);
    
    $server->on("Start", function($server){
        echo "Swoole HTTP Server Iniciado em @ 127.0.0.1:9502.\n";
    });
    
    $server->on("Request", function(Swoole\HTTP\Request $request, Swoole\HTTP\Response $response){

        $response_sv = sol_method
        (
            $request->server['request_method'],
            $request->server['request_uri'],
            $request->getContent(),
            $request->get
        );
        $response->header('Content-Type', $response_sv['header']);
        $response->end($response_sv['end']);

    });

    $server->start();
    
