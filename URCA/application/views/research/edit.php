<?php 
    foreach($research_data as $row){?>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit</h1>
            <a href="<?php echo base_url('research/delete/'.$row->publication_id);?>" class="btn btn-danger">Delete</a>
        </div>
    <?php }
?>
<?php
  if (isset($this->session->userdata['logged_in'])) {
    $user_type = ($this->session->userdata['logged_in']['user_type']);
  }else {
    redirect('login');
  }
?>

<?php
    foreach($research_data as $row){
      if($user_type == 'Admin'){ ?>
        <div class="form-group" style="text-align:center;">
          <a class="btn btn-danger" href="#" id="reject" data-toggle="modal" data-target="#rejectModal">Reject</a>
          <a href="<?php echo base_url('admin/review/'.$row->publication_id);?>" class="btn btn-primary">Accept</a>
        </div><?php 
      }
    }
?>
<style>
    .rdesign{
        background-color: #00b16a;
        padding: .5rem 1rem;
        color: rgba(255,255,255,.75);
        position: relative;
    }
    .rdesign2{
        background-color:  #FF0000;
        padding: .5rem 1rem;
        color: rgba(255,255,255,.75);
        position: relative;
    }
    .rdesign3{
        background-color: 	#A9A9A9;
        padding: .5rem 1rem;
        color: rgba(255,255,255,.75);
        position: relative;
    }
</style>
<?php
    foreach($research_data as $row){
        if($row->status == 'Approved'){ ?>
            <div class = "rdesign">This Research has been Approved!</div>
        <?php 
        }else if($row->status == 'Rejected'){ ?>
            <div class = "rdesign2">This Research has been Rejected. You are given a the following feedback. <strong><?php echo $row->feedback; ?></strong></div>
        <?php
        }else if($row->status == 'Unreviewed'){ ?>
            <div class = "rdesign3">This Research has not been Reviewed yet</div>
        <?php
        }
    }
?>


<!-- Logout Modal-->
  <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Send Feedback</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?php echo base_url('admin/review/'.$row->publication_id)?>">
          <div class="modal-body">
            <textarea name="feedback" class="form-control" placeholder="Enter Feedback" rows="5"></textarea>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input class="btn btn-primary" value="Submit" type="submit"></input>
          </div>
        </form>
      </div>
    </div>
  </div>

<div class="card shadow mb-4">
<div class="card-body">

