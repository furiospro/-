<?php


namespace components;


class App
{

    use \components\traits\SingletonTrait;

    public $request = null;
    public $auth = null;
    public $db = null;
	public $template;
	public $header;
    public function __construct($maket_temp,$maket_header) {
    	$this->template=$maket_temp;
    	$this->header=$maket_header;
	}

	public function init()
    {
        $this->db =   \components\Db::getInstance();
        $this->auth = \components\Auth::getInstance();

        $this->request = new Request($this->template,$this->header);

        if($this->request->is_ajax()===true){

        	switch($_POST['pageAjax']){

				case 'reguser':
					$_SERVER['REQUEST_URI']='/account/reg';
					$this->request->init();
					return;
				case 'basket':
					$_SERVER['REQUEST_URI']='/basket/add';

					$this->request->init();
					break;
				case 'showBasket':
					$_SERVER['REQUEST_URI']='/basket/show';
					$this->request->init();
					break;
				case 'clearBasket':
					$_SERVER['REQUEST_URI']='/basket/clear';
					$this->request->init();
					break;
				case 'delitem':
					$_SERVER['REQUEST_URI']='/basket/delitem';
					$this->request->init();
					break;
				case 'filterform':
					$_SERVER['REQUEST_URI']='/product/filter';
					$this->request->init();
					break;
				case 'toOrder':
					return;
				case 'auth':
				$_SERVER['REQUEST_URI']='/account/login';
				$this->request->init();
				break;
				case 'logout':
					$_SERVER['REQUEST_URI']='/account/logout';
					$this->request->init();
					break;
				case 'editgoods':
					$_SERVER['REQUEST_URI']='/admin/edit';
					$this->request->init();
					break;
				case  'saveedit':
					$_SERVER['REQUEST_URI']= '/admin/save';
					$this->request->init();
					break;
				case  'uploadfile':
					$_SERVER['REQUEST_URI']= '/admin/load';
					$this->request->init();
					break;
				case  'checkdata':
					$_SERVER['REQUEST_URI']= '/admin/check';
					$this->request->init();
					break;
			}
		}else{

			$this->request->init();
		}



    }

    public static function getAppRootDir() {
        return $_SERVER['DOCUMENT_ROOT'].'/';

    }
}