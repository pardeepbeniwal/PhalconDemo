<?php

use Phalcon\Loader;
use Phalcon\Tag;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
 use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Application;

ini_set('display_errors', '1');
ini_set('displaystartuperrors', 1);
error_reporting(E_ALL);

$listener = new \Phalcon\Debug();
$listener->listen(true, true);
$di = new FactoryDefault();


try {		
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
         $di->set(
			"router",
				function () {
					require __DIR__ . "/../app/config/routes.php";
					return $router;
				}
			);
      
   

    // Setup a base URI so that all generated URIs include the "tutorial" folder
    $di->set('url', function() {
        $url = new Url();
        $url->setBaseUri('/phalcon/website/public/');
        return $url;
    });
    $di->set('cookies', function() {
		$cookies = new Phalcon\Http\Response\Cookies();
		$cookies->useEncryption(true);
		return $cookies;
	});

	$di->set('crypt', function() {
		$crypt = new Phalcon\Crypt();
		$crypt->setKey('#_+//*(*&eA|;76$');
		return $crypt;
	});
      $di->set('db', function () {
            return new DbAdapter(array(
            "host"     => "localhost",
            "username" => "root",
            "password" => "password@123",
            "dbname"   => "phalcon"
        ));
        }); 

    // Setup the tag helpers
    $di->set('tag', function() {
        return new Tag();
    });
    $di->set('flash', function() {
        return new \Phalcon\Flash\Direct();
    });
   

	$di->set('session', function() {
		$session = new SessionAdapter();
		$session->start();
		return $session;
	});
    
	$application = new Application($di);  
        //Register the installed modules
        $application->registerModules(array(
            'frontend' => array(
                'className' => 'Multiple\Frontend\Module',
                'path' => '../app/frontend/Module.php'
            ),
            'backend' => array(
                'className' => 'Multiple\Backend\Module',
                'path' => '../app/backend/Module.php'
            )
        ));
    // Handle the request
    

    echo $application->handle()->getContent();

} catch (Exception $e) {
     echo "Exception: ", $e->getMessage();
}
