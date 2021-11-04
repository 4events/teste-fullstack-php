<?php

    require_once('analisys.php'); 

    $server = new Swoole\HTTP\Server("127.0.0.1", 9502);
    
    $server->on("Start", function($server){
        echo "Swoole HTTP Server Iniciado em @ 127.0.0.1:9502.\n";
    });
    
    $server->on("Request", function(Swoole\HTTP\Request $request, Swoole\HTTP\Response $response){
    
        if(strlen($request->server['request_uri']) > 1){
            $final_header = 'application/json';
        }else{
            $final_header = 'text/html';
        }
        $response->header('Content-Type', $final_header);
        $response->end(sol_method(
            $request->server['request_uri'],
            $request->server['request_method'],
            $request->get,
            $request->getContent()
        ));

    });

    $server->start();