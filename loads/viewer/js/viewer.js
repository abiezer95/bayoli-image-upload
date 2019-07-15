function mark_as_completed(id){
    $.post('database/status/status.php', {id_order: id}, function(data){
        console.log(data)
    });
}


function cancelOrder(id){
    $(".piSizes").hide("fast")
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this Order!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.post('database/status/remove.php', {id_order: id}, function(data){
            console.log(data);
            swal("Your order has been deleted!", {
                icon: "success",
              });
          })
        } else {
          $(".piSizes").show("fast")
          swal("Your order is safe!");
        }
      });
}

function pclose(){ //to close the side bar
    $('.piSizes').hide('fast')
}

