<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Publication</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>AUTHOR</th>
                <th>YEAR</th>
                <th>TITLE</th>
                <th>INSTITUE</th>
                <th>URL</th>
                <th>LOCATION</th>
              </tr>
            </thead>
            <tbody>
              <?php if($fetch_comp_data_all->num_rows() > 0){
                foreach($fetch_comp_data_all->result() as $row){ ?>
              <tr>
                  <td><?php echo $row->cr_last; ?>, <?php echo substr($row->cr_first, 0, 1); ?>.
                  <?php echo $row->cr_middle; ?></td>
                  <td><?php echo $row->cr_year; ?></td>
                  <td><?php echo $row->cr_title; ?></td>
                  <td><?php echo $row->cr_institute; ?></td>
                  <td><?php echo $row->cr_url; ?></td>
                  <td><?php echo $row->cr_location; ?></td>
              </tr>
              <?php } }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<!-- /.container-fluid -->
</body>

</html>
