<?php
namespace App;
use PDO;
use Exception;
class paginatedQuery {

    private $query;
    private $queryCount;
    private $classMapping;
    private $pdo;
    private $perPage;
    private $count;

    public function __construct(
        string $query,
        string $queryCount,
        string $classMapping,
        int $perPage = 8,
        ?PDO $pdo = null
        
    )
    {
        $this->query = $query;
        $this->queryCount = $queryCount;
        $this->classMapping = $classMapping;
        if(is_null($pdo)) {
            $this->pdo = Connection::getPDO();
        } else {
            $this->pdo = $pdo;
        }
        $this->perPage = $perPage;
    }

    /** @var Post[] */
    public function getItems(): array
    {
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();
        if($currentPage > $pages) {
            throw new Exception('Cette page n\'existe pas');
        }
        $offset = $this->perPage * ($currentPage - 1);
        return $this->pdo->query($this->query . " LIMIT {$this->perPage} OFFSET $offset")
        ->fetchAll(PDO::FETCH_CLASS, $this->classMapping);
    }

    public function previousLink($link): ?string
    {
        $currentPage = $this->getCurrentPage();
        if ($currentPage <= 1) return null;
        if($currentPage > 2) $link .= "?page=" . ($currentPage - 1);
        return <<<HTML
        <a href="{$link}"><button class="btn btn-swap">&lt;&nbsp; Page précédente</button></a>
        HTML;
    }

    public function nextLink($link): ?string
    {
        $currentPage = $this->getCurrentPage();
        $pages = $this->getPages();
        if ($currentPage >= $pages) return null;
        $link .= "?page=" . ($currentPage + 1);
        return <<<HTML
        <a href="{$link}" class="ml-a"><button class="btn btn-swap">Page suivante &nbsp;&gt;</button></a>
        HTML;
    }

    private function getCurrentPage(): int 
    {
        return URL::getPositiveInt('page', 1);
    }

    private function getPages(): int
    {
        if($this->count === null) {
            $this->count = (int)$this->pdo
            ->query($this->queryCount)
            ->fetch(PDO::FETCH_NUM)[0];
        }
        return ceil($this->count / $this->perPage);
    }
}