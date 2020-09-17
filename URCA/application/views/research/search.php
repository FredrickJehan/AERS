
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Search Results</h1>
    </div>

    <?php foreach($search_result as $row){ ?>
        <div class="card shadow mb-4">
        <div class="card-body">
        <div>
            <h4><a href="<?php echo base_url('research/view/'.$row->publication_id);?>"><?php echo $row->title;?></a></h4>
            <p><?php echo $row->last_name;?>, <?php echo substr($row->first_name, 0, 1);?>. 
            <?php echo $row->middle_initial;?></p>
        </div>
        </div>
        </div>

    <?php }?>
    <!-- ./end of table form-->

</div>
<!-- /.container-fluid -->