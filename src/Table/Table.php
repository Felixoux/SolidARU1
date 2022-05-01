<?php 
namespace App\Table;
use PDO;
use App\Table\Exception\NotFoundException;

abstract class Table {

    protected PDO $pdo;
    protected $table = null;
    protected $class = null; 

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @throws NotFoundException
     */
    public function find(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if($result === false) {
            throw new NotFoundException($this->table, $id);
        }
        return $result;
    }

    /*
     * Vérifie si une valeur existe dans la table
     * @param string $field champs à rechercher
     * @param mixed $value valeur associé au champ
     */
    public function exists(string $field, $value, ?int $except = null): bool
    {
        $sql = "SELECT COUNT(id) FROM $this->table WHERE $field = ?";
        $params= [$value];
        if($except !== null){
            $sql .= " AND id != ?";
            $params[] = $except;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] > 0;
    }

}