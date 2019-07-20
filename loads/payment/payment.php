<?php
    require '../../database/definitions.php'; 
    require_once('../../../wp-load.php');
    
    $logged = is_user_logged_in();
    
    $orderID = $_POST['id'];
    
    $email = $_POST['email'];
    
    $img = $_POST['img'];
    
    $sizes = $_POST['sizes'];

    $type_prints_id = $_POST['type_prints_id'];

    $id_type_prints = getAll('type_prints', ['name'], ['id' => $type_prints_id]);
    

    clearstatcache();
?>
<div id="side_bar_custom">
    <?php 
        if(!isset($_POST['pagado'])){
    ?>
        <div class="pclose" onclick="cancelOrder(<?php echo $orderID; ?>)">
            <i class="fas fa-chevron-left"></i>
        </div>

    <?php }else{?>

        <div class="pclose" onclick="pclose()">
            <i class="fas fa-chevron-left"></i>
        </div>

    <?php } ?>

        <div class="viewerContent">
            <div class="imageV">
                
                <img src='database/img_uploaded/tmp/<?php echo $img;?>' alt='' class="previewImg">

                <div class="vOptions">
                    
                    <?php 
                        if(!isset($_POST['pagado'])){
                    ?>
                        <a href="composer/app/loadPrices.php?sizes=<?php echo urlencode(json_encode($sizes));?>&id=<?php echo $orderID;?>"><button type="button" class="btn btn-light">Pay and finish this order <i class="fab fa-cc-paypal mt-1"></i></button></a>
                        
                        <br>
                        <button type="button" class="btn btn-light mt-2" title="This item will be remove permanently" onclick="cancelOrder(<?php echo $orderID; ?>)">Cancel order <i class="fas fa-ban"></i></button>
                    <?php }else{?>
                        <tt style="font-size:16px">For more information contact us. <a href="<?php echo get_site_url(); ?>/contact/" style="color:blue">Click Here</a></tt>
                        <button type="button" class="btn btn-light mt-4 payment-btn">payment completed <i class="fas fa-glass-cheers cheers"></i></button>
                                               
                    <?php } ?>
                </div>
                <br>
                <div class="allContent mt-2">
                    <label>Preview of order:</label>
<ul class="list-group">
<?php 
        echo "<li class='list-group-item'>Email: ".$email."</li>";

        echo "<li class='list-group-item'>Type Print: ".$id_type_prints[0]['name']."</li>";

        $pay = 0;
        foreach ($sizes as $key => $value) { //getting sizes

            $type_sizes = getAll('types_sizes', ['name', 'price', 'id_type_prints'], ['id' => $sizes[$key]['id_types']]);

            echo "<li class='list-group-item'>Sizes: ".$type_sizes[0]['name']." | Quantity: ".$sizes[$key]['counts']."</li>";

            $pay = $pay + (int)$type_sizes[0]['price'] * (int)$sizes[$key]['counts'];
        }

        echo "<li class='list-group-item'>Total: $".$pay."</li>";
?>
</ul>
                </div>
                <!--  -->
            </div>
            
        </div>
</div>

<!-- <div class="iframePay">
    <iframe src="" frameborder="0"></iframe>
</div> -->

<script src="loads/payment/js/payment.js"></script>
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
        color: #0101DF;
        opacity: 0.8;
        font-size: 21px
    }
    .vOptions button .cheers{
        color: orange;
    }
    .allContent{
        position:relative;
        top: 20px;
    }
    .allContent .list-group{
        height:400px
    }
    .payment-btn{
        position: relative;
        top: 24px;
        background: indigo;
        color: #fff;
    }
    .iframePay{
        position:fixed;
        top:0;
        left:0;
        background: #fff;
        width:50%;
        height:100%;
    }
    .iframePay iframe{
        width: 100%;
        height: 100%
    }
</style>


<script src="loads/payment/js/payment.js"></script>