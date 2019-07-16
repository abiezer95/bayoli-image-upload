<?php require '../../database/definitions.php'; ?>
<div id="side_bar_custom">
    <div class="pclose" onclick="pclose()">
        <i class="fas fa-chevron-left"></i>
    </div>

    <div class="alert alert-light" role="alert" style="border-bottom:groove 1px;font-size:16px">
        Choose the type of print you will use.   
    </div>

    <div class="hd_btn">
        <button type="button" class="btn btn-danger addNewPrint">Done</button>
    </div>

    <div class="custom_list mt-1">
        <div class="card hdP_card" style="width: 95%;">
            <ul class="list-group">
                <?php 
                $types = getAll('type_prints', ['name', 'id'], '');
                $n = 0;
                foreach ($types as $key => $value) {
                    if($n <= 0){
                    echo '
                        <li class="list-group-item" key="'.$types[$key]['id'].'" canChange>
                            <tt>'.strtoupper($types[$key]['name']).'</tt>
                            
                        <i class="selectedprint"></i>
                        </li>
                    ';
                    }
                    // <span>'.$types[$key]['price'].'$</span>

                    if($n >= 1 && $n <=3){
                        echo '
                            <li class="list-group-item" key="'.$types[$key]['id'].'">
                                <tt>'.strtoupper($types[$key]['name']).'</tt>
                            
                            <i class="selectedprint"></i>
                            </li>';
                    }
                    
                    if($n >= 4){
                        echo '
                            <li class="list-group-item" key="'.$types[$key]['id'].'" canChange>
                                <tt>'.strtoupper($types[$key]['name']).'</tt>
                                
                            <i class="selectedprint"></i>
                            </li>';
                    }
                    
                    $n++;
                }
                // echo json_encode($all);
                ?>
            </ul>
        </div>
    </div>

</div>

<script src="loads/hdPrints/js/list_type_prints.js"></script>
<style>
    .custom_list{
        overflow: auto;
        height:450px;
        cursor:pointer;
    }
    .custom_list ul li{
        font-size: 16px
    }
    .hd_btn{
        display:flex;
        justify-content:center
    }
    .hdP_card{
        left: 3%
    }
    .hdP_card ul li{
        color: #000
    }
    .hdP_card ul li span{
        position:absolute;
        right: 40px;
        font-size: 15px
    }
</style>