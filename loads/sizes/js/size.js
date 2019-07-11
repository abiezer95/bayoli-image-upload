$(document).ready(() => {
    addElements();
    $('.editMenu').submit(() => {
        sizes = getEl();
        $.post("database/sizes/create.php", sizes, function(data) {
            console.log(data)
        })
        
        return false;
    })
})

function getEl(){ // getting elements
    var sizes = {menu: '', elname: [], elprice: []};
    if($('#elMenu').val() != "") sizes.menu = $('#elMenu').val()

    $('.elName').each(function(){
        if($(this).val() != "") sizes.elname.push($(this).val())
    })

    $('.elPrice').each(function(){
        if($(this).val() != "") sizes.elprice.push($(this).val())
    })

    return sizes;
}

var n = 0;
 function addElements(){
     n++;
     $('.elSize').append(`
        <div class="element`+n+`">
            <label>`+n+`-</label>
            <input type="text" class="form-control elName" aria-describedby="emailHelp" placeholder="Name" required>
            <input type="number" class="form-control elPrice" aria-describedby="emailHelp" placeholder="Price" required step="any">
            <i class="fas fa-trash" style="position:absolute;right:20px;margin-top:10px" onclick="deleteEl(`+n+`)"></i>
        <div>
     `);
 }