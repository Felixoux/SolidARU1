<?php

namespace App\Model;

use App\Helpers\Text;
use DateTime;

class Category
{

    private ?int $id = null;
    private ?string $name = null;
    private ?string $slug = null;
    private ?string $content = null;
    private string $created_at;
    private $post_id;
    private $post;
    private ?string $image = null;
    private ?string $oldImage = null;
    private bool $pendingUpload = false;

    public function setCreatedAt(string $date): self
    {
        $this->created_at = $date;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }

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
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug($slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
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
        return Text::exerpt($this->content, $limit);
    }

    public function getPostID(): ?int
    {
        return $this->post_id;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        if (is_array($image) && !empty($image['tmp_name'])) {
            if (!empty($this->image)) {
                $this->oldImage = $this->image;
            }
            $this->pendingUpload = true;
            $this->image = $image['tmp_name'];
        }
        if (is_string($image) && !empty($image)) {
            $this->image = $image;
        }

        return $this;
    }

    public function getImageURL(string $format): ?string
    {
        if (empty($this->image)) {
            return null;
        }
        return '/uploads/categories/' . $this->image . '_' . $format . '.jpg';
    }

    public function getOldImage(): ?string
    {
        return $this->oldImage;
    }

    public function shouldUpload(): bool
    {
        return $this->pendingUpload;
    }


}