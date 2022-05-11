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
        try {
            return new PDO("mysql:host=localhost;dbname=solidaru1", "root", "", [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (Exception $e) {
        throw new Exception('Impossible de se connecter à la base de donnée');
    }

    }


}