<?php
namespace Multiple\Frontend\Controllers;
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function initialize()
    {              
        $con = new CommonController();
		$con->theme();
    }

	public function indexAction()
	{
		$this->view->title = 'Home Page';
	}
}

