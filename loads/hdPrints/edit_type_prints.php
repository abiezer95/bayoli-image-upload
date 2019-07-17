<?php require '../../database/definitions.php'; ?>
<div id='side_bar_custom'>
    <div class="pclose">
        <i class="fas fa-chevron-left"></i>
    </div>
    <div class="edit-print-content">
        <!--  -->
        <button class="btn btn-danger pstatus" key='true'>Status: Adding</button>
        <form class="editMenu">
            <br>
            <span>Click to the button status above to edit or add new elements for type prints.</span>
            <div class="form-group">
                <label>Type of prints Elements: </label>
                <div class="elSize"></div>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary addMoreElements" onclick="addElements()">Add more elements <i class="fas fa-plus"></i></button>
                <button type="submit" class="btn btn-primary">Save <i class="far fa-save"></i></button>
            </div>
        </form>
        <!--  -->
    </div>
</div>

<style>
    @import url('loads/hdPrints/css/prints.css');
</style>

<script>
    localStorage.setItem('pstatus', 'create')
    var n = 0 ;
    var prints = <?php echo json_encode(getAll('type_prints', ['name', 'id'], '')); ?>;
    var pdelete = []
    
    $(document).ready(() => {
        $('.editMenu').submit(function(){
            status = localStorage.getItem('pstatus');
       
            if(status == 'create'){
                $.post("database/hd_print/create.php", getEl(), function(data){
                    // console.log(data);
                    pclose()
                })
            }else{
                $.post("database/hd_print/update.php", getEl(), function(data){
                    // console.log(data);
                    pclose()
                })
            }
            
            return false
        })
        
        $('.pstatus').on('click', function(){
           $('.elSize').html('');
            
           if($(this).attr('key') == 'true') {
                $(this).text('Status: Editing')
                $(this).attr('key', 'false')
                $('.addMoreElements').hide('fast')
                n = 0;
                setAll();
                localStorage.setItem('pstatus', 'edit')
           }else {
                $(this).text('Status: Adding')
                $(this).attr('key', 'true')
                $('.addMoreElements').show('fast')
                n = 0;
                addElements();
                localStorage.setItem('pstatus', 'create')
           }
           pdelete = ['']
        })
        
        $('.pclose').click(() => {
            $(".piSizes").css("display", 'none')
        })

        addElements() // executing add element input
    })
function pclose(){
    $(".piSizes").css("display", 'none')
    $(".list-prints-update").load(location.href + " .list-prints-update");
    $(".dropdown-allEl").load(location.href + " .dropdown-allEl");
    $('#picmodal').modal({
        backdrop: 'static',
        keyboard: false
    });
}
function setAll(){
    
    var i = 0;

    for(let item in prints){
        addElements()
        setTimeout(() => {
            $('.elName:eq('+item+')').val(prints[item]['name']); 
            $('.elName:eq('+item+')').attr('key', prints[item]['id']);

            // $('.elPrice:eq('+item+')').val(prints[item]['price']);
            // $('.elPrice:eq('+item+')').attr('key', prints[item]['id']);
            i++;
        }, 0);
    }
}

function deleteEl(n, i){
    let status = localStorage.getItem('pstatus')
    if(status == 'edit'){
        pdelete.push(n)
        // localStorage.setItem('pdelete', pdelete)
    }

    $(".element"+i+"").remove()
}

function getEl(){ // getting elements
    var sizes = {printName: [], id: [], eliminated: null};
    var z = 0;

    $('.elName').each(function(){
        if($(this).val() != ""){
            sizes.printName.push($(this).val())
            sizes.id.push($(this).attr('key'))
            // console.log($(this).attr('key'))
        }
        z++;
    })

    // $('.elPrice').each(function(){
    //     if($(this).val() != "") sizes.printPrice.push($(this).val())
    // })
    
    sizes.eliminated = pdelete;
    // console.log(sizes.eliminated)
    if(z == 0) sizes.printName.push("") //sizes.printPrice.push("")

    return sizes;
}

 function addElements(){
    // <input type="number" class="form-control elPrice" aria-describedby="emailHelp" placeholder="Price" required step="any">

    // <input type="number" class="form-control elPrice" aria-describedby="emailHelp" placeholder="Price" required step="any">
     setTimeout(() => {
        n++;
        status = localStorage.getItem('pstatus');
        if(status == 'create'){
            $('.elSize').append(`
            <div class="element`+n+`">
                <label class="pNumber">•</label>
                <input type="text" class="form-control elName" aria-describedby="emailHelp" placeholder="Name" required>
                
                <i class="fas fa-trash" style="position:absolute;right:20px;margin-top:10px" onclick="deleteEl(`+n+`, `+n+`)"></i>
            <div>
        `);
        }else{
            $('.elSize').append(`
            <div class="element`+n+`" key="`+prints[n-1]['id']+`">
                <label class="pNumber">•</label>
                <input type="text" class="form-control elName" aria-describedby="emailHelp" placeholder="Name" required>
                
                <i class="fas fa-trash" style="position:absolute;right:20px;margin-top:10px" onclick="deleteEl(`+prints[n-1]['id']+`, `+n+`)"></i>
            <div>
        `);
        }
     }, 0);
 }
</script>