<?php
namespace App\Model;

use App\Helpers\Text;
use \DateTime;

class Post {

    private ?int $id;
    private ?string $name;
    private ?string $content;
    private ?string $slug;
    private $created_at;

    private array $categories;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName (): ?string
    {
        return htmlentities($this->name);
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getContent(): string
    {
        return htmlentities($this->content);
    }

    public function getFormattedContent (): ?string
    {
        return nl2br(htmlentities($this->content));
    }

    public function getExerpt(int $limit = 60): ?string
    {
        if($this->content === null) {
            return $this->content;
        }
        return Text::exerpt($this->content, $limit);
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getSlug() : ?string
    {
        return $this->slug;
    }

    public function setCreatedAt(string $date): self
    {
        $this->created_at = $date;
        return $this;
    }

    public function getCreatedAt (): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function getID(): ?int
    {
        return $this->id;
    }
    /** @return Category[] */
    public function getCategories(): array
    {
        return $this->categories;
    }

    public function addCategory(Category $category): void
    {
        $this->categories[] = $category;
        $category->setPost($this);
    }
}