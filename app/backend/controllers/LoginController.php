<?php
namespace Multiple\Backend\Controllers;
use Phalcon\Mvc\Controller;
use Multiple\Backend\Models\Users as Users;

class LoginController extends Controller
{
	public function  initialize()
    {
        $this->view->setTemplateAfter("default1");
        $this->view->title = '';
        if($this->session->has('adminAuth'))
        {
			$this->response->redirect("admin/index/dashboard");
		}
    }
    public function indexAction()
    {
		$this->view->title = 'Admin Login';	
    }
     private function _registerSession($user)
    {
        $this->session->set(
            "adminAuth",
            [
                "id"   => $user->id,
                "username" => $user->username,
            ]
        );
    }
    
    public function processAction()
	{
		 if ($this->request->isPost()) {
            
            $email    = $this->request->getPost("email");
            $password = $this->request->getPost("password");
			
            $user = Users::findFirst(
                [
                    "(email = :email: OR username = :email:) AND password = :password: AND active = '1'",
                    "bind" => [
                        "email"    => $email,
                        "password" => sha1($password),
                    ]
                ]
            );

            if ($user !== false) {
                $this->_registerSession($user);
                $this->flash->success(
                    "Welcome " . $user->username
                );
                $this->response->redirect("admin/index/dashboard");
            }			
            $error = 'Username or password is invalid';
        }
       
		//;
        $this->view->setVars(
            [
               'error' => $error
            ]
        );		
        return $this->dispatcher->forward(
            [
                "controller" => "login",
                "action"     => "index",
            ]
        );
    }
	
}
