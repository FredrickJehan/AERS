<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Landing Page - Start Bootstrap Theme</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="<?php echo base_url('gueststyle/v2/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('gueststyle/v2/vendor/simple-line-icons/css/simple-line-icons.css');?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url('gueststyle/v2/css/landing-page.min.css');?>" rel="stylesheet">

</head>

<body>

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h1 class="mb-5">Search Research</h1>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <form>
            <div class="form-row">
              <div class="col-12 col-md-12 mb-2 mb-md-0">
                <input type="input" class="form-control form-control-lg" name="keyword" id="keyword" placeholder="Enter Research Title">
              </div>
            </div>
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0">
              </div>
              <div class="col-12 col-md-3 mb-2 mb-md-0">
                <a href="<?php echo base_url('research/dummy_table');?>" style="text-decoration: none;">Advance Search</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
        <div id="result"></div>
      </div>
      <div class="col-md-1">
      </div>
      <div id="result"></div>
    </div>
  </div>
   
   
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('URCstyles/vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('URCstyles/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('URCstyles/vendor/jquery-easing/jquery.easing.min.js');?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('URCstyles/js/sb-admin-2.min.js');?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url('URCstyles/vendor/datatables/jquery.dataTables.min.js');?>"></script>
  <script src="<?php echo base_url('URCstyles/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url('URCstyles/js/demo/datatables-demo.js');?>"></script>

</body>

</html>


  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url('gueststyle/v2/vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('gueststyle/v2/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

</body>

</html>

<script>
    $(document).ready(function(){
        load_data();

    function load_data(query){
        $.ajax({
            url: "<?php echo base_url(); ?>research/search",
            method: "POST",
            data: {query:query},
            success:function(data){
                $('#result').html(data);
            }
        })
    }

    $('#keyword').keyup(function(){
        var search = $(this).val();
        if(search != ''){
            load_data(search);
        }else{
            load_data();
        }
    });
    });
</script>
