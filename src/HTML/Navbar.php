<?php

namespace App\HTML;

use App\Auth;
use App\Router;

class Navbar
{
    private Router $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function getTop(): string
    {
        return <<<HTML
        <nav class="header">
            <ul class="header-nav">
        <li class="header__home"><a class="underline" href="{$this->router->url('home')}">
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
        <li class="header__search" id="searchBtn">
            <button>
                <svg>
                    <use xlink:href="/img/svg/sprite.svg#search"></use>
                </svg>
            </button>
        </li>
        <li class="header__burger">
            <button id="js-burger">
                <span>Afficher le menu</span>
            </button>
        </li>
    </ul>
    </nav>
HTML;

    }

    public function getLi(string $full_name, string $link): ?string
    {
        $name_svg = explode('/', $full_name);
        $name = $name_svg[0];
        $svg = $name_svg[1];
        return <<<HTML
        <li>
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

    private function getLink(string $name, string $link): string
    {
        if ($name === 'Blog') {
            return $this->router->url('home') . '#event';
        }
        return $this->router->url($link);
    }

    public function getAdminLink(): ?string
    {
        if (Auth::is_connected() === true) {
            return <<<HTML
        <li>
            <h4>
                <a href="{$this->router->url('admin_posts')}">
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

}