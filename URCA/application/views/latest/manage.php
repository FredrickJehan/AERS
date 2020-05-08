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
  <h1 class="h3 mb-2 text-gray-800">Manage Research</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">FACULTY & STAFF MEMBERS WITH REPORTED RESEARCH WORK</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Department</th>
                <!--<th>Type of Publication</th>
                <th>Citation</th>-->
              </tr>
        </thead>
        <tbody>
          <?php if($CRunapprovedList_data->num_rows() > 0){
            foreach($CRunapprovedList_data->result() as $row){ ?>
          <tr>
            <td><?php echo $row->cr_last; ?>, <?php echo substr($row->cr_first, 0, 1); ?>.
            <?php echo $row->cr_middle; ?></td>
            <!--<td></td>
            <td></td>-->
            <td>
              <a href="<?php echo base_url('view/'.$row->cr_id);?>">
              <?php echo $row->cr_last; ?>, <?php echo substr($row->cr_first, 0, 1); ?>.
              <?php echo $row->cr_middle; ?> (<?php echo $row->cr_year; ?>). <?php echo $row->cr_title; ?>. 
              <?php echo $row->cr_location; ?>. <?php echo $row->cr_institute; ?>. Retrieved from 
              <?php echo $row->cr_url; ?></a>
            </td>
              <?php } }?>
          </tr>
          </tbody>
        </table>
        <form method="post" action="<?php echo base_url(); ?>insert/action">
                <input type="submit" name="export" class="btn btn-success" value="Export" />
              </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
</body>

</html>
