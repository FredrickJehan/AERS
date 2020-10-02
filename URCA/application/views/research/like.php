
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Liked Research</h1>
    </div>


    <?php foreach($liked_completed->result() as $row ){ ?>
  <!-- Testimonials -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row->title?></h5>
              <p class="card-text">
                  <?php foreach($author_data as $name){ 
                    if($row->publication_id == $name->publication_id){ 
                      echo $name->first_name;?>&nbsp<?php
                      echo $name->middle_initial;?>&nbsp<?php 
                      echo $name->last_name;
                  } }?>
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('research/view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
     
     <?php } ?>

     <?php foreach($liked_presented->result() as $row ){ ?>
  <!-- Testimonials -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row->title_presented?></h5>
              <p class="card-text">
              <?php foreach($author_data as $name){ 
                    if($row->publication_id == $name->publication_id){ 
                      echo $name->first_name;?>&nbsp<?php
                      echo $name->middle_initial;?>&nbsp<?php 
                      echo $name->last_name;
                  } }?>
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('research/view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
     
     <?php } ?>

     <?php foreach($liked_published->result() as $row ){ ?>
  <!-- Testimonials -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row->title_article?></h5>
              <p class="card-text">
              <?php foreach($author_data as $name){ 
                    if($row->publication_id == $name->publication_id){ 
                      echo $name->first_name;?>&nbsp<?php
                      echo $name->middle_initial;?>&nbsp<?php 
                      echo $name->last_name;
                  } }?>
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('research/view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
     
     <?php } ?>

     <?php foreach($liked_creative->result() as $row ){ ?>
  <!-- Testimonials -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row->title_work?></h5>
              <p class="card-text">
              <?php foreach($author_data as $name){ 
                    if($row->publication_id == $name->publication_id){ 
                      echo $name->first_name;?>&nbsp<?php
                      echo $name->middle_initial;?>&nbsp<?php 
                      echo $name->last_name;
                  } }?>
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('research/view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
     
     <?php } ?>
</div>
<!-- /.container-fluid -->