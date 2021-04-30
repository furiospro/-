<?php
/**
 * Created by PhpStorm.
 * User: alterwalker
 * Date: 27.02.2018
 * Time: 20:20
 */

namespace components;


abstract class Model
{
	public $c =1;
    public $pdo = null;
    public $table = '';
    public $fields = [];
    public $rules = [];

    public function __construct()
    {
        $this->pdo = \components\Db::getInstance()->getPDO();
    }

    public function select($closure = []) {

        $query = 'select * from ' . $this->table;

        if(!empty($closure['where'])) {
            $query .= ' where ' . $closure['where'];
            if(!empty($closure['and'])){
            	$query.= ' and '.$closure['and'];
			}
        }



        if(!empty($closure['orderby'])) {
            $query .= ' order by ' . $closure['orderby'];
        }

        if(!empty($closure['limit'])) {
            $query .= ' limit ' . $closure['limit'];
        }

        $statement = $this->pdo->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

    public function getBySql($sql,$par=null){

    	$statement = $this->pdo->prepare($sql);
    	if($par){

			 $statement->execute($par);
		}else{
			$statement->execute();
		}
    	return $statement->fetchAll();
		//return $statement->execute();
	}

    public function getById( $id = null, $key=null) {

        if(empty($id)) {
            return null;
        }
        if(!($key)){
        	$key = 'id_good';
		}

        $query = "select * from ".$this->table." where {$key} = :id";

        $statement = $this->pdo->prepare($query);

        $statement->execute(['id'=>$id]);

        return $statement->fetch();

    }

    public function updateById( $id , $values )
    {

        if(empty($id) || empty($values)) {

            return null;
        }

        if(!$this->validate($values, $this->fields)) {
            return false;
        }

        $query = 'update ' . $this->table . ' set ';

        $fields = [];
        foreach ($values as $key => $value) {
            $fields[] = "{$key} = :{$key}";
        }
		unset($key);
        unset($value);
        $a =[];
        $query .= implode(', ', $fields);

        foreach($id as $key=>$value){
        	$a[]="{$key}=:{$key}";
		}
		unset($key);
        unset($value);
        if(count($a)>1){

        	$query .= ' where '.$a[0].' and '.$a[1].'';
		}else{
			$query .= ' where '.$a[0].'';
		}


        $statement = $this->pdo->prepare($query);

        $statement->execute(array_merge( $values ,$id));
        return $statement->rowCount();
    }


    public function deleteById($key=null, $id = null)
    {

        if (empty($id)) {

            return null;
        }
        if(empty($key)){
        	$key='id';
		}

        $query = 'delete from ' . $this->table . ' where '.$key.' = :id ';

        $statement = $this->pdo->prepare($query);

        return $statement->execute(['id' => $id]);
    }

    public function deleteRow($id){
    	$a=[];
		$query = 'delete from '.$this->table.' ';
		foreach($id as $key=>$value){
			$a[]="{$key}=:{$key}";
		}
		unset($key);
		unset($value);
		if(count($a)>1){

			$query .= ' where '.$a[0].' and '.$a[1].'';
		}else{
			$query .= ' where '.$a[0].'';
		}
		$statement = $this->pdo->prepare($query);
		return $statement->execute($id);
	}

    public function insert ($values = []) {


/*
        $statement = $this->pdo->prepare("insert into blogs (title,content) VALUES ('Заголовок из PDO', 'Текст из PDO')");
        return $statement->execute();
*/

/*
        $statement = $this->pdo->prepare("insert into blogs (title,content) VALUES (?, ?)");

        $title = 'Заголовок из PDO2';
        $content = 'Текст из PDO2';

        $statement->bindParam( 1 , $title);
        $statement->bindParam( 2 , $content);

        $statement->execute();

        $title = 'Заголовок из PDO3';
        $content = 'Текст из PDO3';

        $statement->execute();
*/

/*
        $statement = $this->pdo->prepare("insert into blogs (title,content) VALUES (:title, :content)");

        $title = 'Заголовок из PDO4';
        $content = 'Текст из PDO4';

        $statement->bindParam( 'content' , $content);
        $statement->bindParam( 'title' , $title);



        return $statement->execute();
*/

        if(!$this->validate($values,$this->fields)) {
            return false;
        }

        $query = 'insert into ' . $this->table . ' (';
        $query .= implode(', ', array_keys($this->fields)) . ') values (:';
        $query .= implode(', :', array_keys($values)) . ');';

        $statement = $this->pdo->prepare($query);

        return $statement->execute($values);

    }

    public function countAll() {

        $count = $this->pdo->query('select count(*) as count from ' . $this->table);

        $result = $count->fetch();

        return $result['count'];
    }


    public function validate ($values, $rules) {

        foreach ($rules as $key => $rule ) {

            if(!isset($values[$key])) {
                continue;
            }

            switch ($rule) {
                case 'text':
                    if(!is_string($values[$key])) {
                        return false;
                    }
                break;

                case 'int' :
                    if(!is_numeric($values[$key])) {
                        return false;
                    }
                break;

                default:
                    throw new \Exception('Неизвестное правило валидации');
            }

        }

        return true;

    }

    public function insertFile( $path,$upfile){

			if(!is_dir($_SERVER['DOCUMENT_ROOT'].'/'.$path)){
				mkdir($_SERVER['DOCUMENT_ROOT'].'/'.$path);
			}
				$f_dir = $_SERVER['DOCUMENT_ROOT'].'/'.$path;
			$files = $upfile;
			/*if(empty($_FILES)){
				return ['respond'=>$_FILES];
			}*/

				foreach($files as $file){
					if($this->validateFile($file['tmp_name'])===false){
						return ['status'=>'ERROR UPLOAD'];
					}
					else{
						if(move_uploaded_file($file['tmp_name'],$f_dir.'/'. $file['name'])){
							return ['status'=>true,'path'=>$path.'/'.$file['name']];
						}
					}
				}
	}

	public function validateFile($filename){
		$finfo = new \finfo(FILEINFO_MIME);
		$type = $finfo->file($filename);
		return strpos($type,'image');
	}

}