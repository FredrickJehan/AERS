<?php
  if(isset($this->session->userdata['logged_in'])) {
  }else {
    redirect(base_url());
  }
?>
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Manage Rejected Submissions</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Name</th>
                <th>Research Type</th>
                <th>Review</th>
              </tr>
        </thead>
        <tbody>
            <?php foreach($publication_rejected as $row){ ?>
          <tr>
            <td>
              <?php echo $row->last_name?>,<?php echo substr($row->first_name, 0, 1)?>
              <?php echo $row->middle_initial?>
            </td>
            <td><?php echo $row->publication_type?>
            </td>
            <td><a class="btn btn-primary" href="<?php echo base_url('research/edit/'.$row->publication_id);?>">View</a></td>
          </tr>
          <?php }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>
