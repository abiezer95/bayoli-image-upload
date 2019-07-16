<?php
    header('Access-Control-Allow-Origin: *');
    require '../definitions.php';
    require_once('../../../wp-load.php');

    $logged = is_user_logged_in();
    
    if ($logged == true) {

        $id = $_POST['id'];
        $elId = $_POST['elId'];
        $menu = $_POST['menu'];
        $names = $_POST['elname'];
        $prices = $_POST['elprice'];
        $deleted = $_POST['eliminated'];

        // echo json_encode($deleted);
    
        if($id != '' && $id != null) {
            foreach ($names as $key => $value) {
                update('types_sizes', [
                    'name' => $names[$key],
                    'price' => $prices[$key]
                ], [
                    'id' => (int)$elId[$key]
                ]);
            }
            $n = 0;
            if(count($deleted) > 1) {
                foreach ($deleted as $key => $value) {
                    // if($n > 0){
                        delete('types_sizes', ['id' => (int)$deleted[$key]]);
                    // }
                    $n++;
                }
            }
        }
    }
    // 
?>