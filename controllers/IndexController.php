<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 21:06
 */

namespace controllers;


use components\Controller;
use models\Goods;
use models\Basket;
class IndexController extends Controller
{
	public $template;
	public $header;
	public function __construct($template,$header=null) {
		$this->template=$template;
		$this->header=$header;
	}

	public function actionIndex() {


		$_SESSION['basket'] = json_decode($_COOKIE['basket'],true);
		if(!$_SESSION['basket']){
			$_SESSION['basket'] = json_decode($_COOKIE['basket'],true);
		}
		$basket = new Basket();
		$productModel = new Goods();

        echo $this->renderWithLayout ($this->template,['result'=>$productModel->select(['orderby'=>'views desc','limit'=>8])],['basket'=>$basket->basketCost()],$this->header);

    }

}