<?php
App\Helper::sessionStart();
session_destroy();
setcookie('auth', '', time() -3600, '/', C('domain'), false,true);
header('Location: ' . $router->url('login'));
exit();
