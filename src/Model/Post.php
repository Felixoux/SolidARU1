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
    private string $created_at;
    private array $categories = [];
    private array $images = [];
    private array $files = [];
    private ?string $image = null;
    private ?string $oldImage = null;
    private bool $pendingUpload = false;

    public function setID($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
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
        $content = $this->content;
        if (str_contains($content, 'youtube.com/')) {
            $content = Text::getIframe($content);
            return Text::parseDown($content);
        }
        return Text::parseDown($content);
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
        return $this->slug;
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
    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): self
    {
        $this->categories = $categories;
        return $this;
    }

    public function setImages(array $images): self
    {
        $this->categories = $images;
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

    public function setFiles(array $files): void
    {
        $this->files = $files;
    }

    public function getFilesIds(): array
    {
        $ids = [];
        foreach ($this->files as $file) {
            $ids[] = $file->getID();
        }
        return $ids;
    }

    public function getImagesIds(): array
    {
        $ids = [];
        foreach ($this->images as $image) {
            $ids[] = $image->getID();
        }
        return $ids;
    }

    public function addCategory(Category $category): void
    {
        $this->categories[] = $category;
        $category->setPost($this);
    }

    public function addImage(Image $image): void
    {
        $this->images[] = $image;
        $image->setPost($this);
    }

    public function addFile(File $file): void
    {
        $this->files[] = $file;
        $file->setPost($this);
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
        return '/uploads/posts/' . $this->image . '_' . $format . '.jpg';
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