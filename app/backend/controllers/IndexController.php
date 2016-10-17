<?php
namespace Multiple\Backend\Controllers;

class IndexController extends ControllerBase
{	 
	public function initialize()
    {
		
    }
    public function dashboardAction()
    {
        $this->view->title = 'Admin Area';	
    }
    
    public function logoutAction()
    {
       $this->session->remove('adminAuth');
       $this->response->redirect("admin/index/dashboard");	
    }
}
