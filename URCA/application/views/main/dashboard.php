
<?php
  if (isset($this->session->userdata['logged_in'])) {
    $user_type = ($this->session->userdata['logged_in']['user_type']);
  }else {
    redirect('login');
  }
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="<?php echo base_url('research/add');?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add Research</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      <?php if($user_type == 'Researcher'){?>
                        Completed Research
                      <?php }?>
                      <?php if($user_type == 'Admin'){?>
                        Total Publications
                      <?php }?>
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php if($user_type == 'Researcher'){?>
                        <?php echo $completed_count ?>
                      <?php }?>
                      <?php if($user_type == 'Admin'){?>
                        <?php echo $total_pub?>
                      <?php }?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                      <?php if($user_type == 'Researcher'){?>
                        Presented Research
                      <?php }?>
                      <?php if($user_type == 'Admin'){?>
                        Unreviewed Research
                      <?php }?>
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php if($user_type == 'Researcher'){?>
                        <?php echo $presented_count ?>
                      <?php }?>
                      <?php if($user_type == 'Admin'){?>
                        <?php echo $unreviewed_count ?>
                      <?php }?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                      <?php if($user_type == 'Researcher'){?>
                        Published Research
                      <?php }?>
                      <?php if($user_type == 'Admin'){?>
                        Approved Research
                      <?php }?> 
                      </div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                          <?php if($user_type == 'Researcher'){?>
                            <?php echo $published_count ?>
                          <?php }?>
                          <?php if($user_type == 'Admin'){?>
                            <?php echo $approved_count ?>
                          <?php }?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                      <?php if($user_type == 'Researcher'){?>
                        Creative Works
                      <?php }?>
                      <?php if($user_type == 'Admin'){?>
                        Rejected Research
                      <?php }?>
                      </div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                      <?php if($user_type == 'Researcher'){?>
                        <?php echo $creative_count ?>
                      <?php }?>
                      <?php if($user_type == 'Admin'){?>
                        <?php echo $rejected_count ?>
                      <?php }?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

    <br />
    <?php if($most_likes_completed->result() > 0){ ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
      <h5 class="mb-0 text-gray-800">Most Liked Completed Research</h5>
    </div>

    <?php foreach($most_likes_completed->result() as $row){ ?>
  <!-- Testimonials -->
    
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
              <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                <?php echo $row->title?>
              </a>
              </h5>
              <p class="card-text">
            
              </p>
            </div>
          </div>
        </div>
      </div>
     
     <?php } } ?>
      <hr/>
     <?php if($most_likes_presented->result() > 0){ ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
      <h5 class="mb-0 text-gray-800">Most Liked Presented Research</h5>
    </div>

     <?php foreach($most_likes_presented->result() as $row ){ ?>
  <!-- Testimonials -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
              <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                <?php echo $row->title_presented?>
              </a>
              </h5>
              <p class="card-text">
              </p>
            </div>
          </div>
        </div>
      </div>
     
     <?php } } ?>

     <hr/>
     <?php if($most_likes_published->result() > 0){ ?>
     <div class="d-sm-flex align-items-center justify-content-between mb-2">
      <h5 class="mb-0 text-gray-800">Most Liked Published Research</h5>
    </div>

     <?php foreach($most_likes_published->result() as $row ){ ?>
  <!-- Testimonials -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
              <?php if($row->published_type == 'Journal Article'){ ?>
              <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                <?php echo $row->title_article?>
              </a>
              <?php }elseif($row->published_type == 'Book / Textbook'){ ?>
              <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                <?php echo $row->title_book?>
              </a>
              <?php }elseif($row->published_type == 'Book Chapter'){ ?>
              <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                <?php echo $row->title_chapter?>
              </a>  
              <?php }else{ ?>
                <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                <?php echo $row->title_article?>
              </a>
              <?php } ?>
              </h5>
              <p class="card-text">
            
              </p>
            </div>
          </div>
        </div>
      </div>
     
     <?php } } ?>
     <hr/>

     <?php if($most_likes_creative->result() > 0){ ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
      <h5 class="mb-0 text-gray-800">Most Liked Creative Work</h5>
    </div>

     <?php foreach($most_likes_creative->result() as $row ){ ?>
  <!-- Testimonials -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
              <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                <?php echo $row->title_work?>
              </a>
              </h5>
              <p class="card-text">
            
              </p>
            </div>
          </div>
        </div>
      </div>
     
     <?php } } ?>
     <br />
          <!-- Content Row -->
        <!-- /.container-fluid -->
