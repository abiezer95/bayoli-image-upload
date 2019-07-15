<div class="header">
    <h5>Admin board</h5>
    <div class="adminBtn">
        <button type="button" class="btn btn-danger adminPrints">Print Options</button>
        <button type="button" class="btn btn-danger adminSize">Size Options</button>
        <button type="button" class="btn btn-warning ">Seach Image</button>
    </div>

    <div style="display:flex;justify-content:center;display:none">
        <div class="input-group mt-2" style="width: 400px;">
                <input type="text" class="form-control" placeholder="Search By client email" aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
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
    })
</script>

<style>
.header{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height: 41px;
    background: rgba(0,0,0,0.5);
    border-bottom: groove 1px red;
}
.header h5{
    position: absolute;
    top: 10px;
    left: 42px;
    color:#fff
    
}
.adminBtn{
    position:relative;
    top: 4px;
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