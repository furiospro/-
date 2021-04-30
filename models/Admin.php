<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 23.06.2020
 * Time: 1:28
 */

namespace models;

use components\Model;
class Admin extends Model{
	public $table = 'goods';

	/*public function editGoods($closure =[]){
		return $this->select($closure);// Выборка есть в моделях Goods. Переделать
	}*/

	public function getWearOpt($arData,$field){
		switch($field){
			case 'size':
				$tab = 'size';
				break;
			case 'style':
				$tab = 'style';
				break;
			default: return;
		}
		$sized = '';
		$s =[];
		foreach($arData as $item) {

			$s[$item] = $item;

		}
		foreach($s as $key => $value){
			$sized .= ":{$key},";
		}

		$sized = trim($sized,',');

		$sql = "SELECT name FROM $tab  WHERE name IN($sized)";

		return $this->getBySql($sql,$s);
	}

}