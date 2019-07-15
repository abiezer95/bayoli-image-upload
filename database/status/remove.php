<?php
    header('Access-Control-Allow-Origin: *');
    require '../definitions.php'; 
    require_once('../../../wp-load.php');

    $id = $_POST['id_order'];

    $order_print = getAll('order_print', ['id_img'], ['id' => $id]);
    $img_name = getAll('images_print', ['name', 'type'], ['id' => $order_print[0]['id_img']]);

    //deleting the image
    $fileName = $img_name[0]['name'].".".$img_name[0]['type'];
    $path = "../img_uploaded/tmp/";

    $myFile = $path.$fileName;

    if($path == "../img_uploaded/tmp/"){
        unlink($myFile) or die("Couldn't delete the file");
    }
    //deleting the table in DB 

    delete('images_print', ['id' => $order_print[0]['id_img'] ]);

    delete('order_print', ['id' => $id ]);

    echo 'done';
    // delete('order_print', ['name' => 'abiezer'])
?>