<?php

namespace App\Model;

use App\Helpers\Text;

class Category
{

    private ?int $id = null;
    private ?string $name = null;
    private ?string $slug = null;
    private ?string $content = null;
    private $post_id;
    private $post;


    public function getID(): ?int
    {
        return $this->id;
    }

    public function setID($slug): self
    {
        $this->id = $slug;
        return $this;
    }

    public function getName(): ?string
    {
        return e($this->name);
    }

    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSlug(): ?string
    {
        return e($this->slug);
    }

    public function setSlug($slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getContent(): ?string
    {
        return e($this->content);
    }

    public function setContent($content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getExerpt(int $limit = 60): ?string
    {
        if ($this->content === null) {
            return $this->content;
        }
        return e(Text::exerpt($this->content, $limit));
    }

    public function getPostID(): ?int
    {
        return $this->post_id;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }
}