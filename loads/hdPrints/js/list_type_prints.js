var key = null;
var pText = '';

$(document).ready(function(){
    prints_active()
    
    $('.list-group-item').on("click", function() {
        pText = '';
            $(".selectedprint").removeClass("far fa-check-circle")
            let canChange = $(this).attr('canChange'); //if can change value
            if (typeof canChange !== typeof undefined && canChange !== false) {
                pText = $(this).find('tt').text()
                modalPrints(this);
            }
        modalPrints(this);
        prints_active()
    })

    
    $('.addNewPrint').click(() => { //this is the done
        addNewPrint()
        pclose()
    })
})
function addNewPrint(){ //changing the text key and color of type print
    if(pText.length > 0){
        $('#pChanged tt').text(pText)
        $('#pChanged').attr('key', key)
        modalPrints('#pChanged');
    }
}
function modalPrints(el){ //remove and add active color and icon
    $('.list-group-item').removeClass("active")
    $('.selectedprint').removeClass("far fa-check-circle")
  
    $(el).addClass('active')
    $(el).find('.selectedprint').addClass("far fa-check-circle")
}

function pclose(){ //to close the side bar
    $('.piSizes').hide('fast')
    $('#picmodal').modal({
        backdrop: 'static',
        keyboard: false
    });

    addNewPrint()
}

function prints_active(){ //this active the print in both places modal and hd prints sidebar
      $('.list-group-item').each(function(){
          let active = $(this).attr('class');
          $find = active.split(' ').filter(x => x === 'active')
        
          if($find.length >= 1) key = $(this).attr('key')
      })
  
      $('.list-group-item').each(function(){
          let active = $(this).attr('key');
          if(active == key){
                price = $(this).attr('price')
                $('.price span tt').html(price)
                localStorage.setItem('pActiveId', key)
                //to change the price
              $(this).addClass('active')
              $(this).find('.selectedprint').addClass("far fa-check-circle")
          }
      })
  }