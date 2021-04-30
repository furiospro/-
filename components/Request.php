<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 20:23
 */

namespace components;

use controllers\BasketController;
use \Exception;
use models\Basket;

class Request
{
	private $pages = ['index','main','single'];
    protected $controller = 'index';
    protected $action = 'index';
    protected $controllerNamespace = 'controllers';
	public $idGood = null;
	public $template;
	public $header;
    public $getParams = [];
    public $postParams = [];
    public $files = [];
    public $sesParam =[];
    public $cookParam = [];

public function __construct($template,$header) {
	$this->template=$template;
	$this->header=$header;
	 $this->postParams=$_POST;
	 $b = new BasketController();
	 $b->sincBasket();
}

	public function init() {

        $url =  htmlspecialchars($_SERVER['REQUEST_URI']);

        $this->getParams = $_GET;
        $this->postParams = $_POST;
        $this->files = $_FILES;
        $this->sesParam = $_SESSION;

        $this->cookParam = $_COOKIE;


       if( $cleanUrl = stristr($url, '?', true) ) {
            $path = explode('/',$cleanUrl);

        } else {
            $path = explode('/',$url);

        }

        if( count($path) == 3 ) {

            $this->controller = $path[1];
            $this->action = $path[2];

        } elseif (count($path) == 2 && !empty($path[1]) ) {

            $this->controller = $path[1];


        }

        $classController = $this->controllerNamespace . '\\' . ucfirst($this->controller) . 'Controller';

        $action = 'action' . ucfirst($this->action);

        if(class_exists($classController)) {
           $instanceController = new $classController($this->template,$this->header);

           if(method_exists($instanceController,$action)) {
               call_user_func_array([$instanceController,$action],[$this]);


           } else {
                throw new Exception(' Метод не существует!');
           }
        }



    }

    public function is_ajax() {

        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        	//$this->redirect('/');
            return true;
        }
		elseif($_POST['pageAjax'] == 'uploadfile'){
			return true;
		}

        return false;

    }

}