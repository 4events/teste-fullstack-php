<?php

function api_endpoints($request_uri, $type='get'){
 
    $endpoints_uris = [
        'post' => [
            '/veiculos' => "Cadastra um veículo"
        ],
        'get' => [
            '/'              => "Pagina inicial do site",
            '/veiculos'      => "Retorna todos os veículos cadastrados",
            '/veiculos/find' => "Retorna o veículo filtrado pelo título no parâmetro q=:string",
            '/apidocs'       => "Descrições dos endpoints da API"
        ]
    ];

    return $type.$request_uri;
   
}