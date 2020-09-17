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
<br />
<div class="container">
<div class="card shadow mb-4">
  <div class="card-header bg-info py-3">
    <h6 class="m-0 font-weight-bold text-white">Advance Search</h6>
  </div>
  <div class="card-body">
        <form class="form-inline" action="<?php echo base_url('main/filter_search');?>" method="post">
            <div class="form-group">
                <label for="year" style="width:80px">Year: </label>
                <input type="number" id="year" value="2000" class="form-control"> 
            </div>
            <div class="form-group">
                <label for="dep" style="width:150px">Department: </label>
                <input type="" id="dep" class="form-control"> 
            </div>
        </form>
    </div>
    </div>
</div>
</div>
</br>

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
