<?php
    require '../../database/definitions.php'; 
    require_once('../../../wp-load.php');
    
    $logged = is_user_logged_in();

    $orderID = $_GET['view'];
    
    $order_print = getAll('order_print', ['id', 'id_img', 'id_type_prints', 'id_types_sizes', 'order_count', 'email'], ['id' => $orderID]);

    $id_type_prints = getAll('type_prints', ['name'], ['id' => $order_print[0]['id_type_prints']]);
?>
<div id="side_bar_custom">
        <div class="pclose" onclick="pclose()">
            <i class="fas fa-chevron-left"></i>
        </div>

        <div class="viewerContent">
            <div class="imageV">
                <?php 
                    $img = $_GET['img'];
                    echo "<img src='database/img_uploaded/tmp/$img' alt=''>";
                ?>
                <div class="vOptions">
                    <a href="database/download/download.php?file=<?php echo $img;?>"><button type="button" class="btn btn-light">Download the image <i class="fas fa-cloud-download-alt"></i></button></a>
                    <br>
                    <?php if ($logged == true) { ?>
                        
                        <button type="button" class="btn btn-light mt-2" title="This item will be remove permanently" onclick="mark_as_completed(<?php echo $orderID; ?>)">Mark this order as completed <i class="fas fa-minus-square"></i></button>

                    <?php }else { ?>

                        <button type="button" class="btn btn-light mt-2" title="This item will be remove permanently" onclick="cancelOrder(<?php echo $orderID; ?>)">Cancel order <i class="fas fa-ban"></i></button>

                    <?php } ?>
                </div>
                <br>
                <div class="allContent">
                    <label>Preview of order:</label>
<ul class="list-group">
    <?php 
        echo "<li class='list-group-item'>Email: ".$order_print[0]['email']."</li>";

        echo "<li class='list-group-item'>Type Print: ".$id_type_prints[0]['name']."</li>";

        $pay = 0;
        foreach (json_decode($order_print[0]['id_types_sizes']) as $key => $value) { //getting sizes
            $type_sizes = getAll('types_sizes', ['name', 'price', 'id_type_prints'], ['id' => $value]);

            echo "<li class='list-group-item'>Sizes: ".$type_sizes[0]['name']." | Quantity: ".json_decode($order_print[0]['order_count'])[$key]."</li>";

            $pay = $pay + (int)$type_sizes[0]['price'] * (int)json_decode($order_print[0]['order_count'])[$key];
        }

        echo "<li class='list-group-item'>Total to pay: $".$pay."</li>";
    ?>
        
</ul>
                </div>
                <!--  -->
            </div>
            
        </div>
</div>

<script src="loads/viewer/js/viewer.js"></script>
<script src="js/sweetalert.min.js"></script>
<style>
    .viewerContent {
        position: relative;
        top: 65px;
        left: 28px;
        overflow:auto
    }
    .viewerContent .imageV img{
        width: 112px;
    }
    .viewerContent .list-group{
        width: 89%;
        color: #000
    }
    .vOptions{
        position: absolute;
        left: 135px;
        top: -5px;
    }
    .vOptions button i{
        color: orange;
        opacity: 0.8
    }
    .allContent{
        position:relative;
        top: 20px;
    }
    .allContent .list-group{
        height:400px
    }
</style>