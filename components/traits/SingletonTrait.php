<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 02.03.2018
 * Time: 16:59
 */

namespace components\traits;
trait SingletonTrait
{
    private static $instance = null;
    private function __clone() {}
    private function __wakeup() {}
    protected function init() {}
    final private function __construct() {
	}

    public static function getInstance($template='',$header='')
    {

        if (empty(self::$instance)) {
            self::$instance = new self($template,$header);
            self::$instance->init();
        }

        return self::$instance;
    }




}