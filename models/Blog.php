<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 20:54
 */

namespace models;


use components\Model;

class Blog extends Model
{

    public $table = 'blogs';

    public $fields = [
        'title'    => 'text',
        'content'  => 'text',
        'views'    => 'int'
    ];


    public function getBlogsOrderedByViews () {

        return $this->select(['orderby'=> 'views desc']);

    }
}