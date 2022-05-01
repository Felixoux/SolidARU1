<?php

namespace App;

use App\Security\ForbidenException;

class Auth
{

    /**
     * @throws ForbidenException
     */
    public static function check()
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['auth'])) {
            throw new ForbidenException();
        }
    }
}