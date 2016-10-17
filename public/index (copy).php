<?php

use Phalcon\Loader;
use Phalcon\Tag;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Application as BaseApplication;

ini_set('display_errors', '1');
ini_set('displaystartuperrors', 1);
error_reporting(E_ALL);

$listener = new \Phalcon\Debug();
$listener->listen(true, true);
$di = new FactoryDefault();


class Application extends BaseApplication
{
    /**
     * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
     */
    protected function registerServices()
    {
        $di = new FactoryDefault();
        $loader = new Loader();
        /**
         * We're a registering a set of directories taken from the configuration file
         */
        $loader->registerDirs(
            array(
                __DIR__ . '/../app/library/'
            )
        )->register();
        //Registering a router
        $di->set('router', function () {
            $router = new Router();
            $router->setDefaultModule("frontend");
            $router->add('/:controller/:action', array(
                'module' => 'frontend',
                'controller' => 1,
                'action' => 2,
            ));
            $router->add("/admin", array(
                'module' => 'backend',
                'controller' => 'login',
                'action' => 'index',
            ));
            $router->add("/admin/products/:action", array(
                'module' => 'backend',
                'controller' => 'products',
                'action' => 1,
            ));
            $router->add("/products/:action", array(
                'module' => 'frontend',
                'controller' => 'products',
                'action' => 1,
            ));
            return $router;
        });
        $this->setDI($di);
    }
    public function main()
    {
        $this->registerServices();
        //Register the installed modules
        $this->registerModules(array(
            'frontend' => array(
                'className' => 'Multiple\Frontend\Module',
                'path' => '../app/frontend/Module.php'
            ),
            'backend' => array(
                'className' => 'Multiple\Backend\Module',
                'path' => '../app/backend/Module.php'
            )
        ));
        echo $this->handle()->getContent();
    }
}
$application = new Application();
$application->main();
