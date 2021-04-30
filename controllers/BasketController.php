<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 11.03.2020
 * Time: 20:57
 */

namespace controllers;
use components\controller;
use models\Basket;
use models\Goods;
use models\User;
class BasketController extends Controller {

	private $user;
	private $idGood;
	private $basket;
	private $arrGoods = null;
	private $count;
	public $user_id;

	public function __construct() {
		if(\components\Auth::getLogin()){

			$getuser = new User();
			$user_id = $getuser->getUserById($_SESSION['id_user']);
			$this->user_id = $user_id;

		}
	}

	public function actionAdd($session){
		$this->user = htmlspecialchars($session->sesParam['user']);
		$this->idGood = htmlspecialchars($session->postParams['id_good']);
		$this->basket = new Basket();
		$this->count = (int)htmlspecialchars($session->postParams['count']);

		if($this->user_id){

			$this->arrGoods = $this->basket->isGood($this->user,$this->idGood);
			if($this->arrGoods){
				$this->basket->updateById(['id_good'=>$this->idGood,'id_user'=>$this->user_id['id']],['quantity'=>$this->count]);
			}else{
				$this->basket->addToBasket(['id_user'=>$this->user_id['id'],'id_good'=>$this->idGood,'quantity'=>$this->count]);
			}
			echo json_encode($this->basket->selectFromBasket($this->user_id['id']));
		}
		else{
			$goods = new Goods();
			$item = $goods->getById($this->idGood);
			$this->arrGoods[$this->idGood]=['id_good'=>$this->idGood,'quantity'=>$this->count,'price'=>$item['price'],'description'=>$item['description']];

			if($_SESSION['basket']){// Были ли ранее записаны в session товары

				$_SESSION['basket']=array_merge($_SESSION['basket'],$this->arrGoods);

				}

			//Если товаров нет в cookie
			else{
				$_SESSION['basket'][$this->idGood]=['id_good'=>$this->idGood,'quantity'=>$this->count,'price'=>$item['price'],'description'=>$item['description']];}
			//!!!!!!!!!!!!!!!!!!!!!!!
			$basketcook = json_encode($_SESSION['basket']);
			setcookie('basket',$basketcook,time()+3600*24*30*12,'/');
			echo json_encode($_SESSION['basket']);

		}


	}

	public function actionShow(){
		$this->basket = new Basket();
		if(\components\Auth::getLogin()){

			echo json_encode($this->basket->selectFromBasket($this->user_id['id']));

		}else{
			echo json_encode($_SESSION['basket']);

		}

	}

	public function actionClear($session){
		$this->user = htmlspecialchars($session->sesParam['user']);
		$this->basket = new Basket();
		$key='id_user';
		unset($_SESSION['basket']);
		setcookie('basket','',time()-3600*24*30*12,'/');
		if(\components\Auth::getLogin()){
			echo json_encode($this->basket->basketClear($this->user_id['id'],$key));
		}else{
			echo json_encode($_SESSION['basket']);
		}

	}
	public function actionDelitem($this_){

		$this->idGood = htmlspecialchars($this_->postParams['id_good']);
		if(\components\Auth::getLogin()){
			$this->basket = new Basket();
			echo json_encode($this->basket->delItem(['id_user'=>$this->user_id['id'],'id_good'=>$this->idGood]));
		}else{
			unset($_SESSION['basket'][$this->idGood]);
			$basketcook = json_encode($_SESSION['basket']);
			setcookie('basket',$basketcook,time()+3600*24*30*12,'/');
			echo json_encode($_SESSION['basket']);
		}

	}

	public function sincBasket() {

		if($this->user_id) {
			$this->basket = new Basket();
			$res = $this->basket->selectFromBasket($this->user_id['id']);

			$arrBasket = [];

			foreach($res as $item) {
				$arrBasket[$item['id_good']] = $item;
			}
			unset($item);

			if($_SESSION['basket']) {
				$arrBasket = array_merge($arrBasket, $_SESSION['basket']);

				foreach($arrBasket as $item) {
					$l = $this->basket->updateBasket(['id_user' => $this->user_id['id'], 'id_good' => $item['id_good']], ['quantity' => $item['quantity']]);

					if($l == 0) {
						if(!$this->basket->isGood($this->user_id['id'], $item['id_good'])) {
							$goods['id_user'] = $this->user_id['id'];
							$goods['id_good'] = $item['id_good'];
							$goods['quantity'] = $item['quantity'];
							if($this->basket->addToBasket($goods)) {
								unset($goods);
							}
						}
					}
				}
			}
		}
	}
}