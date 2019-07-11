<?php
    include('connect.php');
    
    function getAll($table, $column, $where){
        $database = db();
        $get = $database->select($table, $column, $where);
        return $get;
    }
    
    function update($table, $column, $where){
        $database = db();
        $database->update($table, $column, $where);
        echo "Update Success";
    }
    
    function delete($table, $column){
        $database = db();
        $database->delete($table, [
            "AND" => $column
        ]);
        echo "true";
    }
    
    function insert($table, $column){
        $database = db();
        $database->insert($table, $column);
        echo "true";
        return $database;
    }

    // print_r(getAll('sizes', ['name'], ''));
    // insert('sizes', [
    //     'name' => 'abiezer'
    // ]);
    
    // update('sizes', [
    //     'name' => 'abiezer'
    // ], [
    //     'id' => 3
    // ]);

    // delete('sizes', 
    //     ['name' => 'abiezer'])
    // print_r();
?>