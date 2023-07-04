<?php
require __DIR__.'/Services/VeiculosService.php';

$app = new Swoole\HTTP\Server("0.0.0.0", 8989);

$app->on("start", function($server) {
    echo "Executendo na porta 8989";
});

$app->on("request", function($request, $response) {

    $response->header("Content-Type", "application/json");
    $response->header("Access-Control-Allow-Origin", "*");
    $response->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE");

    $queryString = null;
    $queryString = $request->server['query_string'];
    $requestUri = $request->server['request_uri'];
    $methodHttp = strtolower($request->getMethod());

    $url = explode("/", $requestUri);

    $service = 'Services\\'.ucfirst($url[1]).'Service';

    $parameter[0] = end($url);

    if($methodHttp === "get" && $queryString) {
        $parameter[0] = "function=".$url[2]."&".$queryString;
    }elseif($methodHttp === "post" || $methodHttp === "put"){
        $parameter[0] = $request->getContent();
    }

    $resp = call_user_func_array(array(new $service, $methodHttp), $parameter);

    $response->end(json_encode($resp, JSON_UNESCAPED_UNICODE));

});

$app->start();


//// comando para criar a imagem no Docker:
//// docker build -f ./Dockerfile -t 4events-veiculos .

//// Comando para criar um Container no docker, a partir da imagem anterior criada:
//// docker run -d --name fullstack -p "80:8989" 4events-veiculos