<?php

namespace App\HTML;

use App\{paginatedQuery, Router};

final class ListingQuery
{

    private $items;
    private paginatedQuery $pagination;
    private string $link;
    private string $name;
    private string $display_name;
    private string $svg;
    private Router $router;

    public function __construct(
        array          $items,
        paginatedQuery $pagination,
        array $data,
        string $link,
        Router  $router
    )
    {
        $this->items = $items;
        $this->pagination = $pagination;
        $this->router = $router;
        $this->link = $link;
        foreach ($data as $link => $name) {
            $this->name = $link;

            $name_svg = explode('/', $name);
            $this->display_name = $name_svg[0];
            $this->svg = $name_svg[1];
        }

    }

    private function getHeaderListing(): string
    {
        $pageName = ucfirst($this->display_name);
        return <<<HTML
    <h2 class="medium-title mt3">
        <svg class="edit-svg svg-big">
            <use xlink:href="/img/svg/sprite.svg#{$this->svg}"></use>
        </svg>
        {$pageName}
    </h2>
    <p class="muted mt1">C'est ici que l'on s'occupe des {$this->display_name}s :)</p>
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

    private function getBodyListing($item): ?string
    {
        return <<<HTML
            <div class="card-design admin-card">
            <h4 class="admin-card__id mobile-hidden">{$item->getID()}</h4>
            <h4 class="admin-card__title">
                <a href="{$this->getEditLink($item)}"> {$item->getName()}</a>
            </h4>
            <div class="admin-card__option">
            <a href="{$this->getEditLink($item)}" class="btn-primary section-title {$this->getEditClass()}">
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

    private function getFooterListing(): string
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

    /**
     * Displays the entire listing
     * @return void
     */
    public function getListing(): void
    {
        echo $this->getHeaderListing();

        foreach ($this->items as $item) {
            echo $this->getBodyListing($item);
        }

        echo $this->getFooterListing();
    }

    /**
     * Get name of new button
     * @return string|null
     */
    private function getNewDisplay(): ?string
    {
        if ($this->display_name === 'article') {
            return 'un article';
        } elseif ($this->display_name === "catégorie") {
            return 'une catégorie';
        } elseif ($this->display_name === "image") {
            return 'des images';
        } elseif ($this->display_name === "document") {
            return 'des documents';
        } else {
            return null;
        }
    }

    /**
     * Get name of delete button
     * @return string|null
     */
    private function getDeleteDisplay(): ?string
    {
        if ($this->display_name === 'article') {
            return "l\'article";
        } elseif ($this->display_name === "catégorie") {
            return 'la catégorie';
        } elseif ($this->display_name === "image") {
            return "l\'image";
        } elseif ($this->display_name === "document") {
            return 'le document';
        }
        return null;
    }

    /**
     * Get edit link for Post|Category items
     * @param $item
     * @return string|null
     * @throws \Exception
     */
    private function getEditLink($item): ?string
    {
        if ($this->display_name === 'article' || $this->display_name === 'catégorie') {
            return $this->router->url('admin_' . $this->name, ['id' => $item->getID()]);
        } elseif($this->display_name === 'image') {
            return $this->router->url('image') . "?name=" . $item->getName() . "&width=600&height=600";
        } elseif($this->display_name === 'document') {
            return $this->router->url('home') . 'uploads/files/' . $item->getName();
        }
        return null;
    }

    /**
     * Decide whether edit button visible or not
     * @return string
     */
    private function getEditClass(): string
    {
        if ($this->display_name === 'article' || $this->display_name === 'catégorie') {
            return '';
        }
        return 'hidden';
    }
}