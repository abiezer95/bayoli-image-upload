<?php
    require '../definitions.php'; 
    require_once('../../../wp-load.php');

    $logged = is_user_logged_in();
    $id = $_POST['id_order'];

    if ($logged == true) {
        update('order_print', [
            'status' => true
        ], [
            'id' => $id
        ]);

        echo 'true';
    }else{
        echo 'false';
    }
?>