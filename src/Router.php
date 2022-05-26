<?php

namespace App;

use App\Security\ForbidenException;

final class Router
{
    private string $viewPath;

    private \AltoRouter $router;

    public string $layout = VIEW_PATH . DIRECTORY_SEPARATOR . 'layouts/default.php';

    /**
     * @param string $viewPath
     */
    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new \AltoRouter();
    }

    /**
     * Permet de faire une page en GET
     * @param string $url
     * @param string $view
     * @param string|null $name
     * @return $this
     * @throws \Exception
     */
    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);

        return $this;
    }

    /**
     * Permet de faire une page en POST
     * @param string $url
     * @param string $view
     * @param string|null $name
     * @return $this
     * @throws \Exception
     */
    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);

        return $this;
    }

    /**
     * Permet de faire une page en POST + GET
     * @param string $url
     * @param string $view
     * @param string|null $name
     * @return $this
     * @throws \Exception
     */
    public function match(string $url, string $view, ?string $name = null): self
    {
        try {
            $this->router->map('POST|GET', $url, $view, $name);
        } catch(\Exception $e) {
            throw new \Exception('Cette page n\'est pas trouvée par le routeur');
            //header('Location: /');
        }
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function url(string $name, array $params = []): string
    {
        return $this->router->generate($name, $params);
    }

    /**
     * Execute le Router
     * @return $this
     * @throws \Exception
     */
    public function run(): self
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


