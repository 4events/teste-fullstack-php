<?php

namespace App\Config;

use Swoole\Http\Server as SwooleServer;
use Swoole\Http\Request;
use Swoole\Http\Response;

class Server
{

    protected $server;

    const HOST = "127.0.0.1";

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
            $this->request($request, $response);
        });

        $this->server->start();
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    protected function request(Request $request, Response $response)
    {
        $response->header("Content-Type", "text/plain");
        $response->end("Hello World\n");
    }

    /**
     * @param SwooleServer $server
     */
    protected function starting(SwooleServer $server)
    {
        echo "Swoole Http server is started at Http://".static::HOST.":".static::PORT."\n";
    }

}
