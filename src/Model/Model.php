<?php

namespace App\Model;

use App\Helpers\Text;
use DateTime;

abstract class Model
{
    protected int $id = 0;
    protected string $name = '';
    protected string $created_at = '';
    protected Post $post;
    protected int $post_id = 0;
    protected string $slug = '';
    protected string $content = '';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getName(): ?string
    {
        return e($this->name);
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPostID(): ?int
    {
        return e($this->post_id);
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }
}