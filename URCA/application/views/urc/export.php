<div class="container">
    <br />
    <!--TEST GIThUB TEST -->
        <div class="row">
            <div class="col-2">
                <form action="<?php echo base_url()?>admin/pdfdetails" method="POST">
                    <input type="submit" value="Export PDF" class="btn btn-info" />
                </form>
            </div>
            <div class="col-2">
                <form method="post" action="<?php echo base_url(); ?>admin/export_excel">
                    <input type="submit" name="export" class="btn btn-success" value="Export Excel" />
                </form>
            </div>
            <div class="col-2">
                <form method="post" action="<?php echo base_url(); ?>admin/export_json">
                    <input type="submit" class="btn btn-info" value="Export JSON" />
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-border">
            <tr>
                <td>Name</td>
                <td>Department</td> 
                <td>Number of Views</td>
                <td>Type of Research</td>
                <td>Citation</td>
            </tr>
        <?php if(!empty($test)){ ?>
        <?php foreach($test->result() as $row){ ?>
            <tr>
                <td><?php echo $row->last_name ?>, <?php echo $row->first_name?> <?php echo $row->middle_initial?></td>
                <td><?php echo $row->department?></td>
                <td><?php echo $row->num_views?></td>
                <td><?php echo $row->publication_type ?></td>
                <?php if(!empty($row->url)){ ?>
                <td>
                    <?php echo $row->last_name?>, <?php echo substr($row->first_name, 0, 1);?>. <?php echo $row->middle_initial?>
                    (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
                    <?php echo $row->location?>: <?php echo $row->institution?>. Retrieved from <?php echo $row->url?>
                </td>
                <?php }else{ ?>
                <td>
                    <?php echo $row->last_name?>, <?php echo substr($row->first_name, 0, 1);?>. <?php echo $row->middle_initial?>
                    (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
                    <?php echo $row->location?>: <?php echo $row->institution?>.
                </td>
                <?php } ?>
            </tr>
        <?php } ?>
        </div>
    <?php }else{ ?> 
            No Data Found
    <?php } ?>
</div>