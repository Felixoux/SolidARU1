<?php
namespace App\Model;

use App\Helpers\Text;
use \DateTime;

class Post {

    private $id;

    private $name;

    private $content;
    
    private $slug;

    private $created_at;

    private $categories;

    public function getName (): ?string
    {
        return htmlentities($this->name);
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

    public function getCreatedAt (): DateTime
    {
        return new DateTime($this->created_at);
    }

    public function getSlug() : ?string
    {
        return $this->slug;
    }

    public function getID(): ?int
    {
        return $this->id;
    }



}