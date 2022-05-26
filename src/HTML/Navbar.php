<?php

namespace App\HTML;

use App\Router;

class Navbar
{

    private array $names;
    private array $links;
    private array $svgs;
    private Router $router;

    public function __construct(
        array $links,
        array $svgs,
        Router $router
    )
    {
        $this->names = $links;
        $this->svgs = $svgs;
        $this->router = $router;
    }

    public function getNav(): string
    {
        return <<<HTML
    <nav class="header">
    <ul class="header-nav">
        <li class="header__home"><a class="underline" href="{$this->getLink()}">
                <svg id="home">
                    <use xlink:href="/img/svg/sprite.svg#home"></use>
                </svg>
            </a>
        </li>
        {$this->getLi()}
        {<?php if (App\Auth::is_connected() === true): ?>}
            <li>
                <h4>
                    <a href="{$this->getLink()}">
                        <svg>
                            <use xlink:href="/img/svg/sprite.svg#admin"></use>
                        </svg>
                        Admin
                    </a>
                </h4>
            </li>
        {<?php endif ?>}
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

    private function getLi(): ?string
    {
        foreach ($this->names as $name => $link) {
            foreach ($this->svgs as $name_for_svg => $svg) {
            return <<<HTML
        <li>
            <h4>
                <a href="{$this->getLink()}">
                    <svg>
                        <use xlink:href="/img/svg/sprite.svg#{$svg}"></use>
                    </svg>
                    {$name}
                </a>
            </h4>
        </li>
HTML;
            }
        }
        return null;
    }

    private function getLink(): ?string
    {
        foreach($this->names as $name => $link) {
            return $this->router->url($link);
        }
        return null;
    }



}