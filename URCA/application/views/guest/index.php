<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Landing Page - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

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
        <!-- Recent Publicaitons-->
        <?php foreach($recent_com as $row){ ?>
      <div class="row">
          <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row->title?></h5>
              <p class="card-text"><?php echo $row->last_name?>, <?php echo $row->first_name?></p>
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
              <p class="card-text"><?php echo $row->last_name?>, <?php echo $row->first_name?></p>
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
              <p class="card-text"><?php echo $row->last_name?>, <?php echo $row->first_name?></p>
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
              <p class="card-text"><?php echo $row->last_name?>, <?php echo $row->first_name?></p>
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
