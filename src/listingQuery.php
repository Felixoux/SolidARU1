<?php

namespace App;

class listingQuery
{

    private array $items;
    private paginatedQuery $pagination;
    private string $link;
    private string $name;
    private Router $router;
    private string $name_to_display;

    public function __construct(
        array          $items,
        paginatedQuery $pagination,
        string         $link,
        string         $name,
        string         $name_to_display,
        Router         $router
    )
    {
        $this->items = $items;
        $this->pagination = $pagination;
        $this->link = $link;
        $this->name = $name;
        $this->name_to_display = $name_to_display;
        $this->router = $router;
    }

    public function getHeaderListing(): string
    {
        return <<<HTML
    <h2 class="medium-title mt2">
    {$this->getSvg()}
    Page {$this->name_to_display}
    </h2>
    <p class="muted mt1">C'est ici que l'on s'occupe des {$this->name_to_display}s :)</p>
    <hr>
    <section class="post-listing">
        <div class="post-listing__header">
            <h3 class="mobile-hidden section-title">#</h3>
            <h3 class="mobile-hidden section-title">Titre</h3>
            <a href="{$this->router->url('admin_' . $this->name . '_new')}" class="btn btn-secondary new-article">
                + Ajouter {$this->getNewDisplay()}
            </a>
        </div>
    <section class="post-listing__body">
HTML;
    }

    public function getBodyListing($item): ?string
    {
        return <<<HTML
            <div class="card-design admin-card">
            <h4 class="admin-card__id mobile-hidden">{$item->getID()}</h4>
            <h4 class="admin-card__title">
                <a href="{$this->getEdit($item)}"> {$item->getName()}</a>
            </h4>
            <div class="admin-card__option">
            <a href="{$this->getEdit($item)}" class="btn-primary section-title {$this->getEditClass()}">
            <svg class="edit-svg">
                    <use xlink:href="/img/svg/sprite.svg#edit"></use>
            </svg>
            Éditer
            </a>
            <form style="display: inline;" method="POST"
                  action="{$this->router->url('admin_' . $this->name . '_delete', ['id' => $item->getID(), 'token' => $_SESSION['token']])}"
                  onsubmit="return confirm('Voulez vous vraiment supprimer {$this->getDeleteDisplay()} ?')">
                <button type="submit" class="btn btn-alert">
                <svg class="bin-svg">
                    <use xlink:href="/img/svg/sprite.svg#bin"></use>
                </svg>
                Supprimer
                </button>
            </form>
            </div>
            </div>
        HTML;
    }

    public function getFooterListing(): string
    {
        return <<<HTML
    </section>
    </section>
    <div class="footer-links">
    {$this->pagination->previousLink($this->link)}
    {$this->pagination->nextLink($this->link)}
    </div>
HTML;
    }

    private function getNewDisplay(): ?string
    {
        if ($this->name_to_display === 'article') {
            return 'un article';
        } elseif ($this->name_to_display === "catégorie") {
            return 'une catégorie';
        } elseif ($this->name_to_display === "image") {
            return 'des images';
        } elseif ($this->name_to_display === "document") {
            return 'des documents';
        } else {
            return null;
        }
    }

    private function getDeleteDisplay(): ?string
    {
        if ($this->name_to_display === 'article') {
            return "l\'article";
        } elseif ($this->name_to_display === "catégorie") {
            return 'la catégorie';
        } elseif ($this->name_to_display === "image") {
            return "l\'image";
        } elseif ($this->name_to_display === "document") {
            return 'le document';
        }
        return null;
    }

    private function getEdit($item): ?string
    {
        if ($this->name_to_display === 'article' || $this->name_to_display === 'catégorie') {
            return $this->router->url('admin_' . $this->name, ['id' => $item->getID()]);
        } elseif($this->name_to_display === 'image') {
            return $this->router->url('image') . "?name=" . $item->getName() . "&width=300&height=300";
        } elseif($this->name_to_display === 'document') {
            return $this->router->url('home') . 'uploads/files/' . $item->getName();
        }
        return null;
    }

    private function getEditClass(): string
    {
        if ($this->name_to_display === 'article' || $this->name_to_display === 'catégorie') {
            return '';
        }
        return 'hidden';
    }

    private function getSvg(): string
    {
        if ($this->name_to_display === 'article') {
            $svg = "post";
        } elseif($this->name_to_display === 'catégorie') {
            $svg = "category-title";
        } elseif($this->name_to_display === 'image') {
            $svg = "image";
        } else {
            $svg = 'document';
        }
        return <<<HTML
    <svg class="edit-svg svg-big">
                    <use xlink:href="/img/svg/sprite.svg#{$svg}"></use>
    </svg>
HTML;

    }
}