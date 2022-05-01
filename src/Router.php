<?php 
namespace App; 

class Router {
    /*
    * @var string 
    */
    private $viewPath;

    /*
    * @var altorouter 
    */
    private $router;

    public $layout = "layouts/default.php";
    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new \AltoRouter();
    }

    public function get (string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);

        return $this;
    }

    public function post (string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);

        return $this;
    }

    public function match (string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST|GET', $url, $view, $name);

        return $this;
    }


    public function url(string $name, array $params = [])
    {
        return $this->router->generate($name, $params);
    }

    public function run ()
    {
        $match = $this->router->match();
        $params = $match['params'];
        $view = $match['target'];
        $router = $this;
        $isAdmin = strpos($view, 'admin/') !== false;
        $this->layout = $isAdmin ? 'admin/layouts/default' : 'layouts/default';
        ob_start();
        require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
        $content = ob_get_clean();
        require $this->viewPath . DIRECTORY_SEPARATOR . $this->layout . '.php';

        return $this;
    }

}


