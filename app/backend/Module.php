<?php
namespace Multiple\Backend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    /**
     * Register a specific autoloader for the module
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();
        $loader->registerNamespaces(
            [
                "Multiple\\Backend\\Controllers" => "../app/backend/controllers/",
                "Multiple\\Backend\\Models"      => "../app/backend/models/",
            ]
        );

        $loader->register();
    }

    /**
     * Register specific services for the module
     */
    public function registerServices(DiInterface $di)
    {
        // Registering a dispatcher
        $di->set(
            "dispatcher",
            function () {
                $dispatcher = new Dispatcher();

                $dispatcher->setDefaultNamespace("Multiple\\Backend\\Controllers");

                return $dispatcher;
            }
        );

        // Registering the view component
        $di->set(
            "view",
            function () use($di) {
                $view = new View();

                $view->setViewsDir("../app/backend/views/");
				$volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
				$view->registerEngines(array('.phtml' => $volt));	
                return $view;
            }
        );
        
    }
}
