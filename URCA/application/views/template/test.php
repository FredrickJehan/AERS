<!-- <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script> 
<div id="journal">
    <label>List the author/s of the article in the order they appear in the citation</label>
    <form method="post" action="<?php echo base_url()?>research/published_submit" enctype="multipart/form-data"> 
    <div class="example-1">
        <div class="example-2"> 
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>First Name*</label>
                    <input type="text" name="first_name" class="form-control">
                    <span class="text-danger"><?php echo form_error("first_name");?></span>
                </div>
                <div class="form-group col-md-2">
                    <label>Middle Initial(s)*</label>
                    <input type="text" name="middle_initial" class="form-control">
                    <span class="text-danger"><?php echo form_error("middle_initial");?></span>
                </div>
                <div class="form-group col-md-5">
                    <label>Last Name*</label>
                    <input type="text" name="last_name" class="form-control">
                    <span class="text-danger"><?php echo form_error("last_name");?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Is Author 1 an employee of ADNU? &nbsp;</label>
                    <input type="radio" id="yes" name="is_employee" value="1">
                    <label for="yes">Yes</label>
                    <input type="radio" id="no" name="is_employee" value="0">
                    <label for="no">No</label>
                </div>
            </div>
            <button class="btn-copy">Add Author</button>
        </div>
    </div>
    <div class="form-group" style="text-align:center;">
        <a href="#" class="btn btn-primary">Cancel</a>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
    </div>
</div>
</form>

<!-- Journal Article form -->
<!-- <div id="journal">
    <label>List the author/s of the article in the order they appear in the citation</label>
    <form method="post" action="<?php echo base_url()?>research/published_submit" enctype="multipart/form-data">
        <label>Author 1*</label>
        <div id="author">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>First Name*</label>
                <input type="text" name="first_name[]" class="form-control">
                <span class="text-danger"><?php echo form_error("first_name");?></span>
            </div>
            <div class="form-group col-md-2">
                <label>Middle Initial(s)*</label>
                <input type="text" name="middle_initial[]" class="form-control">
                <span class="text-danger"><?php echo form_error("middle_initial");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Last Name*</label>
                <input type="text" name="last_name[]" class="form-control">
                <span class="text-danger"><?php echo form_error("last_name");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Is Author 1 an employee of ADNU? &nbsp;</label>
                <input type="radio" id="yes" name="is_employee" value="1">
                <label for="yes">Yes</label>
                <input type="radio" id="no" name="is_employee" value="0">
                <label for="no">No</label>
            </div>
        </div>
        <div class="form-group">
            <button type="button" name="btn-author">
            <i class="fas fa-user fa-sm text-white-50"></i> Add Author</button>
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
    </form>
    </div> -->
    <!-- ./Journal Article form -->


    <!-- <div class="form-group">
        <form name="add_author" id="add_author">
            <table class="table table-bordered" id="dynamic_field">
                <tr>
                    <td><input type="text" name="name[]" id="name"/></td>
                    <td><button name="add" id="add" class="btn btn-success"></button></td>
                </tr>
            </table>
            <input type="button" name="submit" id="submit" value="submit"/>
        </form>
    </div> -->

<!-- <script>
$(document).ready(function(){
    var i = 1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append();
    }
}
</script> -->
<script>
$(function(){
  $(".btn-copy").on('click', function(){
    var ele = $(this).closest('.example-2').clone(true);
    $(this).closest('.example-2').after(ele);
  })
})
</script> -->