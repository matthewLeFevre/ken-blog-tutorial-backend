<?php
// utilities
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createMutable(__DIR__ . '/../');
$dotenv->load();
