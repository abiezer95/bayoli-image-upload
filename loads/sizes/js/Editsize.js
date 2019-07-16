
var n = 0;
var pdelete = [];
var id = null; //esto sera asignado mas abajo para setall

$(document).ready(() => {
    addElements();
    
    $('.editMenu').submit(() => {
        status = localStorage.getItem('pstatus');
        if(status == 'edit'){
            $.post("database/sizes/update.php", getEl(), function(data) {
                openSize()
                console.log(data)
            })
        }else{
            $.post("database/sizes/create.php", getEl(), function(data) {
                openSize()
                console.log(data)
            })
        }
        
        return false;
    })

    $('.nav-link').on('click', function(){ //editing
        $('.nav-link').removeClass('active')
        $(this).addClass('active')
        status = localStorage.getItem('pstatus');
        if(status == 'edit'){
            id = $(this).attr('key')
            n=0; //setting all fields in 0
            setAll(id)
        }
        // if()
    })

    $('.pstatus').on('click', function(){
        $('.elSize').html('');
         
        if($(this).attr('key') == 'true') {
             $(this).text('Status: Editing');
             $(this).attr('key', 'false');
             
             $('.existing').hide('fast');
             $('.addMoreElements').hide('fast');
             $('.elMenu').show('fast');
             n = 0;
             
             localStorage.setItem('pstatus', 'edit');
        }else {
             $('#elMenu').val('')
             $(this).text('Status: Adding');
             $(this).attr('key', 'true');

             $('.existing').show('fast');
             $('.addMoreElements').show('fast');
             $('.elMenu').hide('fast');
             n = 0;
             id = '';
             localStorage.setItem('pstatus', 'create')
        }
        addElements();
        pdelete = ['']
     })
})

function getEl(){ // getting elements
    var sizes = {menu: '', elname: [], elprice: [], elId: [], id: null,  eliminated: null};
    
    if($('#existing').val() != "") sizes.id = $('#existing').val()

    // if($('#elMenu').val().length > 0) sizes.menu = $('#elMenu').val()

    $('.elName').each(function(){
        if($(this).val().length > 0){
            sizes.elname.push($(this).val())
            sizes.elId.push($(this).attr('key')) //este es el id del elemento
        } 
    })

    $('.elPrice').each(function(){
        if($(this).val().length > 0) sizes.elprice.push($(this).val())
    })

    status = localStorage.getItem('pstatus');
    if(status == 'edit'){
        sizes.id = id;// this is the tab id
    }

    sizes.eliminated = pdelete;
    // console.log(sizes)
    return sizes;
}
function setAll(id){
    var i = 0;
    $('.elSize').html('')
    data = size_elements.filter(x => x.id_type_prints == id);
    
    
    $('.nav-link').each(function(){
        if($(this).attr('class') == 'nav-link active'){ //ojo puede haber errores si se cambia la clase
            $('#elMenu').val($(this).text());
        }  
    })


    for(let item in data){
        addElements()
        setTimeout(() => {
            $('.elName:eq('+item+')').val(data[item]['name']); 
            $('.elName:eq('+item+')').attr('key', data[item]['id']);

            $('.elPrice:eq('+item+')').val(data[item]['price']);
            // $('.elPrice:eq('+item+')').attr('key', data[item]['id_sizes']);
            i++;
        }, 0);
    }    
}

function deleteEl(n){
    let status = localStorage.getItem('pstatus')
    if(status == 'edit'){
        pdelete.push(n)
        // localStorage.setItem('pdelete', pdelete)
    }

    $(".element"+n+"").remove()
}

 function addElements(){
     n++;
     $('.elSize').append(`
        <div class="element`+n+`">
            <label>• </label>
            <input type="text" class="form-control elName" aria-describedby="emailHelp" placeholder="Name" required>
            <input type="number" class="form-control elPrice" aria-describedby="emailHelp" placeholder="Price" required step="any">
            <i class="fas fa-trash" style="position:absolute;right:20px;margin-top:10px" onclick="deleteEl(`+n+`)"></i>
        <div>
     `);
 }