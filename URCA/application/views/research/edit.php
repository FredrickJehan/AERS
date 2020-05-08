<?php 
    foreach($research_data as $row){?>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit</h1>
            <a href="<?php echo base_url('research/delete/'.$row->publication_id);?>" class="btn btn-danger">Delete</a>
        </div>
    <?php }
?>

<div class="card shadow mb-4">
<div class="card-body">

<?php
    if($publication_type == '1'){
        foreach($research_data as $row){
            if($row->completed_type == '1'){?>
        <!-- Thesis / Dissertation form -->
        <div id="thesis">
        <form method="post" action="<?php echo base_url('research/completed_update/'.$row->publication_id)?>" enctype="multipart/form-data">
        <label>Author*</label>
        <input type='number' style="display:none" name="research_type" value='1'></input>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>First Name*</label>
                <input type="text" value="<?php echo $row->first_name?>" name="first_name" class="form-control">
                <span class="text-danger"><?php echo form_error("first_name");?></span>
            </div>
            <div class="form-group col-md-2">
                <label>Middle Initial(s)*</label>
                <input type="text" value="<?php echo $row->middle_initial?>" name="middle_initial" class="form-control">
                <span class="text-danger"><?php echo form_error("middle_initial");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Last Name*</label>
                <input type="text" value="<?php echo $row->last_name?>" name="last_name" class="form-control">
                <span class="text-danger"><?php echo form_error("last_name");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Completed*</label>
                <input type="number" value="<?php echo $row->year?>" name="year" class="form-control">
                <span class="text-danger"><?php echo form_error("year");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Title of thesis / dissertation*</label>
                <input type="text" name="title" value="<?php echo $row->title?>" class="form-control">
                <span class="text-danger"><?php echo form_error("title");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>URL for published thesis</label>
                <input type="text" value="<?php echo $row->url?>" name="url" class="form-control">
                <span class="text-danger"><?php echo form_error("url");?></span>
            </div>
        </div>
        <div class="form-group">
            <label>Institution where thesis was completed*</label>
            <input type="text" value="<?php echo $row->institution?>" name="institution" class="form-control">
            <span class="text-danger"><?php echo form_error("institution");?></span>
        </div>
        <div class="form-group">
            <label>Location of Institute*</label>
            <input type="text" value="<?php echo $row->location?>" name="location" class="form-control">
            <span class="text-danger"><?php echo form_error("location"); ?>
            </span>
        </div>
        <div class="form-group">
            <label>
                SUBMIT / UPLOAD in one file: Copy of front page, approval pages, table of contents for unpublished thesis*
            </label>
            <input type="file" name="file" class="form-control-file">
            <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank"><?php echo $row->file; ?></a>
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Thesis / Dissertation form -->

        <?php
            }else if($row->completed_type == '2'){?>
    <!-- Technical / Research form -->
    <div id="technical">
    <form method="post" action="<?php echo base_url('research/completed_update/'.$row->publication_id)?>" enctype="multipart/form-data">
        <p>Author*</p>
        <input type='number' style="display:none" name="research_type" value='2'></input>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>First Name*</label>
                <input type="text" name="first_name" value="<?php echo $row->first_name?>" class="form-control">
                <span class="text-danger"><?php echo form_error("first_name");?></span>
            </div>
            <div class="form-group col-md-2">
                <label>Middle Initial(s)*</label>
                <input type="text" name="middle_initial" value="<?php echo $row->middle_initial?>" class="form-control">
                <span class="text-danger"><?php echo form_error("middle_initial");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Last Name*</label>
                <input type="text" name="last_name" value="<?php echo $row->last_name?>" class="form-control">
                <span class="text-danger"><?php echo form_error("last_name");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Year Completed*</label>
                <input type="number" name="year" value="<?php echo $row->year?>" class="form-control">
                <span class="text-danger"><?php echo form_error("year");?></span>
            </div>
            <div class="form-group col-md-10">
                <label>Title of Report*</label>
                <input type="text" name="title" value="<?php echo $row->title?>" class="form-control">
                <span class="text-danger"><?php echo form_error("title");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-7">
                <label>Institution which commissioned the report / where report was completed*</label>
                <input type="text" name="institution" value="<?php echo $row->institution?>" class="form-control">
                <span class="text-danger"><?php echo form_error("institution");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Location of Institute*</label>
                <input type="text" name="location" value="<?php echo $row->location?>" class="form-control">
                <span class="text-danger"><?php echo form_error("location");?></span>
            </div>
        </div>
        <div class="form-group">
            <label>SUBMIT / UPLOAD in one file: Copy of full technical report*</label>
            <input type="file" name="file" value="<?php echo $row->file?>" class="form-control-file">
            <a href="<?php echo base_url()?>" target="__blank" value="<?php echo $row->file?>"></a>
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Technical / Research form -->
        <?php }   
        }
    }else if($publication_type == '2'){
        foreach($research_data as $row){
            if($row->presented_type == '3'){?>
    <!-- Conference Paper form -->
    <div id="conference">
    <form method="post" action="<?php echo base_url('research/presented_update/'.$row->publication_id)?>" enctype="multipart/form-data">
        <label>Author*</label>
        <input type='number' style="display:none" name="research_type" value='3'></input>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>First Name*</label>
                <input type="text" name="first_name" value="<?php echo $row->first_name?>" class="form-control">
                <span class="text-danger"><?php echo form_error("first_name");?></span>
            </div>
            <div class="form-group col-md-2">
                <label>Middle Initial(s)*</label>
                <input type="text" name="middle_initial" value="<?php echo $row->middle_initial?>" class="form-control">
                <span class="text-danger"><?php echo form_error("middle_initial");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Last Name*</label>
                <input type="text" name="last_name" value="<?php echo $row->last_name?>" class="form-control">
                <span class="text-danger"><?php echo form_error("last_name");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Year completed*</label>
                <input type="month" name="month_year" value="<?php echo $row->date_presentation?>" class="form-control">
                <span class="text-danger"><?php echo form_error("month_year");?></span>
            </div>
            <div class="form-group col-md-8">
                <label>Title of paper*</label>
                <input type="text" name="title" value="<?php echo $row->title_presented?>" class="form-control">
                <span class="text-danger"><?php echo form_error("title");?></span>
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-8">
            <label>Full title of conference*</label>
            <input type="text" name="title_conference" value="<?php echo $row->title_conference?>" class="form-control">
            <span class="text-danger"><?php echo form_error("title_conference");?></span>
        </div>
        <div class="form-group col-md-4">
            <label>Place of conference*</label>
            <input type="text" name="place_conference" value="<?php echo $row->place_conference?>" class="form-control">
            <span class="text-danger"><?php echo form_error("place_conference");?></span>
        </div>
        </div>
        <div class="form-group">
            <label>SUBMIT / UPLOAD in one file (jpg or pdf): Copy of Certificate of Presentation</label>
            <input type="file" name="file" class="form-control-file">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Conference Paper form -->

            <?php
            }else if($row->presented_type == '4'){?>
    <!-- Conference Poster form -->
    <div id="poster">
    <form method="post" action="<?php echo base_url('research/presented_update/'.$row->publication_id)?>" enctype="multipart/form-data">
        <div class="form-group"><label>Author*</label></div>
        <input type='number' style="display:none" name="research_type" value='4'></input>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label>First Name*</label>
                <input type="text" name="first_name" value="<?php echo $row->first_name?>" class="form-control">
                <span class="text-danger"><?php echo form_error("first_name");?></span>
            </div>
            <div class="form-group col-md-2">
                <label>Middle Initial(s)*</label>
                <input type="text" name="middle_initial" value="<?php echo $row->middle_initial?>" class="form-control">
                <span class="text-danger"><?php echo form_error("middle_initial");?></span>
            </div>
            <div class="form-group col-md-5">
                <label>Last Name*</label>
                <input type="text" name="last_name" value="<?php echo $row->last_name?>" class="form-control">
                <span class="text-danger"><?php echo form_error("last_name");?></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Year completed*</label>
                <input type="month" name="month_year" value="<?php echo $row->date_presentation?>" class="form-control">
                <span class="text-danger"><?php echo form_error("month_year");?></span>
            </div>
            <div class="form-group col-md-8">
                <label>Title of Poster*</label>
                <input type="text" name="title" value="<?php echo $row->title_presented?>" class="form-control">
                <span class="text-danger"><?php echo form_error("title");?></span>
            </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-8">
            <label>Full title of conference*</label>
            <input type="text" name="title_conference" value="<?php echo $row->title_conference?>" class="form-control">
            <span class="text-danger"><?php echo form_error("title_conference");?></span>
        </div>
        <div class="form-group col-md-4">
            <label>Place of conference*</label>
            <input type="text" name="place_conference" value="<?php echo $row->place_conference?>" class="form-control">
            <span class="text-danger"><?php echo form_error("place_conference");?></span>
        </div>
        </div>
        <div class="form-group">
            <label>
            SUBMIT / UPLOAD in one file: Copy of poster, picture of presenter with poster as background and/or Certificate of Poster Presentation
            </label>
            <input type="file" name="file" class="form-control-file">
        </div>
        <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Cancel</a>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
        </div>
        </form>
    </div>
    <!-- ./Conference Poster form -->

            <?php }   
        }
    }else if($publication_type == '3'){
        foreach($research_data as $row){
            if($row->presented_type == '5'){
                //journal article
            }else if($row->presented_type == '6'){
                //textbook
            }else if($row->presented_type == '7'){
                //chapter
            }else{
                //proceedings
            }
        }
        
    }else{
        // foreach($research_data as $row){
        //     if($row->presented_type == '4'){
            
        //     }
    }
?>
</div>
</div>