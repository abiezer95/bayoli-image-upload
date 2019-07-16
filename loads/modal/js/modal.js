$(document).ready(function(){
    // price = $('#pChanged').attr('price')
    // $('.price span tt').html(price)
    localStorage.setItem('pActiveId', $('#pChanged').attr('key'))
    ////////////////////////////////////////////////////
    $(".list-group-item").on("click", function() {
        $(".selectedprint").removeClass("far fa-check-circle")
        
        //to change the price
        // price = $(this).attr('price')
        // $('.price span tt').html(price)
        localStorage.setItem('pActiveId', $(this).attr('key'))

        modalPrints(this);
    })

})
  
function modalPrints(el){ //to show active option print
    $(".list-group-item").removeClass("active")
    $(".selectedprint").removeClass("far fa-check-circle")
  
    $(el).addClass('active')
    $(el).find('.selectedprint').addClass("far fa-check-circle")
}

var count = 0;
function nsteps(){ //next step to show sizes
  count++;
  $(".piSizes").show("fast")
  $(".piSizes").load("loads/sizes/sizes.php")
    
  $(".allTabs li a").removeClass("active")
  $(".allTabs li a:eq("+count+")").addClass("active")

  $('#picmodal').modal('hide');
}
  
function toasts(text){ //this is the function to execute toast error
  $('.toast-body').html(text)
  $('.toast').toast('show')

  setTimeout(() => {
      $('.toast').toast('hide')
  }, 3000);
}

function list_type_prints(){ //to show list type prints
  $(".piSizes").show("fast")
  $(".piSizes").load("loads/hdPrints/list_type_prints.php")
}