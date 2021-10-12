<?php

namespace App\Config;

use Swoole\Http\Server as SwooleServer;
use Swoole\Http\Request;
use Swoole\Http\Response;

class Server
{

    protected SwooleServer $server;

    const HOST = "0.0.0.0";

    const PORT = 9501;

    public function __construct()
    {
        $this->server = new SwooleServer(
            static::HOST,
            static::PORT
        );

        $this->start();

    }

    protected function start()
    {
        $this->server->on("Start", function(SwooleServer $server)
        {
            $this->starting($server);
        });

        $this->server->on("Request", function(Request $request, Response $response)
        {
            $res = $this->executeEndpoint(
                strtolower($request->server['request_uri']),
                strtoupper($request->server['request_method']),
                $request
            );

            $response->header("Content-Type", "application/json");
            $response->header("charset", "utf-8");
            $response->status($res['status']);
            $response->end(
                json_encode(
                    $res['data']
                )
            );
        });

        $this->server->start();
    }

    /**
     * @param SwooleServer $server
     */
    protected function starting(SwooleServer $server)
    {
        echo "Swoole Http server is started at Http://".static::HOST.":".static::PORT."\n";
    }

    /**
     * @param $uri
     * @param $uriMethod
     * @param Request $request
     * @return array
     */
    protected function executeEndpoint($uri, $uriMethod, Request $request): array
    {

        $route = [];

        foreach (ROUTES as $data) {
            if(
                strtoupper($data['method']) !== strtoupper($uriMethod) ||
                strtolower($data['uri']) !== strtolower($uri)
            ) continue;

            $route = $data;
            break;
        }

        if(count($route) === 0)
            return \response(['error' => 'url not found'], 404);

        return (new $route['controller']())->{$route['function']}($request);

    }

}
