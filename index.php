<?php
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// autoload нужен в том числе для автоматической загрузки классов из директории App (правила прописаны в composer.json)
require_once 'vendor/autoload.php';
require_once 'app/config/config.php';
require_once 'app/functions/core_functions.php';



$route = new \App\Helpers\Route();
$route->start($_SERVER['REQUEST_URI']);
