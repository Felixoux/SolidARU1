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
    protected ?string $image = null;
    protected ?string $oldImage = null;
    protected bool $pendingUpload = false;
    protected string $uploadFolder = 'posts';

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
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPostID(): ?int
    {
        return $this->post_id;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }

    // For PC only
    public function getSlug(): ?string
    {
        return e($this->slug);
    }

    public function setSlug($slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getContent(): ?string
    {
        return e($this->content);
    }

    public function getExerpt(int $limit = 60): string
    {
        $summary = Text::exerpt($this->content, $limit);
        return Text::parseDown($summary);
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
        return '/uploads/' . $this->uploadFolder . '/' . $this->image . '_' . $format . '.jpg';
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