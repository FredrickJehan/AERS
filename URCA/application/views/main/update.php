
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit</h1>
        <a href="<?php echo base_url('edit');?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class=" fa-md text-white-50"></i>Delete</a>
    </div>
    <?php
       if(isset($user_data)){
           foreach($user_data as $row){
        ?>
        <div class="form-group">
            <label>Author*</label>
            <input type="text" name="thesisAuthor" value="<?php echo $row->thesis_author; ?>" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisAuthor"); ?>
            </span>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
            <label>Year Completed*</label>
            <input type="text" name="thesisYear" value="<?php echo $row->thesis_year; ?>" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisYear"); ?>
            </span>
            </div>
            <div class="form-group col-md-5">
            <label>Title of thesis / dissertation*</label>
            <input type="text" name="thesisTitle" value="<?php echo $row->thesis_title; ?>" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisTitle"); ?>
            </span>
            </div>
            <div class="form-group col-md-5">
            <label>URL for published thesis</label>
            <input type="text" name="thesisURL" value="<?php echo $row->thesis_url; ?>" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisURL"); ?>
            </span>
            </div>
        </div>
        <div class="form-group">
            <label>Institution where thesis was completed*</label>
            <input type="text" name="thesisInstitute" value="<?php echo $row->thesis_institute; ?>" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisInstitute"); ?>
            </span>
        </div>
        <div class="form-group">
            <label>Location of Institute*</label>
            <input type="text" name="thesisLocation" value="<?php echo $row->thesis_location; ?>" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisLocation"); ?>
            </span>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: Copy of front page, approval pages, table of contents for unpublished thesis*
            </label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="hidden" name="hidden_id" value="<?php echo $row->thesis_id; ?>" class="btn btn-primary"></input>
            <input type="submit" name="thesisupdate" value="Update" class="btn btn-primary"></input>
        </div>
        <?php
           }
       }else{
       ?>
    <div class="container">
        <form method="post" action="<?php echo base_url()?>insert/thesis_form_validation">
        <!--echos message when redirected to thesis_table --> 
        <!--sadly doesn't work  
        <php
            //if($this->uri->segment(3) == "thesis_table"){
            //    echo '<p class="text-success">Insert Complete</p>';
            //}
        ?> -->

        <div class="form-group">
            <label>Author*</label>
            <input type="text" name="thesisAuthor" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisAuthor"); ?>
            </span>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
            <label>Year Completed*</label>
            <input type="text" name="thesisYear" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisYear"); ?>
            </span>
            </div>
            <div class="form-group col-md-5">
            <label>Title of thesis / dissertation*</label>
            <input type="text" name="thesisTitle" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisTitle"); ?>
            </span>
            </div>
            <div class="form-group col-md-5">
            <label>URL for published thesis</label>
            <input type="text" name="thesisURL" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisURL"); ?>
            </span>
            </div>
        </div>
        <div class="form-group">
            <label>Institution where thesis was completed*</label>
            <input type="text" name="thesisInstitute" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisInstitute"); ?>
            </span>
        </div>
        <div class="form-group">
            <label>Location of Institute*</label>
            <input type="text" name="thesisLocation" class="form-control">
            <span class="text-danger"><?php echo form_error("thesisLocation"); ?>
            </span>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: Copy of front page, approval pages, table of contents for unpublished thesis*
            </label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="thesissubmit" value="Update" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <?php
       }
    ?>
<!-- /.container-fluid -->