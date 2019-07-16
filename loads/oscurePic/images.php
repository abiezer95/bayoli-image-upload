<?php 
require '../../database/definitions.php'; 

$left = ['24.9962%', '49.9925%', '74.9887%', '0%', '24.9962%', '49.9925%', '74.9887%', '0%', '24.9962%', '49.9925%', '74.9887%'];
    
$top = ['0%', '0%', '0%', '266px', '266px', '266px', '266px', '522px', '522px', '522px', '522px'];

if($_POST['oscurePic'] == 1){
  $orders = json_decode($_POST['order']);
  
  $n = 0;
  foreach ($orders as $key => $value) {
    if($n < 11){
        $order_print = getAll('order_print', 
            ['id', 'id_img', 'id_type_prints', 'id_types_sizes', 'order_count', 'email', 'status'],
            [
             "id" => (int)$value
            ]
        );

        $img = getAll('images_print', ['id', 'name', 'type', 'date'], ['id' => $order_print[0]['id_img']]);
            
            echo '<div
            class="grid-item  branding architecture col-md-6 col-lg-3"
            style="position: absolute; left:'.$left[$n].'; top:'.$top[$n].';"
            onclick="viewDetailsPrint(\''.$img[0]['name'].'.'.$img[0]['type'].'\', '.$order_print[0]['id'].')"
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
        
        }

        $n++;
    }
        // echo $value;
    
  }
?>