<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 20.02.2018
 * Time: 20:59
 */

namespace components;


class Db
{

	public $db = null;
    private $pdo = null;
    public $dbname = 'main';
    public $dbuser = 'furiospro';
    public $dbpass = '123456';
    public $dbhost = 'localhost';
    public $charset = 'utf8';
    public $options = [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // по умолчанию ассоциативный массив
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,//ошибки бросают исключения
		\PDO::MYSQL_ATTR_MULTI_STATEMENTS => true
    ];

    use \components\traits\SingletonTrait;

    public function init() {
      $this->getPDO();

    }

    public function getPDO() {
        if(empty($this->pdo)) {
            $this->pdo = new \PDO("mysql:host={$this->dbhost};dbname={$this->dbname};charset={$this->charset}",
                $this->dbuser,
                $this->dbpass,
                $this->options);
        }

        return $this->pdo;

    }
}
/*
 * $ar[] - массив с именами таблиц в базе данных
 * $namerows['Field'] - имена полей таблицы
 * $value - имена таблиц
 *$allcolumns - все колонки таблицы
 *$data_value - данные внутри поля
 *
 * function getDB($dbname, $string='тру-ла') {
	   $ar = [];
	   $link = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
	   $this->db = mysqli_query($link, "SELECT table_name
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA = '".$dbname."';");
	   while($table = mysqli_fetch_array($this->db)) {
		   $ar[] = $table[0];
	   }

	   foreach($ar as $value) {
		   //echo 'для таблицы '.$value.'<br>';
		   $allcolumns= mysqli_query($link, "SHOW COLUMNS FROM $value");
		   if(mysqli_num_rows($allcolumns)>0){
			   while($namerows = mysqli_fetch_assoc($allcolumns)){
					$name = $namerows['Field'];
				   $data_field = mysqli_query($link, "select $name from $value");
				   while($data_field_ar =mysqli_fetch_assoc($data_field)){
					   foreach($data_field_ar as $data_value){

					   	if(preg_match("'.$string.'",$data_value,$matches)){

							  	echo 'для поля '.$name.' таблицы :'.$value.' :';
							   echo $data_value.'<br>';
						   }
					   }


				   }
			   }

		   }

	   }


	   mysqli_close($link);
   }*/