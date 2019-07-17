<div class="header">
    <h5>Admin board</h5>
    <div class="adminBtn">
        <button type="button" class="btn btn-danger adminPrints">Print Options</button>
        <button type="button" class="btn btn-warning adminSize">Size Options</button>
        <!-- <button type="button" class="btn btn-warning search-btn">Seach Image</button> -->
    </div>

    <div class="searchEngine">
        <div class="input-group">
                <div class="spinner-border text-warning searchLoad" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <input type="text" class="form-control search-it" placeholder="Search By client email" aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.adminPrints').click(() => {
            $(".piSizes").css("display", 'block')
            $(".piSizes").load("loads/hdPrints/edit_type_prints.php")
            $('#picmodal').modal('hide');
        })
        
        $('.adminSize').click(() => {
            $(".piSizes").css("display", 'block')
            $(".piSizes").load("loads/sizes/sizes.php")
        })

        $('.search-it').on('keyup', function(){
            $('.searchLoad').css('opacity', 1)
            setTimeout(() => {                
                completed = window.location.href;
                
                if(completed.split('?')[1] != undefined) completed = 'completed'
                else completed = ''

                let uri = 'images.php?isSearch=1&search='+$('.search-it').val()+'&'+completed+'';

                $.post(uri, function(data){
                    $('.searchLoad').css('opacity', 0)
                    $('.picUpdateFrame').html(data)
                })
            }, 1000);
        })
    })
</script>

<style>
.searchLoad{
    opacity: 0
}
.searchEngine{
    position:absolute;
    right: 10px;
    top: 8px;
    width: 35%;
}
.searchEngine div{
    
}
.header{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height: 50px;
    background: rgba(0,0,0,0.5);
    border-bottom: groove 1px red;
}
.header h5{
    position: absolute;
    top: 15px;
    left: 42px;
    color:#fff
    
}
.adminBtn{
    position:relative;
    top: 10px;
    right: 20px;
    display:flex;
    flex-direction: row;
    justify-content:center
}
.adminBtn button{
    height: 30px;
    font-size: 14px;
    margin-left: 10px
}
</style>