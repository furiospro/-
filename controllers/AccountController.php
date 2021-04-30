<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 03.03.2018
 * Time: 18:59
 */

namespace controllers;

use components\Controller;
use \components\Request;
use \models\User;

class AccountController extends Controller
{
    public function actionLogin($post) {

        if(!empty($post->postParams)){
            $modelUser = new User();
			$login = htmlspecialchars($post->postParams['login']);
			$pass = htmlspecialchars($post->postParams['pass']);
            $user = $modelUser->getUserByLogin($login);

//$user['pass'] == password_hash($request->postParams['pass']

            if(!empty($user)) {

            	if(password_verify($pass,$user['pass'])){
					$userCookie = microtime(true).rand(100,1000000000000);
					$_SESSION['user'] = $user['login'];
					$_SESSION['id_user']=$userCookie;
					$val=['id_user'=>$_SESSION['id_user']];
					$modelUser->updateIdUser($val,['login'=>$_SESSION['user']]);
					if(isset($post->postParams['mem']) && $post->postParams['mem']=='on'){
						$_SESSION['memory'] = 'on';
					}
					echo json_encode(['success'=>true]);

				}else{
					echo json_encode(['success'=>false]);
				}
			}
			else {
                echo json_encode(['success'=>'empty']);
            }

        }
    }

    public function actionLogout() {
		$_SESSION['memory'] = 'off';
		setcookie("idUserCookie",'',time() -3600*24*7);
		unset($_SESSION['user']);
		unset($_SESSION['id_user']);
		echo json_encode(['logout'=>true]);
    }

	public function actionReg(Request $request){

		if(!empty($request->postParams['login'] && $request->postParams['pass'])){
			$modelUser = new User();
			$user = $modelUser->getUserByLogin($request->postParams['login']);
			if($user){
				echo json_encode(['success'=>'double']);
			}else{

				$pass = password_hash($request->postParams['pass'],PASSWORD_DEFAULT);
				$a=['login'=>$request->postParams['login'],'pass'=>$pass,'id_user'=>' '];
				$modelUser->regUser($a);
				echo json_encode(['success'=>'hadreg']);
			}
		}else{
			echo json_encode(['success'=>'empty']);
		}
	}

}

