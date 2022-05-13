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