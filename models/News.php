<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 21:03
 */

namespace models;

use \components\Model;

class News extends Model
{

    public $table = 'news';

    public $fields = [
        'title' => 'text',
        'content'  => 'text',
        'views' => 'int',
    ];

    public function getNews () {

        return $this->select();

    }

}