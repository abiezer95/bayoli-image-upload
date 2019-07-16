<?php
    header('Access-Control-Allow-Origin: *');
    require '../definitions.php';
    require_once('../../../wp-load.php');

    $logged = is_user_logged_in();
    
    if ($logged == true) {
        
        // $menuName = $_POST['menu'];
        $names = $_POST['elname'];
        $prices = $_POST['elprice'];
        $id = $_POST['id']; // existing
    
    // // if($id == 'null'){
    // //     if(strlen($menuName) > 0){
    // //         $db = insert('sizes', [
    // //             'name' => $menuName
    // //         ]);
    // //         $id = $db->id();
    // //     }
    // // }
        if($id != 'null' && $names != 'undefined' && $prices != 'undefined'){
            foreach ($names as $key => $value) {
                $db = insert('types_sizes', [
                    'name' => $names[$key],
                    'price' => $prices[$key],
                    'id_type_prints' => $id
                ]);
            }
        }
    }
?>