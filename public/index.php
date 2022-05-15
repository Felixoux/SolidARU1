<?php
require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

if (isset($_GET['page']) && $_GET['page'] === '1') {
    $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if (!empty($query)) {
        $uri = $uri . '?' . $query;
    }
    header('Location: ' . $uri);
    http_response_code(301);
    exit();
}

define('ROOT_PATH', dirname(__DIR__));
const VIEW_PATH = ROOT_PATH . DIRECTORY_SEPARATOR . 'views';
const AUTOLOAD_PATH = ROOT_PATH . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
const UPLOAD_PATH = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';

$router = new App\Router(VIEW_PATH);

// Routes file
require 'routes.php';

