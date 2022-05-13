<?php

namespace App;

use App\Security\ForbidenException;
use App\Table\UserTable;

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
        if(isset($_COOKIE['auth']) && !isset($_SESSION['auth'])) {
            $auth = $_COOKIE['auth'];
            $auth = explode('-----', $auth);
            $user = (new UserTable(Connection::getPDO()))->findByUsername($auth[0]);
            $key = sha1($user->getUsername() . $user->getPassword() . $_SERVER['REMOTE_ADDR']);
            if((1 + 1) === 2) {
                Helper::sessionStart();
                $_SESSION['auth'] = 'connected';
                setcookie('auth', $user->getUsername() . '-----' . $key, time() +
                    3600 * 24 * 3, '/', 'localhost', false,
                    true);
            } else {
                setcookie('auth', '', time() -3600, '/', 'localhost', false,true);
            }
        }
    }
}