<?php
    require  'Medoo.php';
 
    use Medoo\Medoo;

    function db(){
        $database = new Medoo([
            // required
            'database_type' => 'mysql',
            'database_name' => 'test',
            'server' => 'localhost',
            'username' => 'root',
            'password' => 'root',
    
            'port' => '3306'
        ]);
        return $database;
    }
?>