<?php
    if($publication_type == 'Completed Research'){
        foreach($research_data as $row){
            if($row->completed_type == 'Thesis / Dissertation'){ ?>
                <!-- Thesis / Dissertation form -->
                <div id="thesis">
                <form method="post" action="<?php echo base_url('research/completed_update/'.$row->publication_id)?>" enctype="multipart/form-data">
                <label>Author*</label>
                <input type='text' style="display:none" name="research_type" value='Thesis / Dissertation'></input>
                <div class="form-row">
                    <table class="table table-borderless">
                        <tr>
                            <th>First Name*</th>
                            <th>Middle Initial(s)*</th>
                            <th>Last Name*</th>
                        </tr>
                        <?php foreach($author_data as $name){ 
                            if($row->publication_id == $name->publication_id){ ?>
                        <tr>
                            <td>
                                <input type="text" name="first_name[]" value="<?php echo $name->first_name?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="middle_initial[]" value="<?php echo $name->middle_initial?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="last_name[]" value="<?php echo $name->last_name?> "class="form-control" required>
                                <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                            </td>
                        </tr>
                                <input type="hidden" name="author_id[]" value="<?php echo $name->author_id?>">
                        <?php } } ?>
                    </table>
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
                    <p><b>Note: Before clicking the edit button, please reupload file.</b></p>
                </div>
                <div class="form-group">
                    <label>Current file: </label>
                    <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank"><?php echo $row->file; ?></a>
                </div>
                <div class="form-group">
                    <label>
                        SUBMIT / UPLOAD in one file: Copy of front page, approval pages, table of contents for unpublished thesis*
                    </label>
                    <input type="file" name="file" class="form-control-file">
                </div>
                <div class="form-group">
                    <label>Abstract</label>
                    <textarea name="abstract" class="form-control" rows="5"><?php echo $row->abstract?></textarea>
                </div>
                <div class="form-group" style="text-align:center;">
                <?php
                    foreach($research_data as $row){
                        if($user_type == 'Admin'){ ?>
                            <input type="submit" name="submit" value="Edit" class="btn btn-primary"></input>
                        <?php 
                        }else if($user_type == 'Researcher' && $row->status == 'Unreviewed' || $row->status == 'Rejected'){ ?>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
                        <?php
                        }else if($user_type == 'Researcher' && $row->status == 'Approved'){ ?>
                            <a href="<?php echo base_url('research/unsubmit/'.$row->publication_id);?>" class="btn btn-danger">Unsubmit</a>
                        <?php
                        }
                    }
                ?>
                </div>
                </form>
            </div>
            <!-- ./Thesis / Dissertation form -->

        <?php
            }else{ ?>
                <!-- Technical / Research form -->
                <div id="technical">
                <form method="post" action="<?php echo base_url('research/completed_update/'.$row->publication_id)?>" enctype="multipart/form-data">
                    <p>Author*</p>
                    <input type='text' style="display:none" name="research_type" value='Technical / Research Report'></input>
                    <div class="form-row">
                    <table class="table table-borderless">
                        <tr>
                            <th>First Name*</th>
                            <th>Middle Initial(s)*</th>
                            <th>Last Name*</th>
                        </tr>
                        <?php foreach($author_data as $name){ 
                            if($row->publication_id == $name->publication_id){ ?>
                        <tr>
                            <td>
                                <input type="text" name="first_name[]" value="<?php echo $name->first_name?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="middle_initial[]" value="<?php echo $name->middle_initial?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="last_name[]" value="<?php echo $name->last_name?> "class="form-control" required>
                                <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                            </td>
                        </tr>
                                <input type="hidden" name="author_id[]" value="<?php echo $name->author_id?>">
                        <?php } } ?>
                    </table>
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
                        <p><b>Note: Before clicking the edit button, please reupload file.</b></p>
                    </div>
                    <div class="form-group">
                        <label>Current file: </label>
                        <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank"><?php echo $row->file; ?></a>
                    </div>
                    <div class="form-group">
                        <label>SUBMIT / UPLOAD in one file: Copy of full technical report*</label>
                        <input type="file" name="file" value="<?php echo $row->file?>" class="form-control-file">
                        <a href="<?php echo base_url()?>" target="__blank" value="<?php echo $row->file?>"></a>
                    </div>
                    <div class="form-group">
                        <label>Abstract</label>
                        <textarea name="abstract" class="form-control" rows="5"><?php echo $row->abstract?></textarea>
                    </div>
                    <div class="form-group" style="text-align:center;">
                    <?php
                    foreach($research_data as $row){
                        if($user_type == 'Admin'){ ?>
                            <input type="submit" name="submit" value="Edit" class="btn btn-primary"></input>
                        <?php 
                        }else if($user_type == 'Researcher' && $row->status == 'Unreviewed' || $row->status == 'Rejected'){ ?>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
                        <?php
                        }else if($user_type == 'Researcher' && $row->status == 'Approved'){ ?>
                            <a href="<?php echo base_url('research/unsubmit/'.$row->publication_id);?>" class="btn btn-danger">Unsubmit</a>
                        <?php
                        }
                    }
                ?>
                    </div>
                    </form>
                </div>
                <!-- ./Technical / Research form -->
        <?php }   
        }
    }elseif($publication_type == 'Presented Research'){
        foreach($research_data as $row){
            if($row->presented_type == 'Conference Paper'){ ?>
                <!-- Conference Paper form -->
                <div id="conference">
                <form method="post" action="<?php echo base_url('research/presented_update/'.$row->publication_id)?>" enctype="multipart/form-data">
                    <label>Author*</label>
                    <input type='text' style="display:none" name="research_type" value='Conference Paper'></input>
                    <!--<php foreach($author_data as $row){ ?>-->
                        <div class="form-row">
                        <table class="table table-borderless">
                        <tr>
                            <th>First Name*</th>
                            <th>Middle Initial(s)*</th>
                            <th>Last Name*</th>
                        </tr>
                        <?php foreach($author_data as $name){ 
                            if($row->publication_id == $name->publication_id){ ?>
                        <tr>
                            <td>
                                <input type="text" name="first_name[]" value="<?php echo $name->first_name?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="middle_initial[]" value="<?php echo $name->middle_initial?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="last_name[]" value="<?php echo $name->last_name?> "class="form-control" required>
                                <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                            </td>
                        </tr>
                                <input type="hidden" name="author_id[]" value="<?php echo $name->author_id?>">
                        <?php } } ?>
                    </table>
                    </div>               
                    <!--<php }?> -->
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
                        <p><b>Note: Before clicking the edit button, please reupload file.</b></p>
                    </div>
                    <div class="form-group">
                        <label>Current file: </label>
                        <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank"><?php echo $row->file; ?></a>
                    </div>
                    <div class="form-group">
                        <label>SUBMIT / UPLOAD in one file (jpg or pdf): Copy of Certificate of Presentation</label>
                        <input type="file" name="file" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Abstract</label>
                        <textarea name="abstract" class="form-control" rows="5"><?php echo $row->abstract?></textarea>
                    </div>
                    <div class="form-group" style="text-align:center;">
                    <?php
                    foreach($research_data as $row){
                        if($user_type == 'Admin'){ ?>
                            <input type="submit" name="submit" value="Edit" class="btn btn-primary"></input>
                        <?php 
                        }else if($user_type == 'Researcher' && $row->status == 'Unreviewed' || $row->status == 'Rejected'){ ?>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
                        <?php
                        }else if($user_type == 'Researcher' && $row->status == 'Approved'){ ?>
                            <a href="<?php echo base_url('research/unsubmit/'.$row->publication_id);?>" class="btn btn-danger">Unsubmit</a>
                        <?php
                        }
                    }
                ?>
                    </div>
                    </form>
                </div>
                <!-- ./Conference Paper form -->

            <?php
            }elseif($row->presented_type == 'Conference Poster'){?>
                <!-- Conference Poster form -->
                <div id="poster">
                <form method="post" action="<?php echo base_url('research/presented_update/'.$row->publication_id)?>" enctype="multipart/form-data">
                    <div class="form-group"><label>Author*</label></div>
                    <input type='number' style="display:none" name="research_type" value='Conference Paper'></input>
                    <div class="form-row">
                    <table class="table table-borderless">
                        <tr>
                            <th>First Name*</th>
                            <th>Middle Initial(s)*</th>
                            <th>Last Name*</th>
                        </tr>
                        <?php foreach($author_data as $name){ 
                            if($row->publication_id == $name->publication_id){ ?>
                        <tr>
                            <td>
                                <input type="text" name="first_name[]" value="<?php echo $name->first_name?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="middle_initial[]" value="<?php echo $name->middle_initial?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="last_name[]" value="<?php echo $name->last_name?> "class="form-control" required>
                                <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                            </td>
                        </tr>
                                <input type="hidden" name="author_id[]" value="<?php echo $name->author_id?>">
                        <?php } } ?>
                    </table>
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
                        <p><b>Note: Before clicking the edit button, please reupload file.</b></p>
                    </div>
                    <div class="form-group">
                        <label>Current file: </label>
                        <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank"><?php echo $row->file; ?></a>
                    </div>
                    <div class="form-group">
                        <label>
                        SUBMIT / UPLOAD in one file: Copy of poster, picture of presenter with poster as background and/or Certificate of Poster Presentation
                        </label>
                        <input type="file" name="file" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Abstract</label>
                        <textarea name="abstract" class="form-control" rows="5"><?php echo $row->abstract?></textarea>
                    </div>
                    <div class="form-group" style="text-align:center;">
                    <?php
                    foreach($research_data as $row){
                        if($user_type == 'Admin'){ ?>
                            <input type="submit" name="submit" value="Edit" class="btn btn-primary"></input>
                        <?php 
                        }else if($user_type == 'Researcher' && $row->status == 'Unreviewed' || $row->status == 'Rejected'){ ?>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
                        <?php
                        }else if($user_type == 'Researcher' && $row->status == 'Approved'){ ?>
                            <a href="<?php echo base_url('research/unsubmit/'.$row->publication_id);?>" class="btn btn-danger">Unsubmit</a>
                        <?php
                        }
                    }
                ?>
                    </div>
                    </form>
                </div>
                <!-- ./Conference Poster form -->

      <?php }   
        }
    }else if($publication_type == 'Published Research'){
        foreach($research_data as $row){
            if($row->published_type == 'Journal Article'){ ?>
                <!-- Journal Article -->
                <div id="journal">
                <form method="post" action="<?php echo base_url('research/published_update/'.$row->publication_id)?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Author*</label>
                </div>
                <input type='text' style="display:none" name="research_type" value="Journal Article"></input>
                <div class="form-row">
                <table class="table table-borderless">
                        <tr>
                            <th>First Name*</th>
                            <th>Middle Initial(s)*</th>
                            <th>Last Name*</th>
                        </tr>
                        <?php foreach($author_data as $name){ 
                            if($row->publication_id == $name->publication_id){ ?>
                        <tr>
                            <td>
                                <input type="text" name="first_name[]" value="<?php echo $name->first_name?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="middle_initial[]" value="<?php echo $name->middle_initial?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="last_name[]" value="<?php echo $name->last_name?> "class="form-control" required>
                                <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                            </td>
                        </tr>
                                <input type="hidden" name="author_id[]" value="<?php echo $name->author_id?>">
                        <?php } } ?>
                    </table>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>Year Published*</label>
                        <input type="number" name="year" min="1800" max="2099" value="<?php echo $row->year_published?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("year");?></span>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Title of Article*</label>
                        <input type="text" name="title_article" class="form-control" value="<?php echo $row->title_article?>" required>
                        <span class="text-danger"><?php echo form_error("title");?></span>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Title of Journal</label>  
                        <input type="text" name="title_journal" value="<?php echo $row->title_journal?>" class="form-control">
                        <span class="text-danger"><?php echo form_error("title_journal");?></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Volume Number*</label>
                        <input type="number" name="vol_num" value="<?php echo $row->vol_num?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("vol_num");?></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Issue Number</label>
                        <input type="text" name="issue_num" value="<?php echo $row->issue_num?>" class="form-control">
                        <span class="text-danger"><?php echo form_error("issue_num");?></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Page Number*</label>  
                        <input type="text" name="page_num" value="<?php echo $row->page_num?>"class="form-control" required>
                        <span class="text-danger"><?php echo form_error("page_num");?></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>Indexing Databse*</label>
                        <select class="form-control" name="type" required>
                            <?php if($row->indexing_database == 'Scopus'){?>
                                <option value="None">None</option>
                                <option value="Scopus" selected>Scopus</option>
                                <option value="Web Science">Web Science</option>
                                <option value="ASEAN Citation Index">ASEAN Citation Index</option>
                            <?php }elseif($row->indexing_database == 'Web Science'){?>
                                <option value="None">None</option>
                                <option value="Scopus">Scopus</option>
                                <option value="Web Science" selected>Web Science</option>
                                <option value="ASEAN Citation Index">ASEAN Citation Index</option>
                            <?php }elseif($row->indexing_database == 'ASEAN Citation Index'){?>
                                <option value="None">None</option>
                                <option value="Scopus">Scopus</option>
                                <option value="Web Science">Web Science</option>
                                <option value="ASEAN Citation Index" selected>ASEAN Citation Index</option>
                            <?php }else{ ?>
                                <option value="None" selected>None</option>
                                <option value="Scopus">Scopus</option>
                                <option value="Web Science">Web Science</option>
                                <option value="ASEAN Citation Index">ASEAN Citation Index</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Peer-review*</label>
                        <br />  
                        <?php if($row->peer_review == 'yes'){ ?>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="yes_peer" name="peer" class="custom-control-input" checked>
                                <label class="custom-control-label" for="yes_peer">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="no_peer" name="peer" class="custom-control-input">
                                <label class="custom-control-label" for="no_peer">No</label>
                            </div>
                        <?php }else{ ?>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="yes_peer" name="peer" class="custom-control-input">
                                <label class="custom-control-label" for="yes_peer">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="no_peer" name="peer" class="custom-control-input" checked>
                                <label class="custom-control-label" for="no_peer">No</label>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                    <div class="form-group">
                        <p><b>Note: Before clicking the edit button, please reupload file.</b></p>
                    </div>
                    <div class="form-group">
                        <label>Current file: </label>
                        <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank"><?php echo $row->file; ?></a>
                    </div>
                <div class="form-group">
                    <label>
                        SUBMIT / UPLOAD in one file: Copy of original article submitted, Copy of peer-review, Copy of full published paper*
                    </label>
                    <input type="file" name="file" class="form-control-file" required>
                </div>
                <div class="form-group">
                    <label>Abstract</label>
                    <textarea name="abstract" class="form-control" rows="5"><?php echo $row->abstract?></textarea>
                </div>
                <div class="form-group" style="text-align:center;">
                <?php
                    foreach($research_data as $row){
                        if($user_type == 'Admin'){ ?>
                            <input type="submit" name="submit" value="Edit" class="btn btn-primary"></input>
                        <?php 
                        }else if($user_type == 'Researcher' && $row->status == 'Unreviewed' || $row->status == 'Rejected'){ ?>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
                        <?php
                        }else if($user_type == 'Researcher' && $row->status == 'Approved'){ ?>
                            <a href="<?php echo base_url('research/unsubmit/'.$row->publication_id);?>" class="btn btn-danger">Unsubmit</a>
                        <?php
                        }
                    }
                ?>
                </div>
                </form>
            </div>
            <!-- End of Journal Article -->
        <?php
            }elseif($row->published_type == 'Book / Textbook'){ ?>
                <div id="book">
                    <form method="post" action="<?php echo base_url()?>research/published_submit" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Author*</label>
                    </div>
                    <input type='text' style="display:none" name="research_type" value="Book / Textbook"></input>
                    <div class="form-row">
                    <table class="table table-borderless">
                        <tr>
                            <th>First Name*</th>
                            <th>Middle Initial(s)*</th>
                            <th>Last Name*</th>
                        </tr>
                        <?php foreach($author_data as $name){ 
                            if($row->publication_id == $name->publication_id){ ?>
                        <tr>
                            <td>
                                <input type="text" name="first_name[]" value="<?php echo $name->first_name?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="middle_initial[]" value="<?php echo $name->middle_initial?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="last_name[]" value="<?php echo $name->last_name?> "class="form-control" required>
                                <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                            </td>
                        </tr>
                                <input type="hidden" name="author_id[]" value="<?php echo $name->author_id?>">
                        <?php } } ?>
                    </table>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Year Published*</label>
                            <input type="number" name="year" min="1800" max="2099" value="<?php echo $row->year_published?>" class="form-control" required>
                            <span class="text-danger"><?php echo form_error("year");?></span>
                        </div>
                        <div class="form-group col-md-9">
                            <label>Title of Book/Textbook/anthology*</label>
                            <input type="text" name="title_book" class="form-control" value="<?php echo $row->title_book?>" required>
                            <span class="text-danger"><?php echo form_error("title_book");?></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Publisher*</label>
                            <input type="text" name="publisher" class="form-control" value="<?php echo $row->publisher?>" required>
                            <span class="text-danger"><?php echo form_error("publisher");?></span>
                        </div>  
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-12">
                            <label>Place of Publication*</label>
                            <input type="text" name="place" class="form-control" value="<?php echo $row->place_of_publication?>" required>
                            <span class="text-danger"><?php echo form_error("place");?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <p><b>Note: Before clicking the edit button, please reupload file.</b></p>
                    </div>
                    <div class="form-group">
                        <label>Current file: </label>
                        <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank"><?php echo $row->file; ?></a>
                    </div>
                    <div class="form-group">
                        <label>
                            SUBMIT / UPLOAD in one file: Copy of front page, copyright page, table of contents, about the author(s) page*
                        </label>
                        <input type="file" name="file" class="form-control-file" required>
                    </div>
                    <div class="form-group">
                        <label>Abstract</label>
                        <textarea name="abstract" class="form-control" rows="5"><?php echo $row->abstract?></textarea>
                    </div>
                    <div class="form-group" style="text-align:center;">
                    <?php
                    foreach($research_data as $row){
                        if($user_type == 'Admin'){ ?>
                            <input type="submit" name="submit" value="Edit" class="btn btn-primary"></input>
                        <?php 
                        }else if($user_type == 'Researcher' && $row->status == 'Unreviewed' || $row->status == 'Rejected'){ ?>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
                        <?php
                        }else if($user_type == 'Researcher' && $row->status == 'Approved'){ ?>
                            <a href="<?php echo base_url('research/unsubmit/'.$row->publication_id);?>" class="btn btn-danger">Unsubmit</a>
                        <?php
                        }
                    }
                ?>
                    </div>
                    </form>
                </div>
                <!-- Book Text/book form -->
<?php
            }elseif($row->published_type == 'Book Chapter'){?>
                <!-- Book Chapter form -->
                <div id="chapter">
                    <form method="post" action="<?php echo base_url()?>research/published_update" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Author*</label>
                    </div>
                    <input type='text' style="display:none" name="research_type" value="Book Chapter"></input>
                    <div class="form-row">
                    <table class="table table-borderless">
                        <tr>
                            <th>First Name*</th>
                            <th>Middle Initial(s)*</th>
                            <th>Last Name*</th>
                        </tr>
                        <?php foreach($author_data as $name){ 
                            if($row->publication_id == $name->publication_id){ ?>
                        <tr>
                            <td>
                                <input type="text" name="first_name[]" value="<?php echo $name->first_name?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="middle_initial[]" value="<?php echo $name->middle_initial?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="last_name[]" value="<?php echo $name->last_name?> "class="form-control" required>
                                <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                            </td>
                        </tr>
                                <input type="hidden" name="author_id[]" value="<?php echo $name->author_id?>">
                        <?php } } ?>
                    </table>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>Year Published*</label>
                            <input type="number" name="year" min="1800" max="2099" value="<?php echo $row->year_published?>" class="form-control" required>
                            <span class="text-danger"><?php echo form_error("year");?></span>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Title of Chapter*</label>
                            <input type="text" name="title_chapter" class="form-control" value="<?php echo $row->title_chapter?>" required>
                            <span class="text-danger"><?php echo form_error("title_chapter");?></span>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Title of Book*</label>
                            <input type="text" name="title_book" class="form-control" value="<?php echo $row->title_book?>" required>
                            <span class="text-danger"><?php echo form_error("title_book");?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Editor*</label>
                    </div>
                    <div class="form-row">
                        <table class="table table-borderless" id="table_bookchap_ed">
                            <tr>
                                <th>First Name*</th>
                                <th>Middle Initial(s)*</th>
                                <th>Last Name*</th>
                            </tr>
                            <?php foreach($editor_data as $e_name){ 
                                    if($row->published_id == $e_name->published_id){?>
                            <tr>
                                <td>
                                    <input type="text" name="editor_fn[]"  class="form-control" value="<?php echo $e_name->editor_fn ?>" required>
                                    <span class="text-danger"><?php echo form_error("editor_fn[]");?></span>
                                </td>
                                <td>
                                    <input type="text" name="editor_mi[]"  class="form-control" value="<?php echo $e_name->editor_mi ?>" required>
                                    <span class="text-danger"><?php echo form_error("editor_mi[]");?></span>
                                </td>
                                <td>
                                    <input type="text" name="editor_ln[]" class="form-control" value="<?php echo $e_name->editor_ln ?>" required>
                                    <span class="text-danger"><?php echo form_error("editor_ln[]");?></span>
                                </td>
                            </tr>
                                    <input type="hidden" name="editor_id[]" value="<?php echo $e_name->editor_id ?>">
                                    <input type="hidden" name="published_id[]" value="<?php echo $row->published_id ?>">
                            <?php } } ?>
                        </table>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label>Page Numbers*</label>
                            <input type="text" name="page_num" class="form-control" value="<?php echo $row->page_num?>" required>
                            <span class="text-danger"><?php echo form_error("page_num");?></span>
                        </div>
                        <div class="form-group col-md-10">
                            <label>Publisher*</label>
                            <input type="text" name="publisher" class="form-control" value="<?php echo $row->publisher?>" required>
                            <span class="text-danger"><?php echo form_error("publisher");?></span>
                        </div>  
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-12">
                            <label>Place of Publication*</label>
                            <input type="text" name="place" class="form-control" value="<?php echo $row->place_of_publication?>" required>
                            <span class="text-danger"><?php echo form_error("place");?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <p><b>Note: Before clicking the edit button, please reupload file.</b></p>
                    </div>
                    <div class="form-group">
                        <label>Current file: </label>
                        <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank"><?php echo $row->file; ?></a>
                    </div>
                    <div class="form-group">
                        <label>
                            SUBMIT / UPLOAD in one file: CCopy of front page of the book, copyright page, table of contents,
                            Copy of peer-review, Copy of full chapter published in the edited book*
                        </label>
                        <input type="file" name="file" class="form-control-file" required>
                    </div>
                    <div class="form-group">
                        <label>Abstract</label>
                        <textarea name="abstract" class="form-control" rows="5"><?php echo $row->abstract?></textarea>
                    </div>
                    <div class="form-group" style="text-align:center;">
                    <?php
                    foreach($research_data as $row){
                        if($user_type == 'Admin'){ ?>
                            <input type="submit" name="submit" value="Edit" class="btn btn-primary"></input>
                        <?php 
                        }else if($user_type == 'Researcher' && $row->status == 'Unreviewed' || $row->status == 'Rejected'){ ?>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
                        <?php
                        }else if($user_type == 'Researcher' && $row->status == 'Approved'){ ?>
                            <a href="<?php echo base_url('research/unsubmit/'.$row->publication_id);?>" class="btn btn-danger">Unsubmit</a>
                        <?php
                        }
                    }
                ?>
                    </div>
                    </form>
                </div>
                <!-- ./Book Chapter form -->
<?php       }else{ ?>
                <!-- Conference Proceedings form -->
                <div id="proceedings">
                <form method="post" action="<?php echo base_url()?>research/published_submit" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Author*</label>
                </div>
                <input type='text' style="display:none" name="research_type" value="Conference Proceedings"></input>
                <div class="form-row">
                <table class="table table-borderless">
                        <tr>
                            <th>First Name*</th>
                            <th>Middle Initial(s)*</th>
                            <th>Last Name*</th>
                        </tr>
                        <?php foreach($author_data as $name){ 
                            if($row->publication_id == $name->publication_id){ ?>
                        <tr>
                            <td>
                                <input type="text" name="first_name[]" value="<?php echo $name->first_name?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("first_name[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="middle_initial[]" value="<?php echo $name->middle_initial?>" class="form-control" required>
                                <span class="text-danger"><?php echo form_error("middle_initial[]");?></span>
                            </td>
                            <td>
                                <input type="text" name="last_name[]" value="<?php echo $name->last_name?> "class="form-control" required>
                                <span class="text-danger"><?php echo form_error("last_name[]");?></span>
                            </td>
                        </tr>
                                <input type="hidden" name="author_id[]" value="<?php echo $name->author_id?>">
                        <?php } } ?>
                    </table>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>Year Published*</label>
                        <input type="number" name="year" min="1800" max="2099" value="<?php echo $row->year_published?>" class="form-control" required>
                        <span class="text-danger"><?php echo form_error("year");?></span>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Title of Article*</label>
                        <input type="text" name="title_article" class="form-control" value="<?php echo $row->title_article?>" required>
                        <span class="text-danger"><?php echo form_error("title_article");?></span>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Full Title of Conference*</label>
                        <input type="text" name="title_conference" class="form-control" value="<?php echo $row->title_conference?>" required>
                        <span class="text-danger"><?php echo form_error("title_conference");?></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Place of Conference(City & Country)*</label>
                        <input type="text" name="place_con" class="form-control" value="<?php echo $row->place_of_conference?>" required>
                        <span class="text-danger"><?php echo form_error("place_con");?></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Place of Publication*</label>
                        <input type="text" name="place" class="form-control" value="<?php echo $row->place_of_publication?>" required>
                        <span class="text-danger"><?php echo form_error("place");?></span>
                    </div>  
                </div>
                <div class="form-group">
                    <label>Editor*</label>
                </div>
                <div class="form-row">
                    <table class="table table-borderless" id="table_conproc_ed">
                        <tr>
                            <th>First Name*</th>
                            <th>Middle Initial(s)*</th>
                            <th>Last Name*</th>
                        </tr>
                        <?php foreach($editor_data as $e_name){ 
                                if($row->published_id == $e_name->published_id){?>
                            <tr>
                                <td>
                                    <input type="text" name="editor_fn[]"  class="form-control" value="<?php echo $e_name->editor_fn ?>" required>
                                    <span class="text-danger"><?php echo form_error("editor_fn[]");?></span>
                                </td>
                                <td>
                                    <input type="text" name="editor_mi[]"  class="form-control" value="<?php echo $e_name->editor_mi ?>" required>
                                    <span class="text-danger"><?php echo form_error("editor_mi[]");?></span>
                                </td>
                                <td>
                                    <input type="text" name="editor_ln[]" class="form-control" value="<?php echo $e_name->editor_ln ?>" required>
                                    <span class="text-danger"><?php echo form_error("editor_ln[]");?></span>
                                </td>
                            </tr>
                                <input type="hidden" name="editor_id[]" value="<?php echo $e_name->editor_id ?>">
                                <input type="hidden" name="published_id[]" value="<?php echo $row->published_id ?>">
                            <?php } } ?>
                    </table>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>Page Number*</label>
                        <input type="text" name="page_num" class="form-control" value="<?php echo $row->page_num?>" required>
                        <span class="text-danger"><?php echo form_error("page_num");?></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Publisher*</label>
                        <input type="text" name="publisher" class="form-control" value="<?php echo $row->publisher?>" required>
                        <span class="text-danger"><?php echo form_error("publisher");?></span>
                    </div>
                    <?php if(isset($row->url)){ ?>
                    <div class="form-group col-md-6">
                        <label>URL(if published online, no need to submit file)</label>
                        <input type="text" name="url" class="form-control" value="<?php echo $row->url?>">
                        <span class="text-danger"><?php echo form_error("url");?></span>
                    </div>
                    <?php }else{ ?>
                        <div class="form-group col-md-5">
                        <label>URL(if published online, no need to submit file)</label>
                        <input type="text" name="url" class="form-control" value="<?php echo $row->url?>">
                        <span class="text-danger"><?php echo form_error("url");?></span>
                    </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <p><b>Note: Before clicking the edit button, please reupload file.</b></p>
                </div>
                <div class="form-group">
                    <label>Current file: </label>
                    <a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank"><?php echo $row->file; ?></a>
                </div>
                <div class="form-group">
                    <label>
                        SUBMIT / UPLOAD in one file: Copy of front page of conference proceedings, copyright page, table
        of contents, copy of peer-review, copy of published conference proceedings
                    </label>
                    <input type="file" name="file" class="form-control-file">
                </div>
                <div class="form-group">
                    <label>Abstract</label>
                    <textarea name="abstract" class="form-control" rows="5"><?php echo $row->abstract?></textarea>
                </div>
                <div class="form-group" style="text-align:center;">
                <?php
                    foreach($research_data as $row){
                        if($user_type == 'Admin'){ ?>
                            <input type="submit" name="submit" value="Edit" class="btn btn-primary"></input>
                        <?php 
                        }else if($user_type == 'Researcher' && $row->status == 'Unreviewed' || $row->status == 'Rejected'){ ?>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
                        <?php
                        }else if($user_type == 'Researcher' && $row->status == 'Approved'){ ?>
                            <a href="<?php echo base_url('research/unsubmit/'.$row->publication_id);?>" class="btn btn-danger">Unsubmit</a>
                        <?php
                        }
                    }
                ?>
                </div>
                </form>
            </div>
            <!-- ./Conference Proceedings form -->
<?php       } 
        } 
    }else{
        foreach($research_data as $row){ 
?>
            <!-- Creative form -->
            <div id="creative">
                <form method="post" action="<?php echo base_url()?>research/creative_submit" enctype="multipart/form-data">
                <!--<a style="display:none" name="research_type" value='9'></a>-->
                <?php foreach($author_data as $name){ 
                    if($row->publication_id == $name->publication_id){ ?>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>First Name*</label>
                        <input type="text" name="first_name[]" value="<?php echo $name->first_name?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label>M.I.(S)*</label>
                        <input type="text" name="middle_initial[]" value="<?php echo $name->middle_initial?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Lastname*</label>
                        <input type="text" name="last_name[]" value="<?php echo $name->last_name?>" class="form-control" required>
                    </div>
                </div>
                <input type="hidden" name="author_id[]" value="<?php echo $name->author_id?>">
                <?php } } ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label>Type of Research/Creative Work*</label>
                    <select class="form-control" name="type" required>
                        <option>Select</option>
                        <option value="Art Work">Art Work</option>
                        <option value="Film">Film</option>
                        <option value="Photography">Photography</option>
                        <option value="Software Application">Software Applicaiton</option>
                        <option value="Graphic Design">Graphic Design</option>
                        <option value="Theatre">Theatre</option>
                        <option value="Dance">Dance</option>
                        <option value="Performance">Performance</option>
                        <option value="Mural">Mural</option>
                        <option value="Specify">Specify</option>
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Month and/or Year performed / exhibited / published*</label>
                        <input type="date" name="month_year" value="<?php echo $row->month_year?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Title of Work*</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $row->title_work ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Role*</label>
                        <input type="text" name="role" placeholder="(e.g. Director, Actor, Translator)" value="<?php echo $row->role?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Place of performance / publication / exhibition*</label>
                        <input type="text" name="place" value="<?php echo $row->place_performance?>" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">  
                        <label>Producer / Organizer / Publisher</label>
                        <input type="text" name="publisher" value="<?php echo $row->publisher?>" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Number of artworks exhibited (if applicable)</label>
                        <input type="number" name="exhibited" value="<?php echo $row->artwork_exhibited?>" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Duration of performance / exhibition</label>
                        <input type="text" name="duration" placeholder="(e.g. One-Act play, Full-length film)" value="<?php echo $row->duration_performance?>" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Scope of audience*</label>
                        <select name="scope" class="form-control" required>
                        <?php if($row->scope_audience == 'Institutional'){ ?>
                            <option>Select</option>
                            <option value="Institutional" selected>Institutional</option>
                            <option value="Regional">Regional</option>
                            <option value="National">National</option>
                            <option value="International">International</option>
                        <?php }elseif($row->scope_audience == 'Regional'){ ?>
                            <option>Select</option>
                            <option value="Institutional">Institutional</option>
                            <option value="Regional" selected>Regional</option>
                            <option value="National">National</option>
                            <option value="International">International</option>
                        <?php }elseif($row->scope_audience == 'National'){ ?>
                            <option>Select</option>
                            <option value="Institutional">Institutional</option>
                            <option value="Regional">Regional</option>
                            <option value="National" selected>National</option>
                            <option value="International">International</option>
                        <?php }elseif($row->scope_audience == 'International'){ ?>
                            <option>Select</option>
                            <option value="Institutional">Institutional</option>
                            <option value="Regional">Regional</option>
                            <option value="National">National</option>
                            <option value="International" selected>International</option>
                        <?php }else{ ?>    
                            <option>Select</option>
                            <option value="Institutional">Institutional</option>
                            <option value="Regional">Regional</option>
                            <option value="National">National</option>
                            <option value="International">International</option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Commissioning agency (if applicable)</label>
                        <?php if(isset($row->commission_agency)){ ?>
                            <input type="text" name="comm" class="form-control" value="<?php echo $row->commission_agency?>">
                        <?php }else{?>
                            <input type="text" name="comm" class="form-control">
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Award received (if applicable)</label>
                        <?php if(isset($row->award_received)){ ?>
                            <input type="text" name="award" class="form-control" value="<?php echo $row->award_received?>">
                        <?php }else{?>
                            <input type="text" name="award" class="form-control">
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                    SUBMIT / UPLOAD in one file: Documentation (e.g., photos / videos / CD) of the creative work or its
        exhibition / performance*
                    </label>
                    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <div class="form-group" style="text-align:center;">
                <?php
                    foreach($research_data as $row){
                        if($user_type == 'Admin'){ ?>
                            <input type="submit" name="submit" value="Edit" class="btn btn-primary"></input>
                        <?php 
                        }else if($user_type == 'Researcher' && $row->status == 'Unreviewed' || $row->status == 'Rejected'){ ?>
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary"></input>
                        <?php
                        }else if($user_type == 'Researcher' && $row->status == 'Approved'){ ?>
                            <a href="<?php echo base_url('research/unsubmit/'.$row->publication_id);?>" class="btn btn-danger">Unsubmit</a>
                        <?php
                        }
                    }
                ?>
                </div>
                </form>
            </div>
            <!-- ./Creative form -->    
<?php   
        }
    }
?>
</div>
</div>

<script type="text/javascript">
    /*
    $(document).ready(function(){
        //html
        var thesis ='<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger"type="button" id="remove_thesis" name="remove" value="Remove"></td></tr>';
        var technical ='<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger"type="button" id="remove_technical" name="remove" value="Remove"></td></tr>';
        var conference ='<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger"type="button" id="remove_conference" name="remove" value="Remove"></td></tr>';
        var poster ='<tr><td><input type="text" name="first_name[]" class="form-control" required></td><td><input type="text" name="middle_initial[]" class="form-control" required></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger"type="button" id="remove_poster" name="remove" value="Remove"></td></tr>';
        var journal = '<tr><td><input type="text" name="first_name[]" class="form-control" required><br /><label>Is Author an employee of ADNU?</label></td><td><input type="text" name="middle_initial[]" class="form-control" required><br /><div class="custom-control custom-radio custom-control-inline"><input type="radio" name="customRadioInline1" class="custom-control-input"><label class="custom-control-label">Yes</label></div><div class="custom-control custom-radio custom-control-inline"><input type="radio" name="customRadioInline2" class="custom-control-input"><label class="custom-control-label">No</label></div></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger" type="button" id="remove_journal" name="Remove" value="Remove"></td></tr>';
        var booktext = '<tr><td><input type="text" name="first_name[]" class="form-control" required><br /><label>Is Author an employee of ADNU?</label></td><td><input type="text" name="middle_initial[]" class="form-control" required><br /><div class="custom-control custom-radio custom-control-inline"><input type="radio" name="customRadioInline1" class="custom-control-input"><label class="custom-control-label">Yes</label></div><div class="custom-control custom-radio custom-control-inline"><input type="radio" name="customRadioInline2" class="custom-control-input"><label class="custom-control-label">No</label></div></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger" type="button" id="remove_booktext" name="Remove" value="Remove"></td></tr>';
        var bookchap = '<tr><td><input type="text" name="first_name[]" class="form-control" required><br /><label>Is Author an employee of ADNU?</label></td><td><input type="text" name="middle_initial[]" class="form-control" required><br /><div class="custom-control custom-radio custom-control-inline"><input type="radio" name="customRadioInline1" class="custom-control-input"><label class="custom-control-label">Yes</label></div><div class="custom-control custom-radio custom-control-inline"><input type="radio" name="customRadioInline2" class="custom-control-input"><label class="custom-control-label">No</label></div></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger" type="button" id="remove_bookchap" name="Remove" value="Remove"></td></tr>';
        var conference_proceedings = '<tr><td><input type="text" name="first_name[]" class="form-control" required><br /><label>Is Author an employee of ADNU?</label></td><td><input type="text" name="middle_initial[]" class="form-control" required><br /><div class="custom-control custom-radio custom-control-inline"><input type="radio" name="customRadioInline1" class="custom-control-input"><label class="custom-control-label">Yes</label></div><div class="custom-control custom-radio custom-control-inline"><input type="radio" name="customRadioInline2" class="custom-control-input"><label class="custom-control-label">No</label></div></td><td><input type="text" name="last_name[]" class="form-control" required></td><td><input class="btn btn-danger" type="button" id="remove_conproc" name="Remove" value="Remove"></td></tr>';
     
        var min = 1;
        var max = 9;

        //add buttons
        $("#add_thesis").click(function(){
            if(min <= max){
                $("#table_thesis").append(thesis);
                min++;
            }
        });
        $("#add_technical").click(function(){
            if(min <= max){
                $("#table_technical").append(technical);
                min++;
            }
        });
        $("#add_conference").click(function(){
            if(min <= max){
                $("#table_conference").append(conference);
                min++;
            }
        });
        $("#add_poster").click(function(){
            if(min <= max){
                $("#table_poster").append(poster);
                min++;
            }
        });
        $("#add_journal").click(function(){
            if(min <= max){
                $("#table_journal").append(journal);
                min++;
            }
        });
        $("#add_book").click(function(){
            if(min <= max){
                $("#table_book").append(booktext);
                min++;
            }
        });
        $("#add_bookchap").click(function(){
            if(min <= max){
                $("#table_bookchap").append(bookchap);
                min++;
            }
        });
        $("#add_conproc").click(function(){
            if(min <= max){
                $("#table_conproc").append(conference_proceedings);
                min++;
            }
        });

        //remove buttons
        $("#table_thesis").on('click','#remove_thesis',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_technical").on('click','#remove_technical',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_conference").on('click','#remove_conference',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_poster").on('click','#remove_poster',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_journal").on('click','#remove_journal',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_book").on('click','#remove_booktext',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_bookchap").on('click','#remove_bookchap',function(){
            $(this).closest('tr').remove();
            min--;
        });
        $("#table_conproc").on('click','#remove_conproc',function(){
            $(this).closest('tr').remove();
            min--;
        });
    });
    */
</script>
