<?php

namespace models;


use components\Model;
use models\User;
class Basket extends Model
{
	public $basdat;
    public $table = 'basket';
	protected $isGood = null;
	protected $goods =null;
	public $fields = [
		'id_user'  => 'text',
        'id_good'    => 'int',
        'quantity'    => 'int'
    ];

	public function isGood($idUser,$idGood) {
		$this->isGood =  $this->select(['where'=>"id_user= '{$idUser}'",'and'=>"id_good= '{$idGood}'"]);
		if($this->isGood){
			return $this->isGood;
		}
	}

	public function addToBasket ($values) {
		$this->insert($values);

    }

    public function updateBasket($id, $values){
		$this->updateById($id,$values);
	}

	public function selectFromBasket($idUser){

		$sql="SELECT a.id_good, a.price, a.description, b.quantity FROM goods a, basket b WHERE a.id_good IN(SELECT b.id_good FROM basket WHERE b.id_user IN (:id_user)) AND b.id_user IN(:id_user)";

			$statement = $this->pdo->prepare($sql);
			$statement->execute(['id_user'=>$idUser]);
			return $statement->fetchAll();

	}

	public  function basketCost(){

		$total =0;
		$totalCount=0;
		if(\components\Auth::getLogin()){
			$id = new User();
			$id = $id->getUserById($_SESSION['id_user']);

			$this->basdat = $this->selectFromBasket($id['id']);
		}elseif(!empty($_SESSION['basket'])){
			$this->basdat= $_SESSION['basket'];
		}
		if(!empty($this->basdat)){
			foreach($this->basdat as $key=>$value){
				$count = (int)$this->basdat[$key]['quantity'];
				$price = (float)$this->basdat[$key]['price'];
				$price = $count*$price;
				$total += $price;
				$totalCount += $count;
			}
			unset($key);
			unset($value);
		}

			$arrbasket=['total'=>$total,'totalcount'=>$totalCount];
			return $arrbasket;


	}
	public function basketClear($id,$key){

		$this->deleteById($key,$id);
		return $this->select(['where'=>"id_user= '{$id}'"]);
	}
	public function delItem($id){
		$this->deleteRow($id);
		return $this->selectFromBasket($id['id_user']);
	}
}