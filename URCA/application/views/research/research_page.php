
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">My Research</h1>
  <a href="<?php echo base_url('research_form');?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Add Research</a>
</div>
<!-- Completed Research -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Completed Research</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <?php
      foreach($completed_research as $row){ ?>
    <td><a href="<?php echo base_url('research/view/?id='.$row->completed_id);?>">
    <?php echo $row->last_name?>, <?php echo substr($row->first_name, 0, 1);?>. <?php echo $row->middle_initial?>
    (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
    <?php echo $row->location?>: <?php echo $row->institution?>. Retrieved from <?php echo $row->url?>
    </a></td>
    <td>Visit Count: 
        <?php 
          if(!empty($row)){
            echo $row->page_view;
          }
        ?>
    </td>

    </br>
    <?php
      }?>
    </div>
  </div>
</div>
<!-- end of Completed Research -->
<!--
<script>
    $(document).ready(function(){
        $('.delete_presented_data').click(function(){
            var id = $(this).attr("id");
            if(confirm("Are you sure you want to delete this?"))
            {
                window.location="<php echo base_url(); ?>insert/delete_presented_data/"+id;
            }
            else{
                return false;
            }
        });
    });
</script>
-->


