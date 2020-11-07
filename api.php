<?php

/**
 * @todo evaluate before production
*/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, origin");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");

$app = new KenFramework\Ken(['tokenValidation' => FALSE]);

$app->start();