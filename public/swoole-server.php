<?php
namespace Ricardo\Teste;

require __DIR__ . '/../vendor/autoload.php';

ini_set('error_reporting',E_ALL);

use Co;
use Nyholm\Psr7\ServerRequest;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoole\Http\{Request, Response, Server};
use Ricardo\Teste\Controller\BuscaVeiculo;
use Ricardo\Teste\Controller\GravaVeiculo;
use Ricardo\Teste\Controller\TrazVeiculos;
use Ricardo\Teste\Controller\Veiculos;

Co::set([ 'hook_flags'=>SWOOLE_HOOK_ALL ]);

$servidor = new Server('0.0.0.0',8080);

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../container/container.php';

$rotas = [
    "/veiculos" => Veiculos::class,
    "/veiculos/id" => BuscaVeiculo::class,
    "/veiculos/post" => GravaVeiculo::class,
    "/veiculos/find" => TrazVeiculos::class
];

$servidor->on('request',
    function(Request $request, Response $response) use ($container,$rotas){

    //var_dump($request->server['request_method']);

    $path = $request->server['path_info'] ?? '/';
    $method = $request->server['request_method'] ?? 'GET';

    if ($method === 'GET') {

        if ($path === '/') {
            $response->redirect('/veiculos');
            return;
        }

    } elseif ($method === "POST") {
        if ($path === '/veiculos') {
            //$response->redirect('/veiculos/post');
            $path = '/veiculos/post';
        }

    } else {
        $response->setStatusCode(405);
        return;
    }

    if (!isset($rotas[$path])){
        $response->setStatusCode(404);
        return;
    }

    $controllerClass = $rotas[$path];

//    var_dump($path);
//    var_dump($method);
//    var_dump($controllerClass);

    $serverRequest = (new ServerRequest(
        method: $request->getMethod(),
        uri: $request->server['request_uri'],
        headers: $request->header,
        body: $request->getData(),
        version: '1.1',
        serverParams: $request->server
    ))
        ->withQueryParams($request->get ?? [])
        ->withParsedBody($request->post ??[]);

    /** @var RequestHandlerInterface $controllerInstance */
    $controllerInstance = $container->get($controllerClass);
    //$controllerInstance = $container->get(Veiculos::class);

    $responsePsr7 = $controllerInstance->handle($serverRequest);

    foreach ($responsePsr7->getHeaders() as $header => $valores) {
        foreach ($valores as $valor) {
            $response->header($header, $valor);
        }
    }
    $response->end( $responsePsr7->getBody() );

});

$servidor->start();
