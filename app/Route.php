<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/09/2017
 * Time: 00:35
 */

namespace App;


class Route
{
    private $routes;

    public function __construct()
    {
        $this->initRouts();
        $this->run($this->getUrl());
    }


    public function initRouts()
    {
        $routes['home'] = array('route'=>'/', 'controller'=>'indexController', 'action'=>'index');
        $routes['contato'] = array('route'=>'/contact', 'controller'=>'indexController', 'action'=>'contact');

        $this->setRoutes($routes);

    }


    public function run($url)
    {
        array_walk($this->routes, function($route) use($url)
        {
            if($url == $route['route'])
            {
                $class = "App\\Controllers\\".ucfirst($route['controller']);
                $controller = new $class();
                $action = $route['action'];
                $controller->$action();
            }
        });
    }

    /**
     * @param mixed $routes
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    public function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }


}