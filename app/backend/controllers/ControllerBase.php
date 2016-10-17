<?php
namespace Multiple\Backend\Controllers;
use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
	 public function beforeExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher)
    { 
		$this->view->setTemplateAfter("default");
		$this->view->title = 'Admin Area'; 
        if (false === $this->session->has('adminAuth')) {
            $this->response->redirect("admin");
        }
    }	
}
