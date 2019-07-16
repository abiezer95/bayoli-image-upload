<?php 
require '../../database/definitions.php';
require_once('../../../wp-load.php');

$logged = is_user_logged_in();
?>
    <div id="side_bar_custom">
        <div class="pclose" onclick="pclose()">
            <i class="fas fa-chevron-left"></i>
        </div>
        <!-- <i class="fas fa-chevron-right flecha-d"></i> -->
        <div class="menuSlider">
        <ul class="nav nav-tabs allTabs">
                <?php 
                    $type_prints = getAll('type_prints', ['name', 'id'], '');
                    $n = 0;
                    $i = 0;
                    foreach ($type_prints as $key => $value) {
                        echo '
                            <li class="nav-item">
                                <a class="nav-link" href="#'.str_replace(' ', '_', $type_prints[$key]['name']).'"
                                key="'.$type_prints[$key]['id'].'"
                                >'.$type_prints[$key]['name'].'</a>
                            </li>
                        ';
                        $n++;
                    }
                ?>
            </ul>
        </div>
        <!-- <i class="fas fa-chevron-left flecha-r"></i> -->

        <div class="sizeNewOptions">
            <?php 
                if ($logged) { //is logged
            ?>
                <button type="button" class="btn btn-success addNewSises">Add new sizes</button>
                <!-- <button type="button" class="btn btn-success" onclick="finish_order()">Finish order</button> -->
            <?php }else {?>
                <button type="button" class="btn btn-success" onclick="finish_order()">Finish order</button>
                <!-- <button type="button" class="btn btn-warning">Reset options</button> -->
            <?php }?>
        </div>
        
        <form return false>
            <div class="form-group emailSize">
                <label for="exampleInputEmail1">Email address:</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" require>
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
        </form>

<div class="editSizes"></div>

<div class="sizeContent">
    <div class="tab-content sizeTabs" id="myTabContent">

<?php 
    $no = 0;
    while($i < $n) {
        $typeSizes = getAll('types_sizes', ['name', 'price', 'id', 'id_type_prints'], ['id_type_prints' =>  $type_prints[$i]['id']]);
        echo '
            <div id="'.str_replace(' ', '_', $type_prints[$i]['name']).'" >
                <h4>'.$type_prints[$i]['name'].'</h4>
                <hr style="width:85%">';
                
                foreach ($typeSizes as $key => $value) {
                    echo '
                    <section>
                        <label>'.$typeSizes[$key]['name'].' <i class="selected-sizes"></i></label>
                        <span>$'.$typeSizes[$key]['price'].' each</span>
                        <div class="countSize">
                            <button type="button" class="btn btn-primary" onclick="res_prints('.$no.', '.$i.')">-</button>
                            <input type="text" class="form-control prints_count" key="'.$typeSizes[$key]['id'].'" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value=0 disabled>
                            <button type="button" class="btn btn-primary" onclick="sum_prints('.$no.', '.$i.')">+</button>
                        </div>
                    </section>
                    ';
                    $no++;
                }
?>
            </div>
            <?php $i++; } ?>
        </div>
    </div>
</div>
</div>

    <style>
        @import url('loads/sizes/css/sizes.css');
    </style>

<script src="js/sweetalert.min.js"></script>
<script src="js/jquery.mousewheel.js"></script>
<script>
var sizes = <?php echo json_encode(getAll('type_prints', ['name', 'id'], '')); ?>;

var types = <?php echo json_encode(getAll('types_sizes', ['name'], '')); ?>;

    $(document).ready(() => {

        $('.menuSlider').mousewheel(function(e, delta) {
            $(this).scrollLeft(this.scrollLeft + (-delta * 40));
            e.preventDefault();
        });

        $('.addNewSises').click(() => {
            loadEditSize()
        })
        
        $('.editNewSizes').click(() => {
            loadEditSize(true)
        })

    })
    // suma y resta 
    function sum_prints(n, i){
        $(".prints_count:eq("+n+")").each(function(){
            valor = $(this).val();
            valor++;
            $(this).val(valor)
            $(".selected-sizes:eq("+n+")").addClass("fas fa-flag-checkered")
            // console.log()
        })

        $(".emailSize").show('fast')
    }
    function res_prints(n, i){ // this is the flat signal
        $(".prints_count:eq("+n+")").each(function(){
            valor = $(this).val();
            if(valor > 0){
                valor--;
                $(this).val(valor)
            }
            
            if(valor == 0){
                $(".selected-sizes:eq("+n+")").removeClass("fas fa-flag-checkered")
            }
            // console.log()
        })
    }
    function pclose(){
        $(".piSizes").css("display", 'none')
        $('#picmodal').modal({
            backdrop: 'static',
            keyboard: false
        });
        // fullSize()
    }
    
    <?php 
        if($logged){
    ?>
        function loadEditSize(n){
            $('.editSizes').load('loads/sizes/editSizes.php');
            $('.sizeContent').hide('fast');
            $('.emailSize').hide('fast');

            if(n) localStorage.setItem('pstatus', 'edit')
        }
    <?php } ?>
        function finish_order(){
            // 
            var email = $('.emailSize input[type="email"]').val();
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            
            sizes = [];
            
            $(".prints_count").each(function(){
                if($(this).val() != 0){
                    id = $(this).attr('key').split(' ');
                    sizes.push({id_types: id[0], counts: $(this).val()})
                }
            })

            if(sizes.length < 1){
                toasts('You must to select at least one size for your print.')
            }else if(re.test(String(email).toLowerCase())){ //validating email
                send_order(sizes, email)
            }else{
                toasts('You must to provide a valid email address to continue.')
            }
        }

        function send_order(sizes, email){
                var data = new FormData($("#upload_img")[0]);
                
                data.append('rcrop', localStorage.getItem('rcrop'))
                data.append('crop_status', localStorage.getItem('crop_status'))
                data.append('type_prints_id', localStorage.getItem('pActiveId'))
                data.append('sizes', JSON.stringify(sizes))
                data.append('email', email)
                $('.load').css('display', 'block')
                $.ajax({
                    type: "POST",
                    url: 'database/img_uploaded/upload.php',
                    processData: false,
                    data: data,
                    contentType: false,
                    success: function (data) {
                        oscurePic(data)
                        $('.load').css('display', 'none')
                        swal("Good job!", "Your order has been sent", "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        
                    }
                })

                $(".piSizes").hide("fast")        
        }

        function oscurePic(data){ // to set the pic uploaded 
            $order = localStorage.getItem('uploaded');
            if($order == undefined || $order == ''){
                localStorage.setItem('uploaded', JSON.stringify([data]))
            }else{
                $orders = JSON.parse($order);
                $orders.push(data);
                localStorage.setItem('uploaded', JSON.stringify($orders))
            }
            
            $('.oscureDiv').css('display', 'none')
        }
</script>