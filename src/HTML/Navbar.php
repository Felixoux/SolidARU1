<?php

namespace App\HTML;

use App\{Auth, Router};

final class Navbar
{
    private Router $router;
    private ?string $admin = null;

    /**
     * @param $router
     * @param string|null $admin
     */
    public function __construct($router, ?string $admin = null)
    {
        $this->router = $router;
        $this->admin = $admin;
    }

    public function getTop(): string
    {
        return <<<HTML
        <nav class="header {$this->admin}">
            <ul class="header-nav">
        <li class="header__home"><a title="Accueil" class="underline" href="{$this->router->url('home')}">
                <svg id="home">
                    <use xlink:href="/img/svg/sprite.svg#home"></use>
                </svg>
            </a>
        </li>
HTML;
    }

    public function getBottom(): string
    {
        return <<<HTML
    </ul>
    <ul class="header-side flex">
        {$this->getBottomLi()}
        <li class="header__burger">
            <button id="js-burger">
                <span>Afficher le menu</span>
            </button>
        </li>
    </ul>
    </nav>
HTML;

    }

    /**
     * Get the links
     * @param string $full_name
     * @param string $link
     * @return string|null
     * @throws \Exception
     */
    public function getLi(string $full_name, string $link): ?string
    {
        $name_svg = explode('/', $full_name);
        $name = $name_svg[0];
        $svg = $name_svg[1];
        $id = $name === 'Blog' ? 'id="blog-event"' : '';
        return <<<HTML
        <li $id>
            <h4>
                <a href="{$this->getLink($name, $link)}">
                    <svg>
                        <use xlink:href="/img/svg/sprite.svg#$svg"></use>
                    </svg>
                    $name
                </a>
            </h4>
        </li>
HTML;
    }

    /**
     * @param string $name
     * @param string $link
     * @return string
     * @throws \Exception
     */
    private function getLink(string $name, string $link): string
    {
        if ($name === 'Blog') {
            return $this->router->url('home') . '#event';
        }
        return $this->router->url($link);
    }

    /**
     * get the admin link only if connected
     * @return string|null
     * @throws \Exception
     */
    public function getAdminLink(): ?string
    {
        if (Auth::is_connected() === true) {
            return <<<HTML
        <li>
            <h4>
                <a title="Administration du site" href="{$this->router->url('admin_posts')}">
                    <svg>
                        <use xlink:href="/img/svg/sprite.svg#admin"></use>
                    </svg>
                    Admin
                </a>
            </h4>
        </li>
HTML;

        }
        return null;
    }

    /**
     * get link for content after links
     * @return string
     * @throws \Exception
     */
    private function getBottomLi(): string
    {
        if ($this->admin !== null) {
            return <<<HTML
        <li title="Se déconnecter" class="header__logout">
            <form action="{$this->router->url('logout', ['token' => $_SESSION['token']])}" method="POST">
                <button type="submit">
                    <svg>
                        <use xlink:href="/img/svg/sprite.svg#logout"></use>
                    </svg>
                </button>
            </form>
        </li>
HTML;

        }
        return <<<HTML
        <li title="Rechercher" class="header__search" id="searchBtn">
            <button>
                <svg>
                    <use xlink:href="/img/svg/sprite.svg#search"></use>
                </svg>
            </button>
        </li>
HTML;
    }
}