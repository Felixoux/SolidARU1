<?php

namespace App;

use App\Security\ForbidenException;
use App\Table\UserTable;
use App\Helper;

class Auth
{
    /**
     * @throws ForbidenException
     */
    public static function check(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(isset($_SESSION['aut']) && !isset($_SESSION['token'])) {
            $_SESSION['token'] = getToken(128);
        }

        if (!isset($_SESSION['auth'])) {
            throw new ForbidenException();
        }
    }

    public static function is_connected(): bool
    {
        if (isset($_SESSION['auth'])) {
            return true;
        }
        return false;
    }

    public static function remember()
    {
        $domain = C('domain');
        if(isset($_COOKIE['auth']) && !isset($_SESSION['auth'])) {
            $auth = $_COOKIE['auth'];
            $auth = explode('-----', $auth);
            $user = (new UserTable(Connection::getPDO()))->findByUsername($auth[0]);
            $key = sha1($user->getUsername() . $user->getPassword() . $_SERVER['REMOTE_ADDR']);
            if($key == $auth[1]) {
                Helper::sessionStart();
                $_SESSION['auth'] = 'connected';
                $cookieValue = $user->getUsername() . '-----' . sha1($user->getUsername() . $user->getPassword() . $_SERVER['REMOTE_ADDR']);
                $duration = time() + 3600 * 24 * 3;
                (new Helper())->createCookie('auth', $cookieValue, $domain, $duration);
            } else {
                $cookieValue = $user->getUsername() . '-----' . sha1($user->getUsername() . $user->getPassword() . $_SERVER['REMOTE_ADDR']);
                $duration = time() -3600;
                (new Helper())->createCookie('auth', $cookieValue, $domain, $duration);
            }
        }
    }
}