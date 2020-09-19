<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Landing Page - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('guestdesign2/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="<?php echo base_url('guestdesign2/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('guestdesign2/vendor/simple-line-icons/css/simple-line-icons.css');?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url('guestdesign2/css/landing-page.min.css');?>" rel="stylesheet">

</head>

<body>

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-10  col-lg-8 col-xl-7 mx-auto">
         <form action="<?php echo base_url('main/search');?>" method="post">
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0" style="text-align: right">
                <input type="input" name="keyword" id="keyword" class="form-control form-control-lg" placeholder="Search for title...">
              </div>
              <div class="col-12 col-md-3">
                <button type="submit" class="btn btn-block btn-lg btn-primary">Search</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </header>

  <!-- Testimonials -->
  <section class="text-left bg-light">
    <div class="container">
      <h2 class="mb-4 mt-3">Recent Publications</h2>
      <form action="<?php echo base_url('main/search_filter'); ?>" method="post">
      <div class="row mb-3">
            <div class="col"></div>
            <label>Sort by:</label>
            <div class="col-3">
              <select class="form-control form-control-sm" name="department">
                <option value="">Department</option>
                <!--
                <php foreach($dept as $row){ ?>
                  <option value="<php echo $row->department ?>"><php echo $row->department ?></option>
                <php } ?>
                -->
                <option value="Department of Media Studies">Department of Media Studies</option>
                <option value="Department of Social Studies">Department of Social Studies</option>
                <option value="Department of Literature and Language Studies">Department of Literature and Language Studies</option>
                <option value="Department of Philosophy">Department of Philosophy</option>
                <option value="Department of Psychology">Department of Psychology</option>
                <option value="Department of Computer Science">Department of Computer Science</option>
                <option value="Department of Digital Arts and Computer Animation">Department of Digital Arts and Computer Animation</option>
              </select>
            </div>
            <div class="col-2">
              <select id="sort_year"class="form-control form-control-sm" name="year">
                <option value="">Year</option>
              </select>
            </div>
            <div class="col-3">
              <select class="form-control form-control-sm" name="type_research">
                <option value="">Type of Research</option>
                <!--
                <php foreach($type as $row){ ?>
                  <option value="<php echo $row->publication_type ?>"><php echo $row->publication_type ?></option>
                <php } ?>
                -->
                <option value="Completed Research">Completed Research</option>
                <option value="Presented Research">Presented Research</option>
                <option value="Published Research">Published Research</option>
                <option value="Creative Works">Creative Works</option>
              </select>
            </div>
            <button type="submit" class="btn btn-info btn-sm">Filter</button>
            <div class="col"></div>
      </div>
      </form>
        <?php foreach($recent_com as $row){ ?>
      <div class="row">
          <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row->title?></h5>
              <p class="card-text">
              <?php
              $string = array();
              $i = 0;
              foreach($authors as $name){
                if($row->publication_id == $name->publication_id){
                  if(isset($name->middle_initial)){
                    $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                  }else{
                    $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                  }
                  $i++;
                }
              }
            ?>
            <?php if(!empty($row->url)){ ?>
              <?php echo implode(', ', $string) ?> (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
              <?php echo $row->location?>: <?php echo $row->institution?>. Retrieved from <?php echo $row->url?>
            <?php }else{ ?>
              <?php echo implode(', ', $string) ?>
              (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
              <?php echo $row->location?>: <?php echo $row->institution?>.
            <?php } ?>
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
      <?php }?>

      <?php foreach($recent_pre as $row){ ?>
      <div class="row">
          <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row->title_presented?></h5>
              <p class="card-text">
              <?php
              $string = array();
              $i = 0;
              foreach($authors as $name){
                if($row->publication_id == $name->publication_id){
                  if(isset($name->middle_initial)){
                    $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                  }else{
                    $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                  }
                  $i++;
                }
              } 
            ?>
            <?php echo implode(', ', $string) ?> (<?php echo $row->date_presentation;?>). <i><?php echo $row->title_presented;?></i>. Paper presented at the
            <?php echo $row->title_conference;?>, <?php echo $row->place_conference;?>.
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
      <?php }?>

      <?php foreach($recent_pub as $row){ ?>
      <div class="row">
          <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <?php if($row->published_type == 'Journal Article'){ ?>
                <h5 class="card-title"><?php echo $row->title_article ?></h5>
              <?php }elseif($row->published_type == 'Book / Textbook'){ ?>
                <h5 class="card-title"><?php echo $row->title_book ?></h5>
              <?php }elseif($row->published_type == 'Book Chapter'){ ?>
                <h5 class="card-title"><?php echo $row->title_chapter ?></h5>
              <?php }else{ ?>
                <h5 class="card-title"><?php echo $row->title_conference ?></h5>
              <?php } ?>
              <p class="card-text">
              <?php
                $string = array();
                $i = 0;
                foreach($authors as $name){
                  if($row->publication_id == $name->publication_id){
                    if(isset($name->middle_initial)){
                      $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                    }else{
                      $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                    }
                    $i++;
                  }
                }
                $string_ed = array();
                $x = 0;
                foreach($editors as $ed){
                  if($row->published_id == $ed->published_id){
                    if(isset($ed->editor_mi)){
                      $string_ed[$x] = substr($ed->editor_fn, 0, 1) . ". " . $ed->editor_mi . " " . $ed->editor_ln; 
                    }else{
                      $string_ed[$x] = substr($ed->editor_fn, 0, 1) . ". " . $ed->editor_ln; 
                    }
                    $x++;
                  }
                }  
              ?>
              <?php if($row->published_type == 'Journal Article'){ ?>
                <?php echo implode(', ', $string) ?>
                (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. <i><?php echo $row->title_journal; ?></i>.
                <?php echo $row->vol_num; if(isset($row->issue_num)){ ?>(<?php echo $row->issue_num; ?>),<?php }else{ ?>, <?php } ?>
                <?php echo $row->page_num; ?>.

              <?php }elseif($row->published_type == 'Book / Textbook'){ ?>
                <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <i><?php echo $row->title_book; ?></i>. 
                <?php echo $row->place_of_publication; ?>: <?php echo $row->publisher; ?>.

              <?php }elseif($row->published_type == 'Book Chapter'){ ?>
                <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <?php echo $row->title_chapter; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),
                <i><?php echo $row->title_book; ?></i> (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: 
                <?php echo $row->publisher; ?>.

              <?php }else{ ?>
                <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),<?php echo $row->place_of_conference; ?> 
                (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: <?php echo $row->publisher; ?> 
                <?php if(isset($row->url)){ ?>
                  .Retrieved from<?php echo $row->url; ?>
                <?php }else{ ?>.<?php } ?>

              <?php } ?>
              
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
      <?php }?>

      <?php foreach($recent_cre as $row){ ?>
      <div class="row">
          <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row->title_work?></h5>
              <p class="card-text">
              <?php if(isset($row->middle_initial)){ ?>
              <?php echo $row->title_work?> By <?php echo $row->first_name?> <?php echo $row->middle_initial?> <?php echo $row->last_name?>.
              <?php }else{ ?>
                <?php echo $row->title_work?> By <?php echo $row->first_name?> <?php echo $row->last_name?>.
              <?php } ?>
              </p>
              <a class="btn btn-primary" href="<?php echo base_url('view/'.$row->publication_id);?>">View</a>
            </div>
          </div>
        </div>
      </div>
      <br />
      <?php }?>
        <!-- ./End of Recent Publcations-->
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <ul class="list-inline mb-2">
            <li class="list-inline-item">
              <a href="#">About</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Contact</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
          </ul>
          <p class="text-muted small mb-4 mb-lg-0">&copy; AERS 2020. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url('guestdesign2/vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('guestdesign2/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

</body>

</html>
