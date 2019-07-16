$(document).ready(function() {
    // $(".piSizes").css("display", 'block')
    // $(".piSizes").load("loads/hdPrints/edit_type_prints.php")
    // openSize()
    // $(".piSizes").css("display", 'block')
    // $(".piSizes").load("loads/hdPrints/list_type_prints.php")
    // localStorage.setItem('uploaded', JSON.stringify([5]))
});


function viewDetailsPrint(img, id){
    $(".piSizes").show("fast")
    $(".piSizes").load("loads/viewer/viewer.php?view="+id+"&img="+img+"")
}

function getFile(){

        $(".inout2").html(`<img id="output">`);
        $("#piData").html(`
        <form id="upload_img">
            <input type="file" name="new_pic" class="piFiles" accept="image/*">
        </form>`);
        
        $('.piFiles').click()
        
        $('.piFiles').change(() => {
            $('.loading').show('fast')
            
            let t = $('.piFiles').val().length;
            if(t > 0){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#output").attr("src", reader.result);
                    
                    var img = new Image();

                    img.src = reader.result;

                    img.onload = function() {
                        x = img.width;
                        y = img.height;

                        localStorage.setItem('img', reader.result);
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

function openSize(){
  $(".piSizes").css("display", 'block')
  $(".piSizes").load("loads/sizes/sizes.php")
}

function anotherFile(){
    $('#picmodal').modal('hide');
    setTimeout(() => {
        getFile();
    }, 100);
}

function fullSize(){
    let img = localStorage.getItem('img');
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
