<?php
function saveImage(){
    $type = substr($_FILES['new_pic']['name'], strrpos($_FILES['new_pic']['name'], '.')+1);
    
    $hash = substr( md5(microtime()), 1, 8);

    if(!empty($_FILES['new_pic']))
    {
        $path = "tmp/";
        $path = $path . basename($hash.".".$type) ; //name of pic
        if(move_uploaded_file($_FILES['new_pic']['tmp_name'], $path)) {
            if($_POST['crop_status'] == 'true'){
                crop($hash.".".$type);
            }
            // else{
            //     echo "Normal pic true";
            // }
            
            return $hash.".".$type;
        } 
        // else{
        //     echo "error";
        // }
    }
}

function crop($name){
    $sizes = json_decode($_POST['rcrop']);
    $url = "tmp/$name";

    $infoImg = getimagesize($url);

        $imgX = $infoImg[0];
        $imgY = $infoImg[1];
        $typeFile = $infoImg['mime'];

    if($imgX < $sizes->width){
        $sizes->width = $imgX;
    }
    if($imgY < $sizes->height){
        $sizes->height = $imgY;
    }
    // $src_image = imagecreatefrompng($url);
    $src_image = imagecreatefromjpeg($url);
    //new size
    $src_w = $sizes->width;
    $src_h = $sizes->height;

    //coords init
    $src_x = $sizes->x;
    $src_y = $sizes->y;

    $dst_x = 0;
    $dst_y = 0;

    $dst_w = $sizes->width;
    $dst_h = $sizes->height;

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

    imagejpeg($dst_image, "tmp/$name", 100);

    imagedestroy($dst_image);
    imagedestroy($src_image);
}

//$_FILES[input-field-name][tmp_name]

// $_FILES[input-field-name][size]

// $_FILES[input-field-name][type]

// $_FILES[input-field-name][error]
    // echo $fileName;
?>