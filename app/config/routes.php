<?php
use Phalcon\Mvc\Router;

$router = new Router();
$router->setDefaultModule("frontend");
               
	/*$router->add('/:controller/:action', array(
		'module' => 'frontend',
		'controller' => 1,
		'action' => 2,
	));*/
	$router->add("/changetheme/{id}", array(
		'module' => 'frontend',
		'controller' => 'common',
		'action' => 'index',
	));
	$router->add("/admin", array(
                'module' => 'backend'

            ));
	$router->add('/admin', array(
		'module' => 'backend',
		'controller' => 'login',
		'action' => 'index',
	));

	$router->add('/admin/:controller/:action', array(
		'module' => 'backend',
		'controller' => 1,
		'action' => 2,
	));
	$router->add(
		"/admin/:controller/:action/:params",
		array(
		'module' => 'backend',
			"controller" => 1,
			"action"     => 2,
			"params"     => 3,
	));
	/*$router->add("/admin", array(
		'module' => 'backend',
		'controller' => 'login',
		'action' => 'index',
	));
	$router->add('admin/:controller/:action', array(
		'module' => 'backend',
		'controller' => 1,
		'action' => 2,
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
	));*/
	 
            
     
$router->handle();
