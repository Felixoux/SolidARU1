<?php
require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

define('VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');
define('DEBUG_TIME', microtime(true));

$router = new App\Router(VIEW_PATH);

$router
->get('/', 'post/index',  'home')
->get('/category', 'category/show', 'category')
->run();