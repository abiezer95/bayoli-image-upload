<?php
    header('Access-Control-Allow-Origin: *');
    require '../definitions.php';

    $menuName = $_POST['menu'];
    $names = $_POST['elname'];
    $prices = $_POST['elprice'];
    $id = $_POST['id'];
    
    if($id == 'null'){
        if(strlen($menuName) > 0){
            $db = insert('sizes', [
                'name' => $menuName
            ]);
            $id = $db->id();
        }
    }

    foreach ($names as $key => $value) {
        $db = insert('types_sizes', [
            'name' => $names[$key],
            'price' => $prices[$key],
            'id_sizes' => $id
        ]);
    }
?>