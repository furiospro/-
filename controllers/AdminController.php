<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 23.06.2020
 * Time: 1:51
 */

namespace controllers;
use components\Model;
use models\Admin;
class AdminController extends Model {

	/*"access_token": "IGQVJWc0M4UW13QUhnMHYyWDZAKaXhkc0R0ckhIWlJZATnBZANEFralpzcmp4WWRaRXJJN18yMnIxa2ZA5OGR0WFVyM2FBcW1LYy1JVUxIRl94R2RMT01BejdGVHNPZA1IyY2NiWmNQX21PcGJzcXZAYOUdoaFZA1STgtQW4tSnRZA", "user_id": 17841405635605097
	 *
	 *
	 *
	 * */
	public $admin;
	public $table = 'goods';


	public function actionEdit($post){
		//echo '<pre>'.print_r($post->postParams,1).'</pre>';exit();
		$id = htmlspecialchars($post->postParams['id']);
		//$sql = sprintf("`id_good`='%s'", $id);
		//$result = $this->select(['where'=>$sql]);
		$sql =  "SELECT g.*, s.name as style_name,sz.name as size_name FROM `goods` g, style s, size sz WHERE g.style = s.id AND g.size = sz.id and g.id_good = :id";
		$result = $this->getBySql($sql,['id'=>$id]);
		//$result['st_name'] = preg_match('/(\b\w+\b)/i',$result['size_name'],$match);
		//$result['style_name'] = preg_match('/(\b\w+\b)/i',$result['style_name'],$match);
		echo json_encode($result);
		//$curl = curl_init();
		//curl_setopt($curl, CURLOPT_URL,'https://www.instagram.com/avtoservis_zheltye_vorota/');
		//$response = curl_exec($curl);
		//echo $response;
	}


	 public function actionSave($post){
		$post1 = $post->postParams;

			$this->updateById(['id_good'=>htmlspecialchars($post1['id'])],[
				'price'=>htmlspecialchars($post1['price']),'description'=>htmlspecialchars($post1['description'],ENT_NOQUOTES),'quantity'=>htmlspecialchars($post1['quantity']),'img'=>htmlspecialchars($post1['img'])
			]);
			$this->actionEdit($post );




	 }

	 public function actionLoad($file){
			$file = $file->files;
		 echo json_encode($this->insertFile('uploads',$file));

		 //$this->actionEdit($request);
	 }//5640779853
	public function actionCheck($post){
		$admin = new Admin();
		//echo '<pre>'.print_r($post->postParams,1).'</pre>';exit();
		$data = $post->postParams['arData'];
		$field = $post->postParams['field'];
		echo json_encode($admin->getWearOpt($data,$field));
	}
}
