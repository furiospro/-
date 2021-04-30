<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 21:18
 */

namespace components;


use components\traits\SingletonTrait;
use models\User;

class Auth extends Controller
{

    use SingletonTrait;
    private $user;


    public function getUser()
    {
        return $this->user;
    }

    public static function check() {
        return !empty(self::getInstance()->getUser());
    }

    public static function getLogin() {

        if(!self::check()) {
            return null;
        }

        $user = self::getInstance()->getUser();

        return $user['login'];


    }

    public static function isAdmin() {

        $user = self::getInstance()->getUser();

        if(!empty($user['login']) && $user['login'] == 'admin') {
            return true;
        }

        return false;
    }

    public function init() {

        $this->user = null;

        $userModel = new User();



		if(!empty($_SESSION['memory']&& $_SESSION['memory']=='on')){
			//setcookie('idUserCookie',$_SESSION['id_user'],time()+3600*24*7);//Авторизация по кукам
			unset($_SESSION['memory']);
		}elseif(!empty($_SESSION['memory']&& $_SESSION['memory']=='off')){
			//setcookie("idUserCookie",'',time() -3600*24*7);//Удаление куки авторизации
			unset($_SESSION['memory']);
			$this->redirect('/');
		}


		if(!empty($_SESSION['id_user'])){

			$this->user = $userModel->getUserById($_SESSION['id_user']);

		}
        elseif(!empty($_COOKIE['idUserCookie'])){

			$this->user = $userModel->getUserById($_COOKIE['idUserCookie']);
			if($this->user){
				$_SESSION['id_user']=$_COOKIE['idUserCookie'];
				$_SESSION['user']=$this->user['login'];
			}
		}



    }

}