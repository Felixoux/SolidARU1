<?php

namespace App\Table;

use App\Model\File;
use App\Model\Image;
use App\paginatedQuery;
use App\Table\Exception\NotFoundException;
use PDO;

class FileTable extends Table
{
    protected $table = "file";
    protected $class = File::class;

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

    public function list(): array
    {
        $files = $this->queryAndFetchAll("SELECT * FROM $this->table ORDER BY created_at DESC");
        $results = [];
        foreach ($files as $file) {
            $results[$file->getID()] = $file->getName();
        }
        return $results;
    }

    public function hydratePosts(array $posts): void
    {
        $postByID = [];
        foreach ($posts as $post) {
            $post->setFiles([]);
            $postByID[$post->getID()] = $post;
        }
        $files = $this->pdo
            ->query('
                SELECT f.*, pf.post_id
                FROM post_file pf
                JOIN file f ON f.id = pf.file_id
                WHERE pf.post_id IN (' . implode(',', array_keys($postByID)) . ')'
            )->fetchAll(PDO::FETCH_CLASS, File::class);
        foreach ($files as $file) {
            $postByID[$file->getPostID()]->addFile($file);
        }
    }

}