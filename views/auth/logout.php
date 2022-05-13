<?php
App\Helper::sessionStart();
session_destroy();
setcookie('auth', '', time() -3600, '/', 'localhost', false,true);
header('Location: ' . $router->url('login'));
exit();
