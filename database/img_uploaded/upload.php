<?php
    header('Access-Control-Allow-Origin: *');
    require '../definitions.php';
    include('imgCrop.php');
    
    $email = $_POST['email'];
    $size = json_decode($_POST['sizes']);
    
    $type_sizes = [];
    $id_sizes = [];
    $order_counts = [];

    $em = filter_var(strtolower($email), FILTER_VALIDATE_EMAIL);
    if(strlen($em) > 1){
        $imgName = saveImage();
        $img = explode('.', $imgName);
        //img adding
        $data = insert('images_print', [
            'name' => $img[0],
            'type' => $img[1],
            'date' => date('Y/m/d H:i:s')
        ]);
        $img_id = $data->id();
        
        foreach ($size as $key => $value) {
            array_push($type_sizes, $size[$key]->id_types);
            array_push($id_sizes, $size[$key]->id_sizes);
            array_push($order_counts, $size[$key]->counts);
        }

        // // getAll('sizes', );
        $db = insert('order_print', [
            'id_img' => $img_id,
            'id_sizes' => json_encode($id_sizes),
            'id_types_sizes' => json_encode($type_sizes),
            'id_type_prints' => $_POST['type_prints_id'],
            'order_count' => json_encode($order_counts),
            'email' => $em,
        ]);
        
        echo $db->id();
    }
?>