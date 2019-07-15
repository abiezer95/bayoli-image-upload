<?php
    header('Access-Control-Allow-Origin: *');
    require '../definitions.php';

    $names = $_POST['printName'];
    $prices = $_POST['printPrice'];
    
    foreach ($names as $key => $value) {
        // if(strlen($names[$key]) > 0 and strlen($prices[$key]) > 0)) {
            if(is_numeric($prices[$key])){
                $db = insert('type_prints', [
                    'name' => $names[$key],
                    'price' => $prices[$key],
                ]);
            }   
    }
?>