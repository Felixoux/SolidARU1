<?php

namespace App\Table;

use App\{Model\User, Table\Exception\NotFoundException};
use PDO;

class UserTable extends Table
{
    protected $table = "user";
    protected $class = User::class;

    public function findByUsername(string $username)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE username = :username');
        $query->execute(['username' => $username]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if ($result === false) {
            throw new NotFoundException($this->table, $username);
        }
        return $result;
    }

    public function updateUser(User $user, string $password): void
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $query = $this->pdo->prepare('UPDATE ' . $this->table . ' SET password = :password');
        $query->execute(['password' => $password]);
    }
}