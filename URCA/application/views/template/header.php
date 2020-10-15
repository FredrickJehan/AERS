<!DOCTYPE html>
<html lang="en">
<?php
  if (isset($this->session->userdata['logged_in'])) {
    $id = ($this->session->userdata['logged_in']['user_id']);
    $username = ($this->session->userdata['logged_in']['username']);
    $user_type = ($this->session->userdata['logged_in']['user_type']);
  }else {
    redirect('login');
  }
?>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AERS</title>

  <link href="<?php echo base_url('URCstyles/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url('URCstyles/css/sb-admin-2.min.css');?>" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo base_url('URCstyles/vendor/datatables/dataTables.bootstrap4.min.css');?>" rel="stylesheet">


<!-- Bootstrap core JavaScript-->
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="<?php echo base_url('URCstyles/vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('URCstyles/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('URCstyles/vendor/jquery-easing/jquery.easing.min.js');?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url('URCstyles/vendor/datatables/jquery.dataTables.min.js');?>"></script>
  <script src="<?php echo base_url('URCstyles/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url('URCstyles/js/demo/datatables-demo.js');?>"></script>
</head>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: rgb(40,56,145)" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      </br>
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('dashboard');?>">
        <img src="<?php echo base_url('guestdesign2/ateneo_logo.png');?>" alt="ADNU Logo" width="100" height="100">
      </a>
        <!-- <div class="sidebar-brand-text mx-3">AERS</div> -->

      <!-- Divider -->
      <!-- <hr class="sidebar-divider my-0"> -->
      </br>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>">
          <i class="fas fa-home"></i>
          <span>Go to Homepage</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <?php if($user_type == 'Researcher'){?>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('dashboard');?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Dashboard</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('research');?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>My Research</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('liked_research');?>">
          <i class="fas fa-fw fa-table"></i>
          <span>My Likes</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('archive');?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Archive</span></a>
      </li>
      
      <?php }?>
      <!-- Heading -->
    <?php 
      if($user_type == 'Admin'){?>
      <div class="sidebar-heading">
        Admin
      </div>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('dashboard');?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Dashboard</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('research');?>">
          <i class="fas fa-fw fa-table"></i>
          <span>My Research</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('export');?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Reports & Archive</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('registration');?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Registration</span></a>
      </li>

      <div class="sidebar-heading">
        Manage Research
      </div>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('manage/unreviewed');?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Unreviewed</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('manage/approved');?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Approved</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('manage/rejected');?>">
          <i class="fas fa-fw fa-table"></i>
          <span>Rejected</span></a>
      </li>

    <?php }
    ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->

          <form action="<?php echo base_url('research/search');?>" method="post" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" name="keyword" class="form-control bg-light border-0 small" placeholder="Search for title" aria-label="Search" aria-describedby="basic-addon2"></input>
              <button type="submit" class="btn btn-primary"><i class="fas fa-search fa-sm"></i></button>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
          
            <li class="nav-item dropdown no-arrow mx-1">
              <a id="dropdown" class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                 <span id="count" class="badge badge-danger badge-counter"></span>
              </a>
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Notifcations</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div id="notif"></div>
                </a>
              </div>
            </li>
            
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username ?></span>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <!-- <a class="dropdown-item" href="logout"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a> -->
                <a class="dropdown-item" id="logout" href="<?php echo base_url('logout');?>" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
