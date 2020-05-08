<?php
foreach($research_data as $row)
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit</h1>
        <a href="<?php echo base_url('edit');?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class=" fa-md text-white-50"></i>Delete</a>
    </div>

    <!-- Submittion form -->
    <form>
    <div class="form-row">
        <div class="form-group col-md-8">
            <label>Type of Research/Creative Work</label>
            <select id="researchID" name="research" onchange="displayForm(this)" class="form-control">
                <option>Thesis / Dissertation</option>
                <option>Technical / Research report</option>
                <option>Conference Paper</option>
                <option>Conference Poster</option>
                <option>Journal Article</option>
                <option>Book / Textbook</option>
                <option>Book Chapter</option>
                <option>Conference Proceedings</option>
                <option>Creative Work</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Current Academic Rank</label>
            <input type="text" class="form-control" value="Professor 3" disabled>
        </div>
    </div>
    </form>
    <hr>
    <!-- ./End of Submittion form -->

    <!-- Thesis / Dissertation form -->
    <div id="thesis">
        <form method="post" action="<?php echo base_url('insert/update_researchCR/'.$row->cr_id)?>" enctype="multipart/form-data">
        <div class="form-group">
            <label>Author*</label>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>First Name*</label>
                <input type="text" value="<?php echo $row->cr_first;?>" name="thesisFirst" class="form-control">
                <span class="text-danger"><?php echo form_error("thesisFirst");?></span>
            </div>
            <div class="form-group col-md-2">
                <label>Middle Initial(s)*</label>
                <input type="text" value="<?php echo $row->cr_middle;?>" name="thesisMiddle" class="form-control">
                <span class="text-danger"><?php echo form_error("thesisMiddle");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Last Name*</label>
                <input type="text" value="<?php echo $row->cr_last;?>" name="thesisLast" class="form-control">
                <span class="text-danger"><?php echo form_error("thesisLast");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Completed*</label>
                <input type="text" value="<?php echo $row->cr_year;?>" name="thesisYear" class="form-control">
            </div>
            <div class="form-group col-md-5">
                <label>Title of thesis / dissertation*</label>
                <input type="text" value="<?php echo $row->cr_title;?>" name="thesisTitle" class="form-control" >
            </div>
            <div class="form-group col-md-5">
                <label>URL for published thesis</label>
                <input type="text" value="<?php echo $row->cr_url;?>" name="thesisURL" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label>Institution where thesis was completed*</label>
            <input type="text" class="form-control" name="thesisInstitute" value="<?php echo $row->cr_institute;?>">
        </div>
        <div class="form-group">
            <label>Location of Institute*</label>
                <input type="text" name="thesisLocation" value="<?php echo $row->cr_location;?>" class="form-control">
                <span class="text-danger"><?php echo form_error("thesisLocation");?></span>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: Copy of front page, approval pages, table 
                of contents for unpublished thesis*
            </label>
            <input type="file" value="<?php echo $row->cr_file;?>" name="thesisFile" class="form-control-file">
            <a href="<?=base_url().'pdf/'.$row->cr_file;?>" target="_blank">test</a>
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="thesissubmit" value="Save Changes" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Thesis / Dissertation form -->

    <!-- Technical / Research form -->
    <div id="technical" style="display:none;">
    <form method="post" action="<?php echo base_url('insert/update_researchCR/'.$row->cr_id)?>" enctype="multipart/form-data">
        <div class="form-group">
            <label>Author*</label>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>First Name*</label>
                <input type="text" value="<?php echo $row->cr_first;?>" name="technicalFirst" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalFirst");?></span>
            </div>
            <div class="form-group col-md-2">
                <label>Middle Initial(s)*</label>
                <input type="text" value="<?php echo $row->cr_middle;?>" name="technicalMiddle" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalMiddle");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Last Name*</label>
                <input type="text" value="<?php echo $row->cr_last;?>" name="technicalLast" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalLast");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Completed*</label>
                <input type="text" name="technicalYear" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalYear");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Title of thesis / dissertation*</label>
                <input type="text" name="technicalTitle" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalTitle");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>URL for published thesis</label>
                <input type="text" name="technicalURL" class="form-control">
                <span class="text-danger"><?php echo form_error("technicalURL");?></span>
            </div>
        </div>
        <div class="form-group">
            <label>Institution where thesis was completed*</label>
            <input type="text" name="technicalInstitute" class="form-control">
            <span class="text-danger"><?php echo form_error("technicalInstitute");?></span>
        </div>
        <div class="form-group">
            <label>Location of Institute*</label>
            <input type="text" name="technicalLocation" class="form-control">
            <span class="text-danger"><?php echo form_error("technicalLocation");?></span>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: Copy of front page, approval pages, table 
                of contents for unpublished thesis*
            </label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="technicalsubmit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Technical / Research form -->


</div>
<!-- /.container-fluid -->