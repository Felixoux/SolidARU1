<?php

namespace App;

use App\Security\ForbidenException;

class Router
{
    private string $viewPath;

    private \AltoRouter $router;

    public string $layout = "layouts/default.php";

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new \AltoRouter();
    }

    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);

        return $this;
    }

    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);

        return $this;
    }

    public function match(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST|GET', $url, $view, $name);

        return $this;
    }


    /**
     * @throws \Exception
     */
    public function url(string $name, array $params = []): string
    {
        return $this->router->generate($name, $params);
    }

    public function run()
    {
        $match = $this->router->match();
        $view = $match['target'] ?? 'e404';
        $params = $match['params'] ?? null;
        $router = $this;
        $isAdmin = strpos($view, 'admin/') !== false;
        $this->layout = $isAdmin ? 'admin/layouts/default' : 'layouts/default';
        try {
            ob_start();
            require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
            $content = ob_get_clean();
            require $this->viewPath . DIRECTORY_SEPARATOR . $this->layout . '.php';
        } catch (ForbidenException $e) {
            header('Location: ' . $this->url('login') . '?forbidden=1');
            exit();
        }

        return $this;
    }

}


