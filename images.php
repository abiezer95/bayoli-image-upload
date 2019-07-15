<?php
    $page = 0;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    if($page >= 2){
        $page = $page*10 - 10;
    }

    if($page == 1) {
        $page = 0;
    }

    $count = countTable("order_print", [
        "status" => 0
    ]);

    $order_print = getAll('order_print', 
        ['id', 'id_img', 'id_sizes', 'id_type_prints', 'id_types_sizes', 'order_count', 'email', 'status'],
        ['status' => 0, "ORDER" => ["id" => "DESC"],
        "LIMIT" => [$page, 11]]
    );

    $left = ['24.9962%', '49.9925%', '74.9887%', '0%', '24.9962%', '49.9925%', '74.9887%', '0%', '24.9962%', '49.9925%', '74.9887%'];
    $top = ['0%', '0%', '0%', '266px', '266px', '266px', '266px', '522px', '522px', '522px', '522px'];
    
    $n = 0;

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
    //endfor
    ?>
        <nav aria-label="Page navigation" class="pagination-index">
        <ul class="pagination">
        
        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item">
            <a class="page-link" href="?page=1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
<?php
  for($n = 1, $i = 1; $n < (int)$count; $n ++) { //pagination
    if($n%10 == 1){
      if($i < 3){
        echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
      }
      
    //   if($i < 5){
    //     echo '<li class="page-item"><a>........</a></li>';
    //   }
      
      if($count < $n+9){
        echo '<li class="page-item"><a class="page-link" href="?page='.$i.'">'.$i.'</a></li>';
        
        echo '<li class="page-item">
                <a class="page-link" href="?page='.$i.'" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                </a>
            </li>';
      }

      $i++;
    }
  }
?>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
    
    </ul>
</nav>