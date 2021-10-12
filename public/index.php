<?php

require_once __DIR__ . "./../vendor/autoload.php";

require_once __DIR__ . "./../routes/api.php";

date_default_timezone_set("America/Sao_Paulo");

new \App\Config\Server();
