<?php require '../../database/definitions.php'; ?>
    <div id=sizes>
        <div class="pclose" onclick="pclose()">
            <i class="fas fa-chevron-left"></i>
        </div>
        <i class="fas fa-chevron-right flecha-d"></i>
        <div class="menuSlider">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <!-- <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">See All</a>
            </li> -->
                <?php 
                    $sizes = getAll('sizes', ['name', 'id'], '');
                    $n = 0;
                    $i = 0;
                    foreach ($sizes as $key => $value) {
                        echo '
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#'.str_replace(' ', '_', $sizes[$key]['name']).'" role="tab" aria-controls="home" aria-selected="true"
                                key="'.$sizes[$key]['id'].'"
                                >'.$sizes[$key]['name'].'</a>
                            </li>
                        ';
                        $n++; 
                    }
                ?>
            </ul>
        </div>
        <i class="fas fa-chevron-left flecha-r"></i>

        <div class="sizeNewOptions">
            <button type="button" class="btn btn-success addNewSisez">Add new sizes</button>
            <button type="button" class="btn btn-success editNewSizes">Edit sizes</button>
        </div>

<div class="editSizes"></div>

<div class="sizeContent">
    <div class="tab-content sizeTabs" id="myTabContent">

<?php 
    while($i < $n) {
        $typeSizes = getAll('types_sizes', ['name', 'price'], ['id_sizes' =>  $sizes[$i]['id']]);
        echo '
            <div class="tab-pane fade show size_tab_pane" id="'.str_replace(' ', '_', $sizes[$i]['name']).'" role="tabpanel" aria-labelledby="home-tab">
                <h4>'.$sizes[$i]['name'].'</h4>
                <hr style="width:85%">';
                
                foreach ($typeSizes as $key => $value) {
                    echo '
                    <section>
                        <label>'.$typeSizes[$key]['name'].'</label>
                        <span>$'.$typeSizes[$key]['price'].' each</span>
                        <div class="countSize">
                            <button type="button" class="btn btn-primary">-</button>
                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value=0>
                            <button type="button" class="btn btn-primary">+</button>
                        </div>
                    </section>
                    ';
                }
?>
        </div>
            <?php $i++; } ?>
            </div>
        </div>
    </div>

    <style>
        @import url('loads/sizes/css/sizes.css');
    </style>

<script>
    $(document).ready(() => {
        $('.addNewSisez').click(() => {
            openEditSize()
        })
        
        $('.editNewSizes').click(() => {
            openEditSize()
            var sizes = <?php echo json_encode(getAll('sizes', ['name', 'id'], '')); ?>;

            var types = <?php echo json_encode(getAll('types_sizes', ['name', 'id_sizes'], '')); ?>;
 
            $('#myTab li a').each(function(){
                var tab = $(this).attr('class');
                tab = tab.split(' ')
                if(tab.indexOf('active') >= 0){
                    active = $(this).attr('key')
                    console.log(active)
                }
    
            })
        })
    })

    function openEditSize(){
        $('.editSizes').load('loads/sizes/editSizes.php');
        $('.sizeContent').hide('fast');
    }
</script>