$(document).ready(function() {
    // $(".piSizes").css("display", 'block')
    // $(".piSizes").load("loads/hdPrints/edit_type_prints.php")
    // openSize()
});

function getFile(){

        $(".inout2").html(`<img id="output">`);
        $("#piData").html(`
        <form id="upload_img">
            <input type="file" name="new_pic" class="piFiles" accept="image/*">
        </form>`);
        
        $('.piFiles').click()
        
        $('.piFiles').change(() => {
            let t = $('.piFiles').val().length;
            $('.loading').show('fast')
            if(t > 0){
                var reader = new FileReader();
                reader.onload = function(){
                    $("#output").attr("src", reader.result);
                    
                    var x = $("#output").width()
                    var y = $("#output").height()
                    
                    localStorage.setItem("img", reader.result)
                    localStorage.setItem("imgx", x)
                    localStorage.setItem("imgy", y)
                
                    setTimeout(() => {
                        $('.loading').hide('fast')
                        $('.inout img').css('opacity', '1')
                        $('.nstep').removeAttr('disabled')
                    }, 1000);

                // var data = new FormData($("#upload_img")[0])
                // $.ajax({
                //     type: "POST",
                //     url: 'database/img_uploaded/upload.php',
                //     processData: false,
                //     data: {data},
                //     contentType: false,
                //     success: function (data) {
                //         console.log(data)
                //     },
                // })
                    if(x >= 500 && y >= 300){
                        $('#picmodal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });
                        fullSize()
                    }else{
                        alert("The image must be min 600x300")
                    }
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

    if($("#full").is(':checked')) crops();
}

function crops(type){
    x = localStorage.getItem('imgx')
    y = localStorage.getItem('imgy')

    if(type != 1) full = false;
    else full = true

    input = $('#output').rcrop({
        full : full,
        minSize : [200, 200],
        grid : true,
        inputs : true,
        // preserveAspectRatio : true,
    
        preview : {
            display: false,
            size : [x/3, y/3],
            // wrapper : '#custom-preview-wrapper'
        }
    });

    fill = function(){
        $('#output').rcrop('updateCropData');
        var values = $('#output').rcrop('getValues');

        localStorage.setItem('rcrop', values);
    };

    $('#output').on('rcrop-change rcrop-ready', fill);

    console.log(input);
}
