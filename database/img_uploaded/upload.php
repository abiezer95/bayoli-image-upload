<?php
    header('Access-Control-Allow-Origin: *');
    require '../definitions.php';

    $url = 'tmp/1.jpg';
    
    $infoImg = getimagesize($url);

        $imgX = $infoImg[0];
        $imgY = $infoImg[1];
        $typeFile = $infoImg['mime'];

    $src_image = imagecreatefromjpeg($url);
    //new size
    $src_w = 200;
    $src_h = 200;

    //coords init
    $src_x = 100;
    $src_y = 100;

    $dst_x = 0;
    $dst_y = 0;

    $dst_w = 300;
    $dst_h = 300;

    $dst_image = imagecreatetruecolor($dst_w, $dst_h);

    imagecopyresampled(
        $dst_image,
        $src_image,
        $dst_x,
        $dst_y,
        $src_x,
        $src_y,
        $dst_w,
        $dst_h,
        $src_w,
        $src_h
    );

    header('content-type: '.$typeFile);

    imagejpeg($dst_image, 'tmp/11.jpg', 100);

    imagedestroy($dst_image);
    imagedestroy($src_image);
    // print_r($infoImg);
    // $type = substr($_FILES['new_pic']['name'], strrpos($_FILES['new_pic']['name'], '.')+1);
    
    // $hash = substr( md5(microtime()), 1, 8);
    
    // if(!empty($_FILES['new_pic']))
    // {
    //     $path = "tmp/";
    //     $path = $path . basename($hash.".".$type) ;
    //     if(move_uploaded_file($_FILES['new_pic']['tmp_name'], $path)) {
    //         echo $hash.".".$type;
    //     } else{
    //         echo "error";
    //     }
    // }
//     $_FILES[input-field-name][tmp_name]

// $_FILES[input-field-name][size]

// $_FILES[input-field-name][type]

// $_FILES[input-field-name][error]
    // echo $fileName;
?>