<?php


class model extends \PDO{
    public function __construct(){
        parent::__construct('mysql:host=127.0.0.1;dbname=laravel','root','root');
    }
}
$obj=new model();
$result=$obj->query('show tables');
foreach($result as $row){
    var_dump($row);
}

