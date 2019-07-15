<?php

if(isset($_REQUEST["file"])){
    $file = urldecode($_REQUEST["file"]);
    $path = "../img_uploaded/tmp/$file";

    if(file_exists($path)) {
        header('Content-Type: application/download');
        header('Content-Disposition: attachment; filename="'.$file.'"');
        header("Content-Length: " . filesize($path));

        $fp = fopen($path, "r");
        fpassthru($fp);
        fclose($fp);
    }
}
    // 
    
    // $file = $_POST['file'];
    
    
?>