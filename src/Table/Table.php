<?php

namespace App\Table;

use App\Model\Post;
use App\Table\Exception\NotFoundException;
use PDO;

abstract class Table
{

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
        if ($result === false) {
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
        $params = [$value];
        if ($except !== null) {
            $sql .= " AND id != ?";
            $params[] = $except;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] > 0;
    }

    public function all(): array
    {
        $sql = "SELECT * FROM $this->table";
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }

    public function delete(int $id)
    {
        $query = $this->pdo->prepare("DELETE FROM $this->table WHERE id = ?");
        $ok = $query->execute([$id]);
        if ($ok === false) {
            throw new \Exception('Impossible de supprimer l\'enregistrement' . $id . 'dans la table' . $this->table);
        }
    }

    public function create(array $data): int
    {
        $sqlFields = [];
        foreach ($data as $key => $value) {
            $sqlFields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("INSERT INTO $this->table SET " . implode(", ", $sqlFields));
        $ok = $query->execute($data);
        if ($ok === false) {
            throw new \Exception('Impossible de créer l\'enregistrement dans la table' . $this->table);
        }
        return (int)$this->pdo->lastInsertId();
    }

    public function createPC($item): void
    {
        $id = $this->create([
            'name' => $item->getName(),
            'slug' => $item->getSlug(),
            'content' => $item->getContent(),
            'image' => $item->getImage(),
            'created_at' => $item->getCreatedAt()->format("Y-m-d H:i:s")
        ]);
        $item->setID($id);
    }

    public function update(array $data, ?int $id = null)
    {
        $sqlFields = [];
        foreach ($data as $key => $value) {
            $sqlFields[] = "$key = :$key";
        }
        $query = $this->pdo->prepare("UPDATE $this->table SET " . implode(", ", $sqlFields) . " WHERE id = :id");
        $ok = $query->execute(array_merge($data, ['id' => $id]));
        if ($ok === false) {
            throw new \Exception('Impossible de modifier l\'enregistrement dans la table' . $this->table);
        }
        return (int)$this->pdo->lastInsertId();
    }

    public function updatePC($item): void
    {
        $this->update([
            'name' => $item->getName(),
            'slug' => $item->getSlug(),
            'content' => $item->getContent(),
            'created_at' => $item->getCreatedAt()->format("Y-m-d H:i:s"),
            'image' => $item->getImage()
        ], $item->getID());
    }

    public function queryAndFetchAll(string $sql): array
    {
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }
}