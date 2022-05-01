<?php

namespace App\Model;

use App\Helpers\Text;
use DateTime;

class Post
{

    private ?int $id = null;
    private ?string $name = null;
    private ?string $content = null;
    private ?string $slug = null;
    private $created_at;
    private array $categories = [];



    public function setID($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getID(): ?int
    {
        return $this->id ?? null;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): ?string
    {
        return htmlentities($this->name) ?? null;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getBody(): string
    {
        return Text::parseDown($this->content);
    }

    public function getExerpt(int $limit = 60): string
    {
        $summary = Text::exerpt($this->content, $limit);
        return Text::parseDown($summary);
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug ?? null;
    }

    public function setCreatedAt(string $date): self
    {
        $this->created_at = $date;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    /** @return Category[] */
    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories(array $categories): self
    {
        $this->categories = $categories;
        return $this;
    }

    public function getCategoriesIds(): array
    {
        $ids = [];
        foreach ($this->categories as $category) {
            $ids[] = $category->getID();
        }
        return $ids;
    }

    public function addCategory(Category $category): void
    {
        $this->categories[] = $category;
        $category->setPost($this);
    }
}