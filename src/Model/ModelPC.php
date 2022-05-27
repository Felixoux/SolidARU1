<?php

namespace App\Model;

use App\Helpers\Text;

abstract class ModelPC extends Model
{
    protected ?string $image = null;
    protected ?string $oldImage = null;
    protected bool $pendingUpload = false;
    protected string $uploadFolder = 'posts';

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

    /**
     * Get a portion of a string, length defined by int $limit.
     * @param int $limit
     * @return string
     */
    public function getExerpt(int $limit = 60): string
    {
        $summary = Text::exerpt($this->content, $limit);
        return Text::parseDown($summary);
    }

    public function getImage(): ?string
    {
        return e($this->image);
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
        $url = '/uploads/' . $this->uploadFolder . '/' . $this->image . '_' . $format . '.jpg';
        return e($url);
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