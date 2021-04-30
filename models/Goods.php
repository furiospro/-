<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 02.03.2018
 * Time: 21:29
 */

namespace models;


use components\Model;
class Goods extends Model
{
    public $table = 'goods';

    public $fields = [
        'id_good'    =>'text' ,
        'img'  => 'text',
		'price'=>'text',
		'views'=>'int',
        'description'    => 'text'
    ];

    public function getGoods($closure=[]) {
		return $this->select($closure);
    }

    public function getGoodsByCategory($id) {


		$sql =  "SELECT * FROM goods  WHERE id_good = :id";
		$result = $this->getBySql($sql,['id'=>$id]);
		preg_match_all('/\w+/i',$result[0]['style'],$match);


		$style = '';
		foreach($match[0] as $key => $val) {
			$style .= "?,";
		}
		$style = trim($style,',');

		$sql = "SELECT `name` FROM style WHERE id IN ({$style})";

		$result[0]['style'] = $this->getBySql($sql,$match[0]);

		unset($match,$key,$val);
		preg_match_all('/\w+/i',$result[0]['size'],$match);


		$size = '';
		foreach($match[0] as $key => $val) {
			$size .= "?,";
		}
		$size = trim($size,',');

		$sql = "SELECT `name` FROM size WHERE id IN ({$size})";

		$result[0]['size'] = $this->getBySql($sql,$match[0]);

		return $result[0];
    }
    public function getFilterGoods($size=[],$style=[],$price=[]){
    	$query = "select * from goods ";
		$par =[];

    	if(!empty($size)){
			$sized = '';
			$s =[];
			foreach($size as $item) {
				$s[$item] = $item;
				$par[$item] = $item;
    		}
    		foreach($s as $key => $value){
				$sized .= ":{$key},";
			}

			unset($item,$value,$key,$s);
			$sized = trim($sized,',');

			unset($item);
			$query .= "inner join size on size.id = goods.size and size.name in($sized)";

		}
		if(!empty($style)){

    		$s =[];
    		$styled = '';
			foreach($style as $item) {
				$s[$item] = $item;
				$par[$item] = $item;
    		}
    		foreach($s as $key => $value){
				$styled .= ":{$key},";
			}
			unset($item,$value,$key,$s);
    		$styled = trim($styled,',');

			$query .= "inner join style on style.id = goods.style and style.name in({$styled})";

		}
		if(!empty($price)){
				$p =[];
    			for($i=0; $i<count($price);$i++){

    				$par['price'.$i] = $price[$i];
				}
    			$query.= "where price between :price0 and :price1";

		}



    		$query .= " ORDER BY views DESC";

		return $this->getBySql($query,$par);
	}

}