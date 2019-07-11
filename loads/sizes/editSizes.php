<form class="editMenu">
    <span>To edit elements press the tab you will edit and click Edit Sizes Button</span>
    <div class="form-group">
        <label for="elMenu">Menu name:</label>
        <input type="text" class="form-control" id="elMenu" aria-describedby="emailHelp" placeholder="Name" required>
        <small id="emailHelp" class="form-text text-muted">This is the tab menu.</small>
    </div>
    <div class="form-group elSize">
        <label>Element:</label>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-primary" onclick="addElements()">Add more elements <i class="fas fa-plus"></i></button>
        <button type="submit" class="btn btn-primary">Save <i class="far fa-save"></i></button>
    </div>
</form>

<script src="loads/sizes/js/size.js"></script>
<style>
 .editMenu {
     position:relative;
     top: 20px;
     left: 10px;
 }
 .editMenu label{
     color: #000
 }
 .editMenu span{
     /* color: #000 */
     font-size: 14px
 }
 .editMenu {
     width: 450px;
     height: 450px;
     overflow-y:auto;
     overflow-x:hidden;
 }
 .elSize div{
     display:flex;
     flex-direction: row;
     margin-top: 5px;
 }
 .elSize div input{
     width: 180px;
     margin-left:5px
 }
</style>