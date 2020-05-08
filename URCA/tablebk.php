<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thesis Submission Table</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
        <?php
        if($fetch_data->num_rows() > 0){
            foreach($fetch_data->result() as $row){
        ?>
            <tr>
                <td><?php echo $row->thesis_id; ?></td>
                <td><?php echo $row->thesis_author; ?></td>
                <td><?php echo $row->thesis_year; ?></td>
                <td><?php echo $row->thesis_title; ?></td>
                <td><?php echo $row->thesis_institute; ?></td>
                <td><?php echo $row->thesis_url; ?></td>
                <!-- link deletes whole row -->
                <td><a href="###" class="delete_data" id="<?php echo $row->thesis_id; ?>">Delete</a></td>
                <!--<td><a href="<php echo base_url(); ?>insert/update_data/<php echo $row->id; ?>"></a></td>
            -->
            </tr>
        <?php
            }
        }
        else{
        ?>
            <tr>
                <td>No Data Found</td>
            </tr>

        <?php
        }
        ?>
        </table>
    </div>
</div>

  <!-- Page Wrapper -->
  <div id="wrapper">

       <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

       
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Research</h1>
            <a href="<?php echo base_url('submit');?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add Research</a>
          </div>

          <!-- DataTales Example -->
          <!-- Completed Research -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Completed Research</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <?php
              if($fetch_data->num_rows() > 0){
               foreach($fetch_data->result() as $row){
              ?>
              <td>
              <a href="<?php echo base_url('edit');?>"><?php echo $row->thesis_author; ?>(<?php echo $row->thesis_year; ?>). <?php echo $row->thesis_title; ?>. 
              <?php echo $row->thesis_institute; ?>. Retrieved from <?php echo $row->thesis_url; ?></a>
              </td>
              <br />
              <br />
              <?php
                }
              }
              else{
             ?>
              <div>
                  <p>No Data Found</p>
              </div>
            <?php
            }
            ?>
              </div>
            </div>
          </div>
          <!-- end of Completed Research -->
          
          <!-- Presented Research -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Completed Research</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <?php
              if($fetch_data->num_rows() > 0){
               foreach($fetch_data->result() as $row){
              ?>
              <td>
              <a href="<?php echo base_url('edit');?>"><?php echo $row->thesis_author; ?>(<?php echo $row->thesis_year; ?>). <?php echo $row->thesis_title; ?>. 
              <?php echo $row->thesis_institute; ?>. Retrieved from <?php echo $row->thesis_url; ?></a>
              </td>
              <br />
              <br />
              <?php
                }
              }
              else{
             ?>
              <div>
                  <p>No Data Found</p>
              </div>
            <?php
            }
            ?>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
  

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>URCstyles/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>URCstyles/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>URCstyles/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>URCstyles/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url(); ?>URCstyles/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>URCstyles/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url(); ?>URCstyles/js/demo/datatables-demo.js"></script>

</body>

</html>

    <script>
        $(document).ready(function(){
            $('.delete_data').click(function(){
                var id = $(this).attr("id");
                if(confirm("Are you sure you want to delete this?"))
                {
                    window.location="<?php echo base_url(); ?>insert/delete_data/"+id;
                }
                else{
                    return false;
                }
            });
        });
    </script>


