<?php

namespace App\Table;

use App\Model\Category;
use App\Model\Post;
use App\paginatedQuery;
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

    public function update(array $data, ?int $id = null): int
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

    public function findPaginated(): array
    {
        $paginatedQuery = new paginatedQuery(
            "SELECT * FROM $this->table ORDER BY created_at DESC",
            "SELECT COUNT(id) FROM $this->table"
        );
        $items = $paginatedQuery->getItems($this->class);
        return [$items, $paginatedQuery];
    }

    public function attachItems(int $id, array $items): void
    {
        $join_table = 'post_' . $this->table;
        $table_id = $this->table . '_id';
        $this->pdo->exec("DELETE FROM $join_table WHERE post_id = " . $id);
        $query = $this->pdo->prepare("INSERT INTO $join_table SET post_id = ?, $table_id = ?");
        foreach ($items as $item) {
            $query->execute([$id, $item]);
        }
    }

    public function queryAndFetchAll(string $sql): array
    {
        return $this->pdo->query($sql, PDO::FETCH_CLASS, $this->class)->fetchAll();
    }
}