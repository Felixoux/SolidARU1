<?php
App\Helper::sessionStart();
if ($_SESSION['token'] !== $params['token']) {
    header('Location: ' . $router->url('admin_posts'));
    exit();
}
session_destroy();
setcookie('auth', '', time() -3600, '/', C('domain'), false,true);
header('Location: ' . $router->url('login'));
exit();
