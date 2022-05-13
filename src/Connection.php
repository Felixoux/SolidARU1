<?php

namespace App;

use PDO;
use Exception;
class Connection
{

    /**
     * @throws \Exception
     */
    public static function getPDO(): ?PDO
    {
        $host = C('host');
        $dbname = C('dbname');
        $user = C('db_user');
        $password = C('db_password');
        try {
            return new PDO("mysql:host=$host;dbname=$dbname", $user, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (Exception $e) {
        throw new Exception('Impossible de se connecter à la base de donnée');
    }

    }


}