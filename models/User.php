<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 21:21
 */

namespace models;


use components\Model;

class User extends Model
{

    public $table = 'users';

    public $fields = [
        'login' => 'text',
        'pass'  => 'text',
		'id_user'=>'text'

    ];

    public function getUserByLogin($login) {
        $result = $this->select(['where' => "login= '{$login}'"]);
        return $result[0];
    }

    public function getUserById($id = null) {

    	$result = $this->getById($id,'id_user');

        return $result;
    }
    public function updateIdUser($values,$id){
    	$this->updateById($id,$values);
	}

	public function regUser($values){
    	$this->insert($values);
	}
}
