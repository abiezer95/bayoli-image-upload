$(document).ready(function() {
    // $(".piSizes").css("display", 'block')
    // $(".piSizes").load("loads/hdPrints/edit_type_prints.php")
    // openSize()
    const urlParams = new URLSearchParams(window.location.search);
    const payment = urlParams.get('payment');

        data = JSON.parse(localStorage.getItem('productId'));
        if(data != undefined){
            if(payment == '0etw0' || payment == undefined){
                var content = {
                    id: data[0],
                    img: data[1],
                    email: localStorage.getItem('email'),
                    sizes: JSON.parse(localStorage.getItem('sizes')),
                    type_prints_id: localStorage.getItem('pActiveId'),
                };
                $(".piSizes").load("loads/payment/payment.php", content)
            }
            if(payment == 'true1'){
                var content = {
                    id: data[0],
                    img: data[1],
                    email: localStorage.getItem('email'),
                    sizes: JSON.parse(localStorage.getItem('sizes')),
                    type_prints_id: localStorage.getItem('pActiveId'),
                    pagado: 0
                };
                $(".piSizes").load("loads/payment/payment.php", content)
            }

            $(".piSizes").css("display", 'block')
        }
        
        
    
    // if()
    // $(".piSizes").css("display", 'block')
    // $(".piSizes").load("loads/payment/payment.php?view=3&img=1")
    // localStorage.setItem('uploaded', JSON.stringify([5]))
    // $(".piSizes").load("loads/payment/payment.php", 
    // {
    //     id: 16,
    //     email: 'asasd',
    //     sizes: [{'id_types': 1, counts: 2},{'id_types': 2, counts: 2}],
    //     type_prints_id: localStorage.getItem('pActiveId'),
    //     // pagado: 0
    // })
});


function viewDetailsPrint(img, id){
    completed = window.location.href;
                
    if(completed.split('?')[1] != undefined) completed = 1
    else completed = 0

    $(".piSizes").load("loads/viewer/viewer.php?view="+id+"&img="+img+"&completed="+completed+"")

    setTimeout(() => {
        $(".piSizes").show("fast")
    }, 500);
}

function getFile(){

        $("#piData").html(`
        <form id="upload_img">
            <input type="file" name="new_pic" class="piFiles" accept="image/jpeg">
        </form>`);
        
        $('.piFiles').click()
        
        $('.piFiles').change(() => {
            $('.loading').show('fast')
            
            let t = $('.piFiles').val().length;
            if(t > 0){
                var reader = new FileReader();
                reader.onload = function(){
                    // $("#output").attr("src", reader.result);
                    // $(".inout").html(`<img id="output">`);
                    // $("#output").attr("src", reader.result);

                    var img = new Image();
                    
                    img.src = reader.result;

                    img.onload = function() {
                        x = img.width;
                        y = img.height;

                        // localStorage.setItem('img', reader.result);
                        $('.cacheData').html(reader.result)
                        localStorage.setItem("imgx", x)
                        localStorage.setItem("imgy", y)
                        
                        if(x >= 500 && y >= 300){
                            $('#picmodal').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                            fullSize()
                        }else{
                            alert("The image must be min 600x300")
                        }
                    }

                    setTimeout(() => {
                        $('.loading').hide('fast')
                        $('.inout img').css('opacity', '1')
                        $('.nstep').removeAttr('disabled')
                    }, 1000);

                // 
                
                    
                };
                reader.readAsDataURL(event.target.files[0]);
                
            }
        })
}

// function openSize(){
//   $(".piSizes").load("loads/sizes/sizes.php")
//   $('.load').css('display', 'block')
//   setTimeout(() => {
//     $(".piSizes").css("display", 'block')
//     $('.load').css('display', 'none')
//   }, 5000);
// }

function anotherFile(){
    $('#picmodal').modal('hide');
    setTimeout(() => {
        getFile();
    }, 100);
}

function fullSize(){
    // let img = localStorage.getItem('img');
    let img = $('.cacheData').html()
    $(".inout").html(`<img id="output">`);
    $("#output").attr("src", img);

    if($("#full").is(':checked')) crops(), localStorage.setItem("crop_status", true)
    else localStorage.setItem("crop_status", false)
}

function crops(type){
    x = localStorage.getItem('imgx')
    y = localStorage.getItem('imgy')

    if(type != 1) full = false;
    else full = true

    fill = function(){
            setTimeout(() => {
                $('#output').rcrop('updateCropData');
                var values = $('#output').rcrop('getValues');
                // console.log(values)
                localStorage.setItem('rcrop', JSON.stringify(values));
            }, 500);        
    };

    $('#output').rcrop({
        full : full,
        minSize : [300, 300],
        grid : true,
        inputs : true,
        // preserveAspectRatio : true,
    });

    $('#output').on('rcrop-change rcrop-ready', fill);
}
