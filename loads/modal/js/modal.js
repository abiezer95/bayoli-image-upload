$(document).ready(function(){

    $(".list-group-item").on("click", function() {
        $(".dropdown-allEl a").removeClass("active")
        $(".selectedprint").removeClass("far fa-check-circle")
        modalPrints(this);
    })

    $('.dropdown-allEl a').on("click", function(){
        $(this).removeClass("active")
        $(this).removeClass("far fa-check-circle")
        modalPrints(this);
    })

    $('.newPrintMenu').click(function(){
        $(".piSizes").css("display", 'block')
        $(".piSizes").load("loads/hdPrints/edit_type_prints.php")
        $('#picmodal').modal('hide');
    })
})
  
function modalPrints(el){
    $(".list-group-item").removeClass("active")
    $(".selectedprint").removeClass("far fa-check-circle")
  
    $(el).addClass('active')
    $(el).find('.selectedprint').addClass("far fa-check-circle")
}
  var count = 0;
  function nsteps(){
    console.log('asdasd')
    // $(".piSizes").css("display", 'block')
    // $(".piSizes").load("loads/sizes/sizes.php")
      
    // $(".allTabs li a").removeClass("active")
  
    // if(count==0) $('.allTabs li a:eq(1)').addClass('active'), $('.prevStep').show('fast')
    // if(count==1) $('.allTabs li a:eq(2)').addClass('active')
    // if(count <= 1) count++; 
    // console.log('asdasd')
  }
  
  function psteps(){
    
  }