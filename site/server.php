#!/usr/bin/env php
<?php
declare(strict_types=1);
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
$http = new Server("0.0.0.0", 9501);

$http->set(['hook_flags' => SWOOLE_HOOK_ALL]);
$http->set(
    [
        'document_root' => '/var/www/',
        'reload_async' => true,
        'enable_static_handler' => true,
        'static_handler_locations' => []
    ]
);

$http->on(
    "start",
    function (Server $http) {
        echo "\n Swoole HTTP server is started.\n\n";
    }
);

require_once('/var/www/api/redirector.php');

$http->start();
