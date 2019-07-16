<?php
    header('Access-Control-Allow-Origin: *');
    require '../definitions.php';

    $id = $_POST['id'];
    $names = $_POST['printName'];
    // $prices = $_POST['printPrice'];
    $deleted = $_POST['eliminated'];

    if($id == null) $id = [""];

    if($deleted[0] == ""){
        foreach ($deleted as $value) {
            delete('type_prints', ['id' => $value]);
        }
    }
    
    foreach ($names as $key => $value) {
        update('type_prints', [
            'name' => $names[$key],
            // 'price' => $prices[$key]
        ], [
            'id' => (int) $id[$key]
        ]);
    }
?>