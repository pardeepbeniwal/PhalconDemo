<?php
namespace Multiple\Frontend\Controllers;
use Phalcon\Mvc\Controller;
use Multiple\Frontend\Models\Users as Users;

class SignupController extends Controller
{
	public function  initialize()
    {
        $this->view->title = '';
        $con = new CommonController();
		$con->theme();
    }

	public function indexAction()
	{			
		$this->view->title = 'User Singup';		
	}

	public function registerAction()
	{
		$user = new Users();		
		$messages = $user->validation();		
		// Store and check for errors
		$success = $user->save(
			$this->request->getPost(),
			array('name', 'email','password')
		);
		
		if ($success) {
			 $this->flash->success("The post was correctly saved!");
			$this->response->redirect("signup/index");
		} else {			
			$msg = $user;			
		}
		
		 $this->view->setVars(
            [
               'msg' => $msg
            ]
        );
		$this->view->render("signup","index");	
		$this->view->disable();	
	}

}
