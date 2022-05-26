<?php

namespace App;

use Exception;
use PDO;

final class paginatedQuery
{

    private string $query;
    private string $queryCount;
    private ?PDO $pdo;
    private int $perPage;
    private $count;
    private ?array $items = null;

    public function __construct(
        string $query,
        string $queryCount,
        int    $perPage = 8,
        ?PDO   $pdo = null
    )
    {
        $this->query = $query;
        $this->queryCount = $queryCount;
        if (is_null($pdo)) {
            $this->pdo = Connection::getPDO();
        } else {
            $this->pdo = $pdo;
        }
        $this->perPage = $perPage;
    }

    /** @var Post[] */
    public function getItems(string $classMapping): ?array
    {
        if ($this->items === null) {
            $currentPage = $this->getCurrentPage();
            $pages = $this->getPages() + 1;
            if ($currentPage > $pages) {
                throw new Exception('Cette page n\'existe pas');
            }
            $offset = $this->perPage * ($currentPage - 1);
            $this->items = $this->pdo->query($this->query . " LIMIT {$this->perPage} OFFSET {$offset}")
                ->fetchAll(PDO::FETCH_CLASS, $classMapping);
        }
        return $this->items;
    }

    public function previousLink($link): ?string
    {
        $currentPage = $this->getCurrentPage();
        if ($currentPage <= 1) return null;
        if ($currentPage > 2) $link .= "?page=" . ($currentPage - 1);
        return <<<HTML
        <a href="{$link}" class="btn btn-secondary">&lt;&nbsp; Page précédente</a>
        HTML;
    }

    public function nextLink($link): ?string
    {
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();
        if ($currentPage >= $pages) return null;
        $link .= "?page=" . ($currentPage + 1);
        return <<<HTML
        <a href="{$link}" class="ml-a"><button class="btn btn-secondary">Page suivante &nbsp;&gt;</button></a>
        HTML;
    }

    /**
     * get current page (int)
     */
    private function getCurrentPage(): int
    {
        return URL::getPositiveInt('page', 1);
    }

    /**
     * Amount of pages
     * @return int
     */
    private function getPages(): int
    {
        if ($this->count === null) {
            $this->count = (int)$this->pdo
                ->query($this->queryCount)
                ->fetch(PDO::FETCH_NUM)[0];
        }
        return ceil($this->count / $this->perPage);
    }
}