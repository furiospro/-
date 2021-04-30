<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 09.03.2020
 * Time: 22:42
 */

namespace controllers;

use components\controller;
use models\Goods;
use models\Basket;
class ProductController extends Controller

{
	public $template;
	public $header;
	public $basdat;

	public function __construct($template,$header=null) {
		$this->template=$template;
		$this->header=$header;
	}
	public function actionIndex() {
		$productModel = new Goods();
		$basket = new Basket();
		$result = $productModel->getGoods(['orderby'=> 'views desc','limit'=>9]);
		$style = $basket->getBySql("SELECT name FROM `style` ORDER BY id");
		$size = $basket->getBySql("SELECT name FROM `size` ORDER BY id");
		echo $this->renderWithLayout ('product',['arrResult' => ['goods' =>$result,'style' =>$style,'size' => $size]],['basket'=>$basket->basketCost()],$this->header);
	}

	public function actionSingle(){
		/*
		 * добавить в БД гендерные категории товаров и организовать их выборку в шаблон single в зависимости от категории заказываемого товара
		 *
		 *
		 * */
		//echo json_encode($_GET);

		/*public function actionIndex() {
		$productModel = new Goods();
		$basket = new Basket();
		echo $this->renderWithLayout ('product',['result'=>$productModel->getGoods(['orderby'=> 'views desc'])],['basket'=>$basket->basketCost()],$this->header);
	}*/

		$basket = new Basket();
		$productModel = new Goods();
		$result=$productModel->getGoodsByCategory($_GET['id']);

		$productModel->updateById(['id_good'=>$_GET['id']],['views'=>$result['views']+1]);
		echo $this->renderWithLayout ('single',['result'=>$result,'goods'=> $productModel->getGoods(['orderby'=>'views desc','limit'=>4])],['basket'=>$basket->basketCost()],$this->header);
	}

	public  function actionFilter($post){
		$goods = new Goods();
		$size=[];
		$style=[];
		$price=[];
		if(is_array($post->postParams['size'])){
			for($i =0; $i<count($post->postParams['size']);$i++){
				$size[] = htmlspecialchars($post->postParams['size'][$i]);
			}
		}else{
			$size = null;
		}
		if(is_array($post->postParams['style'])){
			for($i =0; $i<count($post->postParams['style']);$i++){
				$style[] = htmlspecialchars($post->postParams['style'][$i]);
			}
		}else{
			$style = null;
		}
		if(is_array($post->postParams['price'])){
			for($i =0; $i<count($post->postParams['price']);$i++){
				$price[] = htmlspecialchars($post->postParams['price'][$i]);
			}
		}else{
			$price = null;
		}

		//$size = htmlspecialchars($post->postParams['size']);
		//$style = htmlspecialchars($post->postParams['style']);
		//$price = htmlspecialchars($post->postParams['price']);
		echo json_encode($goods->getFilterGoods($size,$style,$price));

	}
}