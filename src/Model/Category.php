<?php 
namespace App\Model;
use App\Helpers\Text;

class Category {

    private $id; 

    private $name;

    private $summary;

    private $slug; 

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getName (): ?string
    {
        return $this->name;
    }

    public function getExerpt(int $limit = 60): ?string
    {
        if($this->summary === null) {
            return $this->summary;
        }
        return htmlentities(Text::exerpt($this->summary, $limit));
    }

    public function getSlug() : ?string
    {
        return $this->slug;
    }

    


}