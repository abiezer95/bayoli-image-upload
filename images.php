<?php
// error_reporting(0);
// ini_set('display_errors', 0);

    $status = 0;
    $isSearch = 0;
    $search = '';
    
if(isset($_GET['completed'])){
    $status = 1;
}

if(isset($_GET['isSearch']) && isset($_GET['search'])){
    $isSearch = $_GET['isSearch'];
    $search = $_GET['search'];
}

if($isSearch == 1){
    require 'database/definitions.php'; 
    require_once('../wp-load.php');
    
    $logged = is_user_logged_in();
    $order_print = getAll('order_print', 
        ['id', 'id_img', 'id_type_prints', 'id_types_sizes', 'order_count', 'email', 'status'],
        [
            'status' => $status, "ORDER" => ["id" => "DESC"],
            "LIMIT" => [0, 11],
            'AND' => ['email[~]' => $search],
        ]
    );
}else{
    $order_print = getAll('order_print', 
        ['id', 'id_img', 'id_type_prints', 'id_types_sizes', 'order_count', 'email', 'status'],
        ['status' => $status, "ORDER" => ["id" => "DESC"],
        "LIMIT" => [0, 11]]
    );
}
    $left = ['24.9962%', '49.9925%', '74.9887%', '0%', '24.9962%', '49.9925%', '74.9887%', '0%', '24.9962%', '49.9925%', '74.9887%'];
    $top = ['0%', '0%', '0%', '266px', '266px', '266px', '266px', '522px', '522px', '522px', '522px'];
    
    $n = 0;

    if ($logged == true) {
        foreach ($order_print as $key => $value) {
            $img = getAll('images_print', ['id', 'name', 'type', 'date'], ['id' => $order_print[$key]['id_img']]);
            
            echo '<div
            class="grid-item  branding architecture col-md-6 col-lg-3"
            style="position: absolute; left:'.$left[$n].'; top:'.$top[$n].';"
            onclick="viewDetailsPrint(\''.$img[0]['name'].'.'.$img[0]['type'].'\', '.$order_print[$key]['id'].')"
            >
                <a title="project name 2">
                <div class="project_box_one">
                    <div class="thePimg" 
                    style="
                    width: 100%;
                    height: 235px;
                    background-image: url(database/img_uploaded/tmp/'.$img[0]['name'].'.'.$img[0]['type'].');
                    background-repeat: no-repeat;
                    background-position: center center;
                    background-size: cover;">
                    
                    </div>
                    <div class="product_info">
                    <div class="product_info_text">
                        <div class="product_info_text_inner">
                        <i class="ion ion-plus"></i>
                        <h4>Click here to view details</h4>
                        </div>
                    </div>
                    </div>
                </div>
                </a>
            </div>';
            $n++;
        }
    }else{
            for($n = 0, $i = 1; $n < 11; $n ++) {
                echo '<div
                class="grid-item  branding architecture col-md-6 col-lg-3 oscureDiv"
                style="position: absolute; left:'.$left[$n].'; top:'.$top[$n].';"
                
                >
                    <a title="project name 2">
                    <div class="project_box_one">
                        <div class="thePimg" 
                            style="
                            width: 100%;
                            height: 235px;
                        ;">
                        
                        </div>
                        <div class="product_info">
                        <div class="product_info_text">
                            <div class="product_info_text_inner">
                            <i class="ion ion-plus"></i>
                            <h4>Upload your image</h4>
                            </div>
                        </div>
                        </div>
                    </div>
                    </a>
                </div>';
            }
        }//endfor