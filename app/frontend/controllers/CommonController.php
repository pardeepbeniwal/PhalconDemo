<?php
namespace Multiple\Frontend\Controllers;
use Phalcon\Mvc\Controller;

use Phalcon\Http\Response\Cookies;

class CommonController extends Controller
{
	public function indexAction($id)
	{	
		$this->cookies->set("css",'default_'.$id,time() + 15 * 86400);
		$this->response->redirect("");			
	}
	
	public function theme()
	{
		$css = $layout = 'default_1';
        if ($this->cookies->has("css")) 
        {           
            $css = $this->cookies->get("css");
            $css = $layout = $css->getValue();
        }
        $this->view->setTemplateAfter($layout); 
        $this->assets->addCss('css/'.$css.'.css');
	}
	
}
