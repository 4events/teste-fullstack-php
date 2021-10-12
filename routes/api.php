<?php

use App\Http\Controllers\CarsController;

const ROUTES = [
    [
        "uri" => "/vehicles",
        "method" => "GET",
        "controller" => CarsController::class,
        "function" => "index"
    ],
    [
        "uri" => "/vehicles/find",
        "method" => "GET",
        "controller" => CarsController::class,
        "function" => "show"
    ],
    [
        "uri" => "/vehicles",
        "method" => "POST",
        "controller" => CarsController::class,
        "function" => "store"
    ]
];