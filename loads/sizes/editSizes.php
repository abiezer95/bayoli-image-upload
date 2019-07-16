<?php 
require '../../database/definitions.php'; 
?>
<button class="btn btn-danger pstatus" key='true'>Status: Adding</button>
<form class="editMenu">
    <span>To edit elements press the above tab you will edit</span>
    <div class="form-group names-form-group">
        <div class="existing">
            <label>Use existing:</label>
            <select id="existing">
                <option value="null">N/A</option>
                <?php
                    $existing = getAll('type_prints', ['name', 'id'], '');
                    foreach ($existing as $key => $value) {
                        echo "<option value='".$existing[$key]['id']."'>".$existing[$key]['name']."</option>";
                    }
                ?>
                
            </select>
        </div>
        
        <div class="elMenu">
            <label for="elMenu" class="mt-2">Menu name:</label>
            <input type="text" class="form-control" id="elMenu" aria-describedby="emailHelp" placeholder="Name (opcional for existing)" disabled>
        </div>
        
        <small id="emailHelp" class="form-text text-muted">This is the tab menu.</small>
    </div>
    <div class="form-group elSize">
        <label>Element:</label>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-primary addMoreElements" onclick="addElements()">Add more elements <i class="fas fa-plus"></i></button>
        <button type="submit" class="btn btn-primary">Save <i class="far fa-save"></i></button>
    </div>
</form>

<script> 
    var size_elements = <?php echo json_encode(getAll('types_sizes', ['id', 'name', 'price', 'id_type_prints'], ''));?>;
</script>
<script src="loads/sizes/js/editsize.js"></script>
<style>
.pstatus{
    position: relative;
    top: 28px;
    left: 14px;
}
 .editMenu {
     position:relative;
     top: 27px;
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