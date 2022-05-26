<?php

namespace App\Model;

use App\Helpers\Text;
use DateTime;

class Post extends Model
{

    private array $categories = [];
    private array $images = [];
    private array $files = [];

    public function getBody(): string
    {
        $content = $this->content;
        if (str_contains($content, 'youtube.com/')) {
            $content = Text::getIframe($content);
            return Text::parseDown($content);
        }
        return Text::parseDown($content);
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
}