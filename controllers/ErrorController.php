<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 29.03.2020
 * Time: 15:37
 */

namespace controllers;
use components\Controller;
use models\Goods;
class ErrorController extends Controller{
	function ActionError($par){
		echo $this->renderWithLayout ('error',['result'=>$par]);
	}
}