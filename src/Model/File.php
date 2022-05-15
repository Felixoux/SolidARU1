<?php

namespace App\Model;

use DateTime;

class File
{
    private ?int $id = null;
    private ?string $name = null;
    private $post;
    private $post_id;
    private string $created_at;


    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getPostID(): ?int
    {
        return $this->post_id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }
}