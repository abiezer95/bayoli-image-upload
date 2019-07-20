$(document).ready(() => {
    // $('.previewImg').attr('src', $('.cacheData').html())
})

function pclose(){
    localStorage.setItem('productId', undefined);
    
    $(".piSizes").css("display", 'none')
}

function cancelOrder(id){
    $(".piSizes").hide("fast")
    swal({
        title: "Are you sure to delete?",
        text: "Once deleted, you will not be able to recover this Order!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.post('database/status/remove.php', {id_order: id}, function(data){
            $('.picUpdateFrame').load(location.href + " .picUpdateFrame")
            swal("Your order has been deleted!", {
                icon: "success",
              });
              localStorage.setItem('productId', undefined);
          })
        } else {
          $(".piSizes").show("fast")
          swal("Your order is safe!");
        }
      });
}